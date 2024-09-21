<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;


class LogController extends Controller
{
    public function LogDosen(){
        $role = Role::where('name', 'dosen')->first();
        $dosenIds = $role->users->pluck('id');

        $activities = Activity::whereIn('causer_id', $dosenIds)
            ->with('causer.dosen')
            ->get();
        return view('koor.log_aplikasi.log_dosen', compact('activities'));
    }

    public function LogMahasiswa(){
        $role = Role::where('name', 'mahasiswa')->first();
        $mhsIds = $role->users->pluck('id');


        $activities = Activity::whereIn('causer_id', $mhsIds)
            ->with('causer.mahasiswa')
            ->get();

        return view('koor.log_aplikasi.log_mhs', compact('activities'));
    }
}
