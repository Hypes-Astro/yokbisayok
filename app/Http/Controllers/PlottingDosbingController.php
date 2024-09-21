<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use App\Models\Pengajuan;
use App\Models\StatusDosen;
use Illuminate\Http\Request;
use App\Models\StatusMahasiswa;
use Illuminate\Support\Facades\Validator;

class PlottingDosbingController extends Controller
{
    public function index(){
        // Ambil dosen dengan status "TERSEDIA" dan memiliki sisa kuota
        $dsnStatus = DosenPembimbing::with('dosen')
            ->where('status', 'TERSEDIA')
            ->where('sisa_kuota', '>', 0)
            ->get();

        // Ambil mahasiswa yang belum memiliki dosen pembimbing (id_dsn = 0)
        $mahasiswa = StatusMahasiswa::with('mahasiswa')
            ->where('id_dsn', 0)
            ->get();

        return view('koor.plotting.plotting_dosen', compact('dsnStatus', 'mahasiswa'));
    }

    public function setDosbing(Request $request)
{
    \Log::info('Received request:', $request->all());

    try {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'dosenId' => 'required|exists:dosens,id',
            'mhs_id' => 'required|array',
            'mhs_id.*' => 'exists:status_mahasiswas,id_mhs',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Ambil status dosen yang tersedia
        $statusDosen = DosenPembimbing::where('id_dsn', $request->dosenId)->first();
        if (!$statusDosen) {
            return response()->json(['error' => 'Dosen tidak ditemukan'], 404);
        }

        // Cek kuota dosen
        if ($statusDosen->sisa_kuota < count($request->mhs_id)) {
            return response()->json(['error' => 'Dosen tidak memiliki kuota yang cukup'], 400);
        }

        // Proses mahasiswa yang dipilih
        foreach ($request->mhs_id as $mhs) {
            $statusMahasiswa = StatusMahasiswa::where('id_mhs', $mhs)->first();
            $statusMahasiswa->id_dsn = $statusDosen->id_dsn;
            $statusMahasiswa->save();
        }

        // Update kuota dosen setelah plotting
        $statusDosen->sisa_kuota -= count($request->mhs_id);
        $statusDosen->save();

        return response()->json(['message' => 'Mahasiswa berhasil diplotting']);
    } catch (\Exception $e) {
        \Log::error('Unexpected error:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        return response()->json(['error' => 'Terjadi kesalahan yang tidak terduga'], 500);
    }
}

}
