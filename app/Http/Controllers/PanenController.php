<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Panen;
use App\Models\Karyawan;
use App\Models\Harga;

class PanenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Periksa peran pengguna, jika adalah karyawan, ambil data berdasarkan karyawan yang terkait
        if ($user->role === 'karyawan') {
            // Dapatkan entitas karyawan terkait dari pengguna
            $karyawan = $user->karyawan;

            // Dapatkan data panen yang terkait dengan karyawan
            $panen = $karyawan->panen;

            // Kembalikan view dengan data yang diperlukan
            return view('panen.index', compact('panen'));
        } else {
            // Jika pengguna bukan karyawan, tampilkan semua data panen
            $panen = Panen::all();
            return view('panen.index', compact('panen'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cek role user
        if (Auth::user()->role != 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses');
        }
        // Menampilkan halaman tambah data panen
        $karyawan = Karyawan::all();
        $harga = Harga::all();
        return view('panen.create', compact('karyawan', 'harga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // memvalidasi data yang dikirim
        $validatedData = $request->validate([
            'data_karyawan_id' => 'required',
            'harga_karet_id' => 'required',
            'tanggal_panen' => 'required',
            'hasil_kg' => 'required',
            'total_hasil_kg' => 'required',
        ]);
    
        // Konversi nilai hasil_kg menjadi string
        $validatedData['hasil_kg'] = json_encode($validatedData['hasil_kg']);
    
        // Mengambil harga karet berdasarkan ID
        $harga = Harga::find($validatedData['harga_karet_id']);
    
        // Menghitung total gaji
        $totalGaji = $harga->harga_per_kg * $validatedData['total_hasil_kg'] / 3;
    
        // Menghitung hasil_pemilik
        $hasilPemilik = $validatedData['total_hasil_kg'] * $harga->harga_per_kg - $totalGaji;
    
        // Menyimpan data panen, total gaji, dan hasil_pemilik
        Panen::create($validatedData + ['total_gaji' => $totalGaji, 'hasil_pemilik' => $hasilPemilik]);
    
        return redirect()->route('panen.index')->with('success', 'Data panen berhasil ditambahkan!');
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
        // Cek role user
        if (Auth::user()->role != 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses');
        }
        // Menampilkan halaman edit data panen
        $panen = Panen::findOrFail($id);
        $karyawan = Karyawan::all();
        $harga = Harga::all();
        return view('panen.edit', compact('panen', 'karyawan', 'harga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // memvalidasi data yang dikirim
        $validatedData = $request->validate([
            'data_karyawan_id' => 'required',
            'harga_karet_id' => 'required',
            'tanggal_panen' => 'required',
            'hasil_kg' => 'required',
            'total_hasil_kg' => 'required',
        ]);

        // Konversi nilai hasil_kg menjadi string
        $validatedData['hasil_kg'] = json_encode($validatedData['hasil_kg']);

        // Mengambil harga karet berdasarkan ID
        $harga = Harga::find($validatedData['harga_karet_id']);

        // Menghitung total gaji
        $totalGaji = $harga->harga_per_kg * $validatedData['total_hasil_kg'] / 3;

        // Menghitung hasil_pemilik
        $hasilPemilik = $validatedData['total_hasil_kg'] * $harga->harga_per_kg - $totalGaji;

        // Menyimpan data panen, total gaji, dan hasil_pemilik
        $panen = Panen::findOrFail($id);
        $panen->update($validatedData + ['total_gaji' => $totalGaji, 'hasil_pemilik' => $hasilPemilik]);

        return redirect()->route('panen.index')->with('info', 'Data panen berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cek role user
        if (Auth::user()->role != 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses');
        }
        // Hapus data panen
        $panen = Panen::findOrFail($id);
        $panen->delete();

        return redirect()->route('panen.index')->with('warning', 'Data panen berhasil dihapus!');
    }
}
