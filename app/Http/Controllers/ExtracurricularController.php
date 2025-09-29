<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use Illuminate\Http\Request;

class ExtracurricularController extends Controller
{
    public function index()
    {
        // Gunakan nama variabel yang sama dengan Blade
        $extracurricular = Extracurricular::all();
        return view('admin.extracurricular.index', compact('extracurricular'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ekskul' => 'required|max:40',
            'pembina' => 'required|max:40',
            'jadwal_latihan' => 'required|max:40',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $filename = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('uploads/ekskul'), $filename);

        Extracurricular::create([
            'nama_ekskul' => $request->nama_ekskul,
            'pembina' => $request->pembina,
            'jadwal_latihan' => $request->jadwal_latihan,
            'deskripsi' => $request->deskripsi,
            'gambar' => $filename,
        ]);

        return redirect()->route('extracurricular.index')->with('success', 'Ekskul berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $ekskul = Extracurricular::findOrFail($id);

        $request->validate([
            'nama_ekskul' => 'required|max:40',
            'pembina' => 'required|max:40',
            'jadwal_latihan' => 'required|max:40',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama_ekskul', 'pembina', 'jadwal_latihan', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('uploads/ekskul'), $filename);
            $data['gambar'] = $filename;
        }

        $ekskul->update($data);

        return redirect()->route('extracurricular.index')->with('success', 'Ekskul berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ekskul = Extracurricular::findOrFail($id);

        $path = public_path('uploads/ekskul/' . $ekskul->gambar);
        if (file_exists($path)) {
            unlink($path);
        }

        $ekskul->delete();

        return redirect()->route('extracurricular.index')->with('success', 'Ekskul berhasil dihapus.');
    }
}
