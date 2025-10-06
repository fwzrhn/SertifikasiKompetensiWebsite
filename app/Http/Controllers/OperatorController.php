<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\News;
use App\Models\Extracurricular;
use App\Models\Gallery;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperatorController extends Controller
{
    // Form login (pakai view yang sama kayak admin)
    public function showLoginForm()
    {
        return view('admin.login'); // bisa diganti 'operator.login' kalau mau beda
    }

    // Proses login untuk operator
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'operator') {
                return redirect()->intended(route('operator.dashboard'));
            }

            Auth::logout();
            return redirect()->route('operator.login')
                ->withErrors(['username' => 'Akun ini bukan operator.']);
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // Dashboard operator
    public function dashboard()
    {
        $profile = SchoolProfile::first();

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

        return view('operator.dashboard', compact(
            'studentCount', 'teacherCount', 'newsCount', 'extracurricularCount', 'galleryCount',
            'latestStudents', 'latestTeachers', 'latestNews', 'latestExtracurricular', 'latestGallery',
            'profile'
        ));
    }

    // Logout operator
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('operator.login')->with('success', 'Anda telah logout.');
    }
}
