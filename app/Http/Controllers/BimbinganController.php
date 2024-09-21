<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use App\Models\Pengajuan;
use App\Models\LogbookBimbingan;
use App\Models\StatusMahasiswa;
use App\Models\StatusDosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Log;

class BimbinganController extends Controller
{
    public function update(Request $request){
        try {
                        // dd($request->all());
                        $pengajuan = Pengajuan::findOrFail($request->id);
            
                        $dsnStatus = DosenPembimbing::where('id_dsn', $pengajuan->id_dsn)->first();
            
                        if ($request->status == 'TOLAK') {
                            $pengajuan->status = $request->status;
                            $pengajuan->alasan = $request->alasan;
                            $pengajuan->save();
            
                            $dsnStatus->jumlah_ajuan--;
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
                            $status->status_magang = 'PROSES';
                            $status->save();
                            $pengajuan->status = $request->status;
                            $pengajuan->save();
            
                            $dsnStatus->jumlah_ajuan--;
                            $dsnStatus->ajuan_diterima++;
                            $dsnStatus->sisa_kuota = $dsnStatus->kuota - $dsnStatus->ajuan_diterima;
            
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

    public function selesaiMagang(Request $request){
        $status = StatusMahasiswa::where('id_mhs',$request->id)->first();

        $status->status_magang = $request->status_magang;
        $status->save();
        return redirect()->route('pageDaftarMhsBimbingan');
    }
}
