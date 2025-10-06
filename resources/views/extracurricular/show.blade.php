@extends('template')

@section('title', $extracurricular->nama_ekskul)

@section('content')
<div class="container" style="height: 20px"></div>

<div class="container my-5">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-4">

            {{-- Judul & Info --}}
            <div class="text-center mb-4">
                <h2 class="fw-bold text-success mb-2">{{ $extracurricular->nama_ekskul }}</h2>
                <p class="text-muted small">
                    <i class="bi bi-person-badge"></i> Pembina: {{ $extracurricular->pembina ?? '-' }} <br>
                    <i class="bi bi-calendar-week"></i> Jadwal: {{ $extracurricular->jadwal_latihan ?? '-' }}
                </p>
                <hr class="w-25 mx-auto border-success opacity-50">
            </div>

            {{-- Gambar utama --}}
            @if($extracurricular->gambar)
                <div class="text-center mb-4">
                    <img src="{{ asset($extracurricular->gambar) }}"
                         class="img-fluid rounded-4 shadow-sm"
                         alt="{{ $extracurricular->nama_ekskul }}"
                         style="max-height: 420px; object-fit: cover;">
                </div>
            @else
                <div class="text-center mb-4">
                    <img src="{{ asset('assets/image/default-extracurricular.png') }}"
                         class="img-fluid rounded-4 shadow-sm"
                         alt="Default Extracurricular"
                         style="max-height: 420px; object-fit: cover;">
                </div>
            @endif

            {{-- Deskripsi --}}
            <div class="px-md-3">
                <p class="text-secondary fs-6" style="line-height: 1.8;">
                    {{ $extracurricular->deskripsi }}
                </p>
            </div>

            {{-- Tombol kembali --}}
            <div class="text-center mt-5">
                <a href="{{ route('public.extracurricular.index') }}"
                   class="btn btn-outline-success rounded-pill px-4 py-2">
                    ← Kembali ke Daftar Ekskul
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
