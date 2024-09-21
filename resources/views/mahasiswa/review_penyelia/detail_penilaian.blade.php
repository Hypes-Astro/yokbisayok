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
    <form action="{{ route('store_detail_penilaian') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Form fields -->
        <input type="hidden" name="nama" value="{{ $data['nama'] }}">
        <input type="hidden" name="posisi" value="{{ $data['posisi'] }}">
        <input type="hidden" name="departemen" value="{{ $data['departemen'] }}">
        <input type="hidden" name="perusahaan" value="{{ $data['perusahaan'] }}">
        <input type="hidden" name="mhs" value="{{ $mhs['id'] }}">
        <input type="hidden" name="penyelia" value="{{ $penyelia['id'] }}">

        <div class="form-group row mb-3">
            <label for="inputDeskripsiPekerjaan" class="col-sm-2 col-form-label">Deskripsi Pekerjaan<span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputDeskripsiPekerjaan" name="deskripsi_pekerjaan" placeholder="Masukkan Deskripsi Pekerjaan" required>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputPrestasiKontribusi" class="col-sm-2 col-form-label">Prestasi dan Kontribusi <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPrestasiKontribusi" name="prestasi_kontribusi" placeholder="Masukkan Prestasi dan Kontribusi" required>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputKeterampilanKemampuan" class="col-sm-2 col-form-label">Keterampilan dan Kemampuan <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputKeterampilanKemampuan" name="keterampilan_kemampuan" placeholder="Masukkan Keterampilan dan Kemampuan" required>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputKerjasamaKeterlibatan" class="col-sm-2 col-form-label">Kerjasama Dan Keterlibatan <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputKerjasamaKeterlibatan" name="kerjasama_keterlibatan" placeholder="Masukkan Kerjasama Dan Keterlibatan" required>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputKomentar" class="col-sm-2 col-form-label">Komentar</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="inputKomentar" name="komentar" rows="3" placeholder="Masukkan Komentar"></textarea>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputPerkembangan" class="col-sm-2 col-form-label">Perkembangan <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPerkembangan" name="perkembangan" placeholder="Masukkan Perkembangan" required>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="inputKesimpulanSaran" class="col-sm-2 col-form-label">Kesimpulan Dan Saran <span class="required">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputKesimpulanSaran" name="kesimpulan_saran" placeholder="Masukkan Kesimpulan Dan Saran" required>
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
        {{-- <div class="form-group row mb-3">
            <label for="inputFile" class="col-sm-2 col-form-label">Upload File</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="inputFile" name="file">
            </div>
        </div> --}}
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