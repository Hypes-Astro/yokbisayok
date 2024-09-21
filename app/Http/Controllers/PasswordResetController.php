<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function requestForm()
    {
        return view('forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            // 'email' => 'required|email'
            'nim_npp' => 'required|string'
        ]);

        // Cari user berdasarkan NIM atau NPP
        $user = User::where('nim', $request->nim_npp)->orWhere('npp', $request->nim_npp)->first();

        if (!$user) {
            return back()->withErrors(['nim_npp' => 'NIM/NPP tidak ditemukan.']);
        }

        if (is_null($user->email)) {
            return back()->withErrors(['nim_npp' => 'Pengguna tidak memiliki email terdaftar.']);
        }

        $status = Password::sendResetLink(
            ['email' => $user->email]
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function resetForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request) 
    {
        $request->validate([
            'token' => 'required',
            'nim_npp' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Cari user berdasarkan NIM atau NPP
        $user = User::where('nim', $request->nim_npp)->orWhere('npp', $request->nim_npp)->first();

        if (!$user || $user->email !== $request->email) {
            return back()->withErrors(['nim_npp' => 'NIM/NPP atau Email tidak sesuai.']);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                // $user->setRememberToken(Str::random(60));

                // Auth::login($user);
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}