<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\JenisBarang;
use App\Models\Suplier;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan data barang
        $barang = Barang::all();
        $jenis_barang = JenisBarang::all();
        $barangMasuk = BarangMasuk::all();
        $barangKeluar = BarangKeluar::all();
        return view('barang.index', compact('barang', 'barangMasuk', 'barangKeluar', 'jenis_barang'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data barang
        $request->validate([
            'nama_barang' => 'required',
            'id_jenis_barang' => 'required',
            'satuan' => 'required',
        ]);

        // dd($request->all());
        // Menambah data barang
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'id_jenis_barang' => $request->id_jenis_barang,
            'satuan' => $request->satuan,
        ]);


        return redirect('/barang')->with('success', 'Data barang berhasil ditambahkan!');
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
        // Menampilkan halaman edit barang
        $barang = Barang::findOrFail($id);
        return view('barang.modal-edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data barang
        $request->validate([
            'nama_barang' => 'required',
            'id_jenis_barang' => 'required',
            'satuan' => 'required',
        ]);

        // Mengubah data barang
        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'id_jenis_barang' => $request->id_jenis_barang,
            'satuan' => $request->satuan,
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus data barang
        Barang::destroy($id);
        return redirect('/barang')->with('success', 'Data barang berhasil dihapus!');
    }

}
