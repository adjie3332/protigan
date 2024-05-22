<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Harga;

class HargaKaretController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan halaman karyawan
        $harga = Harga::all();
        return view('harga.index', compact('harga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // memvalidasi data yang dikirim
        $validatedData = $request->validate([
            'kategori' => 'required',
            'harga_per_kg' => 'required',
        ]);
        Harga::create($validatedData);

        return redirect()->route('harga.index')->with('info', 'Harga berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan halaman edit harga
        $harga = Harga::find($id);
        return view('harga.edit', compact('harga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // memvalidasi data yang dikirim
        $validatedData = $request->validate([
            'kategori' => 'required',
            'harga_per_kg' => 'required',
        ]);
        Harga::whereId($id)->update($validatedData);

        return redirect()->route('harga.index')->with('info', 'Harga berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus data harga
        Harga::destroy($id);
        return redirect()->route('harga.index')->with('info', 'Harga berhasil dihapus!');
    }
}
