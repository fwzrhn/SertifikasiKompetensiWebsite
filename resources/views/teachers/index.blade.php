@extends('template')

@section('title', 'Teachers')

@section('content')
<style>
    .teacher-section {
        background: linear-gradient(180deg, #f9fdf9 0%, #f2fff5 100%);
        padding: 60px 0;
        min-height: 100vh;
    }

    .teacher-title {
        color: #145a32;
        font-weight: 700;
        text-align: center;
        margin-bottom: 40px;
        position: relative;
    }

    .teacher-title::after {
        content: "";
        display: block;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #145a32, #1e8449);
        margin: 12px auto 0;
        border-radius: 6px;
    }

    /* Card style */
    .teacher-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #fff;
        flex: 0 0 31%;
        margin: 0 10px;
    }

    .teacher-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.12);
    }

    .teacher-card img {
        height: 550px;
        object-fit: cover;
        width: 100%;
    }

    .teacher-card .card-body {
        padding: 20px;
        text-align: center;
    }

    .teacher-card .card-title {
        font-weight: 700;
        color: #145a32;
        margin-bottom: 8px;
    }

    .teacher-card .card-text {
        color: #555;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Carousel container */
    .teacher-carousel {
        display: flex;
        overflow-x: auto;
        scroll-behavior: smooth;
        padding-bottom: 10px;
        scrollbar-width: none;
    }

    .teacher-carousel::-webkit-scrollbar {
        display: none;
    }

    /* Arrow buttons */
    .carousel-btn {
        background: #145a32;
        color: #fff;
        border: none;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        transition: 0.3s;
        z-index: 10;
    }

    .carousel-btn:hover {
        background: #1e8449;
    }

    .carousel-btn.left {
        left: -20px;
    }

    .carousel-btn.right {
        right: -20px;
    }

    .carousel-wrapper {
        position: relative;
    }

    @media (max-width: 768px) {
        .teacher-card {
            flex: 0 0 70%;
        }
    }
</style>

<div class="teacher-section">
    <div class="container">
        <h2 class="teacher-title">Guru {{$schoolProfile->nama_sekolah}}</h2>

        @if($teachers->count() > 0)
            <div class="carousel-wrapper">
                <button class="carousel-btn left" onclick="scrollCarousel(-1)">
                    ‹
                </button>

                <div class="teacher-carousel" id="teacherCarousel">
                    @foreach($teachers as $teacher)
                        <div class="card teacher-card">
                            @if($teacher->foto)
                                <img src="{{ asset('storage/'.$teacher->foto) }}" alt="{{ $teacher->nama_guru }}">
                            @else
                                <img src="{{ asset('storage/'.$teacher->foto) }}" alt="Default Foto">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $teacher->nama_guru }}</h5>
                                <p class="card-text mb-1"><strong>NIP:</strong> {{ $teacher->nip ?? '-' }}</p>
                                <p class="card-text"><strong>Mapel:</strong> {{ $teacher->mapel ?? '-' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-btn right" onclick="scrollCarousel(1)">
                    ›
                </button>
            </div>
        @else
            <div class="alert alert-info text-center">Belum ada data guru.</div>
        @endif
    </div>
</div>

<script>
    function scrollCarousel(direction) {
        const carousel = document.getElementById('teacherCarousel');
        const scrollAmount = carousel.offsetWidth * 0.9;
        carousel.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }
</script>
@endsection
