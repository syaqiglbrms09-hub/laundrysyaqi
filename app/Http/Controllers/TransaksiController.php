<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('layanan')->latest()->get();
        $layanans = Layanan::all();
        $totalPendapatan = Transaksi::where('status', 'Selesai')->sum('total_harga');
        return view('transaksi.index', compact('transaksis', 'layanans', 'totalPendapatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string',
            'no_hp' => 'required|string',
            'layanan_id' => 'required|exists:layanans,id',
            'berat' => 'required|numeric|min:0.1',
        ]);

        $layanan = Layanan::findOrFail($request->layanan_id);
        $totalHarga = $layanan->harga_per_kg * $request->berat;

        Transaksi::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
            'layanan_id' => $layanan->id,
            'berat' => $request->berat,
            'total_harga' => $totalHarga,
            'status' => 'Proses',
        ]);

        return back()->with('success', 'Transaksi berhasil dicatat.');
    }

    public function selesai($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update(['status' => 'Selesai']);
        return back()->with('success', 'Status cucian diperbarui menjadi Selesai.');
    }
}
