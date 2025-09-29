<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|max:100',
            'keterangan' => 'nullable|string',
            'file'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori'   => 'required|string|max:50',
            'tanggal'    => 'required|date',
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('gallery', 'public');
        }

        Gallery::create([
            'judul'      => $request->judul,
            'keterangan' => $request->keterangan,
            'file'       => $path,
            'kategori'   => $request->kategori,
            'tanggal'    => $request->tanggal,
        ]);

        return redirect()->route('galleries.index')->with('success', 'Galeri berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'judul'      => 'required|max:100',
            'keterangan' => 'nullable|string',
            'file'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori'   => 'required|string|max:50',
            'tanggal'    => 'required|date',
        ]);

        $path = $gallery->file;
        if ($request->hasFile('file')) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $request->file('file')->store('gallery', 'public');
        }

        $gallery->update([
            'judul'      => $request->judul,
            'keterangan' => $request->keterangan,
            'file'       => $path,
            'kategori'   => $request->kategori,
            'tanggal'    => $request->tanggal,
        ]);

        return redirect()->route('galleries.index')->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->file) {
            Storage::disk('public')->delete($gallery->file);
        }

        $gallery->delete();

        return redirect()->route('galleries.index')->with('success', 'Galeri berhasil dihapus!');
    }
}
