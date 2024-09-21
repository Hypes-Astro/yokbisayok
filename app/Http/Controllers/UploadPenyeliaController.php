<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Events\ReviewPenyelia;
use App\Models\ProfilPenyelia;
use App\Models\StatusMahasiswa;
use App\Models\MahasiswaPenyelia;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UploadPenyeliaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('nim', $user->nim)->with('statusMahasiswa')->first();
        $penyelia = Penilaian::where('mahasiswa_id', $mahasiswa->id)->with('penyelia')->latest()->first();

        $data = $request->all();
        if ($penyelia) {
            return view('mahasiswa.upload_penyelia.draft', compact('data', 'penyelia'));
        }
        return view('mahasiswa.upload_penyelia.add_penyelia', compact('mahasiswa'));
    }

    public function add_penyelia(Request $request)
    {
        // alif
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'perusahaan' => 'required|string',
            'alamat_mitra' => 'required|string',
            'telp_penyelia' => 'required|string',
            'id_mhs' => 'required|exists:mahasiswas,id' // Validasi id mahasiswa
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // disini diubah alif

        // ProfilPenyelia::create([
        //     'nama' => $request->nama,
        //     'jabatan' => $request->jabatan,
        //     'perusahaan' => $request->perusahaan,
        //     'alamat_mitra' => $request->alamat_mitra,
        //     'telp_penyelia' => $request->telp_penyelia,
        //     'id_mhs' => $request->id_mhs // Simpan id_mhs (id dari mahasiswa)
        // ]);

        // alif

        $profilPenyelia = ProfilPenyelia::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'perusahaan' => $request->perusahaan,
            'alamat_mitra' => $request->alamat_mitra,
            'telp_penyelia' => $request->telp_penyelia,
            'id_mhs' => $request->id_mhs // Simpan id_mhs yang terkait
        ]);

        // ini penting alif

        Pengajuan::where('id_mhs', $request->id_mhs)
            ->update(['id_penyelia' => $profilPenyelia->id]);

        $data = $request->all();

        // dd($data);

        $mhs = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $penyelia = ProfilPenyelia::where('nama', $request->nama)->first();

        return view('mahasiswa.upload_penyelia.penilaian', compact('data', 'mhs', 'penyelia'));
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
        $validatedData = $request->validate([
            'deskripsi_pekerjaan' => 'required|string',
            'inovasi' => 'required|string',
            'kerjasama' => 'required|string',
            'kedisiplinan' => 'required|string',
            'catatan' => 'nullable|string',
            'score' => 'required|numeric|min:0|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt',
        ]);

        $data = $request->all();
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $penyelia = Penilaian::where('mahasiswa_id', $mahasiswa->id)->with('penyelia')->latest()->first();

        $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();
        $dosen = Dosen::where('id', $status->id_dsn)->first();
        event(new ReviewPenyelia($mahasiswa, $dosen));
        return view('mahasiswa.upload_penyelia.draft', compact('data', 'penyelia'));
    }

    public function submit_penilaian(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'perusahaan' => 'required|string',
            'alamat_mitra' => 'required|string',
            'telp_penyelia' => 'required|string',
            'deskripsi_pekerjaan' => 'required|string',
            'inovasi' => 'required|string',
            'kerjasama' => 'required|string',
            'kedisiplinan' => 'required|string',
            'catatan' => 'nullable|string',
            'score' => 'required|numeric|min:0|max:100',
            'file_path' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // $file = $request->file('file')->store('assets/file', 'public');


        // inovasi kurang ni tadi hee parah sapa ni handle.-bottom-3
        // udah ditambah alif
        Penilaian::create([
            'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
            'prestasi_kontribusi' => $request->prestasi_kontribusi,
            'inovasi' => $request->inovasi,
            'kerjasama' => $request->kerjasama,
            'kedisiplinan' => $request->kedisiplinan,
            'catatan' => $request->catatan,
            'score' => $request->score,
            'file_path' => $request->file_path,
            'mahasiswa_id' => $request->mhs,
            'penyelia_id' => $request->penyelia,
        ]);

        MahasiswaPenyelia::create([
            'mahasiswaId' => $request->mhs,
            'penyeliaId' => $request->penyelia,
        ]);

        return redirect()->route('detail_penyelia');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('mahasiswa.upload_penyelia.penilaian');
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
