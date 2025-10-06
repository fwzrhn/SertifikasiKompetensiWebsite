@extends('template')

@section('title', 'Home')

@section('content')

<!-- ====== Carousel ====== -->
<div id="carousel" class="carousel slide position-relative" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active position-relative">
            <img src="{{ asset('assets/image/image.png') }}" class="d-block w-100" alt="Slide 1">
            <div class="overlay"></div>
        </div>
    </div>

    <div class="carousel-caption d-flex h-100 align-items-center justify-content-center">
        <div class="row w-100 align-items-center">
            <div class="col-md-5 text-center mb-4 mb-md-0">
                <img src="{{ asset('assets/image/ikhlas-beramal-png-6-Transparent-Images.png') }}" class="img-fluid logo-carousel" alt="Logo Sekolah">
            </div>
            <div class="col-md-7 text-start text-light">
                <h1 class="fw-bold display-4 title-carousel">MTsN 10 Tasikmalaya</h1>
                <p class="lead subtitle-carousel">Hebat Bermartabat, Mandiri Berprestasi.</p>
            </div>
        </div>
    </div>
</div>

<!-- ====== Section Data Sekolah ====== -->
<div class="container section-spacing">
    <div class="card section-card">
        <h3 class="section-heading">📊 Data Sekolah</h3>
        <div class="row text-center">
            <div class="col-md-4 mb-3">
                <div class="card stat-card">
                    <i class="bi bi-people-fill stat-icon"></i>
                    <h4 class="fw-bold text-success">320</h4>
                    <p class="mb-0">Siswa</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stat-card">
                    <i class="bi bi-person-badge-fill stat-icon"></i>
                    <h4 class="fw-bold text-success">45</h4>
                    <p class="mb-0">Guru</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card stat-card">
                    <i class="bi bi-dribbble stat-icon"></i>
                    <h4 class="fw-bold text-success">12</h4>
                    <p class="mb-0">Ekstrakurikuler</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ====== Section Sambutan Kepala Sekolah ====== -->
<div class="container section-spacing">
    <div class="card section-card text-center">
        <h3 class="section-heading">👨‍🏫 Sambutan Kepala Sekolah</h3>
        <img src="{{ asset('assets/image/kepala-sekolah.jpg') }}" alt="Kepala Sekolah" class="rounded-circle shadow mb-3 headmaster-img">
        <h5 class="fw-bold">H. Ahmad Fauzi, M.Pd</h5>
        <p class="text-muted mb-3">Kepala MTsN 10 Tasikmalaya</p>
        <p class="text-secondary">
            "Assalamu’alaikum warahmatullahi wabarakatuh.  
            Selamat datang di website resmi MTsN 10 Tasikmalaya.  
            Kami berkomitmen memberikan pendidikan berkualitas dengan nilai keislaman yang kuat,  
            membentuk generasi berakhlak mulia, cerdas, dan berprestasi."
        </p>
    </div>
</div>

<!-- ====== Section Berita ====== -->
<div class="container section-spacing">
    <div class="card section-card">
        <div class="text-center mb-5">
            <h2 class="section-heading">📰 Berita Terbaru</h2>
            <p class="text-muted">Informasi terkini seputar MTsN 10 Tasikmalaya</p>
        </div>

        <div class="row g-4">
            @for($i = 1; $i <= 3; $i++)
                <div class="col-md-4">
                    <div class="card news-card h-100">
                        <img src="{{ asset('assets/image/default-news.jpg') }}" class="card-img-top" alt="Berita {{ $i }}">
                        <div class="card-body">
                            <h5 class="card-title">Judul Berita {{ $i }}</h5>
                            <p class="card-text text-muted">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non arcu quis nisl...
                            </p>
                            <a href="#" class="btn btn-outline-success btn-sm">Selengkapnya</a>
                        </div>
                        <div class="card-footer text-muted small">06 Oktober 2025</div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>

<!-- ====== Section Ekstrakurikuler ====== -->
<div class="container section-spacing">
    <div class="card section-card">
        <div class="text-center mb-5">
            <h2 class="section-heading">🏅 Ekstrakurikuler Unggulan</h2>
            <p class="text-muted">Kegiatan penunjang prestasi siswa MTsN 10 Tasikmalaya</p>
        </div>

        <div class="row g-4">
            @php
                $ekskul = [
                    ['nama' => 'Pramuka', 'gambar' => 'pramuka.jpg'],
                    ['nama' => 'Paskibra', 'gambar' => 'paskibra.jpg'],
                    ['nama' => 'Tahfidz', 'gambar' => 'tahfidz.jpg'],
                ];
            @endphp

            @foreach($ekskul as $item)
                <div class="col-md-4">
                    <div class="card ekskul-card h-100">
                        <img src="{{ asset('assets/image/' . $item['gambar']) }}" class="card-img-top" alt="{{ $item['nama'] }}">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-success">{{ $item['nama'] }}</h5>
                            <p class="text-muted">Kegiatan pengembangan diri yang membangun semangat dan karakter siswa.</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- ====== CSS Styling ====== -->
<style>
    /* === Global Spacing & Layout === */
    .section-spacing {
        margin-top: 60px;
        margin-bottom: 60px;
        min-height: 50vh;
    }
    .section-card {
        border: none;
        border-radius: 16px;
        padding: 40px 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    .section-heading {
        color: #1e8449;
        font-weight: 700;
        margin-bottom: 25px;
        position: relative;
    }
    .section-heading::after {
        content: "";
        display: block;
        width: 60%;
        height: 3px;
        background: #1e8449;
        margin: 8px auto 0;
        border-radius: 2px;
    }

    /* === Carousel === */
    .carousel-item img {
        height: 100vh;
        object-fit: cover;
    }
    .overlay {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.45);
    }
    .logo-carousel {
        max-height: 170px;
        animation: fadeInUp 1.2s ease;
    }
    .title-carousel {
        color: #FFD700;
        animation: fadeInRight 1.4s ease;
    }
    .subtitle-carousel {
        font-size: 1.25rem;
        animation: fadeInLeft 1.6s ease;
    }

    /* === Statistic Cards === */
    .stat-card {
        border: none;
        border-radius: 14px;
        padding: 30px 0;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }
    .stat-icon {
        font-size: 2rem;
        color: #1e8449;
        margin-bottom: 8px;
    }

    /* === Headmaster Section === */
    .headmaster-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 4px solid #1e8449;
    }

    /* === News Section === */
    .news-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 3px 14px rgba(0, 0, 0, 0.08);
        transition: 0.3s ease;
    }
    .news-card img {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .news-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    /* === Ekskul Section === */
    .ekskul-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 3px 14px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    .ekskul-card img {
        height: 220px;
        object-fit: cover;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .ekskul-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    /* === Animation === */
    @keyframes fadeInUp {
        from {opacity: 0; transform: translateY(40px);}
        to {opacity: 1; transform: translateY(0);}
    }
    @keyframes fadeInRight {
        from {opacity: 0; transform: translateX(-40px);}
        to {opacity: 1; transform: translateX(0);}
    }
    @keyframes fadeInLeft {
        from {opacity: 0; transform: translateX(40px);}
        to {opacity: 1; transform: translateX(0);}
    }
</style>

@endsection
