@extends('admin.template')

@section('title', 'School Profile')

@section('content')
<div class="container mt-4">
    <h2>🏫 School Profile</h2>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <div class="card mt-3">
        <div class="card-body">
            <form action="{{ route('school-profile.update', $profile->id_profil) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <!-- Nama Sekolah -->
                        <div class="mb-3">
                            <label class="form-label">Nama Sekolah</label>
                            <input type="text" class="form-control" name="nama_sekolah" value="{{ old('nama_sekolah', $profile->nama_sekolah) }}" required>
                        </div>

                        <!-- Kepala Sekolah -->
                        <div class="mb-3">
                            <label class="form-label">Kepala Sekolah</label>
                            <input type="text" class="form-control" name="kepala_sekolah" value="{{ old('kepala_sekolah', $profile->kepala_sekolah) }}" required>
                        </div>

                        <!-- NPSN -->
                        <div class="mb-3">
                            <label class="form-label">NPSN</label>
                            <input type="text" class="form-control" name="npsn" value="{{ old('npsn', $profile->npsn) }}" required>
                        </div>

                        <!-- Tahun Berdiri -->
                        <div class="mb-3">
                            <label class="form-label">Tahun Berdiri</label>
                            <input type="number" class="form-control" name="tahun_berdiri" value="{{ old('tahun_berdiri', $profile->tahun_berdiri) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Alamat -->
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="2" required>{{ old('alamat', $profile->alamat) }}</textarea>
                        </div>

                        <!-- Kontak -->
                        <div class="mb-3">
                            <label class="form-label">Kontak</label>
                            <input type="text" class="form-control" name="kontak" value="{{ old('kontak', $profile->kontak) }}" required>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="2">{{ old('deskripsi', $profile->deskripsi) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Visi & Misi -->
                <div class="mb-3">
                    <label class="form-label">Visi & Misi</label>
                    <textarea class="form-control" name="visi_misi" rows="4">{{ old('visi_misi', $profile->visi_misi) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <!-- Foto Kepala Sekolah -->
                        <div class="mb-3">
                            <label class="form-label">Foto Kepala Sekolah</label>
                            <input type="file" class="form-control" name="foto">
                            @if($profile->foto)
                                <img src="{{ asset($profile->foto) }}" class="img-thumbnail mt-2" width="150">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Logo -->
                        <div class="mb-3">
                            <label class="form-label">Logo Sekolah</label>
                            <input type="file" class="form-control" name="logo">
                            @if($profile->logo)
                                <img src="{{ asset($profile->logo) }}" class="img-thumbnail mt-2" width="100">
                            @endif
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">💾 Update Profile</button>
            </form>
        </div>
    </div>
</div>
<div class="container" style="height: 50px"></div>
@endsection
