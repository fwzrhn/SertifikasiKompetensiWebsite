@extends('operator.template')

@section('title', 'Data Berita')

@section('content')
<style>
    .card:hover {
        transform: translateY(-4px);
        transition: 0.25s ease;
        box-shadow: 0 0.75rem 1.25rem rgba(0,0,0,.12);
    }
    .modal-header.bg-success {
        background: linear-gradient(90deg, #28a745, #34ce57);
    }
    .btn-success {
        background: #28a745;
        border: none;
    }
    .btn-success:hover {
        background: #218838;
    }
</style>

<div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success mb-0">📰 Data Berita</h2>
        <button class="btn btn-success fw-bold px-3 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#addModal">
            ➕ Tambah Berita
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Grid Berita --}}
    <div class="row">
        @forelse($news as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    {{-- Gambar --}}
                    @if($item->gambar)
                        <img src="{{ asset('storage/'.$item->gambar) }}"
                             class="card-img-top rounded-top"
                             style="height:180px; object-fit:cover;"
                             alt="{{ $item->judul }}">
                    @else
                        <div class="d-flex justify-content-center align-items-center bg-light rounded-top"
                             style="height:180px;">
                            <span class="text-muted">Tidak ada gambar</span>
                        </div>
                    @endif

                    {{-- Isi Card --}}
                    <div class="card-body p-3">
                        <h5 class="fw-bold text-success mb-1">{{ $item->judul }}</h5>
                        <p class="text-muted mb-2">
                            <small><i class="bi bi-calendar"></i> {{ $item->tanggal }}</small>
                        </p>
                        <p class="mb-2">{{ Str::limit($item->isi, 80) }}</p>
                        <p class="mb-0 text-muted">
                            <small><i class="bi bi-person"></i> {{ $item->user->name ?? '-' }}</small>
                        </p>
                    </div>

                    {{-- Footer Card --}}
                    <div class="card-footer bg-white border-0 d-flex justify-content-between">
                        <button class="btn btn-outline-success btn-sm fw-bold" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $item->id_berita }}">
                            ✎ Edit
                        </button>

                        <form action="{{ route('news.destroy', $item->id_berita) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus berita ini?')" style="display:inline-block">
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
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ route('news.update', $item->id_berita) }}" method="POST"
                          enctype="multipart/form-data" class="modal-content shadow">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title fw-bold">✏️ Edit Berita</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Judul</label>
                                <input type="text" name="judul" value="{{ $item->judul }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tanggal</label>
                                <input type="date" name="tanggal" value="{{ $item->tanggal }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Isi</label>
                                <textarea name="isi" class="form-control" rows="4" required>{{ $item->isi }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Gambar</label>
                                <input type="file" name="gambar" class="form-control">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}" width="100" class="mt-2 rounded shadow-sm">
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success fw-bold px-3">💾 Simpan</button>
                            <button type="button" class="btn btn-outline-secondary fw-bold" data-bs-dismiss="modal">✖ Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="alert alert-warning py-4 shadow-sm">Belum ada berita ditambahkan.</div>
            </div>
        @endforelse
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" class="modal-content shadow">
            @csrf
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold">🆕 Tambah Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Isi</label>
                    <textarea name="isi" class="form-control" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success fw-bold px-3">💾 Simpan</button>
                <button type="button" class="btn btn-outline-secondary fw-bold" data-bs-dismiss="modal">✖ Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection
