@extends('template') 

@section('title', 'Students')

@section('content')
<div class="container" style="height: 20px"></div>
<div class="container mt-4">
    <h2 class="mb-4 text-success">👨‍🎓 Students</h2>

    @if($students->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
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
    @else
        <div class="alert alert-info">Belum ada data siswa.</div>
    @endif
</div>
@endsection
