<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Student;
use App\Models\Teacher;

class HomeController extends Controller
{
    public function home()
    {
        $students = Student::orderBy('created_at', 'desc')->get();
        $teachers = Teacher::orderBy('created_at', 'desc')->get();
        // ambil semua berita (atau batasi mis. take(6) kalau mau)
        $news = News::orderBy('tanggal', 'desc')->take(3);

        // kirim $news juga ke view
        return view('home', compact('students', 'teachers', 'news'));
    }
}
