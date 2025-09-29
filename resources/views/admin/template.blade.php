<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        body {
            background-color: #f4f6f9;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(90deg, #1a5e3d, #2e7d50);
        }
        .navbar .nav-link {
            color: #fff !important;
            transition: 0.2s;
        }
        .navbar .nav-link.active {
            font-weight: bold;
            border-bottom: 2px solid #d4af37;
        }
        .navbar .nav-link:hover {
            color: #d4af37 !important;
        }

        /* Buttons */
        .btn-primary {
            background-color: #1a5e3d;
            border-color: #1a5e3d;
        }
        .btn-primary:hover {
            background-color: #2e7d50;
            border-color: #2e7d50;
        }
        .btn-outline-light {
            border-color: #fff;
            color: #fff;
        }
        .btn-outline-light:hover {
            background-color: #d4af37;
            border-color: #d4af37;
            color: #1a1a1a;
        }

        /* Card */
        .card {
            background-color: #fff;
            border-radius: 8px;
            border: none;
        }

        /* Footer */
        footer {
            background-color: #1a5e3d;
            color: #fff;
            padding: 12px 0;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('assets/image/ikhlas-beramal-png-6-Transparent-Images.png') }}" alt="Logo" style="height:36px; margin-right:8px;">
                MTsN 10 Tasikmalaya
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('administrator/students*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                            👨‍🎓 Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('administrator/teachers*') ? 'active' : '' }}" href="{{ route('teachers.index') }}">
                            👨‍🏫 Teachers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('administrator/news*') ? 'active' : '' }}" href="{{ route('news.index') }}">
                            📰 News
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('administrator/galleries*') ? 'active' : '' }}" href="{{ route('galleries.index') }}">
                            🖼️ Gallery
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('administrator/extracurriculars*') ? 'active' : '' }}" href="{{ route('extracurricular.index') }}">
                            🎯 Extracurricular
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="navbar-text text-white me-3">
                            👋 Halo, {{ auth()->check() ? auth()->user()->username : 'Admin' }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm fw-bold">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-4 flex-grow-1">
        <div class="p-4 rounded shadow-sm bg-white">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-auto">
        <small>© {{ date('Y') }} MTsN 10 Tasikmalaya | Ikhlas Beramal</small>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


    @stack('scripts')
</body>
</html>
