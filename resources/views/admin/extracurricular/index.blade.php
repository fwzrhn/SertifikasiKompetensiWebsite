@extends('admin.template')

@section('title', 'Extracurricular')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Extracurricular</h2>
        <button class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#createModal">
            + Tambah Extracurricular
        </button>
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Grid Card --}}
    <div class="row">
        @forelse($extracurricular as $ekskul)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    @if($ekskul->gambar)
                        <img src="{{ asset('uploads/ekskul/' . $ekskul->gambar) }}" 
                             class="card-img-top rounded-top" 
                             alt="{{ $ekskul->nama_ekskul }}" 
                             style="height: 200px; object-fit: cover;">
                    @else
                        <div class="d-flex justify-content-center align-items-center bg-light rounded-top" style="height:200px;">
                            <span class="text-muted">Tidak ada gambar</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title text-success fw-bold">{{ $ekskul->nama_ekskul }}</h5>
                        <p class="mb-1"><strong>Pembina:</strong> {{ $ekskul->pembina }}</p>
                        <p class="mb-1"><strong>Jadwal:</strong> {{ $ekskul->jadwal_latihan }}</p>
                        <p class="text-muted small">{{ Str::limit($ekskul->deskripsi, 80) }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-white border-0">
                        {{-- Tombol Edit --}}
                        <button class="btn btn-outline-success btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#editModal{{ $ekskul->id }}">
                            ✎ Edit
                        </button>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('extracurricular.destroy', $ekskul->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm fw-bold">🗑 Hapus</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Modal Edit --}}
            <div class="modal fade" id="editModal{{ $ekskul->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('extracurricular.update', $ekskul->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Extracurricular</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nama Ekskul</label>
                                    <input type="text" name="nama_ekskul" class="form-control" value="{{ $ekskul->nama_ekskul }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Pembina</label>
                                    <input type="text" name="pembina" class="form-control" value="{{ $ekskul->pembina }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Jadwal Latihan</label>
                                    <input type="text" name="jadwal_latihan" class="form-control" value="{{ $ekskul->jadwal_latihan }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" required>{{ $ekskul->deskripsi }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Gambar</label><br>
                                    @if($ekskul->gambar)
                                        <img src="{{ asset('uploads/ekskul/' . $ekskul->gambar) }}" width="100" class="mb-2 rounded"><br>
                                    @endif
                                    <input type="file" name="gambar" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">Belum ada data ekstrakurikuler.</div>
            </div>
        @endforelse
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('extracurricular.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Extracurricular</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Ekskul</label>
                        <input type="text" name="nama_ekskul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Pembina</label>
                        <input type="text" name="pembina" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Jadwal Latihan</label>
                        <input type="text" name="jadwal_latihan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
