<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\StatusDosen;
use Illuminate\Http\Request;
use App\Models\StatusMahasiswa;
use illuminate\Support\Facades\Log;


class KoorPengajuanMhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::where('email', auth()->user()->email)->first();

        // Ambil data pengajuan yang belum ditolak
        $pengajuan = Pengajuan::with('mahasiswa.statusMahasiswa')
            ->where('status', 'PENDING')
            ->get();

        return view('koor.pengajuan_mhs.daftar_mhs', compact('pengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            // dd($request->all());
            $pengajuan = Pengajuan::findOrFail($request->id);

            $dsnStatus = DosenPembimbing::where('id_dsn', $pengajuan->id_dsn)->first();

            if ($request->status == 'TOLAK') {
                $pengajuan->status = $request->status;
                $pengajuan->save();
                
                if ($dsnStatus->jumlah_ajuan !=0){
                    $dsnStatus->jumlah_ajuan--;
                }
                $dsnStatus->save();

                 // Update status juga di tabel StatusMahasiswa jika ditolak
                $statusMahasiswa = StatusMahasiswa::where('id_mhs', $pengajuan->id_mhs)->first();
                if ($statusMahasiswa) {
                    $statusMahasiswa->status = 'REVISI';
                    $statusMahasiswa->save();
                }
  
                activity()
                    ->inLog('pengajuan')
                    ->causedBy(auth()->user())
                    ->performedOn($pengajuan)
                    ->withProperties(['id_mhs' => $pengajuan->id_mhs])
                    ->log('Menolak pengajuan pengajuan');

                return response()->json(['status' => 'success', 'message' => 'Pengajuan berhasil ditolak']);
            } else {
                $status = StatusMahasiswa::findOrFail($pengajuan->id_mhs);
                $status->id_dsn = $pengajuan->id_dsn;
                $status->status = 'ACC';
                $status->save();
                
                $pengajuan->status = $request->status;
                $pengajuan->save();

                $dsnStatus->jumlah_ajuan++;
                $dsnStatus->ajuan_diterima++;
                $dsnStatus->sisa_kuota = $dsnStatus->kuota - $dsnStatus->ajuan_diterima;

                $dsnStatus->save();

                // activity()
                //     ->inLog('pengajuan')
                //     ->causedBy(auth()->user())
                //     ->performedOn($pengajuan)
                //     ->withProperties(['id_mhs' => $pengajuan->id_mhs])
                //     ->log('Update status pengajuan');

                return redirect()->route('koor-list-mhs');
            }
        } catch (\Exception $e) {
            Log::error($e); // Logging error
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
