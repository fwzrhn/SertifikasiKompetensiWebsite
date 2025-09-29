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
        $news = News::orderBy('tanggal', 'desc')->get();
        return view('home', compact('students', 'teachers'));
    }
}

