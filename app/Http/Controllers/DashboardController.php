<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\Panen;
use App\Models\Harga;
use App\Models\Cuti;
use App\Models\InventoryMasuk;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan halaman dashboard
        $karyawan = Karyawan::count();
        $panen = Panen::count();
        $harga = Harga::count();
        $cuti = Cuti::count();
        
        // Hitung pemasukan dan pengeluaran
        $pemasukan = Panen::sum('hasil_pemilik');
        $pengeluaran = InventoryMasuk::sum('harga');
        
        // Cek Login
        if (!auth()->user()) {
            return redirect()->route('login')->with('warning', 'Silahkan login terlebih dahulu!');
        }
        return view('dashboard', compact('karyawan', 'panen', 'harga', 'cuti', 'pemasukan', 'pengeluaran'));

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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
