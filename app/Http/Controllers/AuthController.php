<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    // solving 1
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'nim_npp' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $credentials = $request->only('nim_npp', 'password');
    
        // Tentukan apakah login menggunakan NIM, NPP, atau email
        if (filter_var($credentials['nim_npp'], FILTER_VALIDATE_EMAIL)) {
            // Login sebagai Koordinator menggunakan email
            $credentials['email'] = $credentials['nim_npp'];
            unset($credentials['nim_npp']);
    
            // Coba login dengan email dan password
            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
    
                $user = Auth::user();
                activity()->inLog('login')->causedBy($user)->log('Melakukan login sebagai Koordinator');
    
                // Redirect ke dashboard koor jika user memiliki role koor
                if ($user->hasRole('koor')) {
                    return redirect()->route('dashboardKoor');
                } else {
                    // Logout jika user bukan koor
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'You are not authorized as a Koordinator.',
                    ])->withInput($request->only('nim_npp'));
                }
            }
    
            // Tampilkan error jika email atau password salah
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->withInput($request->only('nim_npp'));
        } else {
            // Cek apakah login sebagai Mahasiswa atau Dosen menggunakan NIM atau NPP
            $user = User::where('npp', $credentials['nim_npp'])->orWhere('nim', $credentials['nim_npp'])->first();
            
            if (!$user) {
                return back()->withErrors([
                    'nim_npp' => 'The provided credentials do not match our records.',
                ])->withInput($request->only('nim_npp'));
            }
    
            // Login sebagai Dosen menggunakan NPP
            if ($user->hasRole('dosen')) {
                if (Auth::attempt(['npp' => $credentials['nim_npp'], 'password' => $credentials['password']])) {
                    $request->session()->regenerate();
    
                    $user = Auth::user();
                    activity()->inLog('login')->causedBy($user)->log('Melakukan login sebagai Dosen');
    
                    return redirect()->route('dashboardDosen');
                }
            }
            // Login sebagai Mahasiswa menggunakan NIM
            elseif ($user->hasRole('mahasiswa')) {
                if (Auth::attempt(['nim' => $credentials['nim_npp'], 'password' => $credentials['password']])) {
                    $request->session()->regenerate();
    
                    $user = Auth::user();
                    activity()->inLog('login')->causedBy($user)->log('Melakukan login sebagai Mahasiswa');
    
                    return redirect()->route('dashboardMahasiswa');
                }
            }
    
            // Jika password salah atau role tidak cocok, tampilkan pesan error
            return back()->withErrors([
                'nim_npp' => 'The provided credentials do not match our records.',
            ])->withInput($request->only('nim_npp'));
        }
    }    

    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'nim_npp' => 'required|string',
    //         'password' => 'required|string',
    //     ]);

    //     $credentials = $request->only('nim_npp', 'password');

    //     // Tentukan field yang digunakan untuk login
    //     $field = null;
    //     if (preg_match('/^\d{4}\.\d{2}\.\d{4}\.\d{3}$/', $credentials['nim_npp'])) {
    //         $field = 'npp'; // Format npp misalnya, jika Anda menggunakan format khusus
    //     } else {
    //         $field = 'nim'; // Untuk mahasiswa
    //     }

    //     // Sesuaikan kredensial
    //     $credentials[$field] = $credentials['nim_npp'];
    //     unset($credentials['nim_npp']);

    //     \Log::info('Field used for login:', ['field' => $field, 'credentials' => $credentials]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();

    //         $user = Auth::user();
    //         activity()
    //             ->inLog('login')
    //             ->causedBy($user)
    //             ->log('Melakukan login');

    //         // Redirect berdasarkan role
    //         if ($user->hasRole('admin')) {
    //             return redirect()->route('dashboardAdmin');
    //         } elseif ($user->hasRole('dosen')) {
    //             return redirect()->route('dashboardDosen');
    //         } elseif ($user->hasRole('mahasiswa')) {
    //             return redirect()->route('dashboardMahasiswa');
    //         } elseif ($user->hasRole('koor')) {
    //             return redirect()->route('dashboardKoor'); 
    //         }
    //     }

    //     return back()->withErrors([
    //         'nim_npp' => 'The provided credentials do not match our records.',
    //     ])->withInput($request->only('nim_npp'));
    // }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
