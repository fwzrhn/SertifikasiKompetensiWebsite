<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExtracurricularController extends Controller
{
    public function index()
    {
        $extracurriculars = Extracurricular::latest()->get();
        return view('admin.extracurricular.index', compact('extracurriculars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ekskul' => 'required|max:100',
            'pembina' => 'required|max:100',
            'jadwal_latihan' => 'required|max:100',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('extracurriculars', $filename, 'public');
        }

        Extracurricular::create([
            'nama_ekskul' => $request->nama_ekskul,
            'pembina' => $request->pembina,
            'jadwal_latihan' => $request->jadwal_latihan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path,
        ]);

        return redirect()->route('extracurricular.index')->with('success', 'Ekskul berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $ekskul = Extracurricular::findOrFail($id);

        $request->validate([
            'nama_ekskul' => 'required|max:100',
            'pembina' => 'required|max:100',
            'jadwal_latihan' => 'required|max:100',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($ekskul->gambar) {
                Storage::disk('public')->delete($ekskul->gambar);
            }
            $file = $request->file('gambar');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('extracurriculars', $filename, 'public');
        }

        $ekskul->update([
            'nama_ekskul' => $request->nama_ekskul,
            'pembina' => $request->pembina,
            'jadwal_latihan' => $request->jadwal_latihan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path,
        ]);

        return redirect()->route('extracurricular.index')->with('success', 'Ekskul berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ekskul = Extracurricular::findOrFail($id);

        if ($ekskul->gambar) {
            Storage::disk('public')->delete($ekskul->gambar);
        }

        $ekskul->delete();

        return redirect()->route('extracurricular.index')->with('success', 'Ekskul berhasil dihapus!');
    }
    public function publicIndex()
    {
        $extracurriculars = \App\Models\Extracurricular::latest()->get();
        $schoolProfile = \App\Models\SchoolProfile::first();

        return view('extracurricular.index', compact('extracurriculars', 'schoolProfile'));
    }

    public function show($id)
    {
        $extracurricular = \App\Models\Extracurricular::findOrFail($id);
        $schoolProfile = \App\Models\SchoolProfile::first();

        return view('extracurricular.show', compact('extracurricular', 'schoolProfile'));
    }

}
