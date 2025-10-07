@extends('template')

@section('title', 'Home')

@section('content')

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


<section class="container section-spacing">
    <div class="card data-card">
        <div class="section-header mb-4 d-flex align-items-center">
            <h3 class="fw-bold text-success mb-0">Data Sekolah</h3>
        </div>
        <hr class="divider mb-5">

        <div class="row text-center justify-content-center">
            <div class="col-10 col-md-4 mb-3">
                <div class="data-box">
                    <h4 class="fw-bold text-success mb-1">{{ $jumlahSiswa }}</h4>
                    <p class="text-muted mb-0">Siswa</p>
                </div>
            </div>
            <div class="col-10 col-md-4 mb-3">
                <div class="data-box">
                    <h4 class="fw-bold text-success mb-1">{{ $jumlahGuru }}</h4>
                    <p class="text-muted mb-0">Guru</p>
                </div>
            </div>
            <div class="col-10 col-md-4 mb-3">
                <div class="data-box">
                    <h4 class="fw-bold text-success mb-1">{{ $jumlahEkskul }}</h4>
                    <p class="text-muted mb-0">Ekstrakurikuler</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="container section-spacing">
    <div class="card section-card">
        <div class="row align-items-center">
            <div class="col-md-4 text-center mb-4 mb-md-0">
                <img src="{{ asset($schoolProfile->foto) }}"
                     alt="Kepala Sekolah"
                     class="rounded-circle shadow headmaster-img">
                <h5 class="fw-bold mt-3 mb-1">{{$schoolProfile->kepala_sekolah}}</h5>
                <p class="text-muted mb-0">Kepala {{$schoolProfile->nama_sekolah}}</p>
            </div>
            <div class="col-md-8">
                <h3 class="section-heading text-center text-md-start mb-4">
                     Sambutan Kepala Sekolah
                </h3>
                <p class="text-secondary" style="line-height: 1.9; text-align: justify;">
                    "Assalamu’alaikum warahmatullahi wabarakatuh.
                    Selamat datang di website resmi MTsN 10 Tasikmalaya.
                    Kami berkomitmen memberikan pendidikan berkualitas dengan nilai keislaman yang kuat,
                    membentuk generasi berakhlak mulia, cerdas, dan berprestasi."
                </p>
            </div>
        </div>
    </div>
</section>


<section class="container section-spacing">
    <div class="card section-card">
        <div class="text-center mb-5">
            <h2 class="section-heading">Berita Terbaru</h2>
            <p class="text-muted">Informasi terkini seputar {{$schoolProfile->nama_sekolah}}</p>
        </div>

        <div class="row g-4">
            @forelse($berita as $item)
                <div class="col-md-4">
                    <div class="card news-card h-100">
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold">{{ $item->judul }}</h5>
                            <p class="card-text text-muted">
                                {{ Str::limit($item->isi, 100, '...') }}
                            </p>
                            <a href="{{ route('public.news.show', $item->id_berita) }}" class="btn btn-outline-success btn-sm">
                                Selengkapnya
                            </a>
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
</section>


<section class="container section-spacing">
    <div class="card section-card">
        <div class="text-center mb-5">
            <h2 class="section-heading">Ekstrakurikuler Unggulan</h2>
            <p class="text-muted">Kegiatan penunjang prestasi siswa {{$schoolProfile->nama_sekolah}}</p>
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
</section>


<style>
    :root {
        --green: #198754;
        --green-light: #d6f5e1;
        --shadow: rgba(0, 0, 0, 0.1);
        --radius: 16px;
    }

    .section-spacing {
        margin-top: 70px;
        margin-bottom: 70px;
    }

    .section-card {
        border: none;
        border-radius: var(--radius);
        padding: 50px 35px;
        box-shadow: 0 8px 30px var(--shadow);
        background: #fff;
    }

    .data-card {
        border-radius: 20px;
        background: linear-gradient(to bottom right, #ffffff, #f8fff9);
        padding: 40px 30px;
        box-shadow: 0 6px 18px var(--shadow);
    }

    .divider {
        height: 2px;
        background-color: var(--green);
        border: none;
        width: 80px;
        margin: 10px 0 30px;
    }

    .data-box {
        background: #fff;
        border-radius: var(--radius);
        padding: 25px 15px;
        box-shadow: 0 3px 15px var(--shadow);
        transition: all 0.3s ease;
    }
    .data-box:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        background: var(--green-light);
    }

    .carousel-item img {
        height: 100vh;
        object-fit: cover;
    }
    .overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
    }
    .logo-carousel {
        max-height: 170px;
        animation: fadeInUp 1.2s ease;
        filter: drop-shadow(0 3px 8px rgba(0,0,0,0.3));
    }
    .title-carousel {
        color: #ffe57f;
        animation: fadeInRight 1.4s ease;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }
    .subtitle-carousel {
        font-size: 1.2rem;
        color: #e0e0e0;
        animation: fadeInLeft 1.6s ease;
    }

    .headmaster-img {
        width: 180px;
        height: 180px;
        object-fit: cover;
        border: 5px solid var(--green);
        transition: transform 0.3s ease;
    }
    .headmaster-img:hover {
        transform: scale(1.06);
    }

    .news-card, .ekskul-card {
        border: none;
        border-radius: var(--radius);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        transition: 0.3s ease;
    }
    .news-card:hover, .ekskul-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 26px rgba(0, 0, 0, 0.12);
    }
    .news-card img, .ekskul-card img {
        height: 230px;
        object-fit: cover;
        border-top-left-radius: var(--radius);
        border-top-right-radius: var(--radius);
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
