<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSidang;
use App\Models\StatusMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KoorMonitoringSidangController extends Controller
{
    public function index()
    {
        $sidangKP1 = PengajuanSidang::all();
        return view('koor.monitoring_sidang.monitoring_sidang', compact('sidangKP1'));
    }

    public function updateStatus(Request $request)
    {
        Log::info('Data Request:', $request->all());

        DB::beginTransaction();

        try {
            $detailmhs = StatusMahasiswa::where('id_mhs', $request->id_mhs)->first();

            if (!$detailmhs) {
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Status Mahasiswa tidak ditemukan.']);
                } else {
                    return redirect()->back()->with('error', 'Status Mahasiswa tidak ditemukan.');
                }
            }

            $sidang = PengajuanSidang::where('id_mhs', $request->id_mhs)->latest()->first();

            if (!$sidang) {
                return response()->json(['success' => false, 'message' => 'Data Sidang tidak ditemukan.']);
            }

            Log::info('Sebelum update', ['detailmhs' => $detailmhs->toArray(), 'sidang' => $sidang->toArray()]);

            if ($request->aksi == 'ACC') {
                $sidang->statusPengajuan = 'ACC';
            } elseif ($request->aksi == 'TOLAK') {
                $sidang->statusPengajuan = 'TOLAK';
            } elseif ($request->aksi == 'PROSES') {
                $sidang->statusPengajuan = 'PROSES';
            } else {
                return response()->json(['success' => false, 'message' => 'Aksi tidak valid.']);
            }


            $sidang->save();

            DB::commit();

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Status sidang berhasil diperbarui.']);
            } else {
                return redirect()->route('koor-monitoring-sidang')->with('success', 'Status sidang berhasil diperbarui.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating sidang status: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            } else {
                return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }
    }
}

