<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator - @yield('title', $schoolProfile?->nama_sekolah ?? 'School Website')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        body { background-color: #f4f6f9; margin: 0; padding: 0; }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background: #0f2e1f;
            color: #fff;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
        }
        .sidebar .nav-link {
            color: #ddd;
            padding: 10px 20px;
            display: block;
            transition: 0.2s;
        }
        .sidebar .nav-link.active {
            background-color: #1a5e3d;
            font-weight: bold;
            color: #fff;
        }
        .sidebar .nav-link:hover {
            background-color: #2e7d50;
            color: #fff;
        }
        .sidebar .navbar-brand {
            color: #fff;
            font-weight: bold;
            padding: 0 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .sidebar .navbar-brand img {
            height: 36px;
            margin-right: 8px;
            object-fit: contain;
        }

        /* Content */
        .content {
            margin-left: 240px;
            padding: 20px;
            min-height: calc(100vh - 50px);
        }

        /* Footer */
        footer {
            background-color: #0f2e1f;
            color: #fff;
            padding: 12px 0;
            margin-left: 240px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: calc(100% - 240px);
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a class="navbar-brand" href="{{ route('operator.dashboard') }}">
            @if($schoolProfile?->logo)
                <img src="{{ asset($schoolProfile->logo) }}" alt="Logo">
            @endif
            {{ $schoolProfile?->nama_sekolah ?? 'Nama Sekolah' }}
        </a>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('operator/students*') ? 'active' : '' }}" href="{{ route('operator.students.index') }}">👨‍🎓 Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('operator/teachers*') ? 'active' : '' }}" href="{{ route('operator.teachers.index') }}">👨‍🏫 Teachers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('operator/extracurricular*') ? 'active' : '' }}" href="{{ route('operator.extracurricular.index') }}">🎯 Extracurricular</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('operator/news*') ? 'active' : '' }}" href="{{ route('operator.news.index') }}">📰 News</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('operator/galleries*') ? 'active' : '' }}" href="{{ route('operator.galleries.index') }}">🖼️ Gallery</a>
            </li>
        </ul>

        <div class="mt-auto p-3">
            <div class="text-white mb-2">
                👋 Halo, {{ auth()->check() ? auth()->user()->username : 'Operator' }}
            </div>
            <form action="{{ route('operator.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm fw-bold w-100">Logout</button>
            </form>
        </div>
    </div>

    <!-- Content -->
    <main class="content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <small>
            © {{ date('Y') }} {{ $schoolProfile?->nama_sekolah ?? 'MTsN 10' }} | Ikhlas Beramal
        </small>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    @stack('scripts')
</body>
</html>
