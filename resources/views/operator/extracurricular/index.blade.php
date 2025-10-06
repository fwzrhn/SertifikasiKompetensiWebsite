@extends('operator.template')

@section('title', 'Data Ekstrakurikuler')

@section('content')
<style>
    .card:hover {
        transform: translateY(-3px);
        transition: 0.2s;
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.1);
    }
    .square-img {
        aspect-ratio: 1/1;
        object-fit: cover;
        width: 100%;
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Ekstrakurikuler</h2>
        <button class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#addModal">
            ➕ Tambah Ekskul
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($extracurriculars as $item)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    @if($item->gambar)
                        <img src="{{ asset('storage/'.$item->gambar) }}"
                             class="card-img-top rounded-top square-img"
                             alt="{{ $item->nama_ekskul }}">
                    @else
                        <div class="d-flex justify-content-center align-items-center bg-light rounded-top square-img">
                            <span class="text-muted">Tidak ada gambar</span>
                        </div>
                    @endif

                    <div class="card-body p-3">
                        <h5 class="card-title fw-bold mb-1">{{ $item->nama_ekskul }}</h5>
                        <p class="mb-1 text-muted"><small><i class="bi bi-person-badge"></i> {{ $item->pembina }}</small></p>
                        <p class="mb-1 text-muted"><small><i class="bi bi-calendar-event"></i> {{ $item->jadwal_latihan }}</small></p>
                        <p class="mb-2">{{ Str::limit($item->deskripsi, 80) }}</p>
                    </div>

                    <div class="card-footer d-flex justify-content-between bg-white border-0">
                        <button class="btn btn-outline-success btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_ekskul }}">
                            ✎ Edit
                        </button>

                        <form action="{{ route('extracurricular.destroy', $item->id_ekskul) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus ekskul ini?')">
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
            <div class="modal fade" id="editModal{{ $item->id_ekskul }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('extracurricular.update', $item->id_ekskul) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">Edit Ekskul</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Nama Ekskul</label>
                                <input type="text" name="nama_ekskul" value="{{ $item->nama_ekskul }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Pembina</label>
                                <input type="text" name="pembina" value="{{ $item->pembina }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Jadwal Latihan</label>
                                <input type="text" name="jadwal_latihan" value="{{ $item->jadwal_latihan }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="4" required>{{ $item->deskripsi }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Gambar</label>
                                <input type="file" name="gambar" class="form-control">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/extracurriculars/'.$item->gambar) }}"
                                         class="mt-2 rounded square-img"
                                         style="max-width:150px;">
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
                <div class="alert alert-warning">Belum ada data ekstrakurikuler.</div>
            </div>
        @endforelse
    </div>
</div>
<div class="container" style="height: 50px"></div>

{{-- Modal Tambah --}}
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('extracurricular.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Tambah Ekskul</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3"><label>Nama Ekskul</label><input type="text" name="nama_ekskul" class="form-control" required></div>
                <div class="mb-3"><label>Pembina</label><input type="text" name="pembina" class="form-control" required></div>
                <div class="mb-3"><label>Jadwal Latihan</label><input type="text" name="jadwal_latihan" class="form-control" required></div>
                <div class="mb-3"><label>Deskripsi</label><textarea name="deskripsi" class="form-control" rows="4" required></textarea></div>
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
