<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\BarangKeluar;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        $barang_keluar = BarangKeluar::all();
        return view('BarangKeluar.index', compact('barang_keluar', 'barang'));
    }

    public function create()
    {
        $barang = Barang::all();
        return view('barang_keluar.create', compact('barang'));
    }

    public function store(Request $request)
    {
        // Validasi data barang keluar
        $request->validate([
            'data_barang_id' => 'required',
            'jumlah_keluar' => 'required|integer|min:1',
            'tanggal_keluar' => 'required',
            'deskripsi' => 'required',
        ]);

        // Mendapatkan barang dari database
        $barang = Barang::findOrFail($request->data_barang_id);

        // Cek apakah jumlah barang mencukupi
        if ($barang->jumlah < $request->jumlah_keluar) {
            return redirect()->route('barang-keluar.index')->with('warning', 'Jumlah barang tidak mencukupi!');
        }

        // Menambah data barang keluar
        BarangKeluar::create([
            'data_barang_id' => $request->data_barang_id,
            'jumlah_keluar' => $request->jumlah_keluar,
            'tanggal_keluar' => $request->tanggal_keluar,
            'deskripsi' => $request->deskripsi,
        ]);

        // Update jumlah barang di inventory
        $barang->decrement('jumlah', $request->jumlah_keluar);

        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang_keluar = BarangKeluar::findOrFail($id);
        $barang = Barang::all();
        return view('barang_keluar.edit', compact('barang_keluar', 'barang'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data barang keluar
        $request->validate([
            'data_barang_id' => 'required',
            'jumlah_keluar' => 'required',
            'tanggal_keluar' => 'required',
            'deskripsi' => 'required',
        ]);

        // Mendapatkan barang keluar dari database
        $barang_keluar = BarangKeluar::findOrFail($id);

        // Mendapatkan barang dari database
        $barang = Barang::findOrFail($request->data_barang_id);

        // Menghitung selisi jumlah barang sebelum dan sesudah update
        $selisih = $request->jumlah_keluar - $barang_keluar->jumlah_keluar;

        // Cek apakah jumlah barang mencukupi
        if ($barang->jumlah < $selisih) {
            return redirect()->route('barang-keluar.index')->with('warning', 'Jumlah barang tidak mencukupi!');
        }

        // Update jumlah barang di inventory
        $barang->increment('jumlah', $barang_keluar->jumlah_keluar);
        $barang->decrement('jumlah', $request->jumlah_keluar);

        // Update data barang keluar
        $barang_keluar->update([
            'data_barang_id' => $request->data_barang_id,
            'jumlah_keluar' => $request->jumlah_keluar,
            'tanggal_keluar' => $request->tanggal_keluar,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil diubah!');
    }

    public function destroy($id)
    {
        $barang_keluar = BarangKeluar::findOrFail($id);
        $barang = Barang::findOrFail($barang_keluar->data_barang_id);
        $barang->increment('jumlah', $barang_keluar->jumlah_keluar);
        $barang_keluar->delete();

        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil dihapus!');
    }
}
