<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panen;
use App\Models\Karyawan;
use App\Models\Harga;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{   
    // Ambil pengguna yang sedang login
    $user = Auth::user();

    // Jika pengguna memiliki peran sebagai karyawan, ambil data berdasarkan karyawan yang terkait
    $karyawan = $user->role === 'karyawan' ? $user->karyawan : Karyawan::all();
    $panen = $karyawan instanceof Karyawan ? $karyawan->panen : Panen::all();
    $harga = Harga::all(); // Anda mungkin ingin menyaring harga berdasarkan kebutuhan Anda di sini

    // Kembalikan view dengan data yang diperlukan
    return view('gaji.index', compact('karyawan', 'panen', 'harga'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function slip(string $id)
    {
        // Mengambil data panen berdasarkan id
        $panen = Panen::findOrFail($id);

        // Proses logika untuk menampilkan slip gaji

        // Tampilkan view slip gaji dengan data yang telah diambil
        return view('gaji.slip', compact('panen'));

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
