<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laundry Management System')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #087f8c;
            --primary-dark: #075e68;
            --secondary: #13a89e;
            --light-bg: #f0f8f8;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light-bg);
            color: #263b40;
        }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(120deg, #075e68, #087f8c, #13a89e);
            padding: 15px 0;
        }

        .navbar-brand {
            font-size: 23px;
            letter-spacing: .3px;
        }

        .navbar .nav-link {
            color: rgba(255,255,255,.85);
            margin: 0 5px;
            padding: 9px 15px !important;
            border-radius: 9px;
            transition: .3s;
        }

        .navbar .nav-link:hover {
            background: rgba(255,255,255,.15);
            color: white;
        }

        .navbar .nav-link.active {
            background: rgba(255,255,255,.22);
            color: white;
            font-weight: 600;
        }

        .navbar-toggler {
            border-color: rgba(255,255,255,.4);
        }

        /* USER BADGE */
        .user-badge {
            background: rgba(255,255,255,.18);
            color: white;
            border: 1px solid rgba(255,255,255,.25);
            padding: 9px 14px;
            border-radius: 30px;
            font-size: 12px;
        }

        /* BUTTON */
        .btn-outline-light {
            border-radius: 9px;
            font-weight: 500;
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            border-radius: 9px;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        /* CONTENT */
        .container.pb-5 {
            min-height: 75vh;
        }

        /* CARD */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 18px rgba(8,127,140,.07);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e4eeee;
            font-weight: 600;
        }

        /* TABLE */
        .table thead th {
            background: #e0f2f1;
            color: #075e68;
            font-weight: 600;
            border: none;
            padding: 14px;
        }

        .table tbody td {
            padding: 13px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: #f0fbfa;
        }

        /* ALERT */
        .alert {
            border: none;
            border-radius: 12px;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            color: #82999c;
            font-size: 12px;
            padding: 20px 0;
        }

        @media (max-width: 991px) {
            .navbar .nav-link {
                margin: 3px 0;
            }

            .user-section {
                padding-top: 12px;
                border-top: 1px solid rgba(255,255,255,.2);
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-4">
    <div class="container">

    <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">
    🫧 LaundryKu
</a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto ms-lg-4">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                        ▦ Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('layanan.*') ? 'active' : '' }}"
                    href="{{ route('layanan.index') }}">
                        ◈ Data Layanan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('transaksi.*') || request()->routeIs('laporan.*') ? 'active' : '' }}"
                    href="{{ route('transaksi.index') }}">
                        ▤ Rekap Transaksi Laundry
                    </a>
                </li>

            </ul>

            @auth
            <div class="d-flex align-items-center gap-3 user-section">

                <span class="user-badge text-uppercase">
                    👤 {{ auth()->user()->name }}
                    ({{ auth()->user()->role }})
                </span>

                <form action="{{ route('logout') }}"
                      method="POST"
                      class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light px-3">
                        Logout
                    </button>
                </form>

            </div>
            @endauth

        </div>
    </div>
</nav>

<div class="container pb-5">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            ✓ {{ session('success') }}
            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm">
            {{ session('error') }}
            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')

</div>

<footer class="footer">
    <div class="container">
        © {{ date('Y') }} LaundryKu - Sistem Informasi Manajemen Laundry
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
