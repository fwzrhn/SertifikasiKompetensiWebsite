@extends('operator.template')

@section('title', 'Data Berita')

@section('content')
<style>
    .card:hover {
        transform: translateY(-3px);
        transition: 0.2s;
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.1);
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Berita</h2>
        <button class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#addModal">
            ➕ Tambah Berita
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Grid Card --}}
    <div class="row">
        @forelse($news as $item)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    @if($item->gambar)
                        <img src="{{ asset('storage/'.$item->gambar) }}"
                             class="card-img-top rounded-top"
                             style="height:160px; object-fit:cover;"
                             alt="{{ $item->judul }}">
                    @else
                        <div class="d-flex justify-content-center align-items-center bg-light rounded-top"
                             style="height:160px;">
                            <span class="text-muted">Tidak ada gambar</span>
                        </div>
                    @endif

                    <div class="card-body p-3">
                        <h5 class="card-title fw-bold mb-1">{{ $item->judul }}</h5>
                        <p class="mb-1 text-muted"><small><i class="bi bi-calendar"></i> {{ $item->tanggal }}</small></p>
                        <p class="mb-2">{{ Str::limit($item->isi, 80) }}</p>
                        <p class="mb-0 text-muted"><small><i class="bi bi-person"></i> {{ $item->user->name ?? '-' }}</small></p>
                    </div>

                    <div class="card-footer d-flex justify-content-between bg-white border-0">
                        {{-- Tombol Edit --}}
                        <button class="btn btn-outline-success btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_berita }}">
                            ✎ Edit
                        </button>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('news.destroy', $item->id_berita) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus berita ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm fw-bold">
                                🗑 Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Modal Edit --}}
            <div class="modal fade" id="editModal{{ $item->id_berita }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('news.update', $item->id_berita) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">Edit Berita</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Judul</label>
                                <input type="text" name="judul" value="{{ $item->judul }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" value="{{ $item->tanggal }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Isi</label>
                                <textarea name="isi" class="form-control" rows="4" required>{{ $item->isi }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Gambar</label>
                                <input type="file" name="gambar" class="form-control">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}" width="100" class="mt-2 rounded">
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success fw-bold">💾 Simpan</button>
                            <button type="button" class="btn btn-outline-secondary fw-bold" data-bs-dismiss="modal">✖ Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">Belum ada berita.</div>
            </div>
        @endforelse
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Tambah Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3"><label>Judul</label><input type="text" name="judul" class="form-control" required></div>
                <div class="mb-3"><label>Tanggal</label><input type="date" name="tanggal" class="form-control" required></div>
                <div class="mb-3"><label>Isi</label><textarea name="isi" class="form-control" rows="4" required></textarea></div>
                <div class="mb-3"><label>Gambar</label><input type="file" name="gambar" class="form-control"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success fw-bold">💾 Simpan</button>
                <button type="button" class="btn btn-outline-secondary fw-bold" data-bs-dismiss="modal">✖ Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection
