<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Guru;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with(['jurusan', 'waliKelas', 'ruangan'])->latest()->get();
        return view('master.kelas.index', compact('kelas'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        $gurus = Guru::where('status', 'aktif')->get();
        $ruangans = Ruangan::where('jenis', 'kelas')->get();
        return view('master.kelas.form', compact('jurusans', 'gurus', 'ruangans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'tingkat' => 'required|in:10,11,12',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'wali_kelas_id' => 'nullable|exists:gurus,id',
            'ruangan_id' => 'nullable|exists:ruangans,id',
        ]);

        Kelas::create($validated);
        return redirect()->route('master.kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit(Kelas $kelas)
    {
        $jurusans = Jurusan::all();
        $gurus = Guru::where('status', 'aktif')->get();
        $ruangans = Ruangan::where('jenis', 'kelas')->get();
        return view('master.kelas.form', compact('kelas', 'jurusans', 'gurus', 'ruangans'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:50',
            'tingkat' => 'required|in:10,11,12',
            'jurusan_id' => 'nullable|exists:jurusans,id',
            'wali_kelas_id' => 'nullable|exists:gurus,id',
            'ruangan_id' => 'nullable|exists:ruangans,id',
        ]);

        $kelas->update($validated);
        return redirect()->route('master.kelas.index')->with('success', 'Kelas berhasil diupdate');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('master.kelas.index')->with('success', 'Kelas berhasil dihapus');
    }
}
