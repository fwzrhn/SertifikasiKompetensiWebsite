<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <--- tambahkan ini!
use App\Models\Student;
use App\Models\Teacher;
use App\Models\News;
use App\Models\Extracurricular;
use App\Models\Gallery;
use App\Models\SchoolProfile;

class OperatorController extends Controller
{
    public function dashboard()
    {
        // Ambil data ringkasan seperti di admin
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $newsCount = News::count();
        $extracurricularCount = Extracurricular::count();
        $galleryCount = Gallery::count();

        $latestStudents = Student::latest()->take(5)->get();
        $latestTeachers = Teacher::latest()->take(5)->get();
        $latestNews = News::latest()->take(5)->get();
        $latestExtracurricular = Extracurricular::latest()->take(5)->get();
        $latestGallery = Gallery::latest()->take(5)->get();

        $profile = SchoolProfile::first();

        return view('operator.dashboard', compact(
            'studentCount',
            'teacherCount',
            'newsCount',
            'extracurricularCount',
            'galleryCount',
            'latestStudents',
            'latestTeachers',
            'latestNews',
            'latestExtracurricular',
            'latestGallery',
            'profile'
        ));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}
