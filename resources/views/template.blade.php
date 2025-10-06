<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', $schoolProfile?->nama_sekolah ?? 'School Website')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            padding: 0;
            background: white;
            min-height: 100vh;
            font-family: "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", sans-serif;
        }

        nav.navbar {
            background: linear-gradient(90deg, #145a32, #1e8449);
            box-shadow: 0 4px 8px rgb(0 0 0 / 0.15);
            padding: 0.8rem 1rem;
        }
        .navbar-brand {
            color: #f4f186 !important;
            font-weight: 700;
            font-size: 1.35rem;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
        }
        .navbar-nav .nav-link {
            color: #f4f186 !important;
            font-weight: 600;
            margin: 0 0.35rem;
            padding: 0.5rem 0.9rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffb0 !important;
            text-decoration: none;
        }
        img.navbar-logo {
            margin-right: 10px;
            width: 48px;
            height: 48px;
            object-fit: contain;
        }
        .container-gap {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            width: 100%;
        }

        footer {
            background: #145a32;
            color: #fff;
            padding: 15px 0;
            margin-top: 40px;
            text-align: center;
        }
        .content{
            margin-top: 110px
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg mb-0 fixed-top">
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
                    <li class="nav-item"><a class="nav-link {{ request()->is('students*') ? 'active' : '' }}" href="{{ route('public.students.index') }}">Students</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('teachers*') ? 'active' : '' }}" href="{{ route('public.teachers.index') }}">Teachers</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('news*') ? 'active' : '' }}" href="{{ route('public.news.index') }}">News</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('galleries*') ? 'active' : '' }}" href="{{ route('public.galleries.index') }}">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('extracurriculars*') ? 'active' : '' }}" href="{{ route('public.extracurricular.index') }}">Extracurriculars</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->is('school-profile*') ? 'active' : '' }}" href="{{ route('school-profile.show') }}">School Profile</a></li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <small>© {{ date('Y') }} {{ $schoolProfile?->nama_sekolah ?? 'School Website' }} | Ikhlas Beramal</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
