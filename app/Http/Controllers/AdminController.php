<?php

namespace App\Http\Controllers;

use App\Models\SchoolProfile;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\News;
use App\Models\Extracurricular;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }

    public function dashboard()
    {

        $schoolProfile = SchoolProfile::first();

        
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $newsCount = News::count();
        $extracurricularCount = Extracurricular::count();
        $galleryCount = Gallery::count();

        // Ambil data terbaru
        $latestStudents = Student::latest()->take(5)->get();
        $latestTeachers = Teacher::latest()->take(5)->get();
        $latestNews = News::latest()->take(5)->get();
        $latestExtracurricular = Extracurricular::latest()->take(5)->get();
        $latestGallery = Gallery::latest()->take(5)->get();

        // ✅ Kirim semua data ke view pakai compact
        return view('admin.dashboard', compact(
            'schoolProfile',
            'studentCount', 'teacherCount', 'newsCount', 'extracurricularCount', 'galleryCount',
            'latestStudents', 'latestTeachers', 'latestNews', 'latestExtracurricular', 'latestGallery'
        ));
    }
}
