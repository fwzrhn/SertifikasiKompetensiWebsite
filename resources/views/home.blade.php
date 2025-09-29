@extends('template')

@section('title', 'Home')

@section('content')

<div id="carousel" class="carousel slide position-relative" data-bs-ride="carousel">
    <!-- carousel slides sama seperti sebelumnya -->
    ...
</div>

<div class="garis" style="width:auto; height:5px; background-color: #555555;"></div>

<div class="container mt-4">
    <h2 class="mb-3 text-center">Daftar Siswa</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Jenis Kelamin</th>
                <th>Tahun Masuk</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->nisn }}</td>
                    <td>{{ $student->nama_siswa }}</td>
                    <td>{{ $student->jenis_kelamin }}</td>
                    <td>{{ $student->tahun_masuk }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Data siswa tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="container mt-5">
    <h2 class="mb-3 text-center">Daftar Guru</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Guru</th>
                <th>Nama Guru</th>
                <th>NIP</th>
                <th>Mata Pelajaran</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($teachers as $index => $teacher)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $teacher->id_guru }}</td>
                    <td>{{ $teacher->nama_guru }}</td>
                    <td>{{ $teacher->nip }}</td>
                    <td>{{ $teacher->mapel }}</td>
                    <td>
                        @if ($teacher->foto)
                            <img src="{{ asset('storage/' . $teacher->foto) }}" alt="Foto Guru" width="60" class="rounded">
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Data guru tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Daftar Berita dengan Card --}}
<div class="container mt-5">
    <h2 class="mb-3 text-center">Daftar Berita</h2>
    <div class="row">
        @forelse ($news as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" style="height:180px; object-fit:cover;" alt="{{ $item->judul }}">
                    @else
                        <div class="d-flex justify-content-center align-items-center bg-light" style="height:180px;">
                            <span class="text-muted">Tidak ada gambar</span>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $item->judul }}</h5>
                        <p class="mb-1 text-muted"><small>{{ $item->tanggal }}</small></p>
                        <p class="mb-1">{{ Str::limit($item->isi, 100) }}</p>
                        <p class="mb-0 text-muted"><small>Author: {{ $item->user->name ?? '-' }}</small></p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">Belum ada berita.</div>
            </div>
        @endforelse
    </div>
</div>

@endsection
