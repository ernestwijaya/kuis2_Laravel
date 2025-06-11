<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\MataKuliah;
use App\Models\Sesi;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::with(['sesi', 'mataKuliah', 'dosen'])->get();
        return view('jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $sesi = Sesi::all();
        $mataKuliah = MataKuliah::all();
        $dosen = User::all();
        return view('jadwal.create', compact('sesi', 'mataKuliah', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_akademik' => 'required|string|max:10',
            'kode_smt' => 'required|string|in:Gasal,Genap',
            'kelas' => 'required|string|max:10',
            'sesi_id' => 'required|exists:sesi,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'dosen_id' => 'required|exists:users,id',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.index')->with('sukses', 'Jadwal berhasil dibuat.');
    }
    public function edit(Jadwal $jadwal)
    {
        $sesi = Sesi::all();
        $mataKuliah = MataKuliah::all();
        $dosen = User::all();
        return view('jadwal.edit', compact('jadwal', 'sesi', 'mataKuliah', 'dosen'));
    }
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'tahun_akademik' => 'required|string|max:10',
            'kode_smt' => 'required|string|in:Gasal,Genap',
            'kelas' => 'required|string|max:10',
            'sesi_id' => 'required|exists:sesi,id',
            'mata_kuliah_id' => 'required|exists:mata_kuliah,id',
            'dosen_id' => 'required|exists:users,id',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('sukses', 'Jadwal berhasil di update.');
    }
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('sukses', 'Jadwal berhasil di hapus.');
    }
}
