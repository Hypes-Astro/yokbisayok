@extends('mahasiswa.layouts.main')
@section('title', 'Form Mahasiswa')
@section('content')
<div class="container">
    <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-dosbing" class="nav-link rounded-pill">
                <i class="fas fa-chalkboard-teacher"></i>
                Profil Penyelia
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link rounded-pill">
                <i class="fas fa-edit"></i>
                Detail Penilaian
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link active rounded-pill">
                <i class="fas fa-book-open"></i>
                Draft Review Penilaian
            </a>
        </li>
    </ul>


    <div class="container">
        @if($penyelia)
        <form>
            <div class="mb-4">Profil Penyelia</div>
            <div class="form-group row mb-3">
                <label for="inputNama" class="col-sm-2 col-form-label">Nama<span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNama" name="nama" placeholder="Masukkan Nama Penyelia" value="{{ $penyelia->penyelia->nama }}" required readonly>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputJabatan" class="col-sm-2 col-form-label">Jabatan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputJabatan" name="jabatan" placeholder="Masukkan Jabatan Penyelia" value="{{ $penyelia->penyelia->jabatan }}" required readonly>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputPerusahaan" class="col-sm-2 col-form-label">Perusahaan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPerusahaan" name="perusahaan" placeholder="Masukkan Perusahaan" value="{{ $penyelia->penyelia->perusahaan }}" required readonly>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat Perusahaan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputAlamat" name="alamat_mitra" placeholder="Masukkan Alamat Perusahaan " value="{{ $penyelia->penyelia->alamat_mitra }}" required readonly>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputNomor" class="col-sm-2 col-form-label">No Telpon Penyelia <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNomor" name="telp_penyelia" placeholder="Masukkan >No Telpon Penyelia" value="{{ $penyelia->penyelia->telp_penyelia }}" required readonly>
                </div>
            </div>
            <div class="mb-4">Detail Penilaian</div>
            <div class="form-group row mb-3">
                <label for="inputDeskripsiPekerjaan" class="col-sm-2 col-form-label">Deskripsi Pekerjaan<span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputDeskripsiPekerjaan" name="deskripsi_pekerjaan" placeholder="Masukkan Deskripsi Pekerjaan" value="{{ $penyelia->deskripsi_pekerjaan }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputInovasi" class="col-sm-2 col-form-label">Inovasi <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputInovasi" name="inovasi" placeholder="Masukkan Inovasi" value="{{ $penyelia->inovasi }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputKerjasama" class="col-sm-2 col-form-label">Kerjasama <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputKerjasama" name="kerjasama" placeholder="Masukkan Kerjasama" value="{{ $penyelia->kerjasama }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputKedisiplinan" class="col-sm-2 col-form-label">Kedisiplinan</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputKedisiplinan" name="kedisiplinan" rows="3" placeholder="Masukkan Kedisiplinan">{{ $penyelia->kedisiplinan }}</textarea>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputCatatan" class="col-sm-2 col-form-label">Catatan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputCatatan" name="catatan" placeholder="Masukkan Catatan" value="{{ $penyelia->catatan }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputScore" class="col-sm-2 col-form-label">Score <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputScore" name="score" placeholder="Masukkan Score" value="{{ $penyelia->score }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputFile" class="col-sm-2 col-form-label">Upload File <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputFile" name="file_path" placeholder="Masukkan Link Dokumen" value="{{ $penyelia->file_path }}" required>
                </div>
            </div>
        </form>
        @else
            <h4 class="mb-4">Penilaian Hasil Magang</h4>
            <blockquote class="blockquote-primary">
                <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
            </blockquote>
        <form action="{{ route('submit_penilaian') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="mhs" value="{{ $data['mhs'] }}">
            <input type="hidden" name="penyelia" value="{{ $data['penyelia'] }}">

            <div class="mb-4">Profil Penyelia</div>
            <div class="form-group row mb-3">
                <label for="inputNama" class="col-sm-2 col-form-label">Nama<span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNama" name="nama" placeholder="Masukkan Nama Penyelia" value="{{ $data['nama'] }}" required readonly>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputJabatan" class="col-sm-2 col-form-label">Jabatan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputJabatan" name="jabatan" placeholder="Masukkan jabatan Penyelia" value="{{ $data['jabatan'] }}" required readonly>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputPerusahaan" class="col-sm-2 col-form-label">Perusahaan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPerusahaan" name="perusahaan" placeholder="Masukkan Perusahaan" value="{{ $data['perusahaan'] }}" required readonly>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat Perusahaan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputAlamat" name="alamat_mitra" placeholder="Masukkan Alamat Perusahaan" value="{{ $data['alamat_mitra'] }}" required readonly>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputNomor" class="col-sm-2 col-form-label">No Telp Penyelia <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNomor" name="telp_penyelia" placeholder="Masukkan No Telp penyelia" value="{{ $data['telp_penyelia'] }}" required readonly>
                </div>
            </div>
            <div class="mb-4">Detail Penilaian</div>
            <div class="form-group row mb-3">
                <label for="inputDeskripsiPekerjaan" class="col-sm-2 col-form-label">Deskripsi Pekerjaan<span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputDeskripsiPekerjaan" name="deskripsi_pekerjaan" placeholder="Masukkan Deskripsi Pekerjaan" value="{{ $data['deskripsi_pekerjaan'] }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputInovasi" class="col-sm-2 col-form-label">Inovasi <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputInovasi" name="inovasi" placeholder="Masukkan Inovasi" value="{{ $data['inovasi'] }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputKerjasama" class="col-sm-2 col-form-label">Kerjasama <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputKerjasama" name="kerjasama" placeholder="Masukkan Kerjasama" value="{{ $data['kerjasama'] }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputkedisiplinan" class="col-sm-2 col-form-label">kedisiplinan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputkedisiplinan" name="kedisiplinan" placeholder="Masukkan Kedisiplinan" value="{{ $data['kedisiplinan'] }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputCatatan" class="col-sm-2 col-form-label">Catatan</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputCatatan" name="catatan" rows="3" placeholder="Masukkan Catatan">{{ $data['catatan'] }}</textarea>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputScore" class="col-sm-2 col-form-label">Score <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputScore" name="score" placeholder="Masukkan Score" value="{{ $data['score'] }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputFile" class="col-sm-2 col-form-label">Upload File <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputFile" name="file_path" placeholder="Masukkan Link Dokumen" value="{{ $data['file_path'] }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
        @endif       
    </div>
@endsection