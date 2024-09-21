@extends('mahasiswa.layouts.main')
@section('title', 'Pengajuan Sidang KP')
@section('content')
    <div class="container">
        <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
            <li class="nav-item">
                <a data-toggle="pill" class="nav-link active rounded-pill">
                    <i class="fas fa-edit"></i>
                    Form Pengajuan
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="pill" class="nav-link rounded-pill">
                    <i class="fas fa-book-open"></i>
                    Draft Pengajuan
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="nav-tab-pengajuan-sidang" class="tab-pane fade show active">
                        <div class="container">
                            <h4 class="mb-4">Pengajuan Sidang</h4>
                            <blockquote class="blockquote-primary">
                                <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.
                                </p>
                            </blockquote>
                            <form action="{{ route('draft_sidang') }}" method="GET" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="inputJudul" class="col-sm-2 col-form-label">Judul <span class="required">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputJudul" placeholder="Masukkan Judul KP" name="judul" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="inputBidang" class="col-sm-2 col-form-label">Bidang Kajian <span class="required">*</span></label>
                                    <div class="col-sm-3">
                                        <select class="form-select" name="bidang_kajian" id="inputBidang" aria-label="Bidang Kajian" required>
                                            <option disabled hidden>Pilih Bidang Kajian</option>
                                            <option value="SC">SC</option>
                                            <option value="RPLD">RPLD</option>
                                            <option value="SKKKD">SKKKD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="inputBerkas" class="col-sm-2 col-form-label">Dokumen Tugas Akhir <span class="required">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="dokumen" id="inputBerkas" placeholder="Masukkan Link Dokumen" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="inputBerkas" class="col-sm-2 col-form-label">Dokumen Validasi Dosbing <span class="required">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="validasi" id="inputBerkas" placeholder="Masukkan Link Dokumen" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="inputNilai" class="col-sm-2 col-form-label">Nilai Penyelia <span class="required">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputNilai" placeholder="Masukkan Nilai Penyelia" name="nilaiPenyelia" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3 justify-content-end">
                                    <div class="col-sm-1 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-secondary me-2">Kembali</button>
                                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
            </div>
        </div>
    </div>
@endsection