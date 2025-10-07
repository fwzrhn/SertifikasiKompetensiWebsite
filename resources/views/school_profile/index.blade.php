@extends('template')

@section('title', $profile->nama_sekolah ?? 'Profil Sekolah')

@section('content')
<style>
    .profile-header {
        background: #f9f9f9;
        color: #333;
        padding: 50px 20px 30px;
        text-align: center;
        border-radius: 12px;
        margin-bottom: 50px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    }

    .profile-header img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        background: white;
        padding: 6px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }

    .profile-header h2 {
        font-weight: 700;
        margin-top: 20px;
    }

    .profile-header p {
        margin: 6px 0;
        font-size: 15px;
        color: #555;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.04);
        transition: all 0.3s ease-in-out;
        background: #ffffff;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        border-left: 4px solid #6c757d;
        padding-left: 10px;
        margin-bottom: 15px;
        color: #333;
    }

    .info-list p {
        margin-bottom: 8px;
        font-size: 15px;
        color: #444;
    }

    .principal-photo img {
        border-radius: 12px;
        max-width: 100%;
        height: auto;
        box-shadow: 0 4px 14px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .principal-photo img:hover {
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .profile-header {
            padding: 40px 10px 20px;
        }

        .card-title {
            font-size: 16px;
        }

        .info-list p {
            font-size: 14px;
        }
    }
</style>

<div class="container my-5">
    <!-- Header Sekolah -->
    <div class="profile-header">
        @if($profile && $profile->logo)
            <img src="{{ asset($profile->logo) }}" alt="Logo Sekolah">
        @endif
        <h2>{{ $profile->nama_sekolah ?? 'Nama Sekolah Belum Diisi' }}</h2>
        <p>{{ $profile->alamat ?? 'Alamat belum diisi' }}</p>
        <p><strong>Kepala Sekolah:</strong> {{ $profile->kepala_sekolah ?? '-' }}</p>
    </div>

    <!-- Informasi Sekolah, Deskripsi, Foto Kepsek -->
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Informasi Sekolah</h5>
                    <div class="info-list">
                        <p><strong>NPSN:</strong> {{ $profile->npsn ?? '-' }}</p>
                        <p><strong>Tahun Berdiri:</strong> {{ $profile->tahun_berdiri ?? '-' }}</p>
                        <p><strong>Kontak:</strong> {{ $profile->kontak ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Deskripsi</h5>
                    <p class="text-muted mb-0">{{ $profile->deskripsi ?? 'Belum ada deskripsi.' }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100 text-center p-3">
                @if($profile && $profile->foto)
                    <div class="principal-photo mb-3">
                        <img src="{{ asset($profile->foto) }}" alt="Kepala Sekolah">
                    </div>
                @endif
                <h5 class="card-title mt-2">Kepala Sekolah</h5>
                <p class="text-muted">{{ $profile->kepala_sekolah ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Visi Misi -->
    <div class="card shadow-sm mt-5">
        <div class="card-body">
            <h5 class="card-title">Visi & Misi</h5>
            <p class="text-muted">{!! nl2br(e($profile->visi_misi ?? 'Belum ada visi & misi.')) !!}</p>
        </div>
    </div>
</div>
@endsection
