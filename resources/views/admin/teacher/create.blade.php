@extends('admin.template')

@section('title', 'Tambah Guru')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-success mb-4">Tambah Guru</h2>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Maaf,</strong>, NIP nya telah digunakan!!
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    {{-- <li>{{ $error }}</li> --}}
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Guru</label>
            <input type="text" name="nama_guru" class="form-control @error('nama_guru') is-invalid @enderror"
                   value="{{ old('nama_guru') }}" required>
            @error('nama_guru')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                   value="{{ old('nip') }}" required>
            {{-- @error('nip')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror --}}
        </div>

        <div class="mb-3">
            <label class="form-label">Mata Pelajaran</label>
            <input type="text" name="mapel" class="form-control @error('mapel') is-invalid @enderror"
                   value="{{ old('mapel') }}" required>
            @error('mapel')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success rounded-pill px-4">Simpan</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary rounded-pill px-4">Batal</a>
    </form>
</div>
@endsection
