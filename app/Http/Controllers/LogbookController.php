<?php

namespace App\Http\Controllers;

use App\Events\Logbook;
use App\Models\Mahasiswa;
use App\Events\PengajuanKP;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Models\StatusMahasiswa;
use App\Models\LogbookBimbingan;
use Spatie\Activitylog\Models\Activity;


class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // Menampilkan data logbook dari tabel logbook dan paginate 10 data per halaman. data logbook sesuai dengan user yang login saat ini
    //     $mahasiswa = Mahasiswa::where('email', auth()->user()->email)->first();
    //     $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();
    //     $logbook = LogbookBimbingan::where('id_mhs', $status->id_mhs)->paginate(10);

    //     return view('mahasiswa.logbook_kp.logbook_kp', compact('logbook', 'status'));
    // }

    public function index()
    {
        // Menampilkan data logbook dari tabel logbook dan paginate 10 data per halaman. data logbook sesuai dengan user yang login saat ini
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();
        $logbook = LogbookBimbingan::where('id_mhs', $status->id_mhs)->get();

        return view('mahasiswa.logbook_kp.logbook_kp', compact('logbook', 'status'));
    }

    public function store(Request $request)
    {
        // Menyimpan data logbook yang diinputkan dari form ke dalam tabel logbook
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();
        $logbook = new LogbookBimbingan();
        $logbook->id_mhs = $status->id_mhs;
        $logbook->id_dsn = $status->id_dsn;
        // Aku ingin mengambil tanggal saat request ini dibuat, di database menggunakan tipe data DATE
        $logbook->tanggal = $request->tanggal;
        $logbook->bab = $request->bab;
        $logbook->uraian = $request->uraian;
        $logbook->dokumen = $request->dokumen;

        $logbook->save();

//        Mengambil data bab_terakhir_bimbingan paling baru untuk dimasukkan ke dalam tabel status mahasiswa
        $status->bab_terakhir = $request->bab;
        $status->jml_bimbingan = LogbookBimbingan::where('id_mhs', $status->id_mhs)->count();

        $status->save();

        // return redirect()->back();

        activity()
            ->inLog('logbook')
            ->causedBy(auth()->user())
            ->performedOn($logbook)
            ->withProperties(['id_mhs' => $mahasiswa->id, 'id_dsn' => $status->id_dsn])
            ->log('Menambahkan logbook');
        $dosen = Dosen::where('id', $status->id_dsn)->first();
        event(new Logbook($mahasiswa, $dosen));   
        return redirect()->back()->with('success', 'Logbook Berhasil Ditambahkan.');
    }

    public function updateFolder(Request $request)
    {
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();
        $status->logbook = $request->logbook;

        $status->save();

        activity()
            ->inLog('logbook')
            ->causedBy(auth()->user())
            ->withProperties(['id_mhs' => $mahasiswa->id, 'id_dsn' => $status->id_dsn])
            ->log('Mengupdate folder logbook');
        // return redirect()->route('mahasiswa-logbook');
        return redirect()->back()->with('success', 'Folder Link KP Berhasil Ditambahkan.');
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
//     public function store(Request $request)
//     {
//         // Menyimpan data logbook yang diinputkan dari form ke dalam tabel logbook
//         $mahasiswa = Mahasiswa::where('email', auth()->user()->email)->first();
//         $status = StatusMahasiswa::where('nim', $mahasiswa->nim)->first();
//         $logbook = new LogbookBimbingan();
//         $logbook->id_mhs = $status->id_mhs;
//         $logbook->id_dsn = $status->id_dsn;
//         // Aku ingin mengambil tanggal saat request ini dibuat, di database menggunakan tipe data DATE
//         $logbook->tanggal_bimbingan = date('Y-m-d');
//         $logbook->uraian_bimbingan = $request->uraian_bimbingan;
//         $logbook->bab_terakhir_bimbingan = $request->bab_terakhir_bimbingan;
//         $logbook->dokumen = $request->dokumen;

//         $logbook->save();

// //        Mengambil data bab_terakhir_bimbingan paling baru untuk dimasukkan ke dalam tabel status mahasiswa
//         $status->bab_terakhir = $request->bab_terakhir_bimbingan;
//         $status->jml_bimbingan = LogbookBimbingan::where('id_mhs', $status->id_mhs)->count();
        
//         $status->save();

//         return redirect()->route('mahasiswa-logbook');
//     }

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
