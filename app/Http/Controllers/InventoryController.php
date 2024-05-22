<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InventoryMasuk;
use App\Models\InventoryKeluar;
use App\Models\Karyawan;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan data inventory
        $inventory = Inventory::all();
        $inventoryMasuk = InventoryMasuk::all();
        $inventoryKeluar = InventoryKeluar::all();
        return view('inventory.index', compact('inventory', 'inventoryMasuk', 'inventoryKeluar'));
    }

    public function inventoryMasuk()
    {
        // Menampilkan data inventory masuk
        $inventory = Inventory::all();
        $inventoryMasuk = InventoryMasuk::all();
        return view('inventory.masuk', compact('inventory', 'inventoryMasuk'));
    }

    public function inventoryKeluar()
    {
        // Menampilkan data inventory keluar
        $inventory = Inventory::all();
        $inventoryKeluar = InventoryKeluar::all();
        $karyawan = Karyawan::all();
        return view('inventory.keluar', compact('inventory','inventoryKeluar', 'karyawan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data inventory
        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
        ]);

        // Menambah data inventory
        Inventory::create([
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'satuan' => $request->satuan,
        ]);

        return redirect('/inventory')->with('status', 'Data inventory berhasil ditambahkan!');
    }

    public function storeMasuk(Request $request)
    {
        // Validasi data inventory masuk
        $request->validate([
            'data_inventory_id' => 'required',
            'jumlah_masuk' => 'required',
            'harga' => 'required',
            'tanggal_masuk' => 'required',
        ]);

        // Menambah data inventory masuk
        InventoryMasuk::create([
            'data_inventory_id' => $request->data_inventory_id,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga' => $request->harga,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        // Update jumlah barang di inventory
        $inventory = Inventory::findOrFail($request->data_inventory_id);
        $inventory->increment('jumlah', $request->jumlah_masuk);

        return redirect()->route('inventory.masuk')->with('status', 'Data inventory masuk berhasil ditambahkan!');
    }

    public function storeKeluar(Request $request)
    {
        // Validasi data inventory keluar
        $request->validate([
            'data_inventory_id' => 'required',
            'data_karyawan_id' => 'required',
            'jumlah_keluar' => 'required|numeric|min:1', // Memastikan jumlah keluar lebih besar dari 0
            'tanggal_keluar' => 'required',
            'keperluan' => 'required',
        ]);

        // Ambil data inventory yang dipilih
        $inventory = Inventory::findOrFail($request->data_inventory_id);

        // Memeriksa apakah jumlah yang keluar tidak melebihi jumlah yang tersedia di inventaris
        if ($inventory->jumlah < $request->jumlah_keluar) {
            return redirect()->back()->with('error', 'Jumlah barang yang keluar melebihi jumlah yang tersedia di inventaris.');
        }

        // Menambah data inventory keluar
        InventoryKeluar::create([
            'data_inventory_id' => $request->data_inventory_id,
            'data_karyawan_id' => $request->data_karyawan_id,
            'jumlah_keluar' => $request->jumlah_keluar,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keperluan' => $request->keperluan,
        ]);

        // Update jumlah barang di inventory
        $inventory->decrement('jumlah', $request->jumlah_keluar);

        return redirect()->route('inventory.keluar')->with('status', 'Data inventory keluar berhasil ditambahkan!');
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
        // Menampilkan halaman edit inventory
        $inventory = Inventory::findOrFail($id);
        return view('inventory.edit', compact('inventory'));
    }

    public function editMasuk(string $id)
    {
        $inventoryMasuk = InventoryMasuk::findOrfail($id);
        return view('inventoryMasuk.edit', compact('inventoryMasuk'));
    }

    public function editKeluar(string $id)
    {
        $inventoryKeluar = InventoryKeluar::findOrfail($id);
        $inventory = Inventory::all();
        $karyawan = Karyawan::all();
        return view('inventoryKeluar.edit', compact('inventoryKeluar', 'inventory', 'karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data inventory
        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'satuan' => 'required',
        ]);

        // Mengubah data inventory
        $inventory = Inventory::findOrFail($id);
        $inventory->update([
            'nama_barang' => $request->nama_barang,
            'kategori' => $request->kategori,
            'satuan' => $request->satuan,
        ]);

        return redirect('/inventory')->with('status', 'Data inventory berhasil diubah!');
    }

    public function updateMasuk(Request $request, string $id)
    {
        // Validasi data inventory masuk
        $request->validate([
            'data_inventory_id' => 'required',
            'jumlah_masuk' => 'required|numeric|min:1', // Pastikan jumlah masuk lebih besar dari 0
            'harga' => 'required',
            'tanggal_masuk' => 'required',
        ]);
        
        // Mengambil data inventory masuk
        $inventoryMasuk = InventoryMasuk::findOrFail($id);

        // Menghitung selisih jumlah sebelum dan setelah pembaruan
        $selisihJumlah = $request->jumlah_masuk - $inventoryMasuk->jumlah_masuk;

        // Update data inventory masuk
        $inventoryMasuk->update([
            'data_inventory_id' => $request->data_inventory_id,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga' => $request->harga,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        // Update jumlah barang di inventory
        $inventory = Inventory::findOrFail($request->data_inventory_id);
        $inventory->increment('jumlah', $selisihJumlah);

        return redirect()->route('inventory.masuk')->with('status', 'Data inventory masuk berhasil diubah!');
    }

    public function updateKeluar(Request $request, string $id)
    {
        // Validasi data inventory keluar
        $request->validate([
            'data_inventory_id' => 'required',
            'data_karyawan_id' => 'required',
            'jumlah_keluar' => 'required|numeric|min:1', // Memastikan jumlah keluar lebih besar dari 0
            'tanggal_keluar' => 'required',
            'keperluan' => 'required',
        ]);

        // Mengambil data inventory keluar
        $inventoryKeluar = InventoryKeluar::findOrFail($id);

        // Mengambil data inventory yang dipilih
        $inventory = Inventory::findOrFail($request->data_inventory_id);

        // Menghitung selisih jumlah sebelum dan setelah pembaruan
        $selisihJumlah = $request->jumlah_keluar - $inventoryKeluar->jumlah_keluar;

        // Memeriksa apakah jumlah yang keluar tidak melebihi jumlah yang tersedia di inventaris
        if ($inventory->jumlah < $selisihJumlah) {
            return redirect()->back()->with('error', 'Jumlah barang yang keluar melebihi jumlah yang tersedia di inventaris.');
        }

        // Update jumlah barang di inventory
        $inventory->increment('jumlah', $inventoryKeluar->jumlah_keluar); // Mengembalikan jumlah sebelumnya
        $inventory->decrement('jumlah', $request->jumlah_keluar); // Mengurangi jumlah dengan jumlah baru

        // Update data inventory keluar
        $inventoryKeluar->update([
            'data_inventory_id' => $request->data_inventory_id,
            'data_karyawan_id' => $request->data_karyawan_id,
            'jumlah_keluar' => $request->jumlah_keluar,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keperluan' => $request->keperluan,
        ]);

        return redirect()->route('inventory.keluar')->with('status', 'Data inventory keluar berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus data inventory
        Inventory::destroy($id);
        return redirect('/inventory')->with('status', 'Data inventory berhasil dihapus!');
    }

    public function destroyMasuk(string $id)
    {
        // Mengambil data inventory masuk berdasarkan ID
        $inventoryMasuk = InventoryMasuk::findOrFail($id);

        // Mengurangi jumlah barang di inventaris sesuai dengan jumlah masuk yang dihapus
        $inventory = Inventory::findOrFail($inventoryMasuk->data_inventory_id);
        $inventory->decrement('jumlah', $inventoryMasuk->jumlah_masuk);

        // Menghapus data inventory masuk
        $inventoryMasuk->delete();

        return redirect()->route('inventory.masuk')->with('status', 'Data inventory masuk berhasil dihapus!');
    }

    public function destroyKeluar(string $id)
    {
        // Mengambil data inventory keluar berdasarkan ID
        $inventoryKeluar = InventoryKeluar::findOrFail($id);

        // Menambahkan jumlah barang di inventaris sesuai dengan jumlah keluar yang dihapus
        $inventory = Inventory::findOrFail($inventoryKeluar->data_inventory_id);
        $inventory->increment('jumlah', $inventoryKeluar->jumlah_keluar);

        // Menghapus data inventory keluar
        $inventoryKeluar->delete();

        return redirect()->route('inventory.keluar')->with('status', 'Data inventory keluar berhasil dihapus!');
    }

}
