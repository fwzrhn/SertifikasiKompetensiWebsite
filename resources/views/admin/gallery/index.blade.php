@extends('admin.template')

@section('title', 'Data Galeri')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Galeri</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            + Tambah Galeri
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Grid Card --}}
    <div class="row">
        @forelse($galleries as $gallery)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    @if($gallery->file)
                        <img src="{{ asset('storage/' . $gallery->file) }}" 
                             class="card-img-top" 
                             alt="{{ $gallery->judul }}" 
                             style="height: 180px; object-fit: cover;">
                    @else
                        <div class="d-flex justify-content-center align-items-center bg-light" style="height:180px;">
                            <span class="text-muted">Tidak ada file</span>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $gallery->judul }}</h5>
                        <p class="mb-1"><strong>Keterangan:</strong> {{ $gallery->keterangan }}</p>
                        <p class="mb-1"><strong>Kategori:</strong> {{ $gallery->kategori }}</p>
                        <p class="mb-1"><strong>Tanggal:</strong> {{ $gallery->tanggal }}</p>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $gallery->id_galeri }}">
                            Edit
                        </button>

                        <form action="{{ route('galleries.destroy', $gallery->id_galeri) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus galeri ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Modal Edit --}}
            <div class="modal fade" id="editModal{{ $gallery->id_galeri }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('galleries.update', $gallery->id_galeri) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
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
                                <div class="mb-3">
                                    <label>File</label><br>
                                    @if($gallery->file)
                                        <img src="{{ asset('storage/' . $gallery->file) }}" width="100" class="mb-2"><br>
                                    @endif
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">Belum ada data galeri.</div>
            </div>
        @endforelse
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
