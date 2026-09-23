<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $gurus = Guru::query()
            ->when($request->search, function ($query, $search) {
                $query->where('nama_guru', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_guru' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:gurus,nip',
            'jabatan' => 'required|string|max:50',
            'mata_pelajaran' => 'required|string|max:50',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:gurus,email',
            'alamat' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-guru', 'public');
        }

        Guru::create($data);

        return redirect()->route('guru.index')->with('success', 'Berhasil Tambah Data Guru!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        return view('guru.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        $data = $request->validate([
            'nama_guru' => 'required|string|max:255',
            'nip' => 'required|string|max:20|unique:gurus,nip,'.$guru->id,
            'jabatan' => 'required|string|max:50',
            'mata_pelajaran' => 'required|string|max:50',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|email|unique:gurus,email,'.$guru->id,
            'alamat' => 'required|string',
            'status' => 'required|in:aktif,nonaktif',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }

            $data['foto'] = $request->file('foto')->store('foto-guru', 'public');
        }

        $guru->update($data);

        return redirect()->route('guru.index')->with('success', 'Berhasil Update data Guru!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
            Storage::disk('public')->delete($guru->foto);
        }

        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Berhasil Menghapus data Guru!');
    }
}
