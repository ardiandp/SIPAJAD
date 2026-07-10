<?php

namespace App\Http\Controllers;

use App\Models\Hari;
use Illuminate\Http\Request;

class HariController extends Controller
{
    public function index()
    {
        $hariList = Hari::orderBy('urutan')->get();
        return view('master.hari.index', compact('hariList'));
    }

    public function create()
    {
        return view('master.hari.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:20',
            'urutan' => 'required|integer|unique:hari,urutan',
        ]);

        Hari::create($validated);
        return redirect()->route('master.hari.index')->with('success', 'Hari berhasil ditambahkan');
    }

    public function edit(Hari $hari)
    {
        return view('master.hari.form', compact('hari'));
    }

    public function update(Request $request, Hari $hari)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:20',
            'urutan' => 'required|integer|unique:hari,urutan,' . $hari->id,
        ]);

        $hari->update($validated);
        return redirect()->route('master.hari.index')->with('success', 'Hari berhasil diupdate');
    }

    public function destroy(Hari $hari)
    {
        $hari->delete();
        return redirect()->route('master.hari.index')->with('success', 'Hari berhasil dihapus');
    }
}
