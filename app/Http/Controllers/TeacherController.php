<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{

    public function index()
    {
        $teachers = Teacher::orderBy('created_at', 'desc')->get();
        $schoolProfile = SchoolProfile::first();

        if (Auth::user()->role === 'operator') {
            return view('operator.teacher.index', compact('teachers', 'schoolProfile'));
        }

        return view('admin.teacher.index', compact('teachers', 'schoolProfile'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:100',
            'nip' => 'required|string|max:30',
            'mapel' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('teachers', 'public');
        }

        Teacher::create([
            'nama_guru' => $request->nama_guru,
            'nip' => $request->nip,
            'mapel' => $request->mapel,
            'foto' => $fotoPath,
        ]);

        $route = Auth::user()->role === 'operator' ? 'operator.teachers.index' : 'teachers.index';
        return redirect()->route($route)->with('success', 'Guru berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'nama_guru' => 'required|string|max:100',
            'nip' => 'required|string|max:30',
            'mapel' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($teacher->foto && Storage::disk('public')->exists($teacher->foto)) {
                Storage::disk('public')->delete($teacher->foto);
            }
            $teacher->foto = $request->file('foto')->store('teachers', 'public');
        }

        $teacher->update([
            'nama_guru' => $request->nama_guru,
            'nip' => $request->nip,
            'mapel' => $request->mapel,
            'foto' => $teacher->foto,
        ]);

        $route = Auth::user()->role === 'operator' ? 'operator.teachers.index' : 'teachers.index';
        return redirect()->route($route)->with('success', 'Data guru berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);

        if ($teacher->foto && Storage::disk('public')->exists($teacher->foto)) {
            Storage::disk('public')->delete($teacher->foto);
        }

        $teacher->delete();

        $route = Auth::user()->role === 'operator' ? 'operator.teachers.index' : 'teachers.index';
        return redirect()->route($route)->with('success', 'Guru berhasil dihapus.');
    }

    
    public function publicIndex()
    {
        $teachers = Teacher::orderBy('nama_guru')->get();
        $schoolProfile = SchoolProfile::first();

        return view('teachers.index', compact('teachers', 'schoolProfile'));
    }
}
