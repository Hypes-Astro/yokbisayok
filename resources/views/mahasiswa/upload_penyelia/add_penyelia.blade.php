@extends('mahasiswa.layouts.main')
@section('title', 'Form Mahasiswa')
@section('content')
    <div class="container">
        <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
            <li class="nav-item">
                <a data-toggle="pill" href="#nav-tab-dosbing" class="nav-link active rounded-pill">
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
                <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link rounded-pill">
                    <i class="fas fa-book-open"></i>
                    Draft Review Penilaian
                </a>
            </li>
        </ul>

        <div class="container">
            <h4 class="mb-4">Profil Penyelia</h4>
            @if ($mahasiswa->statusMahasiswa->status_magang == 'SELESAI')
                <blockquote class="blockquote-primary">
                    <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
                </blockquote>

                <form method="POST" action="{{ route('page-add-penyelia') }}">
                    @csrf
                    <div class="form-group row mb-3">
                        <label for="inputNama" class="col-sm-2 col-form-label">Nama <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputNama" name="nama"
                                placeholder="Masukkan Nama Penyelia" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputJabatan" class="col-sm-2 col-form-label">Jabatan <span
                                class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputJabatan" name="jabatan"
                                placeholder="Masukkan Jabatan Penyelia" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputPerusahaan" class="col-sm-2 col-form-label">Perusahaan <span
                                class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPerusahaan" name="perusahaan"
                                placeholder="Masukkan Perusahaan" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat Perusahaan <span
                                class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputAlamat" name="alamat_mitra"
                                placeholder="Masukkan Alamat Perusahaan " required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputNomor" class="col-sm-2 col-form-label">No Telpon Penyelia <span
                                class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputNomor" name="telp_penyelia"
                                placeholder="Masukkan No Telpon Penyelia" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3 justify-content-end">
                        <div class="col-sm-1 d-flex justify-content-end">
                            {{-- ambil id mhs --}}

                            <input type="hidden" name="id_mhs" value="{{ $mahasiswa->id }}">


                            <button type="button" class="btn btn-secondary me-2">Kembali</button>
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        </div>
                    </div>
                </form>
            @else
                <div class="alert alert-warning" role="alert">
                    Harap menghubungi Dosen Pembimbing untuk pengisian Review Penyelia.
                </div>
            @endif

        </div>
    </div>
@endsection