<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Menampilkan daftar galeri (admin & operator)
     */
    public function index()
    {
        $galleries = Gallery::latest()->get();
        $schoolProfile = SchoolProfile::first();

        if (Auth::user()->role === 'operator') {
            return view('operator.gallery.index', compact('galleries', 'schoolProfile'));
        }

        return view('admin.gallery.index', compact('galleries', 'schoolProfile'));
    }

    /**
     * Simpan galeri baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|max:100',
            'keterangan' => 'nullable|string',
            'file'       => 'nullable|mimes:jpg,jpeg,png,mp4,mov,avi,mkv|max:20480', // 20MB
            'kategori'   => 'required|in:Foto,Video',
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

        $route = Auth::user()->role === 'operator' ? 'operator.galleries.index' : 'galleries.index';
        return redirect()->route($route)->with('success', 'Galeri berhasil ditambahkan!');
    }

    /**
     * Update galeri
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'judul'      => 'required|max:100',
            'keterangan' => 'nullable|string',
            'file'       => 'nullable|mimes:jpg,jpeg,png,mp4,mov,avi,mkv|max:20480',
            'kategori'   => 'required|in:Foto,Video',
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

        $route = Auth::user()->role === 'operator' ? 'operator.galleries.index' : 'galleries.index';
        return redirect()->route($route)->with('success', 'Galeri berhasil diperbarui!');
    }

    /**
     * Hapus galeri
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->file) {
            Storage::disk('public')->delete($gallery->file);
        }

        $gallery->delete();

        $route = Auth::user()->role === 'operator' ? 'operator.galleries.index' : 'galleries.index';
        return redirect()->route($route)->with('success', 'Galeri berhasil dihapus!');
    }

    /**
     * Halaman publik: daftar galeri
     */
    public function publicIndex()
    {
        $galleries = Gallery::latest('tanggal')->paginate(9);
        $schoolProfile = SchoolProfile::first();

        return view('galleries.index', compact('galleries', 'schoolProfile'));
    }

    /**
     * Halaman publik: detail galeri
     */
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        $schoolProfile = SchoolProfile::first();

        return view('galleries.show', compact('gallery', 'schoolProfile'));
    }
}
