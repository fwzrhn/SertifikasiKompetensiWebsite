@extends('admin.template')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    /* Styling untuk card dengan background gradient */
    .dashboard-card {
        background: linear-gradient(120deg, #eafaf1, #d1f0e0);
        color: #333;
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 0.075);
        transition: box-shadow 0.3s ease;
        height: 100%;
    }
    .dashboard-card:hover {
        box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 0.15);
    }
    .dashboard-card a {
        color: #2c7a54;
        text-decoration: none;
    }
    .dashboard-card a:hover {
        text-decoration: underline;
    }
</style>

<div class="container mt-4">
    <h1>Dashboard Admin</h1>

    <div class="row mb-4 justify-content-between">
        {{-- Ringkasan Statistik --}}
        <!-- Card Ringkasan -->
        <div class="col-md-2 mb-3">
            <div class="card dashboard-card p-3">
                <div class="card-body p-2">
                    <h5 class="card-title fw-bold">Siswa</h5>
                    <p class="card-text fs-3">{{ $studentCount }}</p>
                    <a href="{{ route('students.index') }}">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card dashboard-card p-3">
                <div class="card-body p-2">
                    <h5 class="card-title fw-bold">Guru</h5>
                    <p class="card-text fs-3">{{ $teacherCount }}</p>
                    <a href="{{ route('teachers.index') }}">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card dashboard-card p-3">
                <div class="card-body p-2">
                    <h5 class="card-title fw-bold">Berita</h5>
                    <p class="card-text fs-3">{{ $newsCount }}</p>
                    <a href="{{ route('news.index') }}">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card dashboard-card p-3">
                <div class="card-body p-2">
                    <h5 class="card-title fw-bold">Ekskul</h5>
                    <p class="card-text fs-3">{{ $extracurricularCount }}</p>
                    <a href="{{ route('extracurricular.index') }}">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <div class="card dashboard-card p-3">
                <div class="card-body p-2">
                    <h5 class="card-title fw-bold ">Galeri</h5>
                    <p class="card-text fs-3">{{ $galleryCount }}</p>
                    <a href="{{ route('galleries.index') }}">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel 5 Siswa Terbaru --}}
    <h3>5 Siswa Terbaru</h3>

    <div class="card shadow-sm mb-4">
        <div class="card-body p-0">
            <table id="latestStudentTable" class="table table-striped mb-0">
                <thead class="table-success text-dark">
                    <tr>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Tahun Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestStudents as $student)
                    <tr>
                        <td>{{ $student->nisn }}</td>
                        <td>{{ $student->nama_siswa }}</td>
                        <td>{{ $student->jenis_kelamin }}</td>
                        <td>{{ $student->tahun_masuk }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#latestStudentTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "lengthChange": false,
            "pageLength": 5,
            "info": false
        });
    });
</script>
@endpush
