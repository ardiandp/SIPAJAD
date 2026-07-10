<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::latest()->get();
        return view('master.ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        return view('master.ruangan.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'kapasitas' => 'required|integer|min:1',
            'jenis' => 'required|in:kelas,laboratorium,aula,bengkel,lainnya',
            'keterangan' => 'nullable|string',
        ]);

        Ruangan::create($validated);
        return redirect()->route('master.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function edit(Ruangan $ruangan)
    {
        return view('master.ruangan.form', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'kapasitas' => 'required|integer|min:1',
            'jenis' => 'required|in:kelas,laboratorium,aula,bengkel,lainnya',
            'keterangan' => 'nullable|string',
        ]);

        $ruangan->update($validated);
        return redirect()->route('master.ruangan.index')->with('success', 'Ruangan berhasil diupdate');
    }

    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->route('master.ruangan.index')->with('success', 'Ruangan berhasil dihapus');
    }
}
