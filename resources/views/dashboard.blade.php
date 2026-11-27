@extends('layouts.app')

@section('title', 'Dashboard - LaundryKu')

@section('content')

<style>
    :root {
        --primary: #087f8c;
        --primary-dark: #075e68;
        --secondary: #13a89e;
        --light-bg: #f0f8f8;
    }

    .dashboard-title {
        color: var(--primary-dark);
    }

    .dashboard-card {
        border: none;
        border-radius: 16px;
        transition: 0.3s ease;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(8, 127, 140, 0.12) !important;
    }

    .dashboard-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        font-size: 23px;
    }

    .icon-blue {
        background: #dff3f5;
        color: #087f8c;
    }

    .icon-orange {
        background: #fff1d9;
        color: #e69a19;
    }

    .icon-green {
        background: #dff5e9;
        color: #198754;
    }

    .icon-teal {
        background: #d9f3ef;
        color: #13a89e;
    }

    .dashboard-number {
        color: var(--primary-dark);
        font-size: 27px;
    }

    .btn-teal {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border: none;
        color: white;
        border-radius: 9px;
        font-weight: 500;
    }

    .btn-teal:hover {
        background: var(--primary-dark);
        color: white;
    }

    .btn-outline-teal {
        color: var(--primary);
        border: 1px solid var(--primary);
        border-radius: 9px;
    }

    .btn-outline-teal:hover {
        background: var(--primary);
        color: white;
    }

    .dashboard-subtitle {
        color: #718080;
        font-size: 13px;
    }
</style>

<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold dashboard-title mb-1">
            🫧 Dashboard
        </h4>
        <small class="dashboard-subtitle">
            Ringkasan operasional dan keuangan laundry
        </small>
    </div>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('layanan.index') }}" class="btn btn-outline-teal px-3">
            🧼 Data Layanan
        </a>

        <a href="{{ route('transaksi.index') }}" class="btn btn-teal px-3">
            📋 Rekap Transaksi Laundry
        </a>
    </div>
</div>

<div class="row g-3">

    {{-- Total Transaksi --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted small fw-semibold">Total Transaksi</span>
                    <div class="dashboard-icon icon-blue">📋</div>
                </div>

                <h3 class="fw-bold dashboard-number mb-1">
                    {{ $totalTransaksi }}
                </h3>

                <small class="text-muted">Seluruh transaksi laundry</small>
            </div>
        </div>
    </div>

    {{-- Sedang Diproses --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted small fw-semibold">Sedang Diproses</span>
                    <div class="dashboard-icon icon-orange">⏳</div>
                </div>

                <h3 class="fw-bold text-warning mb-1">
                    {{ $proses }}
                </h3>

                <small class="text-muted">Transaksi dalam pengerjaan</small>
            </div>
        </div>
    </div>

    {{-- Transaksi Selesai --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted small fw-semibold">Transaksi Selesai</span>
                    <div class="dashboard-icon icon-green">✅</div>
                </div>

                <h3 class="fw-bold text-success mb-1">
                    {{ $selesai }}
                </h3>

                <small class="text-muted">Laundry sudah selesai</small>
            </div>
        </div>
    </div>

    {{-- Total Pendapatan --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted small fw-semibold">Total Pendapatan</span>
                    <div class="dashboard-icon icon-teal">💰</div>
                </div>

                <h4 class="fw-bold dashboard-number mb-1">
                    Rp {{ number_format($pendapatan, 0, ',', '.') }}
                </h4>

                <small class="text-muted">Dari transaksi yang selesai</small>
            </div>
        </div>
    </div>

</div>

@endsection
