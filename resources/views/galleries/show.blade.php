@extends('template')

@section('title', $gallery->judul)

@section('content')
<div class="container my-5">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-4">

            <div class="text-center mb-4">
                <h2 class="fw-bold text-success mb-2">{{ $gallery->judul }}</h2>
                <p class="text-muted small">
                    <i class="bi bi-calendar3"></i>
                    {{ \Carbon\Carbon::parse($gallery->tanggal)->format('d M Y') }}
                </p>
                <hr class="w-25 mx-auto border-success opacity-50">
            </div>

            @if($gallery->file)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $gallery->file) }}" 
                         class="img-fluid rounded-4 shadow-sm" 
                         alt="{{ $gallery->judul }}" 
                         style="max-height: 480px; object-fit: cover;">
                </div>
            @endif

            <div class="px-md-3">
                <p class="text-secondary fs-6" style="line-height: 1.8;">
                    {{ $gallery->keterangan }}
                </p>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('public.galleries.index') }}" 
                   class="btn btn-outline-success rounded-pill px-4 py-2">
                    ← Kembali ke Galeri
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
