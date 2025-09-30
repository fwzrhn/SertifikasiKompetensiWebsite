@extends('template')

@section('title', 'Home')

@section('content')

<!-- Carousel -->
<div id="carousel" class="carousel slide position-relative" data-bs-ride="carousel">
    <!-- Indikator -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="2"></button>
    </div>

    <!-- Isi carousel -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('assets/image/image.png') }}" class="d-block w-100" alt="Slide 1" style="height:100vh; object-fit:cover;">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('assets/image/image.png') }}" class="d-block w-100" alt="Slide 2" style="height:100vh; object-fit:cover;">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('assets/image/image.png') }}" class="d-block w-100" alt="Slide 3" style="height:100vh; object-fit:cover;">
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
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-4 text-white h-100" style="background: linear-gradient(135deg, #38b2ac, #319795); border:none; border-radius:1rem; transition: transform 0.3s;">
                <div class="mb-2">
                    <i class="bi bi-people-fill fs-1"></i>
                </div>
                <h5 class="fw-bold">Jumlah Siswa</h5>
                <p class="fs-2 mb-0">{{ $students->count() }}</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-4 text-white h-100" style="background: linear-gradient(135deg, #667eea, #764ba2); border:none; border-radius:1rem; transition: transform 0.3s;">
                <div class="mb-2">
                    <i class="bi bi-person-badge-fill fs-1"></i>
                </div>
                <h5 class="fw-bold">Jumlah Guru</h5>
                <p class="fs-2 mb-0">{{ $teachers->count() }}</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-4 text-white h-100" style="background: linear-gradient(135deg, #f6d365, #fda085); border:none; border-radius:1rem; transition: transform 0.3s;">
                <div class="mb-2">
                    <i class="bi bi-newspaper fs-1"></i>
                </div>
                <h5 class="fw-bold">Jumlah Berita</h5>
                <p class="fs-2 mb-0">{{ $newsCount ?? 0 }}</p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-4 text-white h-100" style="background: linear-gradient(135deg, #ff758c, #ff7eb3); border:none; border-radius:1rem; transition: transform 0.3s;">
                <div class="mb-2">
                    <i class="bi bi-star-fill fs-1"></i>
                </div>
                <h5 class="fw-bold">Jumlah Ekskul</h5>
                <p class="fs-2 mb-0">{{ $extracurricularCount ?? 0 }}</p>
            </div>
        </div>
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-8px);
    }
</style>


@endsection
