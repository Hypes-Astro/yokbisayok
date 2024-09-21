<?php

namespace App\Http\Controllers;

use App\Exports\PengajuanExport;
use App\Models\Dosen;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Models\ProfilPenyelia;
use App\Models\DosenPembimbing;
use App\Models\StatusMahasiswa;
use illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajuan = Pengajuan::with('profilPenyelia')
            ->where('status', 'ACC')
            ->get();
        // dd($pengajuan); // Debug data

        return view('koor.riwayat_data.riwayat_mhs', compact('pengajuan'));
    }

    // alif
    public function export()
    {
        return Excel::download(new PengajuanExport, 'pengajuan.xlsx');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //return view('koor.riwayat_data.riwayat_mhs', compact('pengajuan'));
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
        try {
            $pengajuan = Pengajuan::with('profilPenyelia')->find($id);

            if (!$pengajuan) {
                return response()->json(['status' => 'error', 'message' => 'Pengajuan tidak ditemukan']);
            }


            return response()->json(['status' => 'success', 'data' => $pengajuan]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan']);
        }
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
    public function update(Request $request, string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
