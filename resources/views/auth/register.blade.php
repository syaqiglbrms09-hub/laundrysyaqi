<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Laundry</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f8f8;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-card {
            width: 100%;
            max-width: 450px;
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
        }

        .register-header {
            background: linear-gradient(135deg, #087f8c, #13a89e);
            color: white;
            text-align: center;
            padding: 28px;
        }

        .register-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 10px;
            padding: 11px;
        }

        .btn-register {
            background: #087f8c;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
        }

        .btn-register:hover {
            background: #075e68;
            color: white;
        }
    </style>
</head>
<body>

<div class="card register-card">
    <div class="register-header">
        <h3>🫧 Laundry</h3>
        <p class="mb-0">Buat Akun Baru</p>
    </div>

    <div class="register-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                       class="form-control" required>
            </div>

            <button type="submit" class="btn btn-register w-100">
                Daftar Sekarang
            </button>
        </form>

        <div class="text-center mt-3">
            Sudah punya akun?
            <a href="{{ route('login') }}" style="color:#087f8c;">
                Login di sini
            </a>
        </div>

    </div>
</div>

</body>
</html>