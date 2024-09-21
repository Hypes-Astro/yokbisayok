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
                <label for="inputPosisi" class="col-sm-2 col-form-label">Posisi <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPosisi" name="posisi" placeholder="Masukkan Posisi Penyelia" value="{{ $penyelia->penyelia->posisi }}" required readonly>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputDepartemen" class="col-sm-2 col-form-label">Departemen <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputDepartemen" name="departemen" placeholder="Masukkan Departemen penyelia" value="{{ $penyelia->penyelia->departemen }}" required readonly>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputPerusahaan" class="col-sm-2 col-form-label">Perusahaan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPerusahaan" name="perusahaan" placeholder="Masukkan Perusahaan" value="{{ $penyelia->penyelia->perusahaan }}" required readonly>
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
                <label for="inputPrestasiKontribusi" class="col-sm-2 col-form-label">Prestasi dan Kontribusi <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPrestasiKontribusi" name="prestasi_kontribusi" placeholder="Masukkan Prestasi dan Kontribusi" value="{{ $penyelia->prestasi_kontribusi }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputKeterampilanKemampuan" class="col-sm-2 col-form-label">Keterampilan dan Kemampuan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputKeterampilanKemampuan" name="keterampilan_kemampuan" placeholder="Masukkan Keterampilan dan Kemampuan" value="{{ $penyelia->keterampilan_kemampuan }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputKerjasamaKeterlibatan" class="col-sm-2 col-form-label">Kerjasama Dan Keterlibatan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputKerjasamaKeterlibatan" name="kerjasama_keterlibatan" placeholder="Masukkan Kerjasama Dan Keterlibatan" value="{{ $penyelia->kerjasama_keterlibatan }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputKomentar" class="col-sm-2 col-form-label">Komentar</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputKomentar" name="komentar" rows="3" placeholder="Masukkan Komentar">{{ $penyelia->komentar }}</textarea>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputPerkembangan" class="col-sm-2 col-form-label">Perkembangan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPerkembangan" name="perkembangan" placeholder="Masukkan Perkembangan" value="{{ $penyelia->perkembangan }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputKesimpulanSaran" class="col-sm-2 col-form-label">Kesimpulan dan Saran</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputKesimpulanSaran" name="kesimpulan_saran" rows="3" placeholder="Masukkan Kesimpulan dan Saran">{{ $penyelia->kesimpulan_saran }}</textarea>
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
            {{-- <div class="form-group row mb-3">
                <label for="inputFile" class="col-sm-2 col-form-label">Upload File</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="inputFile" name="file">
                </div>
            </div> --}}
        </form>
        @else
            <h4 class="mb-4">Penilaian Hasil Magang</h4>
            <blockquote class="blockquote-primary">
                <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
            </blockquote>
        <form action="{{ route('submit_review') }}" method="POST" enctype="multipart/form-data">
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
                <label for="inputPosisi" class="col-sm-2 col-form-label">Posisi <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPosisi" name="posisi" placeholder="Masukkan Posisi Penyelia" value="{{ $data['posisi'] }}" required readonly>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputDepartemen" class="col-sm-2 col-form-label">Departemen <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputDepartemen" name="departemen" placeholder="Masukkan Departemen penyelia" value="{{ $data['departemen'] }}" required readonly>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputPerusahaan" class="col-sm-2 col-form-label">Perusahaan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPerusahaan" name="perusahaan" placeholder="Masukkan Perusahaan" value="{{ $data['perusahaan'] }}" required readonly>
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
                <label for="inputPrestasiKontribusi" class="col-sm-2 col-form-label">Prestasi dan Kontribusi <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPrestasiKontribusi" name="prestasi_kontribusi" placeholder="Masukkan Prestasi dan Kontribusi" value="{{ $data['prestasi_kontribusi'] }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputKeterampilanKemampuan" class="col-sm-2 col-form-label">Keterampilan dan Kemampuan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputKeterampilanKemampuan" name="keterampilan_kemampuan" placeholder="Masukkan Keterampilan dan Kemampuan" value="{{ $data['keterampilan_kemampuan'] }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputKerjasamaKeterlibatan" class="col-sm-2 col-form-label">Kerjasama Dan Keterlibatan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputKerjasamaKeterlibatan" name="kerjasama_keterlibatan" placeholder="Masukkan Kerjasama Dan Keterlibatan" value="{{ $data['kerjasama_keterlibatan'] }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputKomentar" class="col-sm-2 col-form-label">Komentar</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputKomentar" name="komentar" rows="3" placeholder="Masukkan Komentar">{{ $data['komentar'] }}</textarea>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputPerkembangan" class="col-sm-2 col-form-label">Perkembangan <span class="required">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPerkembangan" name="perkembangan" placeholder="Masukkan Perkembangan" value="{{ $data['perkembangan'] }}" required>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputKesimpulanSaran" class="col-sm-2 col-form-label">Kesimpulan dan Saran</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputKesimpulanSaran" name="kesimpulan_saran" rows="3" placeholder="Masukkan Kesimpulan dan Saran">{{ $data['kesimpulan_saran'] }}</textarea>
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
        @endif       
    </div>
@endsection