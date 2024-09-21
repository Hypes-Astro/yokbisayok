<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSidang;
use App\Models\Mahasiswa;
use App\Models\StatusMahasiswa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PengajuanSidangController extends Controller
{
    // public function form_sidang()
    // {
    //     return view('mahasiswa.pengajuan_sidang.pengajuan_sidang'); // Sesuaikan dengan nama view yang Anda buat
    // }
    public function pengajuan_sidang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string',
            'bidang_kajian' => 'required|string|in:SC,RPLD,SKKKD',
            'dokumen' => 'required|string',
            'validasi' => 'required|string',
            'nilaiPenyelia' => 'required|string',
            'nilaiPembimbing' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $pengajuanSidang = PengajuanSidang::where('id_mhs', $mahasiswa->id)->first();

        if ($pengajuanSidang) {
            $pengajuanSidang->judul = $request->judul;
            $pengajuanSidang->bidang_kajian = $request->bidang_kajian;
            $pengajuanSidang->dokumen = $request->dokumen;
            $pengajuanSidang->validasi = $request->validasi;
            $pengajuanSidang->nilaiPenyelia = $request->nilaiPenyelia;
            $pengajuanSidang->nilaiPembimbing = $request->nilaiPembimbing;
            $pengajuanSidang->save();
        } else {
            PengajuanSidang::create([
                'id_mhs' => $mahasiswa->id,
                'judul' => $request->judul,
                'bidang_kajian' => $request->bidang_kajian,
                'dokumen' => $request->dokumen,
                'validasi' => $request->validasi,
                'nilaiPenyelia' => $request->nilaiPenyelia,
                'nilaiPembimbing' => $request->nilaiPembimbing,
            ]);
    }

    return redirect()->route('draft_sidang')->with('success', 'Pengajuan sidang berhasil disimpan.');
    }

    public function form_sidang(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $sidang = PengajuanSidang::where('id_mhs', $mahasiswa->id)->latest()->first();  
        if ($sidang){
            return view('mahasiswa.pengajuan_sidang.draft_sidang', [
                'sidang' => $sidang,
                'data' => $data, 
            ]);
        }   

        return view('mahasiswa.pengajuan_sidang.pengajuan_sidang', compact('data'));
    }

    public function draft_sidang(Request $request)
    {
        $data = $request->query();
        // dd($data);
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $sidang = PengajuanSidang::where('id_mhs', $mahasiswa->id)->first(); // Ambil data pengajuan sidang
        $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();
        // return view('mahasiswa.pengajuan_sidang.draft_sidang', compact(
        //     'data',
        //     'mahasiswa',
        //     'status',
        // ));
        return view('mahasiswa.pengajuan_sidang.draft_sidang', [
            'sidang' => $sidang,
            'data' => $data, // Asumsi $data sama dengan $sidang
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();

        $sidang = new PengajuanSidang();
        $sidang->id_mhs = $status->id_mhs;
        $sidang->judul = $data['judul'];
        $sidang->bidang_kajian = $data['bidang_kajian'];
        $sidang->dokumen = $data['dokumen'];
        $sidang->validasi = $data['validasi'];
        $sidang->nilaiPenyelia = $data['nilaiPenyelia'];

        $sidang->save();

        return redirect()->route('draft_pengajuan_sidang')->with('success', 'Pengajuan sidang berhasil disimpan.');

        return view('mahasiswa.pengajuan_sidang.draft_sidang', compact('data', 'mahasiswa','status',));

    }

    public function updateNilaiPembimbing(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nilaiPembimbing' => 'required|numeric|min:0|max:100',
        ]);

        // Temukan pengajuan sidang berdasarkan ID
        $pengajuanSidang = PengajuanSidang::findOrFail($id);

        // Perbarui nilai pembimbing
        $pengajuanSidang->nilaiPembimbing = $request->input('nilaiPembimbing');
        $pengajuanSidang->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Nilai Pembimbing berhasil diperbarui.');
    }

    public function updateStatus(Request $request, $id)
    {
        $pengajuan = PengajuanSidang::find($id);

        if ($pengajuan) {
            $pengajuan->statusPengajuan = $request->input('status');
            $pengajuan->save();

            return redirect()->back()->with('success', 'Status updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Pengajuan not found.');
        }
    }

    public function updatePengajuanSidang(Request $request, $id)
{
    $pengajuanSidang = PengajuanSidang::find($id);

    if ($pengajuanSidang) {
        $pengajuanSidang->nilaiPembimbing = $request->input('nilaiPembimbing');
        $pengajuanSidang->save();

        return response()->json(['success' => 'Nilai pembimbing updated successfully']);
    }

    return response()->json(['error' => 'Pengajuan sidang not found'], 404);
}
}
