<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mapels = MataPelajaran::latest()->get();
        return view('master.mapel.index', compact('mapels'));
    }

    public function create()
    {
        return view('master.mapel.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:mata_pelajarans',
            'nama' => 'required|string|max:100',
            'kelompok' => 'required|in:A,B,C',
            'durasi' => 'required|integer|min:1',
            'jam_per_minggu' => 'required|integer|min:1',
            'jenis' => 'required|in:teori, praktikum',
        ]);

        MataPelajaran::create($validated);
        return redirect()->route('master.mapel.index')->with('success', 'Mata pelajaran berhasil ditambahkan');
    }

    public function edit(MataPelajaran $mataPelajaran)
    {
        return view('master.mapel.form', compact('mataPelajaran'));
    }

    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:mata_pelajarans,kode,' . $mataPelajaran->id,
            'nama' => 'required|string|max:100',
            'kelompok' => 'required|in:A,B,C',
            'durasi' => 'required|integer|min:1',
            'jam_per_minggu' => 'required|integer|min:1',
            'jenis' => 'required|in:teori, praktikum',
        ]);

        $mataPelajaran->update($validated);
        return redirect()->route('master.mapel.index')->with('success', 'Mata pelajaran berhasil diupdate');
    }

    public function destroy(MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->delete();
        return redirect()->route('master.mapel.index')->with('success', 'Mata pelajaran berhasil dihapus');
    }
}
