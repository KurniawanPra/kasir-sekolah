<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('siswa.kelas')->latest()->get();

        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $siswas = Siswa::with('kelas.guru')->get();

        return view('transaksi.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'bulan_tagihan' => 'required',
            'nominal_bayar' => 'required|numeric|min:0',
        ]);

        $siswa = Siswa::with('kelas')->findOrFail($request->siswa_id);
        $biaya_spp = $siswa->kelas->nominal_spp ?? 0;
        $status = ($request->nominal_bayar >= $biaya_spp) ? 'Lunas' : 'Belum Lunas';

        Transaksi::create([
            'kode_transaksi' => 'TRX-'.mt_rand(1000, 9999),
            'siswa_id' => $request->siswa_id,
            'bulan_tagihan' => $request->bulan_tagihan,
            'nominal_bayar' => $request->nominal_bayar,
            'status' => $status,
            'tanggal_bayar' => now(),
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Pembayaran berhasil disimpan.');
    }

    public function edit(Transaksi $transaksi)
    {
        $siswas = Siswa::with('kelas')->get();

        return view('transaksi.edit', compact('transaksi', 'siswas'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'siswa_id' => 'required',
            'bulan_tagihan' => 'required',
            'nominal_bayar' => 'required|numeric',
        ]);

        $siswa = Siswa::with('kelas')->findOrFail($request->siswa_id);
        $biaya_spp = $siswa->kelas->nominal_spp ?? 0;
        $status = ($request->nominal_bayar >= $biaya_spp) ? 'Lunas' : 'Belum Lunas';

        $transaksi->update([
            'siswa_id' => $request->siswa_id,
            'bulan_tagihan' => $request->bulan_tagihan,
            'nominal_bayar' => $request->nominal_bayar,
            'status' => $status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi dihapus.');
    }
}
