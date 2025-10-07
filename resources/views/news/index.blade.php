@extends('template')

@section('title', 'News')

@section('content')
<style>
    .news-section {
        background: linear-gradient(180deg, #f9fdf9 0%, #f2fff5 100%);
        padding: 60px 0;
    }

    .news-title {
        color: #145a32;
        font-weight: 700;
        text-align: center;
        margin-bottom: 40px;
        position: relative;
    }

    .news-title::after {
        content: "";
        display: block;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #145a32, #1e8449);
        margin: 12px auto 0;
        border-radius: 6px;
    }

    .news-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .news-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
    }

    .news-card img {
        height: 220px;
        object-fit: cover;
    }

    .news-carousel .carousel-item {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: #1e8449;
        border-radius: 50%;
        padding: 15px;
    }
</style>

<div class="news-section">
    <div class="container">
        <h2 class="news-title">Berita Terbaru</h2>

        @if($news->count() > 0)
            @php
                $chunks = $news->chunk(3);
            @endphp

            <div id="newsCarousel" class="carousel slide news-carousel" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($chunks as $key => $chunk)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            @foreach($chunk as $item)
                                <div class="card news-card" style="width: 22rem;">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}">
                                    @else
                                        <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="Default News">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title text-success">{{ $item->judul }}</h5>
                                        <p class="card-text text-muted">
                                            {{ Str::limit(strip_tags($item->isi), 100) }}
                                        </p>
                                        <a href="{{ route('public.news.show', $item->id_berita) }}" class="btn btn-sm btn-outline-success">Read More</a>
                                    </div>
                                    <div class="card-footer text-muted small">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <!-- Tombol navigasi -->
                <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        @else
            <div class="alert alert-info text-center">Belum ada berita.</div>
        @endif
    </div>
</div>
@endsection
