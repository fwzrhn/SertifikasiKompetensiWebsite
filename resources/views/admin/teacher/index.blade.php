@extends('admin.template')

@section('title', 'Data Guru')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Data Guru</h2>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambah Guru</button>

    <table id="teacherTable" class="table table-bordered table-striped">
        <thead class="table-success">
            <tr>
                <th>ID Guru</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Mapel</th>
                <th>Foto</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
            <tr>
                <td>{{ $teacher->id_guru }}</td>
                <td>{{ $teacher->nama_guru }}</td>
                <td>{{ $teacher->nip }}</td>
                <td>{{ $teacher->mapel }}</td>
                <td>
                    @if ($teacher->foto)
                        <img src="{{ asset('storage/'.$teacher->foto) }}" width="60" class="rounded">
                    @else
                        <span class="text-muted">Tidak ada</span>
                    @endif
                </td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $teacher->id_guru }}">Edit</button>
                    <form action="{{ route('teachers.destroy', $teacher->id_guru) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus guru ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama Guru</label>
                    <input type="text" name="nama_guru" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>NIP</label>
                    <input type="text" name="nip" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Mata Pelajaran</label>
                    <input type="text" name="mapel" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@foreach ($teachers as $teacher)
<div class="modal fade" id="editModal{{ $teacher->id_guru }}" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('teachers.update', $teacher->id_guru) }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nama Guru</label>
                    <input type="text" name="nama_guru" value="{{ $teacher->nama_guru }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>NIP</label>
                    <input type="text" name="nip" value="{{ $teacher->nip }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Mata Pelajaran</label>
                    <input type="text" name="mapel" value="{{ $teacher->mapel }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Foto</label>
                    <input type="file" name="foto" class="form-control">
                    @if ($teacher->foto)
                        <img src="{{ asset('storage/'.$teacher->foto) }}" width="80" class="mt-2 rounded">
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection
