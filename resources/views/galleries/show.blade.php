@extends('template')

@section('title', $gallery->judul)

@section('content')
<style>
    .gallery-show {
        margin-top: 40px;
    }

    .gallery-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        background: #ffffff;
    }

    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 22px rgba(0, 0, 0, 0.1);
    }

    .gallery-title {
        color: #198754;
        font-weight: 700;
    }

    .gallery-divider {
        width: 60px;
        height: 3px;
        background-color: #198754;
        opacity: 0.7;
        margin: 0 auto 20px auto;
        border-radius: 4px;
    }

    .gallery-media {
        max-height: 500px;
        border-radius: 15px;
        object-fit: cover;
        width: 100%;
        transition: transform 0.3s ease;
    }

    .gallery-media:hover {
        transform: scale(1.02);
    }

    .gallery-desc {
        line-height: 1.8;
        color: #555;
        text-align: justify;
        font-size: 0.96rem;
    }

    .back-btn {
        border-radius: 30px;
        padding: 10px 25px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background-color: #198754;
        color: #fff !important;
    }
</style>

<div class="container gallery-show">
    <div class="card gallery-card mx-auto p-4">
        <div class="text-center mb-4">
            <h2 class="gallery-title">{{ $gallery->judul }}</h2>
            <p class="text-muted small mb-2">
                <i class="bi bi-calendar3"></i>
                {{ \Carbon\Carbon::parse($gallery->tanggal)->format('d M Y') }}
            </p>
            <div class="gallery-divider"></div>
        </div>

        {{-- tampilkan file sesuai kategori --}}
        @if($gallery->kategori === 'Video' && $gallery->file)
            @php
                $ext = pathinfo($gallery->file, PATHINFO_EXTENSION);
            @endphp
            <div class="text-center mb-4">
                <video controls class="gallery-media shadow-sm">
                    <source src="{{ asset('storage/' . $gallery->file) }}" type="video/{{ strtolower($ext) }}">
                    Browser kamu tidak mendukung pemutar video.
                </video>
            </div>
        @elseif($gallery->file)
            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . $gallery->file) }}"
                     alt="{{ $gallery->judul }}"
                     class="gallery-media shadow-sm">
            </div>
        @else
            <div class="text-center mb-4">
                <img src="{{ asset('assets/image/default-gallery.png') }}"
                     alt="Default Gallery"
                     class="gallery-media shadow-sm">
            </div>
        @endif

        <div class="px-md-3">
            <p class="gallery-desc">{{ $gallery->keterangan }}</p>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('public.galleries.index') }}" class="btn btn-outline-success back-btn">
                ← Kembali ke Galeri
            </a>
        </div>
    </div>
</div>
@endsection
