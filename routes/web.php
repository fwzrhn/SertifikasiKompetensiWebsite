<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/administrator', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // ================= Students =================
    Route::get('/administrator/students', [StudentController::class, 'index'])->name('students.index');
    Route::post('/administrator/students/store', [StudentController::class, 'store'])->name('students.store');
    Route::put('/administrator/students/update/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/administrator/students/destroy/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

    // ================= Teachers =================
    Route::get('/administrator/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::post('/administrator/teachers/store', [TeacherController::class, 'store'])->name('teachers.store');
    Route::put('/administrator/teachers/update/{id}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/administrator/teachers/destroy/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

    // ================= News =================
    Route::get('/administrator/news', [NewsController::class, 'index'])->name('news.index');
    Route::post('/administrator/news/store', [NewsController::class, 'store'])->name('news.store');
    Route::put('/administrator/news/update/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/administrator/news/destroy/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

    // ================= Extracurriculars =================
    Route::get('extracurricular', [ExtracurricularController::class, 'index'])->name('extracurricular.index');
    Route::post('extracurricular/store', [ExtracurricularController::class, 'store'])->name('extracurricular.store');
    Route::post('extracurricular/update/{id}', [ExtracurricularController::class, 'update'])->name('extracurricular.update');
    Route::delete('extracurricular/destroy/{id}', [ExtracurricularController::class, 'destroy'])->name('extracurricular.destroy');

    // ================= Galleries =================
    Route::get('/admin/galleries', [GalleryController::class, 'index'])->name('galleries.index');
    Route::post('/admin/galleries', [GalleryController::class, 'store'])->name('galleries.store');
    Route::put('/admin/galleries/{id}', [GalleryController::class, 'update'])->name('galleries.update'); // ← fixed here
    Route::delete('/admin/galleries/{id}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
});
