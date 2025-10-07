<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', $schoolProfile?->nama_sekolah ?? 'School Website')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom Style -->
    <style>
        :root {
            --green-dark: #145a32;
            --green: #1e8449;
            --green-light: #28b463;
            --yellow: #f4f186;
            --text-light: #ffffcc;
        }

        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
            min-height: 100vh;
            font-family: "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", sans-serif;
        }

        /* ===== Navbar ===== */
        nav.navbar {
            background: linear-gradient(90deg, var(--green-dark), var(--green));
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            padding: 0.8rem 1rem;
            transition: background 0.3s ease;
        }

        .navbar-brand {
            color: var(--yellow) !important;
            font-weight: 700;
            font-size: 1.35rem;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            text-transform: uppercase;
        }

        img.navbar-logo {
            margin-right: 10px;
            width: 48px;
            height: 48px;
            object-fit: contain;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        }

        .navbar-nav .nav-link {
            color: var(--yellow) !important;
            font-weight: 600;
            margin: 0 0.35rem;
            padding: 0.5rem 0.9rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: var(--text-light) !important;
        }

        /* Underline effect for active link */
        .navbar-nav .nav-link.active::after {
            content: "";
            position: absolute;
            bottom: 5px;
            left: 10%;
            width: 80%;
            height: 2px;
            background-color: var(--text-light);
            border-radius: 1px;
        }

        /* Navbar toggle button (burger) */
        .navbar-toggler {
            border: none;
            filter: invert(100%);
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .container-gap {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            width: 100%;
        }

        /* ===== Content ===== */
        .content {
            margin-top: 75px;
            min-height: calc(100vh - 160px);
        }

        /* ===== Footer ===== */
        footer {
            background: linear-gradient(90deg, var(--green-dark), var(--green));
            color: #fff;
            padding: 20px 0;
            text-align: center;
            font-size: 0.95rem;
            box-shadow: 0 -3px 8px rgba(0, 0, 0, 0.1);
        }

        footer small {
            color: #f1f1f1;
            letter-spacing: 0.3px;
        }

        footer small span {
            color: var(--yellow);
            font-weight: 600;
        }

        /* ===== Responsive ===== */
        @media (max-width: 992px) {
            .navbar-nav .nav-link {
                text-align: center;
                margin: 0.25rem 0;
            }
            .navbar-collapse {
                background: rgba(0, 0, 0, 0.2);
                border-radius: 12px;
                padding: 0.75rem;
            }
        }
    </style>
</head>

<body>
    <!-- ===== Navbar ===== -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container container-gap">
            <a class="navbar-brand" href="{{ url('/') }}">
                @if($schoolProfile?->logo)
                    <img src="{{ asset($schoolProfile->logo) }}" alt="Logo" class="navbar-logo" />
                @else
                    <img src="{{ asset('assets/image/default-logo.png') }}" alt="Logo" class="navbar-logo" />
                @endif
                {{ $schoolProfile?->nama_sekolah ?? 'MTsN 10 Tasikmalaya' }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link {{ request()->is('students*') ? 'active' : '' }}" href="{{ route('public.students.index') }}">Siswa</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('teachers*') ? 'active' : '' }}" href="{{ route('public.teachers.index') }}">Guru</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('news*') ? 'active' : '' }}" href="{{ route('public.news.index') }}">Berita</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('galleries*') ? 'active' : '' }}" href="{{ route('public.galleries.index') }}">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('extracurriculars*') ? 'active' : '' }}" href="{{ route('public.extracurricular.index') }}">Ekstrakurikuler</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('school-profile*') ? 'active' : '' }}" href="{{ route('school-profile.show') }}">Profil Sekolah</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ===== Content ===== -->
    <div class="content">
        @yield('content')
    </div>

    <!-- ===== Footer ===== -->
    <footer>
        <small>
            © {{ date('Y') }}
            <span>{{ $schoolProfile?->nama_sekolah ?? 'School Website' }}</span>
            — Ikhlas Beramal
        </small>
    </footer>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
