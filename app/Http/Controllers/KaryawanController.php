<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use App\Models\User;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Cek role user
        if (Auth::user()->role != 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses');
        }
        // Menampilkan data karyawan
        $karyawan = Karyawan::all();
        return view('karyawan.index', compact('karyawan'));
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
        // Menambah data karyawan
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|regex:/^[a-zA-Z\s]*$/',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:today', // Menambahkan aturan untuk memeriksa apakah tanggal lahir tidak boleh setelah tanggal saat ini
            'jenis_kelamin' => 'required',
            'no_telp' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|email|unique:users,email',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);
        // Setting umur
        $tanggal_lahir = new \DateTime($request->tanggal_lahir);
        $sekarang = new \DateTime();
        $umur = $sekarang->diff($tanggal_lahir)->y; // Menggunakan ->y untuk mendapatkan tahun dari perhitungan umur
        // $umur = 21;
        // Image upload
        $imageName = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('images'), $imageName);
        // dd($request->all());
        // Menambah data pengguna
        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email, // Sesuaikan dengan form jika diperlukan
                'password' => bcrypt($request->password),
                'role' => $request->role, // Sesuaikan dengan form jika diperlukan
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan pengguna: '.$e->getMessage());
        }

        // Menambah data karyawan
        try {
            Karyawan::create([
                'users_id' => $user->id, // Menggunakan ID pengguna baru
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_telepon' => $request->no_telp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'umur' => $umur, // Menggunakan umur yang dihitung
                'foto' => $imageName,
            ]);
        } catch (\Exception $e) {
            // Hapus pengguna yang baru dibuat jika gagal menambahkan karyawan
            $user->delete();
            return redirect()->back()->with('error', 'Gagal menambahkan karyawan: '.$e->getMessage());
        }

        // Mengembalikan halaman ke route karyawan.index
        return redirect()->route('karyawan.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Cek role user
        if (Auth::user()->role != 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses');
        }
        // Menampilkan detail data karyawan
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.show', compact('karyawan'));
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
        // Mengedit data karyawan
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|regex:/^[a-zA-Z\s]*$/',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_kelamin' => 'required',
            'no_telp' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Mengambil data karyawan
        $karyawan = Karyawan::findOrFail($id);

        // Setting umur
        $tanggal_lahir = new \DateTime($request->tanggal_lahir);
        $sekarang = new \DateTime();
        $umur = $sekarang->diff($tanggal_lahir)->y;

        // Image upload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            $image_path = public_path("images/{$karyawan->foto}");
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            // Unggah foto baru
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('images'), $imageName);
        } else {
            // Jika tidak ada foto baru, gunakan foto lama
            $imageName = $karyawan->foto;
        }

        // Mengupdate data karyawan
        $karyawan->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'umur' => $umur,
            'foto' => $imageName,
        ]);

        // Mengembalikan halaman ke route karyawan.index
        return redirect()->route('karyawan.index')->with('success', 'Data berhasil diubah');
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
        // Menghapus data karyawan
        $karyawan = Karyawan::findOrFail($id);

        // Menghapus data user terkait
        if ($karyawan->user) {
            $karyawan->user->delete();
        }

        // Mengembalikan halaman ke route karyawan.index
        return redirect()->route('karyawan.index')->with('success', 'Data berhasil dihapus');
    }
}
