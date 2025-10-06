@extends('template') 

@section('title', 'Teachers')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-success">👩‍🏫 Teachers</h2>

    @if($teachers->count() > 0)
        <div class="row">
            @foreach($teachers as $teacher)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($teacher->foto)
                            <img src="{{ asset($teacher->foto) }}" class="card-img-top" alt="{{ $teacher->nama_guru }}" style="height:250px; object-fit:cover;">
                        @else
                            <img src="{{ asset('assets/image/default-teacher.png') }}" class="card-img-top" alt="Default Foto" style="height:250px; object-fit:cover;">
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $teacher->nama_guru }}</h5>
                            <p class="card-text">
                                <strong>NIP:</strong> {{ $teacher->nip ?? '-' }} <br>
                                <strong>Mapel:</strong> {{ $teacher->mapel ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">Belum ada data guru.</div>
    @endif
</div>
@endsection
