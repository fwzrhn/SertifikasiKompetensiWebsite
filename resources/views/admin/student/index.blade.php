@extends('admin.template')

@section('title', 'Data Siswa')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Siswa</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
            + Tambah Siswa
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="">
        <div class="card-body p-0">
            <table id="studentTable" class="table table-hover mb-0">
                <thead class="table-success text-dark">
                    <tr>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Tahun Masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->nisn }}</td>
                            <td>{{ $student->nama_siswa }}</td>
                            <td>{{ $student->jenis_kelamin }}</td>
                            <td>{{ $student->tahun_masuk }}</td>
                            <td>
                                <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $student->id_siswa }}">
                                    ✎ Edit
                                </button>
                                <form action="{{ route('students.destroy', $student->id_siswa) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">🗑 Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $student->id_siswa }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('students.update', $student->id_siswa) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title">Edit Siswa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>NISN</label>
                                                <input type="text" name="nisn" class="form-control" value="{{ $student->nisn }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Nama Siswa</label>
                                                <input type="text" name="nama_siswa" class="form-control" value="{{ $student->nama_siswa }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Jenis Kelamin</label>
                                                <select name="jenis_kelamin" class="form-control" required>
                                                    <option value="Laki-laki" {{ $student->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                    <option value="Perempuan" {{ $student->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label>Tahun Masuk</label>
                                                <input type="number" name="tahun_masuk" class="form-control" value="{{ $student->tahun_masuk }}" required>
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

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Tambah Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>NISN</label>
                        <input type="text" name="nisn" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Siswa</label>
                        <input type="text" name="nama_siswa" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Tahun Masuk</label>
                        <input type="number" name="tahun_masuk" class="form-control" required>
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
        $('#studentTable').DataTable({
            // "paging": true,
            // "searching": true,
            // "ordering": true,
            "responsive": true
        });
    });
</script>
@endpush
@endsection
