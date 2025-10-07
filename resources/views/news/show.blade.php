@extends('template')

@section('title', $article->judul)

@section('content')
<style>
    .news-detail {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        padding: 30px;
        margin-bottom: 40px;
    }

    .news-detail img {
        border-radius: 10px;
        width: 100%;
        height: 400px;
        object-fit: cover;
        margin-bottom: 25px;
    }

    .news-detail h2 {
        color: #198754;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .news-detail .meta {
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 20px;
    }

    .news-detail .content {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #333;
        text-align: justify;
    }

    .back-btn {
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        color: #198754;
        border: 1px solid #198754;
        padding: 8px 16px;
        border-radius: 8px;
        transition: 0.2s;
    }

    .back-btn:hover {
        background: #198754;
        color: #fff;
    }
</style>

<div class="container" style="height: 20px"></div>

<div class="container mt-4">
    <div class="news-detail">
        <h2>{{ $article->judul }}</h2>
        <p class="meta">
            Published: {{ \Carbon\Carbon::parse($article->tanggal)->format('d M Y') }}
        </p>

        @if($article->gambar)
            <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}">
        @endif

        <div class="content">
            {!! nl2br(e($article->isi)) !!}
        </div>

        <a href="{{ route('public.news.index') }}" class="back-btn mt-4">
            ← Back to News
        </a>
    </div>
</div>
@endsection
