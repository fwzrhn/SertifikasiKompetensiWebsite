<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::orderBy('created_at', 'desc')->get();
        $schoolProfile = SchoolProfile::first();

        if (Auth::user()->role === 'operator') {
            return view('operator.student.index', compact('students', 'schoolProfile'));
        }

        return view('admin.student.index', compact('students', 'schoolProfile'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:students,nisn',
            'nama_siswa' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tahun_masuk' => 'required|integer',
        ]);

        Student::create($request->all());

        $route = Auth::user()->role === 'operator' ? 'operator.students.index' : 'students.index';
        return redirect()->route($route)->with('success', 'Data siswa berhasil ditambahkan!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nisn' => 'required|unique:students,nisn,' . $id . ',id_siswa',
            'nama_siswa' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tahun_masuk' => 'required|integer',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        $route = Auth::user()->role === 'operator' ? 'operator.students.index' : 'students.index';
        return redirect()->route($route)->with('success', 'Data siswa berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        $route = Auth::user()->role === 'operator' ? 'operator.students.index' : 'students.index';
        return redirect()->route($route)->with('success', 'Data siswa berhasil dihapus!');
    }

    
    public function publicIndex()
    {
        $students = Student::orderBy('nama_siswa')->get();
        $schoolProfile = SchoolProfile::first();

        return view('students.index', compact('students', 'schoolProfile'));
    }
}
