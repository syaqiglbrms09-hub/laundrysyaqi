<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LaundryKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #087f8c;
            --primary-dark: #075e68;
            --secondary: #13a89e;
            --light-bg: #f0f8f8;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e3f5f4, #f0f8f8, #d9eeee);
        }

        .login-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-dark), var(--secondary));
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .login-header h3 {
            font-weight: 700;
            margin-bottom: 5px;
        }

        .login-header p {
            font-size: 13px;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .form-label {
            font-weight: 600;
            color: #34495e;
            font-size: 14px;
        }

        .form-control {
            border-radius: 10px;
            padding: 11px 13px;
            border: 1px solid #d5e5e5;
        }

        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 0.2rem rgba(19, 168, 158, 0.15);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: white;
            border-radius: 10px;
            font-weight: 600;
            padding: 12px;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-1px);
        }

        .account-info {
            background: var(--light-bg);
            border-radius: 12px;
            padding: 15px;
            font-size: 12px;
            color: #526767;
        }

        .account-info strong {
            color: var(--primary-dark);
        }

        code {
            color: var(--primary);
        }
    </style>
</head>

<body class="d-flex align-items-center min-vh-100">

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">

            <div class="card login-card shadow-lg">

                <div class="login-header">
                    <h3>🫧 LaundryKu</h3>
                    <p>Sistem Informasi Manajemen Laundry</p>
                </div>

                <div class="card-body p-4">

                    {{-- Pesan Error Login --}}
                    @if($errors->any())
                        <div class="alert alert-danger py-2 small rounded-3">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger py-2 small rounded-3">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Form Login --}}
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control"
                                placeholder="admin@laundry.test"
                                required
                                autofocus
                            >
                        </div>

                        <div class="text-center mt-3">
    Belum punya akun?
    <a href="{{ route('register') }}">
        Daftar Sekarang
    </a>
</div>

                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-login w-100">
                            Masuk
                        </button>
                    </form>

                    <hr class="my-4">

                    {{-- Akun Uji Coba --}}
                    <div class="account-info">
                        <strong>🔐 Akun Uji Coba</strong>
                        <hr class="my-2">

                        <strong>Admin</strong><br>
                        Email: <code>admin@laundry.test</code><br>
                        Password: <code>password</code>

                        <hr class="my-2">

                        <strong>Kasir</strong><br>
                        Email: <code>kasir@laundry.test</code><br>
                        Password: <code>password</code>
                    </div>

                </div>
            </div>

            <p class="text-center text-muted small mt-3">
                © {{ date('Y') }} LaundryKu. All Rights Reserved.
            </p>

        </div>
    </div>
</div>

</body>
</html>