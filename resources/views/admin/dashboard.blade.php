@extends('admin.template')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    .summary-card {
        border-radius: 16px;
        transition: all 0.25s ease;
        border: none;
    }
    .summary-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    }
    .summary-icon {
        font-size: 2.5rem;
        color: #198754;
    }
    .summary-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #198754;
    }
    .summary-label {
        font-weight: 500;
        color: #555;
    }
    .card-header {
        border-top-left-radius: 16px !important;
        border-top-right-radius: 16px !important;
    }
</style>

<div class="container mt-4">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold text-success mb-2">📊 Dashboard Admin</h2>
        <p class="text-muted mb-1">
            Halo, <strong>{{ Auth::user()->name }}</strong> 👋  
            <span class="badge bg-success">Administrator</span>
        </p>
        <hr class="border-success opacity-25">
    </div>

    <!-- Ringkasan Data -->
    <div class="row g-4 mb-4">
        @php
            $cards = [
                ['icon' => 'bi-people-fill', 'label' => 'Siswa', 'count' => $studentCount, 'route' => 'students.index'],
                ['icon' => 'bi-person-badge-fill', 'label' => 'Guru', 'count' => $teacherCount, 'route' => 'teachers.index'],
                ['icon' => 'bi-newspaper', 'label' => 'Berita', 'count' => $newsCount, 'route' => 'news.index'],
                ['icon' => 'bi-dribbble', 'label' => 'Ekskul', 'count' => $extracurricularCount, 'route' => 'extracurricular.index'],
                ['icon' => 'bi-images', 'label' => 'Galeri', 'count' => $galleryCount, 'route' => 'galleries.index'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                <div class="card summary-card shadow-sm text-center py-3">
                    <div class="card-body">
                        <i class="bi {{ $card['icon'] }} summary-icon mb-2"></i>
                        <div class="summary-value">{{ $card['count'] }}</div>
                        <p class="summary-label mb-2">{{ $card['label'] }}</p>
                        <a href="{{ route($card['route']) }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Garis pembatas -->
    <hr class="my-4 border-success opacity-50">

    <!-- Data Terbaru -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-header bg-success text-white fw-semibold">
                    👦 Siswa Terbaru
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($latestStudents as $s)
                            <li class="list-group-item border-0 px-0 py-2">
                                <i class="bi bi-person-circle text-success me-2"></i>
                                {{ $s->nama }}
                            </li>
                        @empty
                            <li class="text-muted text-center py-2">Belum ada data siswa.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-header bg-success text-white fw-semibold">
                    📰 Berita Terbaru
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($latestNews as $n)
                            <li class="list-group-item border-0 px-0 py-2">
                                <i class="bi bi-newspaper text-success me-2"></i>
                                {{ $n->judul }}
                            </li>
                        @empty
                            <li class="text-muted text-center py-2">Belum ada berita.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
