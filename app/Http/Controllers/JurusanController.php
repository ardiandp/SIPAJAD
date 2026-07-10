<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::latest()->get();
        return view('master.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('master.jurusan.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:jurusans',
            'nama' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        Jurusan::create($validated);
        return redirect()->route('master.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('master.jurusan.form', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:20|unique:jurusans,kode,' . $jurusan->id,
            'nama' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $jurusan->update($validated);
        return redirect()->route('master.jurusan.index')->with('success', 'Jurusan berhasil diupdate');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('master.jurusan.index')->with('success', 'Jurusan berhasil dihapus');
    }
}
