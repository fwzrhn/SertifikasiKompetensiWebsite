@extends('admin.template')

@section('title', 'Edit Guru')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-success mb-4">Edit Guru</h2>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada beberapa masalah dengan input Anda:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teachers.update', $teacher->id_guru) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Guru</label>
            <input type="text" name="nama_guru"
                   class="form-control @error('nama_guru') is-invalid @enderror"
                   value="{{ old('nama_guru', $teacher->nama_guru) }}" required>
            @error('nama_guru')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" name="nip"
                   class="form-control @error('nip') is-invalid @enderror"
                   value="{{ old('nip', $teacher->nip) }}" required>
            @error('nip')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Mata Pelajaran</label>
            <input type="text" name="mapel"
                   class="form-control @error('mapel') is-invalid @enderror"
                   value="{{ old('mapel', $teacher->mapel) }}" required>
            @error('mapel')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="foto"
                   class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($teacher->foto)
                <img src="{{ asset('storage/' . $teacher->foto) }}" width="90" class="mt-2 rounded-3 shadow-sm">
            @endif
        </div>

        <button type="submit" class="btn btn-success rounded-pill px-4">Simpan</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary rounded-pill px-4">Batal</a>
    </form>
</div>
@endsection
