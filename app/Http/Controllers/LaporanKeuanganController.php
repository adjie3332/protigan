<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKeuangan;
use App\Models\Karyawan;
use App\Models\InventoryMasuk;
use App\Models\Panen;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menetapkan data yang akan ditampilkan
        $keuangan = LaporanKeuangan::all();
        $karyawan = Karyawan::all();
        $pengeluaran = InventoryMasuk::all();
        $panen = Panen::all();

        // Menetapkan date yang akan dikirim ke view

        // Mengembalikan view keuangan.index
        return view('Keuangan.index', compact('keuangan', 'karyawan', 'pengeluaran', 'panen'));
    }

    public function cetak()
    {
        // Menetapkan data yang akan ditampilkan
        $keuangan = LaporanKeuangan::all();
        $karyawan = Karyawan::all();
        $pengeluaran = InventoryMasuk::all();
        $panen = Panen::all();

        // Menetapkan date yang akan dikirim ke view

        // Mengembalikan view keuangan.cetak
        $pdf = PDF::loadview('Keuangan.cetak', compact('keuangan', 'karyawan', 'pengeluaran', 'panen'));
        return $pdf->stream('laporan-keuangan.pdf');
    }
}
