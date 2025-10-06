@extends('template')

@section('title', $gallery->judul)

@section('content')
<div class="container mt-4">
    <h2 class="text-success">{{ $gallery->judul }}</h2>
    <p class="text-muted">Published: {{ \Carbon\Carbon::parse($gallery->tanggal)->format('d M Y') }}</p>

    @if($gallery->file)
        <img src="{{ asset($gallery->file) }}" class="img-fluid mb-4" alt="{{ $gallery->judul }}">
    @endif

    <p>{{ $gallery->keterangan }}</p>

    <a href="{{ route('public.galleries.index') }}" class="btn btn-secondary">← Back to Gallery</a>
</div>
@endsection
