<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\RegisterController;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $totalTransaksi = Transaksi::count();
        $proses = Transaksi::where('status', 'Proses')->count();
        $selesai = Transaksi::where('status', 'Selesai')->count();
        $pendapatan = Transaksi::where('status', 'Selesai')->sum('total_harga');

        return view('dashboard', compact('totalTransaksi', 'proses', 'selesai', 'pendapatan'));
    })->name('dashboard');

    // CRUD Layanan (Admin kelola data layanan, Kasir melihat daftar layanan)[cite: 1, 3]
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
    Route::middleware('role:admin')->group(function () {
        Route::post('/layanan', [LayananController::class, 'store'])->name('layanan.store');
        Route::put('/layanan/{layanan}', [LayananController::class, 'update'])->name('layanan.update');
        Route::delete('/layanan/{layanan}', [LayananController::class, 'destroy'])->name('layanan.destroy');
    });

Route::get('/register', [RegisterController::class, 'show'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');

    // Rekap & Input Transaksi (Admin & Kasir)[cite: 1, 3]
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::patch('/transaksi/{id}/selesai', [TransaksiController::class, 'selesai'])->name('transaksi.selesai');
});