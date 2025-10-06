@extends('template')

@section('title', $profile->nama_sekolah ?? 'Profil Sekolah')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">🏫 Profil Sekolah</h2>

    <div class="text-center mb-5">
        @if($profile && $profile->logo)
            <img src="{{ asset($profile->logo) }}" alt="Logo Sekolah" class="mb-3" style="max-width:150px;">
        @endif
        <h3>{{ $profile->nama_sekolah ?? 'Nama Sekolah Belum Diisi' }}</h3>
        <p><strong>Kepala Sekolah:</strong> {{ $profile->kepala_sekolah ?? '-' }}</p>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Informasi Sekolah</h5>
            <p><strong>NPSN:</strong> {{ $profile->npsn ?? '-' }}</p>
            <p><strong>Tahun Berdiri:</strong> {{ $profile->tahun_berdiri ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $profile->alamat ?? '-' }}</p>
            <p><strong>Kontak:</strong> {{ $profile->kontak ?? '-' }}</p>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Deskripsi</h5>
            <p>{{ $profile->deskripsi ?? 'Belum ada deskripsi.' }}</p>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Visi & Misi</h5>
            <p>{!! nl2br(e($profile->visi_misi ?? 'Belum ada visi & misi.')) !!}</p>
        </div>
    </div>

    @if($profile && $profile->foto)
        <div class="text-center mt-4">
            <h5>👨‍🏫 Kepala Sekolah</h5>
            <img src="{{ asset($profile->foto) }}" alt="Kepala Sekolah" class="img-thumbnail mt-2" style="max-width:250px;">
        </div>
    @endif
</div>
@endsection
