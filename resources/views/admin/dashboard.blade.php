@extends('admin.template')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    /* Card dashboard dengan aksen */
    .dashboard-card {
        background: linear-gradient(120deg, #eafaf1, #d1f0e0);
        color: #333;
        border-radius: 0.75rem;
        box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 0.075);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
    }
    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 0.15);
    }

    /* Aksen bulatan dekoratif */
    .dashboard-card::before {
        content: "";
        position: absolute;
        top: -20px;
        right: -20px;
        width: 80px;
        height: 80px;
        background: rgba(44, 122, 84, 0.1);
        border-radius: 50%;
    }

    /* Ikon dalam card */
    .card-icon {
        font-size: 2rem;
        color: #2c7a54;
        margin-bottom: 0.5rem;
    }

    /* Tombol detail */
    .btn-detail {
        display: inline-block;
        margin-top: 0.5rem;
        padding: 4px 10px;
        font-size: 0.875rem;
        border-radius: 0.375rem;
        background-color: #2c7a54;
        color: #fff;
        text-decoration: none;
    }
    .btn-detail:hover {
        background-color: #256445;
        color: #fff;
    }
</style>

<div class="container mt-4">
    <h1 class="mb-4">Dashboard Admin</h1>

    <div class="row mb-4 justify-content-center gap-4">
        {{-- Siswa --}}
        <div class="col-md-2 mb-3">
            <div class="card dashboard-card p-3 text-center">
                <i class="bi bi-people-fill card-icon"></i>
                <h5 class="card-title fw-bold">Siswa</h5>
                <p class="card-text fs-3">{{ $studentCount }}</p>
                <a href="{{ route('students.index') }}" class="btn-detail">Detail</a>
            </div>
        </div>

        {{-- Guru --}}
        <div class="col-md-2 mb-3">
            <div class="card dashboard-card p-3 text-center">
                <i class="bi bi-person-badge-fill card-icon"></i>
                <h5 class="card-title fw-bold">Guru</h5>
                <p class="card-text fs-3">{{ $teacherCount }}</p>
                <a href="{{ route('teachers.index') }}" class="btn-detail">Detail</a>
            </div>
        </div>

        {{-- Berita --}}
        <div class="col-md-2 mb-3">
            <div class="card dashboard-card p-3 text-center">
                <i class="bi bi-newspaper card-icon"></i>
                <h5 class="card-title fw-bold">Berita</h5>
                <p class="card-text fs-3">{{ $newsCount }}</p>
                <a href="{{ route('news.index') }}" class="btn-detail">Detail</a>
            </div>
        </div>

        {{-- Ekskul --}}
        <div class="col-md-2 mb-3">
            <div class="card dashboard-card p-3 text-center">
                <i class="bi bi-dribbble card-icon"></i>
                <h5 class="card-title fw-bold">Ekskul</h5>
                <p class="card-text fs-3">{{ $extracurricularCount }}</p>
                <a href="{{ route('extracurricular.index') }}" class="btn-detail">Detail</a>
            </div>
        </div>

        {{-- Galeri --}}
        <div class="col-md-2 mb-3">
            <div class="card dashboard-card p-3 text-center">
                <i class="bi bi-images card-icon"></i>
                <h5 class="card-title fw-bold">Galeri</h5>
                <p class="card-text fs-3">{{ $galleryCount }}</p>
                <a href="{{ route('galleries.index') }}" class="btn-detail">Detail</a>
            </div>
        </div>
    </div>
</div>
@endsection
