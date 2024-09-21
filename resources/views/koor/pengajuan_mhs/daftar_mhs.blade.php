@extends('koor.layouts.main')
@section('title', 'Daftar Pengajuan Mahasiswa')
@section('content')

    <div class="wrapper d-flex flex-column min-vh-100">
        <div class="container flex-grow-1">

            @if(session('success'))
                <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <h3 class="mb-3"><b>Daftar Pengajuan Mahasiswa Bimbingan Kerja Praktek</b></h3>
            <p class="mb-2">Berikut ini adalah daftar pengajuan mahasiswa bimbingan Kerja Praktek</p>
            <div class="table-container table-dosbing">
                <table class="table table-bordered mb-1" id="table-log">
                    <thead class="table-header">
                        <th>No</th>
                        <th>Waktu Pengajuan</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Judul KP</th>
                        <th>Usulan Dosbing</th>
                        <th>Kuota Dosen</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </thead>
                    @foreach ($pengajuan as $pj)
                        <tr class="centered-column">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pj->created_at }}</td>
                            <td>{{ $pj->mahasiswa->nim }}</td>
                            <td>{{ $pj->mahasiswa->nama }}</td>
                            <td>{{ $pj->judul }}</td>
                            <td>{{ $pj->dosen->nama }}</td>
                            <td>{{ $pj->dosen->dosen->sisa_kuota }}</td>
                            <td>
                                <button class="btn btn-warning">{{ $pj->status }}</button>
                            </td>
                            <td class="centered-column">
                                @if ($pj->status == 'ACC')
                                    <button class="btn btn-success" value="ACC">
                                        Status Diterima
                                    </button>
                                @elseif ($pj->status == 'TOLAK') 
                                    {{-- Status Ditolak --}}
                                    <button class="btn btn-danger" value="TOLAK">
                                        Status Ditolak
                                    </button>
                                @else
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('update-list') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $pj->id }}">
                                                @if ($pj->dosen->dosen->sisa_kuota > 0)
                                                <button type="submit" name="status" class="btn btn-success" value="ACC">
                                                    <i class="fa-regular fa-circle-check"></i> 
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-secondary" disabled>
                                                    <i class="fa-regular fa-circle-check"></i> 
                                                </button>
                                            @endif
                                        </form>
                                        <button type="submit" name="status" class="btn btn-danger delete-button ms-2" value="TOLAK" id="rejectButton_{{ $pj->id }}">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </button>
                                    </div>
                                @endif
                            </td>
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
        document.addEventListener('DOMContentLoaded', function () {
            var deleteButtons = document.querySelectorAll('.delete-button');
    
            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var id = this.id.split('_')[1]; // Ambil ID pengajuan dari ID tombol
    
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Pengajuan ini akan ditolak!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, tolak!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log({id: id, status: 'TOLAK'})
                            fetch('/update-mahasiswa', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({id: id, status: 'TOLAK'})
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'success') {
                                    Swal.fire('Success!', 'Pengajuan berhasil ditolak', 'success');
                                    // Lakukan tindakan tambahan setelah berhasil (misalnya, refresh tabel)
                                    location.reload(); // Contoh: Refresh halaman setelah berhasil
                                } else {
                                    Swal.fire('Error!', 'Terjadi kesalahan saat menolak pengajuan.', 'error');
                                }
                            });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire('Canceled!', 'Pengajuan gagal ditolak', 'error');
                        }
                    });
                });
            });
    
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
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        // Inisialisasi DataTables
        $(document).ready(function () {
            $('#table-log').DataTable();
        });
    </script>
    @endsection
    