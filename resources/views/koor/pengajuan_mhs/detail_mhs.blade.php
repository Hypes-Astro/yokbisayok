@extends('koor.layouts.main')
@section('title', 'Detail Pengajuan Mahasiswa')
@section('content')
    <style>
        /* Add some basic styling to make the form look good */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>

    <div class="wrapper d-flex flex-column min-vh-100">
        <div class="container flex-grow-1">
            <img src="https://via.placeholder.com/200x200" alt="Profile" class="image mt-5">
            <div class="form">
                <h2 class="mb-4">Detail Mahasiswa</h2>
                <form action="{{ route('update-list', ['id' => $pengajuan->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" value="{{ $mahasiswa->nama }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nim">Nomor Induk Mahasiswa</label>
                        <input type="text" id="nim" value="{{ $mahasiswa->nim }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="kategori-bidang">Kategori Bidang</label>
                        <input type="text" id="kategori-bidang" value="{{ $pengajuan->kategori_bidang }}" class="form-control"
                               disabled>
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul Penelitian</label>
                        <input type="text" id="judul" value="{{ $pengajuan->judul }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="perusahaan">perusahaan</label>
                        <input type="text" id="perusahaan" value="{{ $pengajuan->perusahaan }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Umum</label>
                        <input type="text" id="deskripsi" value="{{ $pengajuan->deskripsi }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="durasi">Durasi Magang</label>
                        <input type="text" id="durasi" value="{{ $pengajuan->durasi }}" class="form-control" disabled>
                    </div>
                    @if ($pengajuan->status == 'PENDING')
                        <div style="display: flex; justify-content: flex-end;">
                            <button type="submit" name="status" value="ACC"
                                    class="btn btn-success px-4 py-2 me-2">Setuju</button>
                            <button type="submit" name="status" value="TOLAK" class="btn btn-danger px-4 py-2">Tolak</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection