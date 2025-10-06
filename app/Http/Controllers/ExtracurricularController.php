<?php

namespace App\Http\Controllers;

use App\Models\Extracurricular;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExtracurricularController extends Controller
{

    public function index()
    {
        $extracurriculars = Extracurricular::latest()->get();
        $schoolProfile = SchoolProfile::first();


        if (Auth::user()->role === 'operator') {
            return view('operator.extracurricular.index', compact('extracurriculars', 'schoolProfile'));
        }


        return view('admin.extracurricular.index', compact('extracurriculars', 'schoolProfile'));
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

        // Arahkan sesuai role yang login
        $route = Auth::user()->role === 'operator' ? 'operator.extracurricular.index' : 'extracurricular.index';
        return redirect()->route($route)->with('success', 'Ekskul berhasil ditambahkan!');
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

        $path = $ekskul->gambar;

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

        $route = Auth::user()->role === 'operator' ? 'operator.extracurricular.index' : 'extracurricular.index';
        return redirect()->route($route)->with('success', 'Ekskul berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $ekskul = Extracurricular::findOrFail($id);

        if ($ekskul->gambar) {
            Storage::disk('public')->delete($ekskul->gambar);
        }

        $ekskul->delete();

        $route = Auth::user()->role === 'operator' ? 'operator.extracurricular.index' : 'extracurricular.index';
        return redirect()->route($route)->with('success', 'Ekskul berhasil dihapus!');
    }


    public function publicIndex()
    {
        $extracurriculars = Extracurricular::latest()->get();
        $schoolProfile = SchoolProfile::first();

        return view('extracurricular.index', compact('extracurriculars', 'schoolProfile'));
    }

    
    public function show($id)
    {
        $extracurricular = Extracurricular::findOrFail($id);
        $schoolProfile = SchoolProfile::first();

        return view('extracurricular.show', compact('extracurricular', 'schoolProfile'));
    }
}
