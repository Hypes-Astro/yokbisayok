@extends('mahasiswa.layouts.main')
@section('title', 'Detail Penilaian')
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
            <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link active rounded-pill">
                <i class="fas fa-edit"></i>
                Detail Penilaian
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link rounded-pill">
                <i class="fas fa-book-open"></i>
                Draft Review Penilaian
            </a>
        </li>
    </ul>

<div class="container">
    <h4 class="mb-4">Detail Penilaian</h4>
    <blockquote class="blockquote-primary">
        <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
    </blockquote>
</div>


<div class="container">
    <form action="{{ route('store_penilaian') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Form fields -->
        <input type="hidden" name="nama" value="{{ $data['nama'] }}">
        <input type="hidden" name="jabatan" value="{{ $data['jabatan'] }}">
        <input type="hidden" name="perusahaan" value="{{ $data['perusahaan'] }}">
        <input type="hidden" name="alamat_mitra" value="{{ $data['alamat_mitra'] }}">
        <input type="hidden" name="telp_penyelia" value="{{ $data['telp_penyelia'] }}">
        <input type="hidden" name="mhs" value="{{ $mhs['id'] }}">
        <input type="hidden" name="penyelia" value="{{ $penyelia['id'] }}">

        <div class="form-group row mb-3">
            <label for="inputDeskripsiPekerjaan" class="col-sm-2 col-form-label">Deskripsi Pekerjaan<span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputDeskripsiPekerjaan" name="deskripsi_pekerjaan" placeholder="Masukkan Deskripsi Pekerjaan" required>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputInovasi" class="col-sm-2 col-form-label">Inovasi<span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputInovasi" name="inovasi" placeholder="Masukkan Inovasi" required>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputKerjasama" class="col-sm-2 col-form-label">Kerjasama<span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputKerjasama" name="kerjasama" placeholder="Masukkan Kerjasama" required>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputKedisiplinan" class="col-sm-2 col-form-label">Kedisiplinan<span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputKedisiplinan" name="kedisiplinan" placeholder="Masukkan Kedisiplinan" required>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputCatatan" class="col-sm-2 col-form-label">Catatan<span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputCatatan" name="catatan" placeholder="Masukkan Catatan" required>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputScore" class="col-sm-2 col-form-label">Score <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputScore" name="score" placeholder="Masukkan Score" required>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputFile" class="col-sm-2 col-form-label">Upload File <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputFile" name="file_path" placeholder="Masukkan Link Dokumen" required>
            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>   
</div>
</div>

</body>
</html>
@endsection