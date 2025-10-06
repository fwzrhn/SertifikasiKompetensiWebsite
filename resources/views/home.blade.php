@extends('template')

@section('title', $schoolProfile?->nama_sekolah ?? 'Home')

@section('content')

<!-- Carousel -->
<div id="carousel" class="carousel slide position-relative" data-bs-ride="carousel">

    <!-- Indikator -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="2"></button>
    </div>

    <!-- Isi carousel (gambar statis) -->
    <div class="carousel-inner">
        <div class="carousel-item active position-relative">
            <img src="{{ asset('assets/image/image.png') }}" class="d-block w-100" alt="Slide 1">
            <div class="overlay"></div>
        </div>
        <div class="carousel-item position-relative">
            <img src="{{ asset('assets/image/image.png') }}" class="d-block w-100" alt="Slide 2">
            <div class="overlay"></div>
        </div>
        <div class="carousel-item position-relative">
            <img src="{{ asset('assets/image/image.png') }}" class="d-block w-100" alt="Slide 3">
            <div class="overlay"></div>
        </div>
    </div>

    <!-- Overlay konten -->
    <div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
        <div class="row w-100 align-items-center">

            <!-- Logo Sekolah -->
            <div class="col-md-5 text-center mb-4 mb-md-0">
                @if($schoolProfile?->logo)
                    <img src="{{ asset($schoolProfile->logo) }}" 
                         alt="Logo {{ $schoolProfile->nama_sekolah }}" 
                         class="img-fluid logo-carousel">
                @else
                    <img src="{{ asset('assets/image/ikhlas-beramal-png-6-Transparent-Images.png') }}" 
                         alt="Logo Default" 
                         class="img-fluid logo-carousel">
                @endif
            </div>

            <!-- Nama & Motto Sekolah -->
            <div class="col-md-7 text-start text-light">
                <h1 class="fw-bold display-4 title-carousel">
                    {{ $schoolProfile?->nama_sekolah ?? 'Nama Sekolah' }}
                </h1>
                <p class="lead subtitle-carousel">
                    {{ $schoolProfile?->motto ?? 'Hebat Bermartabat, Mandiri Berprestasi.' }}
                </p>
            </div>

        </div>
    </div>

    <!-- Kontrol -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

</div>

<!-- Garis Pembatas -->
<div class="divider"></div>

<!-- Section Berita -->
<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold section-title">Berita Terbaru</h2>
        <p class="text-muted">Informasi terkini seputar {{ $schoolProfile?->nama_sekolah ?? 'Sekolah' }}</p>
    </div>

    <div class="row g-4">
        @php
            use App\Models\News;
            $news = News::orderBy('tanggal', 'desc')->take(6)->get();
        @endphp

        @foreach($news as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card news-card h-100">
                    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : asset('assets/image/default-news.jpg') }}" 
                         class="card-img-top" 
                         alt="{{ $item->judul }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <p class="card-text text-muted">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 100) }}
                        </p>
                        <a href="{{ url('/news/'.$item->id_berita) }}" class="btn btn-outline-success btn-sm">Selengkapnya</a>
                    </div>
                    <div class="card-footer text-muted small">
                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- CSS -->
<style>
    /* Carousel */
    .carousel-item img {
        height: 100vh;
        object-fit: cover;
    }
    .carousel-item .overlay {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.45);
    }
    .carousel-caption {
        text-shadow: 0 2px 6px rgba(0,0,0,0.7);
    }

    /* Logo & Teks */
    .logo-carousel {
        max-height: 170px;
        animation: fadeInUp 1.2s ease-in-out;
    }
    .title-carousel { color: #FFD700; animation: fadeInRight 1.4s ease-in-out; }
    .subtitle-carousel { font-size: 1.25rem; animation: fadeInLeft 1.6s ease-in-out; }

    /* Divider */
    .divider { width: 100%; height: 5px; background-color: #555; margin: 2rem 0; }

    /* Section Title */
    .section-title {
        color: #145a32;
        position: relative;
        display: inline-block;
    }
    .section-title::after {
        content: "";
        display: block;
        width: 60%;
        height: 3px;
        background: #1e8449;
        margin: 8px auto 0;
        border-radius: 2px;
    }

    /* Card Berita */
    .news-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .news-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.18);
    }
    .news-card img { height: 200px; object-fit: cover; }
    .news-card .card-title { font-weight: 600; color: #145a32; }
    .news-card .btn { border-radius: 20px; padding: 4px 14px; }

    /* Animasi */
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeInRight { from { opacity: 0; transform: translateX(-40px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes fadeInLeft { from { opacity: 0; transform: translateX(40px); } to { opacity: 1; transform: translateX(0); } }
</style>

@endsection
