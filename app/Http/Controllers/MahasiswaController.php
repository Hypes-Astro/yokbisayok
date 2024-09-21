<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Penyelia;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Events\ReviewPenyelia;
use App\Models\DetailPenilaian;
use App\Models\DosenPembimbing;
use App\Models\StatusMahasiswa;
use App\Models\MahasiswaPenyelia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    // nyoba solving :)
    // public function index()
    // {
    //     // Ambil data mahasiswa berdasarkan NIM
    //     $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();

    //     // Jika mahasiswa ditemukan
    //     if ($mahasiswa) {
    //         // Cek kelengkapan data diri mahasiswa
    //         $checkNull = is_null($mahasiswa->telp_mhs) || is_null($mahasiswa->ipk) || is_null($mahasiswa->transkrip_nilai);

    //         // Ambil status mahasiswa, pengajuan, dan pengumuman
    //         $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();
    //         $pengajuans = Pengajuan::where('id_mhs', $mahasiswa->id)->get();
    //         $pengumumans = Pengumuman::orderBy('published_at', 'asc')->get();
    //     } else {
    //         // Jika mahasiswa tidak ditemukan, set variabel default
    //         $checkNull = true;
    //         $status = null;
    //         $pengajuans = collect(); // Menggunakan koleksi kosong
    //         $pengumumans = collect(); // Menggunakan koleksi kosong
    //     }

    //     // Kembalikan view dengan data yang dibutuhkan
    //     return view('mahasiswa.dashboard', compact('mahasiswa', 'status', 'pengajuans', 'checkNull', 'pengumumans'));
    // }

    public function index()
    {
        // $mahasiswa = Auth::user()->mahasiswa;
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();
        $pengajuans = Pengajuan::where('id_mhs', $mahasiswa->id)->get();
        // $checkNull = false;
        // if ($mahasiswa) {
        //     $columns = Schema::getColumnListing('mahasiswas');

        //     foreach ($columns as $column) {
        //         if (is_null($mahasiswa->$column)) {
        //             $checkNull = true;
        //             break;
        //         }
        //     }
        // }

        $checkNull = is_null($mahasiswa->telp_mhs) || is_null($mahasiswa->ipk) || is_null($mahasiswa->transkrip_nilai);

        $pengumumans = Pengumuman::orderBy('published_at', 'asc')->get();

        return view('mahasiswa.dashboard', compact('mahasiswa', 'status', 'pengajuans', 'checkNull', 'pengumumans'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telp_mhs' => 'required',
            'ipk' => 'required',
            'transkrip_nilai' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $mahasiswa->telp_mhs = $request->telp_mhs;
        $mahasiswa->ipk = $request->ipk;
        $mahasiswa->transkrip_nilai = $request->transkrip_nilai;
        $mahasiswa->save();

        activity()
            ->inLog('Pengajuan')
            ->causedBy(auth()->user())
            ->performedOn($mahasiswa)
            ->withProperties(['id_mhs' => $mahasiswa->id])
            ->log('Melengkapi data diri');

        return redirect()->route('dashboardMahasiswa')->with('success', 'Data Mahasiswa Berhasil Diperbarui');
        // return redirect()->back()->with('success', 'Data Mahasiswa Berhasil Diperbarui.');
    }

    public function pengajuan_kp()
    {
        $dosens = DosenPembimbing::all();
        return view('mahasiswa.pengajuan_kp.pengajuan_kp', compact('dosens'));
    }

    public function pilih_dosbing()
    {
        $dosens = DosenPembimbing::all();
        return view('mahasiswa.pengajuan_kp.pilihDosbing', compact('dosens'));
    }

    public function formPengajuan()
    {
        return view('mahasiswa.pengajuan_kp.formPengajuan');
    }

    public function storePengajuan(Request $request)
    {
        dd($request->mahasiswa_id);
        $validator = Validator::make($request->all(), [
            'kategori_bidang' => 'required|in:Web Development,Application Development,Game Development,Data Analysis,Data Science,Artificial Intelligence,Graphic Design,Networking',
            'judul' => 'required|string',
            'perusahaan' => 'required|string',
            'posisi' => 'required|string',
            'deskripsi' => 'required|string',
            'durasi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('formPengajuan')
                ->withErrors($validator)
                ->withInput();
        }

        $pengajuan = Pengajuan::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'kategori_bidang' => $request->kategori_bidang,
            'judul' => $request->judul,
            'perusahaan' => $request->perusahaan,
            'posisi' => $request->posisi,
            'deskripsi' => $request->deskripsi,
            'durasi' => $request->durasi,
        ]);

        // arahkan ke halaman draftPengajuan dengan mengirimkan parameter $id
        return redirect()->route('draftKP', ['id' => $request->mahasiswa_id])
            ->with('success', 'Data Mahasiswa Berhasil Ditambahkan');
    }

    public function draft_kp($id)
    {
        $pengajuan = Pengajuan::where('mahasiswa_id', $id)->first();
        return view('draftPengajuan', compact('pengajuan'));
    }

    public function updatePengajuan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kategori_bidang' => 'required|in:Web Development,Application Development,Game Development,Data Analysis,Data Science,Artificial Intelligence,Graphic Design,Networking',
            'judul' => 'required|string',
            'perusahaan' => 'required|string',
            'posisi' => 'required|string',
            'deskripsi' => 'required|string',
            'durasi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('draftKP', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        $pengajuan = Pengajuan::find($id);
        $pengajuan->update([
            'kategori_bidang' => $request->kategori_bidang,
            'judul' => $request->judul,
            'perusahaan' => $request->perusahaan,
            'posisi' => $request->posisi,
            'deskripsi' => $request->deskripsi,
            'durasi' => $request->durasi,
        ]);

        // arahkan ke halaman draftPengajuan dengan mengirimkan parameter $id
        return redirect()->route('draftKP', ['id' => $pengajuan->mahasiswa_id])
            ->with('success', 'Data Mahasiswa Berhasil Diperbarui');
    }

    public function deletePengajuan()
    {
        session()->forget('pengajuan');
        return redirect()->route('formPengajuan')->with('success', 'Pengajuan berhasil dihapus');
    }

    // public function submitPengajuan()
    // {
    //     $pengajuan = session('pengajuan');
    //     // Simpan pengajuan ke database, misal:
    //     // $pengajuan->save();

    //     // Hapus dari session setelah disimpan
    //     session()->forget('pengajuan');

    //     return redirect()->route('dashboardMahasiswa')->with('success', 'Pengajuan berhasil diajukan ke dosen');
    // }

    public function logbook()
    {
        return view('mahasiswa.logbook_kp.logbook_kp');
    }

    public function profil()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        return view('mahasiswa.profil_mhs.profil_mhs', compact('mahasiswa'));
    }

    public function profile_penyelia(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('nim', $user->nim)->with('statusMahasiswa')->first();
        $penyelia = DetailPenilaian::where('mahasiswa_id', $mahasiswa->id)->with('penyelia')->latest()->first();
        $data = $request->all();
        if ($penyelia) {
            return view('mahasiswa.review_penyelia.draft_penilaian', compact('data', 'penyelia'));
        }
        return view('mahasiswa.review_penyelia.tambah_penyelia', compact('mahasiswa'));
    }

    public function tambah_penyelia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'posisi' => 'required|string',
            'departemen' => 'required|string',
            'perusahaan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Penyelia::create([
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'departemen' => $request->departemen,
            'perusahaan' => $request->perusahaan,
        ]);

        $data = $request->all();

        // dd($data);

        $mhs = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $penyelia = Penyelia::where('nama', $request->nama)->first();

        return view('mahasiswa.review_penyelia.detail_penilaian', compact('data', 'mhs', 'penyelia'));
    }

    public function detail_penilaian()
    {
        return view('mahasiswa.review_penyelia.detail_penilaian');
    }

    public function store_detail_penilaian(Request $request)
    {
        $validatedData = $request->validate([
            'deskripsi_pekerjaan' => 'required|string|max:1000',
            'prestasi_kontribusi' => 'required|string|max:1000',
            'keterampilan_kemampuan' => 'required|string|max:1000',
            'kerjasama_keterlibatan' => 'required|string|max:1000',
            'komentar' => 'nullable|string|max:1000',
            'perkembangan' => 'required|string|max:1000',
            'kesimpulan_saran' => 'required|string|max:1000',
            'score' => 'required|numeric|min:0|max:100',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:2048',
        ]);

        $data = $request->all();
        $mahasiswa = Mahasiswa::where('nim', auth()->user()->nim)->first();
        $penyelia = DetailPenilaian::where('mahasiswa_id', $mahasiswa->id)->with('penyelia')->latest()->first();

        $status = StatusMahasiswa::where('id_mhs', $mahasiswa->id)->first();
        $dosen = Dosen::where('id', $status->id_dsn)->first();
        event(new ReviewPenyelia($mahasiswa, $dosen));
        return view('mahasiswa.review_penyelia.draft_penilaian', compact('data', 'penyelia'));
    }

    // public function draft_review()
    // {
    //     $penyelia = Penyelia::all();
    //     $detailPenilaian = detailPenilaian::all();
    //     return view('mahasiswa.review_penyelia.draft_penilaian', compact('penyelia', 'detailPenilaian'));
    // }

    public function submit_review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'posisi' => 'required|string',
            'departemen' => 'required|string',
            'perusahaan' => 'required|string',
            'deskripsi_pekerjaan' => 'required|string|max:1000',
            'prestasi_kontribusi' => 'required|string|max:1000',
            'keterampilan_kemampuan' => 'required|string|max:1000',
            'kerjasama_keterlibatan' => 'required|string|max:1000',
            'komentar' => 'nullable|string|max:1000',
            'perkembangan' => 'required|string|max:1000',
            'kesimpulan_saran' => 'required|string|max:1000',
            'score' => 'required|numeric|min:0|max:100',
            'file_path' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // $file = $request->file('file')->store('assets/file', 'public');

        DetailPenilaian::create([
            'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
            'prestasi_kontribusi' => $request->prestasi_kontribusi,
            'keterampilan_kemampuan' => $request->keterampilan_kemampuan,
            'kerjasama_keterlibatan' => $request->kerjasama_keterlibatan,
            'komentar' => $request->komentar,
            'perkembangan' => $request->perkembangan,
            'kesimpulan_saran' => $request->kesimpulan_saran,
            'score' => $request->score,
            'file_path' => $request->file_path,
            'mahasiswa_id' => $request->mhs,
            'penyelia_id' => $request->penyelia,
        ]);

        MahasiswaPenyelia::create([
            'mahasiswaId' => $request->mhs,
            'penyeliaId' => $request->penyelia,
        ]);

        return redirect()->route('profile_penyelia');
    }

    public function riwayat()
    {
        return view('mahasiswa.riwayat_pengajuan.riwayat_pengajuan');
    }

    public function datadiri()
    {
        $mhs = Mahasiswa::where('nim', auth()->user()->nim)->first();
        return view('mahasiswa.profil', compact('mhs'));
    }

    public function penilaian_sidang()
    {
        return view('mahasiswa.pengajuan_sidang.pengajuan_sidang');
    }

    public function tentang()
    {
        return view('mahasiswa.tentang');
    }
}
