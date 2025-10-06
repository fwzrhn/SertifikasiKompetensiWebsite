@extends('admin.template')

@section('title', 'Data Ekstrakurikuler')

@section('content')
<style>
    .card {
        border: none;
        border-radius: 16px;
        transition: all 0.25s ease;
    }
    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    }
    .square-img {
        aspect-ratio: 1/1;
        object-fit: cover;
        width: 100%;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }
    .btn-outline-success, .btn-outline-danger {
        border-width: 2px;
    }
    .btn-outline-success:hover {
        background-color: #198754;
        color: #fff;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }
    .modal-content {
        border-radius: 16px;
        overflow: hidden;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success mb-0">🏀 Data Ekstrakurikuler</h2>
        <button class="btn btn-success fw-bold shadow-sm px-3" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-lg"></i> Tambah Ekskul
        </button>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm border-0 rounded-3">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        @forelse($extracurriculars as $item)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm">
                    {{-- Gambar --}}
                    @if($item->gambar)
                        <img src="{{ asset('storage/'.$item->gambar) }}" class="square-img" alt="{{ $item->nama_ekskul }}">
                    @else
                        <div class="d-flex justify-content-center align-items-center bg-light square-img">
                            <span class="text-muted">Tidak ada gambar</span>
                        </div>
                    @endif

                    {{-- Isi --}}
                    <div class="card-body p-3">
                        <h5 class="fw-bold text-success mb-1">{{ $item->nama_ekskul }}</h5>
                        <p class="mb-1 text-muted"><i class="bi bi-person-badge"></i> {{ $item->pembina ?? '-' }}</p>
                        <p class="mb-1 text-muted"><i class="bi bi-calendar-event"></i> {{ $item->jadwal_latihan ?? '-' }}</p>
                        <p class="text-secondary small mb-0">{{ Str::limit($item->deskripsi, 80) }}</p>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="card-footer d-flex justify-content-between bg-white border-0 p-3">
                        <button class="btn btn-outline-success btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_ekskul }}">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        <form action="{{ route('extracurricular.destroy', $item->id_ekskul) }}" method="POST" onsubmit="return confirm('Yakin hapus ekskul ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm fw-semibold">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Modal Edit --}}
            <div class="modal fade" id="editModal{{ $item->id_ekskul }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('extracurricular.update', $item->id_ekskul) }}" method="POST" enctype="multipart/form-data" class="modal-content shadow">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title fw-semibold">Edit Ekskul</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Ekskul</label>
                                <input type="text" name="nama_ekskul" value="{{ $item->nama_ekskul }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pembina</label>
                                <input type="text" name="pembina" value="{{ $item->pembina }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jadwal Latihan</label>
                                <input type="text" name="jadwal_latihan" value="{{ $item->jadwal_latihan }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="4" required>{{ $item->deskripsi }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" name="gambar" class="form-control">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/'.$item->gambar) }}" class="mt-2 rounded" style="width:120px;">
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
                <div class="alert alert-warning text-center border-0 rounded-3 shadow-sm">
                    Belum ada data ekstrakurikuler 😕
                </div>
            </div>
        @endforelse
    </div>
</div>

<div class="container mb-5"></div>

{{-- Modal Tambah --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('extracurricular.store') }}" method="POST" enctype="multipart/form-data" class="modal-content shadow">
            @csrf
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-semibold">Tambah Ekskul</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label">Nama Ekskul</label><input type="text" name="nama_ekskul" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Pembina</label><input type="text" name="pembina" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Jadwal Latihan</label><input type="text" name="jadwal_latihan" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Deskripsi</label><textarea name="deskripsi" class="form-control" rows="4" required></textarea></div>
                <div class="mb-3"><label class="form-label">Gambar</label><input type="file" name="gambar" class="form-control"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success fw-bold">💾 Simpan</button>
                <button type="button" class="btn btn-outline-secondary fw-bold" data-bs-dismiss="modal">✖ Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection
