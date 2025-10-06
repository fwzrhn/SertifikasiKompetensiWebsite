@extends('operator.template')

@section('title', 'Dashboard Operator')

@section('content')
<style>
    .summary-card {
        border-radius: 16px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        border: none;
        padding: 20px 0;
    }
    .summary-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .summary-icon {
        font-size: 2.8rem;
        color: #198754;
        margin-bottom: 0.5rem;
    }
    .summary-value {
        font-size: 1.9rem;
        font-weight: 700;
        color: #198754;
    }
    .summary-label {
        font-weight: 500;
        color: #555;
    }
    .btn-outline-success {
        transition: all 0.3s;
    }
    .btn-outline-success:hover {
        background-color: #198754;
        color: #fff;
    }
    .list-group-item {
        border-radius: 8px;
        margin-bottom: 6px;
        transition: background-color 0.2s;
    }
    .list-group-item:hover {
        background-color: rgba(25, 135, 84, 0.1);
    }
    .card-header {
        border-top-left-radius: 16px !important;
        border-top-right-radius: 16px !important;
        font-size: 1.1rem;
    }
</style>

<div class="container mt-4">
    <!-- Header -->
    <div class="mb-4">
        <h2 class="fw-bold text-success mb-2">📊 Dashboard Operator</h2>
        <p class="text-muted mb-1">
            Halo, <strong>{{ Auth::user()->name }}</strong> 👋  
            <span class="badge bg-primary">Operator</span>
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
                <div class="card summary-card shadow-sm text-center">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <i class="bi {{ $card['icon'] }} summary-icon"></i>
                        <div class="summary-value">{{ $card['count'] }}</div>
                        <p class="summary-label mb-3">{{ $card['label'] }}</p>
                        <a href="{{ route($card['route']) }}" class="btn btn-sm btn-outline-success rounded-pill px-4">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <hr class="my-4 border-success opacity-50">

    <!-- Data Terbaru -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-header bg-success text-white fw-semibold">
                    👦 Siswa Terbaru
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($latestStudents as $s)
                            <li class="list-group-item px-3 py-2">
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

        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-header bg-success text-white fw-semibold">
                    📰 Berita Terbaru
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($latestNews as $n)
                            <li class="list-group-item px-3 py-2">
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
