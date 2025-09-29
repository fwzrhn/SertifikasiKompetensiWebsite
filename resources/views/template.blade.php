<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'School Website')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(120deg, #eafaf1, #d1f0e0);
            min-height: 100vh;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        }
        nav.navbar {
            background: linear-gradient(90deg, #1a5e3d, #2e7d50);
            box-shadow: 0 2px 4px rgb(0 0 0 / 0.1);
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
        .navbar-brand {
            color: #f4f186 !important;  /* kuning soft */
            font-weight: 700;
            font-size: 1.25rem;
        }
        .navbar-nav .nav-link {
            color: #f4f186 !important; /* kuning soft juga untuk link */
            font-weight: 600;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #ffffa0 !important;
            text-decoration: underline;
        }
        img.navbar-logo {
            margin-right: 10px;
            width: 50px;
            height: 50px;
            object-fit: contain;
        }
        .container-gap {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding-left: 1rem;
            padding-right: 1rem;
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg mb-0">
        <div class="container container-gap">
            <img src="{{ asset('assets/image/ikhlas-beramal-png-6-Transparent-Images.png') }}" alt="Logo" class="navbar-logo" />
            <a class="navbar-brand" href="{{ url('/') }}">MTsN 10 Tasikmalaya</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="">Students</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Teachers</a></li>
                    <li class="nav-item"><a class="nav-link" href="">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Extracurriculars</a></li>
                    <li class="nav-item"><a class="nav-link" href="">School Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content-wrapper">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
