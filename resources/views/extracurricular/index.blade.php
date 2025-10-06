@extends('template')

@section('title', 'Extracurriculars')

@section('content')
<div class="container" style="height: 20px"></div>
<div class="container mt-4">
    <h2 class="mb-4 text-success">🏀 Extracurricular Activities</h2>

    <div class="row">
        @foreach($extracurriculars as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($item->gambar)
                        <img src="{{ asset($item->gambar) }}" class="card-img-top" alt="{{ $item->nama_ekskul }}" style="height:220px; object-fit:cover;">
                    @else
                        <img src="{{ asset('assets/image/default-extracurricular.png') }}" class="card-img-top" alt="Extracurricular" style="height:220px; object-fit:cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama_ekskul }}</h5>
                        <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($item->deskripsi, 90) }}</p>
                        <a href="{{ route('public.extracurricular.show', $item->id_ekskul) }}" class="btn btn-sm btn-success">Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
