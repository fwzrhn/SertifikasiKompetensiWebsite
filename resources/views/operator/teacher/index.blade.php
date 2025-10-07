@extends('operator.template')

@section('title', 'Data Guru')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-success">👩‍🏫 Data Guru</h2>
        <button class="btn btn-success shadow-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#createModal">
            + Tambah Guru
        </button>
    </div>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Table --}}
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <table id="teacherTable" class="table table-hover align-middle mb-0">
                <thead class="table-success text-dark">
                    <tr class="text-center">
                        <th style="width: 80px;">ID</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Mapel</th>
                        <th>Foto</th>
                        <th style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $teacher)
                    <tr>
                        <td class="text-center fw-semibold">{{ $teacher->id_guru }}</td>
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
                            <button class="btn btn-outline-success btn-sm me-1 rounded-pill"
                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $teacher->id_guru }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('operator.teachers.destroy', $teacher->id_guru) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus guru ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editModal{{ $teacher->id_guru }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content rounded-4 border-0 shadow">
                                <form action="{{ route('operator.teachers.update', $teacher->id_guru) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title">Edit Data Guru</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Nama Guru</label>
                                            <input type="text" name="nama_guru" value="{{ $teacher->nama_guru }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">NIP</label>
                                            <input type="text" name="nip" value="{{ $teacher->nip }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Mata Pelajaran</label>
                                            <input type="text" name="mapel" value="{{ $teacher->mapel }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Foto</label>
                                            <input type="file" name="foto" class="form-control">
                                            @if ($teacher->foto)
                                                <img src="{{ asset('storage/'.$teacher->foto) }}" width="90" class="mt-2 rounded-3 shadow-sm">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success rounded-pill px-4">💾 Simpan</button>
                                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
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

{{-- Modal Tambah --}}
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('operator.teachers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Tambah Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Guru</label>
                        <input type="text" name="nama_guru" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">NIP</label>
                        <input type="text" name="nip" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Mata Pelajaran</label>
                        <input type="text" name="mapel" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success rounded-pill px-4">✅ Simpan</button>
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container" style="height: 50px"></div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#teacherTable').DataTable({
            responsive: true,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ guru",
                infoEmpty: "Tidak ada data tersedia",
                paginate: {
                    previous: "← Sebelumnya",
                    next: "Selanjutnya →"
                }
            }
        });
    });
</script>
@endpush
@endsection
