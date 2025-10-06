@extends('admin.template')

@section('title', 'School Profile')

@section('content')
<style>
    .card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .form-label {
        font-weight: 600;
        color: #198754;
    }

    .section-title {
        font-weight: 700;
        font-size: 1.3rem;
        color: #198754;
        margin-bottom: 10px;
    }

    input.form-control, textarea.form-control, select.form-control {
        border-radius: 10px;
        border: 1px solid #ccc;
    }

    input.form-control:focus, textarea.form-control:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.1rem rgba(25,135,84,0.25);
    }

    .preview-img {
        border-radius: 10px;
        border: 2px solid #ddd;
        object-fit: cover;
    }

    .btn-success {
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 600;
    }

    .alert-success {
        border-radius: 10px;
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .image-preview {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .image-preview img {
        border-radius: 10px;
        max-height: 100px;
    }
</style>

<div class="container mt-4">
    <h2 class="fw-bold text-success mb-3">🏫 Profil Sekolah</h2>

    @if(session('success'))
        <div class="alert alert-success shadow-sm mt-2">{{ session('success') }}</div>
    @endif

    <div class="card mt-3">
        <div class="card-body">
            <form action="{{ route('school-profile.update', $profile->id_profil) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <p class="section-title">📘 Informasi Umum</p>

                        <div class="mb-3">
                            <label class="form-label">Nama Sekolah</label>
                            <input type="text" class="form-control" name="nama_sekolah" value="{{ old('nama_sekolah', $profile->nama_sekolah) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kepala Sekolah</label>
                            <input type="text" class="form-control" name="kepala_sekolah" value="{{ old('kepala_sekolah', $profile->kepala_sekolah) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NPSN</label>
                            <input type="text" class="form-control" name="npsn" value="{{ old('npsn', $profile->npsn) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tahun Berdiri</label>
                            <input type="number" class="form-control" name="tahun_berdiri" value="{{ old('tahun_berdiri', $profile->tahun_berdiri) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <p class="section-title">📍 Kontak & Lokasi</p>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="2" required>{{ old('alamat', $profile->alamat) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kontak</label>
                            <input type="text" class="form-control" name="kontak" value="{{ old('kontak', $profile->kontak) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="2">{{ old('deskripsi', $profile->deskripsi) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="section-title">🎯 Visi & Misi</p>
                    <textarea class="form-control" name="visi_misi" rows="4">{{ old('visi_misi', $profile->visi_misi) }}</textarea>
                </div>

                <hr class="my-4">

                <div class="row">
                    <div class="col-md-6">
                        <p class="section-title">👨‍🏫 Foto Kepala Sekolah</p>
                        <div class="mb-3 image-preview">
                            <input type="file" class="form-control" name="foto">
                            @if($profile->foto)
                                <img src="{{ asset($profile->foto) }}" class="preview-img mt-2" width="120">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <p class="section-title">🏫 Logo Sekolah</p>
                        <div class="mb-3 image-preview">
                            <input type="file" class="form-control" name="logo">
                            @if($profile->logo)
                                <img src="{{ asset($profile->logo) }}" class="preview-img mt-2" width="100">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container" style="height: 50px"></div>
@endsection
