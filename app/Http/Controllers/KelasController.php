<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with('guru')->get();

        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guru = Guru::all();

        return view('kelas.create', compact('guru'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'guru_id' => 'required|exists:gurus,id',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Berhasil Tambah data Kelas!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $kelas = Kelas::findOrFail($id);
        $guru = Guru::all();

        return view('kelas.edit', compact('kelas', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,int $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'guru_id' => 'required|exists:gurus,id',
        ]);

        $kelas = Kelas::findOrFail($id);

        $kelas->update([
            'nama' => $request->nama,
            'guru_id' => $request->guru_id,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Berhasil Mengupdate Data Kelas!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Berhasil Hapus Data Kelas!');
    }
}
