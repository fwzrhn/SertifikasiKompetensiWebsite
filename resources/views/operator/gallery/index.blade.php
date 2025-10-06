@extends('operator.template')

@section('title', 'Data Galeri')

@section('content')
<style>

    .card {
        transition: all 0.25s ease;
        border-radius: 10px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
    }


    .badge-category {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 10;
        font-size: 0.85rem;
        padding: 6px 10px;
        border-radius: 6px;
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
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }
</style>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success">📸 Data Galeri</h2>
        <button class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#createModal">
            ➕ Tambah Galeri
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- 🔹 Grid Galeri --}}
    <div class="row">
        @forelse($galleries as $gallery)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="card shadow-sm h-100 border-0 position-relative">

                    {{-- 🔹 Label kategori --}}
                    @if($gallery->kategori === 'Video')
                        <span class="badge bg-danger badge-category">🎥 Video</span>
                    @else
                        <span class="badge bg-primary badge-category">🖼 Foto</span>
                    @endif

                    {{-- 🔹 Preview Foto / Video --}}
                    @if($gallery->kategori === 'Video' && $gallery->file)
                        @php $ext = pathinfo($gallery->file, PATHINFO_EXTENSION); @endphp
                        <video controls class="card-img-top rounded-top" style="height:200px; object-fit:cover;">
                            <source src="{{ asset('storage/' . $gallery->file) }}" type="video/{{ strtolower($ext) }}">
                            Browser kamu tidak mendukung pemutar video.
                        </video>
                    @elseif($gallery->file)
                        <img src="{{ asset('storage/' . $gallery->file) }}"
                             class="card-img-top rounded-top"
                             alt="{{ $gallery->judul }}"
                             style="height:200px; object-fit:cover;">
                    @else
                        <div class="d-flex justify-content-center align-items-center bg-light rounded-top" style="height:200px;">
                            <span class="text-muted">Tidak ada file</span>
                        </div>
                    @endif

                    {{-- 🔹 Isi Card --}}
                    <div class="card-body p-3">
                        <h5 class="card-title fw-bold text-dark">{{ $gallery->judul }}</h5>
                        <p class="mb-1"><strong>Keterangan:</strong> {{ $gallery->keterangan }}</p>
                        <p class="mb-1"><strong>Kategori:</strong> {{ $gallery->kategori }}</p>
                        <p class="mb-0 text-muted"><small>Tanggal: {{ $gallery->tanggal }}</small></p>
                    </div>

                    {{-- 🔹 Tombol Edit / Hapus --}}
                    <div class="card-footer d-flex justify-content-between bg-white border-0">
                        <button class="btn btn-outline-success btn-sm fw-bold"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $gallery->id_galeri }}">
                            ✎ Edit
                        </button>

                        <form action="{{ route('galleries.destroy', $gallery->id_galeri) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus galeri ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm fw-bold">
                                🗑 Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- 🔹 Modal Edit --}}
            <div class="modal fade" id="editModal{{ $gallery->id_galeri }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('galleries.update', $gallery->id_galeri) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">Edit Galeri</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Judul</label>
                                <input type="text" name="judul" class="form-control" value="{{ $gallery->judul }}" required>
                            </div>
                            <div class="mb-3">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control">{{ $gallery->keterangan }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label>Kategori</label>
                                <select name="kategori" class="form-control" required>
                                    <option value="Foto" {{ $gallery->kategori == 'Foto' ? 'selected' : '' }}>Foto</option>
                                    <option value="Video" {{ $gallery->kategori == 'Video' ? 'selected' : '' }}>Video</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ $gallery->tanggal }}" required>
                            </div>

                            {{-- 🔹 Preview file lama --}}
                            <div class="mb-3">
                                <label>File Saat Ini</label><br>
                                @if($gallery->file)
                                    @if($gallery->kategori === 'Video')
                                        <video controls width="100%" class="rounded mb-2">
                                            <source src="{{ asset('storage/' . $gallery->file) }}" type="video/mp4">
                                        </video>
                                    @else
                                        <img src="{{ asset('storage/' . $gallery->file) }}" width="100%" class="mb-2 rounded">
                                    @endif
                                @else
                                    <p class="text-muted">Tidak ada file.</p>
                                @endif
                                <input type="file" name="file" class="form-control mt-2">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success fw-bold">💾 Simpan</button>
                            <button type="button" class="btn btn-outline-secondary fw-bold" data-bs-dismiss="modal">✖ Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center fw-bold">⚠️ Belum ada data galeri.</div>
            </div>
        @endforelse
    </div>
</div>

{{-- 🔹 Modal Tambah --}}
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Tambah Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control" required>
                        <option value="Foto">Foto</option>
                        <option value="Video">Video</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>File</label>
                    <input type="file" name="file" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success fw-bold">💾 Simpan</button>
                <button type="button" class="btn btn-outline-secondary fw-bold" data-bs-dismiss="modal">✖ Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection
