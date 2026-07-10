<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::with('bebanMengajar.mataPelajaran')->latest()->get();
        return view('master.guru.index', compact('gurus'));
    }

    public function create()
    {
        $semuaMapel = MataPelajaran::all();
        return view('master.guru.form', compact('semuaMapel'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'nullable|unique:gurus,nip',
            'nama' => 'required|string|max:100',
            'gender' => 'nullable|in:L,P',
            'no_hp' => 'nullable|string|max:20',
            'status' => 'required|in:aktif,nonaktif',
            'bidang' => 'nullable|string|max:100',
            'maks_jam' => 'required|integer|min:1|max:40',
        ]);

        Guru::create($validated);
        return redirect()->route('master.guru.index')->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit(Guru $guru)
    {
        $semuaMapel = MataPelajaran::all();
        return view('master.guru.form', compact('guru', 'semuaMapel'));
    }

    public function update(Request $request, Guru $guru)
    {
        $validated = $request->validate([
            'nip' => 'nullable|unique:gurus,nip,' . $guru->id,
            'nama' => 'required|string|max:100',
            'gender' => 'nullable|in:L,P',
            'no_hp' => 'nullable|string|max:20',
            'status' => 'required|in:aktif,nonaktif',
            'bidang' => 'nullable|string|max:100',
            'maks_jam' => 'required|integer|min:1|max:40',
        ]);

        $guru->update($validated);
        return redirect()->route('master.guru.index')->with('success', 'Guru berhasil diupdate');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('master.guru.index')->with('success', 'Guru berhasil dihapus');
    }
}
