@extends('mahasiswa.layouts.main')
@section('title', 'Profil Mahasiswa')
@section('content')
    <div class="container">
        <h4 class="mb-4">Profil Mahasiswa</h4>
    </div>
    <div class="container">
        <form>
            <div class="form-group row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" id="nama" value="{{ $mahasiswa->nama }}">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nim" id="nim" value="{{ $mahasiswa->nim }}">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="prodi" id="prodi" value="Teknik Informatika">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="ipk" id="ipk" value="{{ $mahasiswa->ipk }}">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="telp_mhs" class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="telp_mhs" id="telp_mhs" value="{{ $mahasiswa->telp_mhs }}">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" value="{{ $mahasiswa->email }}">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="dosen_wali" class="col-sm-2 col-form-label">Dosen Wali</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="dosen_wali" id="dosen_wali" value="{{ $mahasiswa->dosen_wali }}">
                </div>
            </div>
            {{-- <div class="form-group row mb-3">
                <label for="inputDeskripsi" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <input type="deskripsi" class="form-control" id="inputDeskripsi">
                </div>
            </div> --}}
        </form>
    </div>
@endsection