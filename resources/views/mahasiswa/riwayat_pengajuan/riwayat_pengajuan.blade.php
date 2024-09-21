@extends('mahasiswa.layouts.main')
@section('title', 'Riwayat Pengajuan')
@section('content')

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><b>Riwayat Pengajuan</b></h1>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-briefcase me-1"></i>
                    Riwayat Pengajuan Bimbingan Kerja Praktek
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTableMahasiswa" width="100%"
                               cellspacing="0">
                            <thead class="table-danger">
                            <tr>
                                <th>No</th>
                                <th>NPP</th>
                                <th>Nama Dosen</th>
                                <th>Email Dosen</th>
                                <th>Judul Pengajuan</th>
                                <th>Alasan</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <th>0686.11.2012.444</th>
                                    <th>ADHITYA NUGRAHA, S.Kom, M.CS</th>
                                    <th>adhitya@dsn.dinus.ac.id</th>
                                    <th>sentimen analysis</th>
                                    <th>judul uelek</th>
                                    <th>
                                    <button type="button" class="btn btn-danger">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- riwayat penyelia Table -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chalkboard-teacher me-1"></i>
                    Riwayat Review Penyelia
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTableDosen" width="100%"
                               cellspacing="0">
                            <thead class="table-danger">
                            <tr>
                                <th>No</th>
                                <th>NPP</th>
                                <th>Dosen Pembimbing</th>
                                <th>Dosen Penguji</th>
                                <th>Nama Penyelia</th>
                                <th>Posisi</th>
                                <th>Perusahaan</th>
                                <th>File</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <th>0686.11.2012.444</th>
                                    <th>ADHITYA NUGRAHA, S.Kom, M.CS</th>
                                    <th>ADHITYA NUGRAHA, S.Kom, M.CS</th>
                                    <th>ADHITYA NUGRAHA, S.Kom, M.CS</th>
                                    <th>Lektor</th>
                                    <th>Universitas Dian Nuswantoro</th>
                                    <th>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#dialogDetailRiwayat">
                                        <i class="fas fa-file-alt"></i>
                                    </button>
                                    </th>
                                    <th>
                                    <button type="button" class="btn btn-success">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

<!--Dialog detail riwayat pengajuan-->
@include('mahasiswa.riwayat_pengajuan.detail_riwayat')
@endsection

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTableMahasiswa').DataTable();
        $('#dataTableDosen').DataTable();
        $('#dataTableLogbook').DataTable();
    });
</script> --}}
