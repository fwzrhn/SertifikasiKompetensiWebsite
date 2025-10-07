<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    // Helper: menentukan path view berdasarkan role
    private function getViewPath($view)
    {
        $role = Auth::user()->role;
        return ($role === 'operator' ? 'operator' : 'admin') . ".teacher.$view";
    }

    // Helper: menentukan route redirect berdasarkan role
    private function getRedirectRoute()
    {
        return Auth::user()->role === 'operator' ? 'operator.teachers.index' : 'teachers.index';
    }

    public function index()
    {
        $teachers = Teacher::latest()->get();
        $schoolProfile = SchoolProfile::first();

        return view($this->getViewPath('index'), compact('teachers', 'schoolProfile'));
    }

    public function create()
    {
        $schoolProfile = SchoolProfile::first();
        return view($this->getViewPath('create'), compact('schoolProfile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_guru' => 'required|string|max:100',
            'nip' => 'required|string|max:30|unique:teachers,nip',
            'mapel' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = $request->hasFile('foto')
            ? $request->file('foto')->store('teachers', 'public')
            : null;

        Teacher::create([
            'nama_guru' => $request->nama_guru,
            'nip' => $request->nip,
            'mapel' => $request->mapel,
            'foto' => $fotoPath,
        ]);

        return redirect()->route($this->getRedirectRoute())->with('success', 'Guru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        $schoolProfile = SchoolProfile::first();

        return view($this->getViewPath('edit'), compact('teacher', 'schoolProfile'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'nama_guru' => 'required|string|max:100',
            'nip' => 'required|string|max:30|unique:teachers,nip,' . $teacher->id_guru . ',id_guru',
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

        return redirect()->route($this->getRedirectRoute())->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);

        if ($teacher->foto && Storage::disk('public')->exists($teacher->foto)) {
            Storage::disk('public')->delete($teacher->foto);
        }

        $teacher->delete();

        return redirect()->route($this->getRedirectRoute())->with('success', 'Guru berhasil dihapus.');
    }
    public function publicIndex()
    {

        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

}
