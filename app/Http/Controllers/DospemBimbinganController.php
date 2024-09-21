<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\StatusMahasiswa;
use App\Models\LogbookBimbingan;
use Illuminate\Http\Request;

class DospemBimbinganController extends Controller
{
    public function index()
    {
        $dosen = Dosen::where('email', auth()->user()->email)->first();
        $status = StatusMahasiswa::with('mahasiswa')->where('id_dsn', $dosen->id)->get();

        return view(
            'dosen.logbook_bimbingan.logbook_bimbingan_mhs',
            compact('dosen', 'status')
        );
    }

    public function detail($id)
    {
        $logbook = LogbookBimbingan::where('id_mhs', $id)->get();
        return response()->json($logbook);
    }

    public function update(Request $request)
    {
        $logbook = LogbookBimbingan::findOrFail($request->id_logbook);
        $logbook->status = $request->status;
        $logbook->save();

        $status = StatusMahasiswa::where('id_mhs', $logbook->id_mhs)->first();
        $status->status = $request->status;
        $status->save();

        $dsn = Dosen::where('email', auth()->user()->email)->first();

        // activity()
        //     ->inLog('logbook')
        //     ->causedBy($dsn)
        //     ->performedOn($logbook)
        //     ->withProperties(['id_mhs' => $logbook->id_mhs])
        //     ->log('Update status logbook');

        // return redirect()->route('dosbing-logbook');
    }

    public function show($id)
    {
        $logbook = LogbookBimbingan::where('id_mhs', $id)->get();
        return response()->json($logbook);
    }

    public function profileDospem()
    {
        $dosen = Dosen::where('npp', auth()->user()->npp)->first();
        return view('dosen.profile', compact('dosen'));
    
    }
}
