@extends('template')

@section('title', 'Gallery')

@section('content')
<style>
    .gallery-section {
        margin-top: 30px;
    }

    .gallery-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .gallery-header h2 {
        color: #198754;
        font-weight: 700;
    }

    /* Scrollable row */
    .gallery-scroll {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        scroll-behavior: smooth;
        padding-bottom: 10px;
    }

    .gallery-scroll::-webkit-scrollbar {
        height: 8px;
    }

    .gallery-scroll::-webkit-scrollbar-thumb {
        background-color: rgba(25, 135, 84, 0.4);
        border-radius: 10px;
    }

    .gallery-scroll::-webkit-scrollbar-thumb:hover {
        background-color: rgba(25, 135, 84, 0.7);
    }

    .gallery-card {
        flex: 0 0 300px;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
    }

    .gallery-card img,
    .gallery-card video {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .gallery-card .card-body {
        padding: 15px;
    }

    .gallery-card h5 {
        font-size: 1.1rem;
        color: #198754;
        margin-bottom: 8px;
    }

    .gallery-card .card-text {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .gallery-card .card-footer {
        font-size: 0.85rem;
        background: #f8f9fa;
        color: #6c757d;
        padding: 10px 15px;
    }

    .btn-success {
        font-size: 0.9rem;
        border-radius: 6px;
        padding: 5px 12px;
    }
</style>

<div class="container" style="height: 20px"></div>

<div class="container gallery-section">
    <div class="gallery-header">
        <h2>📸 School Gallery</h2>
    </div>

    @if($galleries->count() > 0)
        <div class="gallery-scroll">
            @foreach($galleries as $item)
                <div class="gallery-card">
                    {{-- tampilkan foto atau video --}}
                    @if($item->kategori === 'Video' && $item->file)
                        @php
                            $ext = pathinfo($item->file, PATHINFO_EXTENSION);
                        @endphp
                        <video controls>
                            <source src="{{ asset('storage/' . $item->file) }}" type="video/{{ strtolower($ext) }}">
                            Browser kamu tidak mendukung tag video.
                        </video>
                    @elseif($item->file)
                        <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->judul }}">
                    @else
                        <img src="{{ asset('assets/image/default-gallery.png') }}" alt="Gallery">
                    @endif

                    <div class="card-body">
                        <h5>{{ $item->judul }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($item->keterangan, 80) }}</p>
                        <a href="{{ route('public.galleries.show', $item->id_galeri) }}" class="btn btn-sm btn-success">View</a>
                    </div>

                    <div class="card-footer">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-3 text-muted" style="font-size: 0.9rem;">
            Geser ke kanan untuk melihat lebih banyak →
        </div>
    @else
        <div class="alert alert-info">Belum ada data galeri.</div>
    @endif
</div>
@endsection
