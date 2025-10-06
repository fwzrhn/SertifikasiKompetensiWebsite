@extends('template')

@section('title', 'Extracurriculars')

@section('content')
<style>
    .extracurricular-section {
        margin-top: 30px;
    }

    .extracurricular-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .extracurricular-header h2 {
        color: #198754;
        font-weight: 700;
    }

    .extracurricular-scroll {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        scroll-behavior: smooth;
        padding-bottom: 10px;
    }

    .extracurricular-scroll::-webkit-scrollbar {
        height: 8px;
    }

    .extracurricular-scroll::-webkit-scrollbar-thumb {
        background-color: rgba(25, 135, 84, 0.4);
        border-radius: 10px;
    }

    .extracurricular-scroll::-webkit-scrollbar-thumb:hover {
        background-color: rgba(25, 135, 84, 0.7);
    }

    .extracard {
        flex: 0 0 300px;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .extracard:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
    }

    .extracard img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .extracard .card-body {
        padding: 15px;
    }

    .extracard h5 {
        font-size: 1.1rem;
        color: #198754;
        margin-bottom: 8px;
    }

    .extracard .card-text {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .btn-success {
        font-size: 0.9rem;
        border-radius: 6px;
        padding: 5px 12px;
    }

    .scroll-hint {
        text-align: center;
        font-size: 0.9rem;
        color: #6c757d;
        margin-top: 10px;
    }
</style>

<div class="container" style="height: 20px"></div>

<div class="container extracurricular-section">
    <div class="extracurricular-header">
        <h2>Extracurricular Activities</h2>
    </div>

    @if($extracurriculars->count() > 0)
        <div class="extracurricular-scroll">
            @foreach($extracurriculars as $item)
                <div class="extracard">
                    @if($item->gambar)
                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama_ekskul }}">
                    @else
                        <img src="{{ asset('assets/image/default-extracurricular.png') }}" alt="Extracurricular">
                    @endif

                    <div class="card-body">
                        <h5>{{ $item->nama_ekskul }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($item->deskripsi, 90) }}</p>
                        <a href="{{ route('public.extracurricular.show', $item->id_ekskul) }}" class="btn btn-sm btn-success">Details</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="scroll-hint">
            Geser ke kanan untuk melihat lebih banyak →
        </div>
    @else
        <div class="alert alert-info">Belum ada data ekstrakurikuler.</div>
    @endif
</div>
@endsection
