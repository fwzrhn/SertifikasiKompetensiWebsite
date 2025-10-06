@extends('template')

@section('title', $article->judul)

@section('content')
<div class="container mt-4">
    <h2 class="text-success">{{ $article->judul }}</h2>
    <p class="text-muted">Published: {{ \Carbon\Carbon::parse($article->tanggal)->format('d M Y') }}</p>

    @if($article->gambar)
        <img src="{{ asset($article->gambar) }}" class="img-fluid mb-4" alt="{{ $article->judul }}">
    @endif

    <div class="content">
        {!! nl2br(e($article->isi)) !!}
    </div>
</div>
@endsection
