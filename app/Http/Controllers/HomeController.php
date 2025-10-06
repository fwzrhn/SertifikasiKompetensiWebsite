<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Extracurricular;
use App\Models\News;

class HomeController extends Controller
{
    public function home()
    {
        // Ambil data
        $jumlahSiswa = Student::count();
        $jumlahGuru = Teacher::count();
        $jumlahEkskul = Extracurricular::count();

        // Ambil 3 berita 
        $berita = News::orderBy('tanggal', 'desc')->take(3)->get();

        // Ambil 3 ekskul
        $ekskul = Extracurricular::orderBy('id_ekskul', 'desc')->take(3)->get();

        return view('home', compact(
            'jumlahSiswa',
            'jumlahGuru',
            'jumlahEkskul',
            'berita',
            'ekskul'
        ));
    }
}
