@extends('template')

@section('title', 'Students')

@section('content')
<style>
    .student-section {
        background: linear-gradient(180deg, #f9fdf9 0%, #f2fff5 100%);
        padding: 60px 0;
        min-height: 100vh;
    }

    .student-title {
        color: #145a32;
        font-weight: 700;
        text-align: center;
        margin-bottom: 40px;
        position: relative;
    }

    .student-title::after {
        content: "";
        display: block;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #145a32, #1e8449);
        margin: 12px auto 0;
        border-radius: 6px;
    }

    /* Table style */
    .table-container {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead {
        background: linear-gradient(90deg, #145a32, #1e8449);
        color: #fff;
        font-weight: 600;
        text-align: center;
    }

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
        padding: 12px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9fff9;
    }

    .table-striped tbody tr:hover {
        background-color: #e8f8ed;
        transition: 0.2s;
    }

    .table th:first-child {
        border-top-left-radius: 12px;
    }

    .table th:last-child {
        border-top-right-radius: 12px;
    }

    .alert {
        border-radius: 12px;
    }
</style>

<div class="student-section">
    <div class="container">
        <h2 class="student-title">Siswa {{$schoolProfile->nama_sekolah}}</h2>

        @if($students->count() > 0)
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
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
                            @foreach($students as $index => $student)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
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
        @else
            <div class="alert alert-info text-center">Belum ada data siswa.</div>
        @endif
    </div>
</div>
@endsection
