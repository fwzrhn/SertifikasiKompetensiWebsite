@extends('template')

@section('title', $profile->nama_sekolah ?? 'Profil Sekolah')

@section('content')
<style>
    /* === Header tanpa background abu === */
    .profile-header {
        background: none;
        padding: 40px 20px 10px;
        text-align: center;
        margin-bottom: 40px;
    }

    .profile-header img {
        border: none;
        margin-bottom: 15px;
        object-fit: cover;
    }

    .profile-header h2 {
        font-weight: 700;
        color: #222;
    }

    .profile-header p {
        color: #555;
    }

    /* === Card dan bagian bawah tetap seperti sebelumnya === */
    .card {
        border: 1px solid #e5e5e5;
        border-radius: 12px;
        transition: box-shadow 0.2s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 3px 12px rgba(0,0,0,0.08);
    }

    .card-title {
        color: #444;
        font-weight: 600;
        border-left: 4px solid #0d6efd;
        padding-left: 10px;
        margin-bottom: 15px;
    }

    .info-list p {
        margin-bottom: 6px;
    }

    .principal-photo img {
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }

    .principal-photo img:hover {
        transform: scale(1.03);
    }
</style>

<div class="container my-5">
    <!-- Header Sekolah -->
    <div class="profile-header">
        @if($profile && $profile->logo)
            <img src="{{ asset($profile->logo) }}" alt="Logo Sekolah" width="150" height="150">
        @endif
        <h2 class="fw-bold mt-2">{{ $profile->nama_sekolah ?? 'Nama Sekolah Belum Diisi' }}</h2>
        <p class="mb-1">{{ $profile->alamat ?? 'Alamat belum diisi' }}</p>
        <p><strong>Kepala Sekolah:</strong> {{ $profile->kepala_sekolah ?? '-' }}</p>
    </div>

    <!-- Informasi dan Deskripsi -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">📘 Informasi Sekolah</h5>
                    <div class="info-list">
                        <p><strong>NPSN:</strong> {{ $profile->npsn ?? '-' }}</p>
                        <p><strong>Tahun Berdiri:</strong> {{ $profile->tahun_berdiri ?? '-' }}</p>
                        <p><strong>Kontak:</strong> {{ $profile->kontak ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">🏫 Deskripsi</h5>
                    <p class="text-muted mb-0">{{ $profile->deskripsi ?? 'Belum ada deskripsi.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Visi Misi -->
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h5 class="card-title">🎯 Visi & Misi</h5>
            <p class="text-muted">{!! nl2br(e($profile->visi_misi ?? 'Belum ada visi & misi.')) !!}</p>
        </div>
    </div>

    <!-- Foto Kepala Sekolah -->
    @if($profile && $profile->foto)
        <div class="text-center mt-5 principal-photo">
            <h5 class="mb-3">👨‍🏫 Kepala Sekolah</h5>
            <img src="{{ asset($profile->foto) }}" alt="Kepala Sekolah" class="img-fluid" style="max-width:250px;">
        </div>
    @endif
</div>
@endsection
