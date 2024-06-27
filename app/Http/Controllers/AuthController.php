<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Karyawan;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan halaman login
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan halaman register
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // memvalidasi data yang dikirim
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return back()->with('warning', 'Username atau password salah!');
    }

    public function register(Request $request)
    {
        // memvalidasi data yang dikirim
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        return redirect()->route('login')->with('info', 'Akun berhasil dibuat!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login')->with('info', 'Anda berhasil logout!');
    }

    public function profile()
    {
        return view('auth.profile');
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
        // Menampilkan halaman edit profil
        $user = User::findOrFail($id);

        return view('auth.edit-profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'username' => 'required',
        ]);

        $user = User::findOrFail($id);

        // Update data user
        $user->update([
            'email' => $request->email,
            'username' => $request->username,
        ]);
        // Redirect ke halaman profile
        return redirect()->route('profile')->with('success', 'Data berhasil diubah');
    }

    public function changePassword(Request $request, string $id)
    {
        // Validasi data
        $request->validate([
            'password' => 'required',
            'new_password' => 'required',
        ]);

        $user = User::findOrFail($id);

        if (password_verify($request->password, $user->password)) {
            $user->update([
                'password' => bcrypt($request->new_password),
            ]);
            return redirect()->route('profile')->with('success', 'Password berhasil diubah');
        }

        return back()->with('warning', 'Password lama salah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 
    }
}
