@extends('koor.layouts.main')
@section('title', 'History Pengajuan Mahasiswa')
@section('content')

    <div class="wrapper d-flex flex-column min-vh-100">
        <div class="container flex-grow-1">

            @if (session('success'))
                <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <h3 class="mb-3"><b>History Pengajuan Mahasiswa Bimbingan Kerja Praktek</b></h3>
            <p class="mb-2">Berikut ini adalah History pengajuan mahasiswa bimbingan Kerja Praktek</p>
            <!-- Container for export button aligned to the right -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('pengajuan.export') }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export to Excel
                </a>

            </div>
            <div class="table-container table-dosbing">
                <table class="table table-bordered mb-1" id="table-log">
                    <thead class="table-header">
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Judul KP</th>
                        <th>Nama Perusahaan</th>
                        <th>Alamat Perusahaan</th>
                        <th>Nama Penyelia</th>
                        <th>No. Telp Penyelia</th>
                    </thead>
                    @foreach ($pengajuan as $pj)
                        <tr class="centered-column">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pj->mahasiswa->nim }}</td>
                            <td>{{ $pj->mahasiswa->nama }}</td>
                            <td>{{ $pj->judul }}</td>
                            <td>{{ $pj->profilPenyelia ? $pj->profilPenyelia->perusahaan : '-' }}</td>
                            <td>{{ $pj->profilPenyelia ? $pj->profilPenyelia->alamat_mitra : '-' }}</td>
                            <td>{{ $pj->profilPenyelia ? $pj->profilPenyelia->nama : '-' }}</td>
                            <td>{{ $pj->profilPenyelia ? $pj->profilPenyelia->telp_penyelia : '-' }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <footer class="py-4 mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Kerja Praktek</div>
                    <div>
                        <a href="#" class="text-secondary">Privacy Policy</a>
                        &middot;
                        <a href="#" class="text-secondary">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var successAlert = document.getElementById('success-alert');
                if (successAlert) {
                    successAlert.style.display = 'none';
                }

                var errorAlert = document.getElementById('error-alert');
                if (errorAlert) {
                    errorAlert.style.display = 'none';
                }
            }, 3000);
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        // Inisialisasi DataTables
        $(document).ready(function() {
            $('#table-log').DataTable();
        });
    </script>
@endsection
