<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Cuti;
use App\Models\Karyawan;
use Barryvdh\DomPDF\Facade\Pdf;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan halaman index
        $cuti = Cuti::with('karyawan')->get();
        return view('cuti.index', compact('cuti'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil data karyawan
        $karyawan = Karyawan::all();
        // Menampilkan halaman create
        return view('cuti.create', compact('karyawan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // memvalidasi data yang dikirim
        $validatedData = $request->validate([
            'data_karyawan_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'required',
        ]);

        // Menghitung total hari cuti
        $tanggalMulai = Carbon::parse($validatedData['tanggal_mulai']);
        $tanggalSelesai = Carbon::parse($validatedData['tanggal_selesai']);
        $totalHariCuti = $tanggalMulai->diffInDays($tanggalSelesai) + 1; // Menambahkan 1 karena perhitungan inclusif

        // Menambahkan total hari cuti ke dalam data yang akan disimpan
        $validatedData['total_hari'] = $totalHariCuti;

        // Menyimpan data cuti
        Cuti::create($validatedData);

        return redirect()->route('cuti.index')->with('success', 'Data cuti berhasil ditambahkan!');
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
        // Mengambil data karyawan
        $karyawan = Karyawan::all();
        // Mengambil data cuti
        $cuti = Cuti::findOrFail($id);
        // Menampilkan halaman edit
        return view('cuti.edit', compact('cuti', 'karyawan'));
    }

    public function update(Request $request, string $id)
    {
        // memvalidasi data yang dikirim
        $validatedData = $request->validate([
            'data_karyawan_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'required',
        ]);

        // Menghitung total hari cuti
        $tanggalMulai = Carbon::parse($validatedData['tanggal_mulai']);
        $tanggalSelesai = Carbon::parse($validatedData['tanggal_selesai']);
        $totalHariCuti = $tanggalMulai->diffInDays($tanggalSelesai) + 1; // Menambahkan 1 karena perhitungan inclusif

        // Menambahkan total hari cuti ke dalam data yang akan disimpan
        $validatedData['total_hari'] = $totalHariCuti;

        // Mengambil data cuti
        $cuti = Cuti::findOrFail($id);

        // Mengubah data cuti
        $cuti->update($validatedData);

        return redirect()->route('cuti.index')->with('success', 'Data cuti berhasil diubah!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, string $id)
    {
        // memvalidasi data yang dikirim
        $validatedData = $request->validate([
            'status' => 'required',
        ]);

        // Mengambil data cuti
        $cuti = Cuti::findOrFail($id);

        // Mengubah status cuti
        $cuti->update($validatedData);

        return redirect()->route('cuti.index')->with('success', 'Data cuti berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mengambil data cuti
        $cuti = Cuti::findOrFail($id);

        // Menghapus data cuti
        $cuti->delete();

        return redirect()->route('cuti.index')->with('success', 'Data cuti berhasil dihapus!');
    }

    public function cetakPdf()
    {
        $cuti = Cuti::with('karyawan')->get();
        $pdf = PDF::loadView('cuti.cetak', compact('cuti'));
        return $pdf->download('data-cuti.pdf');
    }
}
