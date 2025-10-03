@extends('template')

@section('title', 'Home')

@section('content')

<!-- Carousel dengan overlay text & logo -->
<div id="carousel" class="carousel slide position-relative" data-bs-ride="carousel">
    <!-- Indikator -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="2"></button>
    </div>

    <!-- Isi carousel -->
    <div class="carousel-inner">
        <div class="carousel-item active position-relative">
            <img src="{{ asset('assets/image/image.png') }}" class="d-block w-100" alt="Slide 1" style="height:100vh; object-fit:cover;">
            <div class="overlay"></div>
        </div>
        <div class="carousel-item position-relative">
            <img src="{{ asset('assets/image/image.png') }}" class="d-block w-100" alt="Slide 2" style="height:100vh; object-fit:cover;">
            <div class="overlay"></div>
        </div>
        <div class="carousel-item position-relative">
            <img src="{{ asset('assets/image/image.png') }}" class="d-block w-100" alt="Slide 3" style="height:100vh; object-fit:cover;">
            <div class="overlay"></div>
        </div>
    </div>

    <!-- Overlay konten di tengah -->
    <div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
        <div class="row w-100 align-items-center">
            <!-- Logo kiri -->
            <div class="col-md-5 text-center mb-4 mb-md-0">
                <img src="{{ asset('assets/image/ikhlas-beramal-png-6-Transparent-Images.png') }}" 
                     alt="Logo Sekolah" 
                     class="img-fluid" 
                     style="max-height: 180px;">
            </div>
            <!-- Teks kanan -->
            <div class="col-md-7 text-start text-light">
                <h1 class="fw-bold display-4" style="color: #FFD700;">MTsN 10 Tasikmalaya</h1>
                <p class="lead">Hebat Bermartabat, Mandiri Berprestasi.</p>
            </div>
        </div>
    </div>

    <!-- Kontrol kiri kanan -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<div class="garis" style="width:auto; height:5px; background-color: #555555;"></div>

<!-- Ringkasan -->
<div class="container my-5">
    <div class="row text-center">
        <!-- ... card jumlah siswa/guru/berita/ekskul tetap ... -->
    </div>
</div>

<!-- CSS tambahan -->
<style>
    .carousel-item .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.4); /* 40% gelap */
    }

    .carousel-caption {
        text-shadow: 0 2px 4px rgba(0,0,0,0.6); /* biar teks lebih jelas */
    }
</style>



@endsection
