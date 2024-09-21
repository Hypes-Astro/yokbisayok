<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.user_mahasiswa.user_mahasiswa');
    }

    // public function user_mhs()
    // {
    //     return view('admin.user_mahasiswa.user_mahasiswa');
    // }

    // public function user_dosen()
    // {
    //     return view('admin.user_dosen.user_dosen');
    // }

    // public function user_koor()
    // {
    //     return view('admin.user_koor.user_koor');
    // }

    public function log_dosbing(){
        return view('admin.log_aplikasi.log_dosen');
    }

    public function log_mhs(){
        return view('admin.log_aplikasi.log_mhs');
    }
}
