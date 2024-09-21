<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Pengajuan;
use App\Models\LogbookBimbingan;
use App\Models\StatusMahasiswa;
use App\Models\StatusDosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Log;

class MahasiswaBimbinganController extends Controller
{
    public function index()
    {
        $dosen = Dosen::where('email', auth()->user()->email)->first();
        // Cara mengambil data pengajuan yang belum di tolak
        $pengajuan = Pengajuan::with('mahasiswa.statusMahasiswa')
            ->where('id_dsn', $dosen->id)
            ->where('status', 'PENDING')
            ->get();

        return view('dosen.daftar_bimbingan.daftar_bimbingan', compact('pengajuan'));
    }

    public function detail($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $status = StatusMahasiswa::where('id_mhs', $pengajuan->id_mhs)->first();
        $mahasiswa = Mahasiswa::where('id', $status->id_mhs)->first();
        return view('dosen.daftar_bimbingan.detail_mahasiswa_bimbingan', compact('pengajuan', 'mahasiswa'));
    }

    public function update(Request $request){
        try {
                        dd($request->all());
                        $pengajuan = Pengajuan::findOrFail($request->id);
            
                        $dsnStatus = StatusDosen::where('id_dsn', $pengajuan->id_dsn)->first();
            
                        if ($request->status == 'TOLAK') {
                            $pengajuan->status = $request->status;
                            $pengajuan->alasan = $request->alasan;
                            $pengajuan->save();
            
                            $dsnStatus->ajuan--;
                            $dsnStatus->save();
            
                            // activity()
                            //     ->inLog('pengajuan')
                            //     ->causedBy(auth()->user())
                            //     ->performedOn($pengajuan)
                            //     ->withProperties(['id_mhs' => $pengajuan->id_mhs])
                            //     ->log('Menolak pengajuan pengajuan');
            
                            return response()->json(['status' => 'success', 'message' => 'Pengajuan berhasil ditolak']);
                        } else {
                            $status = StatusMahasiswa::findOrFail($pengajuan->id_mhs);
                            $status->id_dsn = $pengajuan->id_dsn;
                            $status->save();
                            $pengajuan->status = $request->status;
                            $pengajuan->save();
            
                            $dsnStatus->ajuan--;
                            $dsnStatus->diterima++;
                            $dsnStatus->sisa = $dsnStatus->kuota - $dsnStatus->diterima;
            
                            $dsnStatus->save();
            
                            // activity()
                            //     ->inLog('pengajuan')
                            //     ->causedBy(auth()->user())
                            //     ->performedOn($pengajuan)
                            //     ->withProperties(['id_mhs' => $pengajuan->id_mhs])
                            //     ->log('Update status pengajuan');
            
                            return redirect()->route('mahasiswa-bimbingan');
                        }
                    } catch (\Exception $e) {
                        Log::error($e); // Logging error
                        return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan'], 500);
                    }
    }

    

}
