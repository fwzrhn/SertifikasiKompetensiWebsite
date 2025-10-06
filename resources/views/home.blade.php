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
                <img src="{{ asset($schoolProfile->logo) }}" class="img-fluid logo-carousel" alt="Logo Sekolah">
            </div>
            <div class="col-md-7 text-start text-light">
                <h1 class="fw-bold display-4 title-carousel">{{ $schoolProfile?->nama_sekolah }}</h1>
                <p class="lead subtitle-carousel">{{ $schoolProfile->visi_misi }}</p>
            </div>
        </div>
    </div>
</div>

<!-- ====== Section Data Sekolah ====== -->
<div class="container section-spacing">
    <div class="card data-card">
        <div class="section-header mb-4 d-flex align-items-center">
            <img src="{{ asset('assets/icon/stats.png') }}" alt="icon" width="32" class="me-2">
            <h3 class="fw-bold text-success mb-0">Data Sekolah</h3>
        </div>
        <hr class="divider mb-5">

        <div class="row text-center justify-content-center">
            <div class="col-md-4 mb-3">
                <div class="data-box">
                    <h4 class="fw-bold text-success mb-1">{{ $jumlahSiswa }}</h4>
                    <p class="text-muted mb-0">Siswa</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="data-box">
                    <h4 class="fw-bold text-success mb-1">{{ $jumlahGuru }}</h4>
                    <p class="text-muted mb-0">Guru</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="data-box">
                    <h4 class="fw-bold text-success mb-1">{{ $jumlahEkskul }}</h4>
                    <p class="text-muted mb-0">Ekstrakurikuler</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ====== Section Sambutan Kepala Sekolah ====== -->
<div class="container section-spacing">
    <div class="card section-card">
        <div class="row align-items-center">
            <div class="col-md-4 text-center mb-4 mb-md-0">
                <img src="{{ asset('assets/image/kepala-sekolah.jpg') }}"
                     alt="Kepala Sekolah"
                     class="rounded-circle shadow headmaster-img">
                <h5 class="fw-bold mt-3 mb-1">H. Ahmad Fauzi, M.Pd</h5>
                <p class="text-muted mb-0">Kepala MTsN 10 Tasikmalaya</p>
            </div>
            <div class="col-md-8">
                <h3 class="section-heading text-center text-md-start mb-4">👨‍🏫 Sambutan Kepala Sekolah</h3>
                <p class="text-secondary" style="line-height: 1.8; text-align: justify;">
                    "Assalamu’alaikum warahmatullahi wabarakatuh.
                    Selamat datang di website resmi MTsN 10 Tasikmalaya.
                    Kami berkomitmen memberikan pendidikan berkualitas dengan nilai keislaman yang kuat,
                    membentuk generasi berakhlak mulia, cerdas, dan berprestasi."
                </p>
            </div>
        </div>
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
            @forelse($berita as $item)
                <div class="col-md-4">
                    <div class="card news-card h-100">
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            <p class="card-text text-muted">
                                {{ Str::limit($item->isi, 100, '...') }}
                            </p>
                            <a href="{{ route('public.news.show', $item->id_berita) }}" class="btn btn-outline-success btn-sm">Selengkapnya</a>
                        </div>
                        <div class="card-footer text-muted small">
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada berita.</p>
            @endforelse
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
            @forelse($ekskul as $item)
                <div class="col-md-4">
                    <div class="card ekskul-card h-100">
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->nama_ekskul }}">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-success">{{ $item->nama_ekskul }}</h5>
                            <p class="text-muted">{{ Str::limit($item->deskripsi, 100, '...') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada data ekstrakurikuler.</p>
            @endforelse
        </div>
    </div>
</div>

<!-- ====== CSS Styling ====== -->
<style>
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

    /* Data Sekolah Style */
    .data-card {
        border: none;
        border-radius: 20px;
        padding: 40px 30px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        background: #fff;
    }
    .divider {
        height: 2px;
        background-color: #1e8449;
        border: none;
        opacity: 1;
        width: 100%;
        margin: 8px 0 0;
    }
    .data-box {
        background: #fff;
        border-radius: 16px;
        padding: 25px 15px;
        box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }
    .data-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }
    .data-box h4 {
        font-size: 2rem;
    }

    /* Carousel */
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

    /* Headmaster Section */
    .headmaster-img {
        width: 180px;
        height: 180px;
        object-fit: cover;
        border: 5px solid #1e8449;
        transition: transform 0.3s ease;
    }
    .headmaster-img:hover {
        transform: scale(1.05);
    }

    /* Card Reuse */
    .news-card, .ekskul-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 3px 14px rgba(0, 0, 0, 0.08);
        transition: 0.3s ease;
    }
    .news-card:hover, .ekskul-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }
    .news-card img, .ekskul-card img {
        height: 220px;
        object-fit: cover;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

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
