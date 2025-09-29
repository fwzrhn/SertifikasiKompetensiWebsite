<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Tampilkan semua siswa
    public function index()
    {
        $students = Student::orderBy('created_at', 'desc')->get();
        return view('admin.student.index', compact('students'));
    }

    // Simpan siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:students,nisn',
            'nama_siswa' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tahun_masuk' => 'required|integer',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    // Update siswa
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

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    // Hapus siswa
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}
