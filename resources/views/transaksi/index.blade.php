@extends('layouts.app')

@section('title', 'Rekap Transaksi Laundry - LaundryKu')

@section('content')

<style>
    :root {
        --primary: #087f8c;
        --primary-dark: #075e68;
        --secondary: #13a89e;
        --light-bg: #f0f8f8;
    }

    .page-title {
        color: var(--primary-dark);
    }

    .custom-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
    }

    .custom-card .card-header {
        background: linear-gradient(135deg, var(--primary-dark), var(--secondary));
        color: white;
        border: none;
        padding: 16px 20px;
        font-weight: 600;
    }

    .income-card {
        background: linear-gradient(135deg, var(--primary-dark), var(--secondary));
        color: white;
        border: none;
        border-radius: 15px;
        min-width: 220px;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #425b5b;
    }

    .form-control,
    .form-select {
        border-radius: 9px;
        padding: 10px 12px;
        border: 1px solid #d5e5e5;
        font-size: 13px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--secondary);
        box-shadow: 0 0 0 0.2rem rgba(19, 168, 158, 0.15);
    }

    .btn-teal {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border: none;
        border-radius: 9px;
        font-weight: 500;
    }

    .btn-teal:hover {
        background: var(--primary-dark);
        color: white;
    }

    .btn-finish {
        background: #dff5e9;
        color: #198754;
        border: none;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-finish:hover {
        background: #198754;
        color: white;
    }

    .table thead th {
        background: var(--light-bg);
        color: var(--primary-dark);
        font-size: 12px;
        font-weight: 600;
        padding: 14px;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 14px;
        font-size: 13px;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background: #f5fbfb;
    }

    .customer-name {
        color: var(--primary-dark);
        font-weight: 600;
    }

    .price-text {
        color: var(--primary-dark);
        font-weight: 700;
        white-space: nowrap;
    }

    .badge-proses {
        background: #fff1d9;
        color: #a66a0b;
        padding: 7px 12px;
        border-radius: 20px;
    }

    .badge-selesai {
        background: #dff5e9;
        color: #198754;
        padding: 7px 12px;
        border-radius: 20px;
    }
</style>

{{-- Header Halaman --}}
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

    <div>
        <h4 class="fw-bold page-title mb-1">
            📋 Rekap Transaksi Laundry
        </h4>

        <small class="text-muted">
            Pencatatan transaksi masuk, status pengerjaan, dan rekap pendapatan
        </small>
    </div>

    <div class="card income-card shadow-sm px-3 py-3">
        <div class="small opacity-75">
            💰 Total Pendapatan (Selesai)
        </div>

        <div class="fw-bold fs-5">
            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
        </div>
    </div>

</div>

{{-- Form Transaksi Baru --}}
<div class="card custom-card shadow-sm mb-4">

    <div class="card-header">
        ➕ Catat Transaksi Baru
    </div>

    <div class="card-body p-4">

        <form action="{{ route('transaksi.store') }}" method="POST" class="row g-3">
            @csrf

            <div class="col-md-6 col-lg-3">
                <label class="form-label">Nama Pelanggan</label>

                <input
                    type="text"
                    name="nama_pelanggan"
                    value="{{ old('nama_pelanggan') }}"
                    class="form-control"
                    placeholder="Masukkan nama pelanggan"
                    required
                >
            </div>

            <div class="col-md-6 col-lg-3">
                <label class="form-label">No. HP</label>

                <input
                    type="text"
                    name="no_hp"
                    value="{{ old('no_hp') }}"
                    class="form-control"
                    placeholder="08xxxxxxxxxx"
                    required
                >
            </div>

            <div class="col-md-6 col-lg-3">
                <label class="form-label">Jenis Layanan</label>

                <select name="layanan_id" class="form-select" required>
                    <option value="">-- Pilih Layanan --</option>

                    @foreach($layanans as $layanan)
                        <option
                            value="{{ $layanan->id }}"
                            {{ old('layanan_id') == $layanan->id ? 'selected' : '' }}
                        >
                            {{ $layanan->nama_layanan }}
                            (Rp {{ number_format($layanan->harga_per_kg, 0, ',', '.') }}/kg)
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 col-lg-2">
                <label class="form-label">Berat (Kg)</label>

                <input
                    type="number"
                    step="0.1"
                    min="0.1"
                    name="berat"
                    value="{{ old('berat') }}"
                    class="form-control"
                    placeholder="2.5"
                    required
                >
            </div>

            <div class="col-lg-1 d-flex align-items-end">
                <button type="submit" class="btn btn-teal w-100 py-2">
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>

{{-- Tabel Transaksi --}}
<div class="card custom-card shadow-sm">

    <div class="card-header">
        📑 Daftar Transaksi Laundry
    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Pelanggan</th>
                        <th>No. HP</th>
                        <th>Layanan</th>
                        <th>Berat</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($transaksis as $index => $trx)

                    <tr>
                        <td class="ps-4">
                            {{ $index + 1 }}
                        </td>

                        <td class="customer-name">
                            {{ $trx->nama_pelanggan }}
                        </td>

                        <td>
                            {{ $trx->no_hp }}
                        </td>

                        <td>
                            <div class="fw-semibold">
                                {{ $trx->layanan->nama_layanan }}
                            </div>

                            <small class="text-muted">
                                Rp {{ number_format($trx->layanan->harga_per_kg, 0, ',', '.') }}/kg
                            </small>
                        </td>

                        <td>
                            {{ $trx->berat }} kg
                        </td>

                        <td class="price-text">
                            Rp {{ number_format($trx->total_harga, 0, ',', '.') }}
                        </td>

                        <td>
                            @if($trx->status === 'Proses')
                                <span class="badge badge-proses">
                                    ⏳ Proses
                                </span>
                            @else
                                <span class="badge badge-selesai">
                                    ✓ Selesai
                                </span>
                            @endif
                        </td>

                        <td class="text-center">

                            @if($trx->status === 'Proses')

                                <form
                                    action="{{ route('transaksi.selesai', $trx->id) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Tandai transaksi ini sebagai selesai?')"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-sm btn-finish px-3">
                                        ✓ Tandai Selesai
                                    </button>
                                </form>

                            @else

                                <span class="text-success small fw-semibold">
                                    ✓ Tuntas
                                </span>

                            @endif

                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <div class="fs-2 mb-2">🫧</div>

                            <div class="fw-semibold">
                                Belum ada transaksi tercatat
                            </div>

                            <small>
                                Silakan catat transaksi laundry baru.
                            </small>
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>
</div>

@endsection
