@extends('template')

@section('title', $extracurricular->nama_ekskul)

@section('content')
<div class="container mt-4">
    <h2 class="text-success">{{ $extracurricular->nama_ekskul }}</h2>

    @if($extracurricular->gambar)
        <img src="{{ asset($extracurricular->gambar) }}" class="img-fluid mb-3" alt="{{ $extracurricular->nama_ekskul }}">
    @endif

    <p><strong>Pembina:</strong> {{ $extracurricular->pembina ?? '-' }}</p>
    <p><strong>Jadwal Latihan:</strong> {{ $extracurricular->jadwal_latihan ?? '-' }}</p>
    <p>{{ $extracurricular->deskripsi }}</p>

    <a href="{{ route('public.extracurricular.index') }}" class="btn btn-secondary">← Back to Extracurriculars</a>
</div>
@endsection
