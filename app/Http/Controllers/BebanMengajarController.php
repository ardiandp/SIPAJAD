<?php

namespace App\Http\Controllers;

use App\Models\BebanMengajar;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use Illuminate\Http\Request;

class BebanMengajarController extends Controller
{
    public function index()
    {
        $bebans = BebanMengajar::with(['guru', 'mataPelajaran', 'kelas'])->latest()->get();
        $gurus = Guru::where('status', 'aktif')->get();
        return view('master.beban.index', compact('bebans', 'gurus'));
    }

    public function create()
    {
        $gurus = Guru::where('status', 'aktif')->get();
        $mapels = MataPelajaran::all();
        $kelas = Kelas::all();
        return view('master.beban.form', compact('gurus', 'mapels', 'kelas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'jumlah_jam' => 'required|integer|min:1',
        ]);

        BebanMengajar::create($validated);
        return redirect()->route('master.beban.index')->with('success', 'Beban mengajar berhasil ditambahkan');
    }

    public function edit(BebanMengajar $bebanMengajar)
    {
        $gurus = Guru::where('status', 'aktif')->get();
        $mapels = MataPelajaran::all();
        $kelas = Kelas::all();
        return view('master.beban.form', compact('bebanMengajar', 'gurus', 'mapels', 'kelas'));
    }

    public function update(Request $request, BebanMengajar $bebanMengajar)
    {
        $validated = $request->validate([
            'guru_id' => 'required|exists:gurus,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'jumlah_jam' => 'required|integer|min:1',
        ]);

        $bebanMengajar->update($validated);
        return redirect()->route('master.beban.index')->with('success', 'Beban mengajar berhasil diupdate');
    }

    public function destroy(BebanMengajar $bebanMengajar)
    {
        $bebanMengajar->delete();
        return redirect()->route('master.beban.index')->with('success', 'Beban mengajar berhasil dihapus');
    }

    public function byGuru(Guru $guru)
    {
        $bebans = BebanMengajar::with(['mataPelajaran', 'kelas'])
            ->where('guru_id', $guru->id)->get();
        return response()->json($bebans);
    }
}
