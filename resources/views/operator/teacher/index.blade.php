@extends('operator.template')

@section('title', 'Data Guru')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Guru</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
            + Tambah Guru
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="">
        <div class="card-body p-0">
            <table id="teacherTable" class="table table-hover mb-0">
                <thead class="table-success text-dark">
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
                            <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $teacher->id_guru }}">
                                ✎ Edit
                            </button>
                            <form action="{{ route('teachers.destroy', $teacher->id_guru) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus guru ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">🗑 Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal{{ $teacher->id_guru }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('teachers.update', $teacher->id_guru) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header bg-success text-white">
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
                                        <button type="submit" class="btn btn-success">✅ Update</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container" style="height: 50px"></div>

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('teachers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-success text-white">
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
                    <button type="submit" class="btn btn-success">💾 Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#teacherTable').DataTable({
            "responsive": true
        });
    });
</script>
@endpush
@endsection
