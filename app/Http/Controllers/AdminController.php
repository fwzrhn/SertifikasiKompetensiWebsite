<?php

namespace App\Http\Controllers;

use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            // Arahkan sesuai role
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'operator') {
                return redirect()->route('operator.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login')
                    ->withErrors(['username' => 'Anda tidak memiliki akses ke sistem ini.']);
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }

    // Dashboard admin
    public function dashboard()
    {
        $profile = SchoolProfile::first();

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
            'latestStudents', 'latestTeachers', 'latestNews', 'latestExtracurricular', 'latestGallery',
            'profile'
        ));
    }
}
