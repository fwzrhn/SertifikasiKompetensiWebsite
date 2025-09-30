<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // form login admin
    public function showLoginForm()
    {
        return view('admin.login'); // buat file resources/views/admin/login.blade.php
    }

    // proses login admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                Auth::logout();
                return redirect()->route('admin.login')
                    ->withErrors(['username' => 'Hanya admin yang boleh login.']);
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda berhasil logout.');
    }

    // halaman dashboard admin
    public function dashboard()
    {
        $studentCount = \App\Models\Student::count();
        $teacherCount = \App\Models\Teacher::count();
        $newsCount = \App\Models\News::count();
        $extracurricularCount = \App\Models\Extracurricular::count();
        $galleryCount = \App\Models\Gallery::count();

        $latestStudents = \App\Models\Student::latest()->take(5)->get();
        $latestTeachers = \App\Models\Teacher::latest()->take(5)->get();
        $latestNews = \App\Models\News::latest()->take(5)->get();
        $latestExtracurricular = \App\Models\Extracurricular::latest()->take(5)->get();
        $latestGallery = \App\Models\Gallery::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'studentCount', 'teacherCount', 'newsCount', 'extracurricularCount', 'galleryCount',
            'latestStudents', 'latestTeachers', 'latestNews', 'latestExtracurricular', 'latestGallery'
        ));
    }

    
}
