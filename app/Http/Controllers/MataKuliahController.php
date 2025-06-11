<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = MataKuliah::with('prodi')->get();
        return view('mata_kuliah.index', compact('mataKuliah'));
    }

    public function create()
    {
        $prodi = Prodi::all();
        return view('mata_kuliah.create', compact('prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|string|max:10|unique:mata_kuliah',
            'nama' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        MataKuliah::create($request->all());

        return redirect()->route('mata_kuliah.index')->with('sukses', 'Mata Kuliah berhasil dibuat.');
    }
    public function edit(MataKuliah $mataKuliah)
    {
        $prodi = Prodi::all();
        return view('mata_kuliah.edit', compact('mataKuliah', 'prodi'));
    }
    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $request->validate([
            'kode_mk' => 'required|string|max:10|unique:mata_kuliah,kode_mk,' . $mataKuliah->id,
            'nama' => 'required|string|max:100',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $mataKuliah->update($request->all());

        return redirect()->route('mata_kuliah.index')->with('sukses', 'Mata Kuliah berhasil di update.');
    }
    public function destroy(MataKuliah $mataKuliah)
    {
        $mataKuliah->delete();
        return redirect()->route('mata_kuliah.index')->with('sukses', 'Mata Kuliah berhasil dihapus.');
    }
}
