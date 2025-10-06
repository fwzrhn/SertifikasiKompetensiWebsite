@extends('template')

@section('title', 'Gallery')

@section('content')
<div class="container" style="height: 20px"></div>
<div class="container mt-4">
    <h2 class="mb-4 text-success">📸 School Gallery</h2>

    <div class="row">
        @foreach($galleries as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($item->file)
                        <img src="{{ asset('storage/' . $item->file) }}" class="card-img-top" alt="{{ $item->judul }}" style="height:220px; object-fit:cover;">
                    @else
                        <img src="{{ asset('assets/image/default-gallery.png') }}" class="card-img-top" alt="Gallery" style="height:220px; object-fit:cover;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($item->keterangan, 80) }}</p>
                        <a href="{{ route('public.galleries.show', $item->id_galeri) }}" class="btn btn-sm btn-success">View</a>
                    </div>

                    <div class="card-footer text-muted">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $galleries->links() }}
    </div>
</div>
@endsection
