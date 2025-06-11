<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    public function index()
    {
        $sesi = Sesi::all();
        return view('sesi.index', compact('sesi'));
    }

    public function create()
    {
        return view('sesi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
        ]);

        Sesi::create($request->all());

        return redirect()->route('sesi.index')->with('sukses', 'Sesi berhasil di buat.');
    }

    public function edit(Sesi $sesi)
    {
        return view('sesi.edit', compact('sesi'));
    }
    public function update(Request $request, Sesi $sesi)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
        ]);

        $sesi->update($request->all());

        return redirect()->route('sesi.index')->with('sukses', 'Sesi berhasil di update.');
    }
    public function destroy(Sesi $sesi)
    {
        $sesi->delete();
        return redirect()->route('sesi.index')->with('sukses', 'Sesi berhasil di hapus.');
    }
}
