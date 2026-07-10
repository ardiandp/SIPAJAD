<?php

namespace App\Http\Controllers;

use App\Models\Jam;
use Illuminate\Http\Request;

class JamController extends Controller
{
    public function index()
    {
        $jamList = Jam::orderBy('urutan')->get();
        return view('master.jam.index', compact('jamList'));
    }

    public function create()
    {
        return view('master.jam.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:20',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'urutan' => 'required|integer',
        ]);

        Jam::create($validated);
        return redirect()->route('master.jam.index')->with('success', 'Jam pelajaran berhasil ditambahkan');
    }

    public function edit(Jam $jam)
    {
        return view('master.jam.form', compact('jam'));
    }

    public function update(Request $request, Jam $jam)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:20',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'urutan' => 'required|integer',
        ]);

        $jam->update($validated);
        return redirect()->route('master.jam.index')->with('success', 'Jam pelajaran berhasil diupdate');
    }

    public function destroy(Jam $jam)
    {
        $jam->delete();
        return redirect()->route('master.jam.index')->with('success', 'Jam pelajaran berhasil dihapus');
    }
}
