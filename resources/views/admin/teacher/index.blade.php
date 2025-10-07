@extends('admin.template')

@section('title', 'Data Guru')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success">👩‍🏫 Data Guru</h2>
        <a href="{{ route('teachers.create') }}" class="btn btn-success shadow-sm rounded-pill px-3">
            + Tambah Guru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <table class="table table-hover align-middle mb-0">
        <thead class="table-success text-dark">
            <tr class="text-center">
                <th>ID</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Mapel</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
            <tr>
                <td class="text-center">{{ $teacher->id_guru }}</td>
                <td>{{ $teacher->nama_guru }}</td>
                <td>{{ $teacher->nip }}</td>
                <td>{{ $teacher->mapel }}</td>
                <td class="text-center">
                    @if ($teacher->foto)
                        <img src="{{ asset('storage/'.$teacher->foto) }}" width="60" height="60" class="rounded-circle object-fit-cover shadow-sm border">
                    @else
                        <span class="text-muted fst-italic">Tidak ada</span>
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('teachers.edit', $teacher->id_guru) }}" class="btn btn-outline-success btn-sm rounded-pill">
                        Edit
                    </a>
                    <form action="{{ route('teachers.destroy', $teacher->id_guru) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus guru ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
