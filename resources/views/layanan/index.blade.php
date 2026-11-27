@extends('layouts.app')

@section('title', 'Data Layanan - LaundryKu')

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

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #425b5b;
    }

    .form-control {
        border-radius: 9px;
        padding: 10px 12px;
        border: 1px solid #d5e5e5;
    }

    .form-control:focus {
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

    .table thead th {
        background: var(--light-bg);
        color: var(--primary-dark);
        font-size: 13px;
        font-weight: 600;
        padding: 14px;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 14px;
        font-size: 13px;
    }

    .table tbody tr:hover {
        background: #f5fbfb;
    }

    .service-name {
        color: var(--primary-dark);
        font-weight: 600;
    }

    .price-badge {
        background: #e0f3f2;
        color: var(--primary-dark);
        padding: 6px 10px;
        border-radius: 8px;
        font-weight: 600;
        white-space: nowrap;
    }

    .btn-edit {
        background: #fff1d9;
        color: #b7791f;
        border: none;
        border-radius: 7px;
    }

    .btn-edit:hover {
        background: #f5dfb8;
        color: #8a5a12;
    }

    .btn-delete {
        background: #fde8e8;
        color: #c0392b;
        border: none;
        border-radius: 7px;
    }

    .btn-delete:hover {
        background: #f8d0d0;
        color: #922b21;
    }

    .modal-content {
        border: none;
        border-radius: 16px;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-dark), var(--secondary));
        color: white;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }
</style>

{{-- Judul Halaman --}}
<div class="mb-4">
    <h4 class="fw-bold page-title mb-1">🧼 Data Layanan</h4>
    <small class="text-muted">
        Daftar jenis layanan cuci dan tarif per kilogram
    </small>
</div>

<div class="row g-4">

    {{-- Form Tambah Layanan --}}
    @if(auth()->user()->role === 'admin')
    <div class="col-lg-4">
        <div class="card custom-card shadow-sm h-100">

            <div class="card-header">
                ➕ Tambah Layanan Baru
            </div>

            <div class="card-body p-4">

                <form action="{{ route('layanan.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Layanan</label>
                        <input
                            type="text"
                            name="nama_layanan"
                            class="form-control"
                            placeholder="Contoh: Reguler / Ekspres / Superkilat"
                            value="{{ old('nama_layanan') }}"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga per Kg (Rp)</label>
                        <input
                            type="number"
                            name="harga_per_kg"
                            class="form-control"
                            placeholder="7000"
                            min="0"
                            value="{{ old('harga_per_kg') }}"
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Estimasi Waktu</label>
                        <input
                            type="text"
                            name="estimasi_waktu"
                            class="form-control"
                            placeholder="Contoh: 3-4 hari"
                            value="{{ old('estimasi_waktu') }}"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-teal w-100 py-2">
                        💾 Simpan Layanan
                    </button>

                </form>

            </div>
        </div>
    </div>
    @endif

    {{-- Tabel Daftar Layanan --}}
    <div class="{{ auth()->user()->role === 'admin' ? 'col-lg-8' : 'col-12' }}">
        <div class="card custom-card shadow-sm">

            <div class="card-header">
                📋 Daftar Jenis Layanan
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead>
                            <tr>
                                <th class="ps-4">No</th>
                                <th>Nama Layanan</th>
                                <th>Harga / Kg</th>
                                <th>Estimasi</th>

                                @if(auth()->user()->role === 'admin')
                                    <th class="text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($layanans as $index => $layanan)

                            <tr>
                                <td class="ps-4">{{ $index + 1 }}</td>

                                <td class="service-name">
                                    {{ $layanan->nama_layanan }}
                                </td>

                                <td>
                                    <span class="price-badge">
                                        Rp {{ number_format($layanan->harga_per_kg, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td>
                                    <span class="text-muted">
                                        ⏱ {{ $layanan->estimasi_waktu }}
                                    </span>
                                </td>

                                @if(auth()->user()->role === 'admin')
                                <td class="text-center">

                                    <button
                                        type="button"
                                        class="btn btn-sm btn-edit px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $layanan->id }}"
                                    >
                                        ✏️ Edit
                                    </button>

                                    <form
                                        action="{{ route('layanan.destroy', $layanan) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus layanan ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-delete px-3">
                                            🗑 Hapus
                                        </button>
                                    </form>

                                </td>
                                @endif
                            </tr>

                            @if(auth()->user()->role === 'admin')
                            {{-- Modal Edit --}}
                            @push('modals')
                            <div
                                class="modal fade"
                                id="editModal{{ $layanan->id }}"
                                tabindex="-1"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content">

                                        <form action="{{ route('layanan.update', $layanan) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-header">
                                                <h5 class="modal-title fw-semibold">
                                                    ✏️ Edit Layanan
                                                </h5>

                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                ></button>
                                            </div>

                                            <div class="modal-body p-4">

                                                <div class="mb-3">
                                                    <label class="form-label">Nama Layanan</label>
                                                    <input
                                                        type="text"
                                                        name="nama_layanan"
                                                        value="{{ $layanan->nama_layanan }}"
                                                        class="form-control"
                                                        required
                                                    >
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Harga per Kg (Rp)</label>
                                                    <input
                                                        type="number"
                                                        name="harga_per_kg"
                                                        value="{{ $layanan->harga_per_kg }}"
                                                        class="form-control"
                                                        min="0"
                                                        required
                                                    >
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Estimasi Waktu</label>
                                                    <input
                                                        type="text"
                                                        name="estimasi_waktu"
                                                        value="{{ $layanan->estimasi_waktu }}"
                                                        class="form-control"
                                                        required
                                                    >
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Batal
                                                </button>

                                                <button type="submit" class="btn btn-teal px-4">
                                                    Simpan Perubahan
                                                </button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                            @endpush
                            @endif

                            @empty

                            <tr>
                                <td
                                    colspan="{{ auth()->user()->role === 'admin' ? 5 : 4 }}"
                                    class="text-center py-5 text-muted"
                                >
                                    <div class="fs-2 mb-2">🫧</div>
                                    <div class="fw-semibold">Belum ada data layanan</div>
                                    <small>Silakan tambahkan layanan baru.</small>
                                </td>
                            </tr>

                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')

@endpush
