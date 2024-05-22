<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResetPasswordToken;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function forgotPassword()
    {
        // Menampilkan halaman lupa password
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // memvalidasi data yang dikirim
        $validatedData = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(60);

        // membuat token reset password
        ResetPasswordToken::UpdateOrCreate(
            [
                'email' => $validatedData['email']
            ],
            [   
                'email' => $validatedData['email'],
                'token' => $token,
        ]);

        Mail::to($validatedData['email'])->send(new ResetPasswordMail($token));

        // kirim email reset password
        return back()->with('info', 'Email reset password berhasil dikirim!');
    }

    public function resetPassword(Request $request, $token)
    {
        $GetToken = ResetPasswordToken::where('token', $token)->first();

        if (!$GetToken) {
            return redirect()->route('login')->with('warning', 'Token reset password tidak valid!');
        }

        return view('auth.reset-password', compact('token'));
    }

    public function updatePassword(Request $request)
    {
        // memvalidasi data yang dikirim
        $validatedData = $request->validate([
            'password' => 'required',
            'token' => 'required',
        ]);
        // dd($validatedData);
        $token = ResetPasswordToken::where('token', $validatedData['token'])->first();

        if (!$token) {
            return redirect()->route('login')->with('warning', 'Token reset password tidak valid!');
        }

        $user = User::where('email', $token->email)->first();
        $user->update([
            'password' => bcrypt($validatedData['password']),
        ]);

        $token->delete();

        return redirect()->route('login')->with('info', 'Password berhasil diubah!');
    }
}
