<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - MTsN 10 Tasikmalaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #eafaf1, #d1f0e0);
            font-family: "Segoe UI", sans-serif;
        }
        .card {
            border-radius: 12px;
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(90deg, #1a5e3d, #2e7d50);
            color: #fff;
            text-align: center;
            font-weight: bold;
            padding: 15px;
        }
        .btn-login {
            background-color: #1a5e3d;
            border: none;
        }
        .btn-login:hover {
            background-color: #2e7d50;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow" style="width: 400px;">
        <div class="card-header">
            MTsN 10 Tasikmalaya <br>
            <small class="fw-normal">Login Admin</small>
        </div>
        <div class="card-body p-4">
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="username" 
                        name="username" 
                        value="{{ old('username') }}" 
                        required 
                        autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password" 
                        name="password" 
                        required>
                </div>

                <button type="submit" class="btn btn-login text-white w-100 fw-bold">
                    Login
                </button>
            </form>
        </div>
    </div>

</body>
</html>
