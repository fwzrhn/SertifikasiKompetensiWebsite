<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('user')->latest()->get();
        $schoolProfile = SchoolProfile::first();

        if (Auth::check() && Auth::user()->role === 'operator') {
            return view('operator.news.index', compact('news', 'schoolProfile'));
        }

        return view('admin.news.index', compact('news', 'schoolProfile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('news', 'public');
        }

        News::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar' => $gambarPath,
            'id_user' => Auth::id(),
        ]);

        $route = (Auth::user()->role === 'operator')
            ? 'operator.news.index'
            : 'news.index';

        return redirect()->route($route)->with('success', 'Berita berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $gambarPath = $news->gambar;

        if ($request->hasFile('gambar')) {
            if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
                Storage::disk('public')->delete($gambarPath);
            }
            $gambarPath = $request->file('gambar')->store('news', 'public');
        }

        $news->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'gambar' => $gambarPath,
        ]);

        $route = (Auth::user()->role === 'operator')
            ? 'operator.news.index'
            : 'news.index';

        return redirect()->route($route)->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->gambar && Storage::disk('public')->exists($news->gambar)) {
            Storage::disk('public')->delete($news->gambar);
        }

        $news->delete();

        $route = (Auth::user()->role === 'operator')
            ? 'operator.news.index'
            : 'news.index';

        return redirect()->route($route)->with('success', 'Berita berhasil dihapus.');
    }

    public function publicIndex()
    {
        $news = News::latest('tanggal')->paginate(6);
        $schoolProfile = SchoolProfile::first();

        return view('news.index', compact('news', 'schoolProfile'));
    }

    public function show($id)
    {
        $article = News::findOrFail($id);
        $schoolProfile = SchoolProfile::first();

        return view('news.show', compact('article', 'schoolProfile'));
    }
}
