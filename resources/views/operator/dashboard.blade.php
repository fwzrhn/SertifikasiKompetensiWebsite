@extends('operator.template')

@section('title', 'Dashboard Operator')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3 fw-bold text-success">📊 Dashboard Operator</h2>
    <p class="text-muted">
        Halo, <strong>{{ Auth::user()->name }}</strong> 👋.  
        Anda login sebagai <span class="badge bg-success">Operator</span>.
    </p>

    <!-- Ringkasan Data -->
    <div class="row text-center mt-4">
        <div class="col-md-2 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-bold text-success">{{ $studentCount }}</h5>
                    <p class="mb-0">Siswa</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-bold text-success">{{ $teacherCount }}</h5>
                    <p class="mb-0">Guru</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-bold text-success">{{ $newsCount }}</h5>
                    <p class="mb-0">Berita</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-bold text-success">{{ $extracurricularCount }}</h5>
                    <p class="mb-0">Ekstrakurikuler</p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="fw-bold text-success">{{ $galleryCount }}</h5>
                    <p class="mb-0">Galeri</p>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <!-- Data Terbaru -->
    <h5 class="fw-bold mb-3 text-success">🆕 Data Terbaru</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">Siswa Terbaru</div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        @forelse($latestStudents as $s)
                            <li>👦 {{ $s->nama }}</li>
                        @empty
                            <li class="text-muted">Belum ada data siswa.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">Berita Terbaru</div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        @forelse($latestNews as $n)
                            <li>📰 {{ $n->judul }}</li>
                        @empty
                            <li class="text-muted">Belum ada berita.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
