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
            'name' => 'required|string|max:255',
            'guru_id' => 'required|exists:gurus,id',
            'nominal_spp' => 'required|numeric|min:0',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'guru_id' => 'required|exists:gurus,id',
            'nominal_spp' => 'required|numeric|min:0',
        ]);

        $kelas = Kelas::findOrFail($id);

        $kelas->update([
            'name' => $request->name,
            'guru_id' => $request->guru_id,
            'nominal_spp' => $request->nominal_spp,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus!');
    }
}
