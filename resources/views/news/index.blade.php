@extends('template')

@section('title', 'News')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">📰 Latest News</h2>

    <div class="row">
        @foreach($news as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($item->gambar)
                        <img src="{{ asset($item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}" style="height:200px; object-fit:cover;">
                    @else
                        <img src="{{ asset('assets/image/default-news.png') }}" class="card-img-top" alt="Default News" style="height:200px; object-fit:cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 100) }}</p>
                        <a href="{{ route('public.news.show', $item->id_berita) }}" class="btn btn-sm btn-success">Read More</a>
                    </div>

                    <div class="card-footer text-muted">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $news->links() }}
    </div>
</div>
@endsection
