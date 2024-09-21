@extends('koor.layouts.main')
@section('title', 'Pengumuman')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Kelola Pengumuman</h1>

        @if(session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahPengumumanModal">
            <i class="fa-solid fa-plus"></i>Tambah Pengumuman
        </button>

        <div class="table-responsive">
            <table id="tabelPengumuman" class="table table-bordered table-striped table-hover">
                <thead class="table-header">
                    <tr>
                        <th style="width: 2%">No</th>
                        <th style="width: 25%">Judul</th>
                        <th style="width: 10%">Sender</th>
                        <th style="width: 10%">Tanggal dan Waktu</th>
                        <th style="width: 5%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengumuman as $p)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $p->judul }}</td>
                            <td class="text-center">{{ $p->user }}</td>
                            <td class="text-center">{{ $p->published_at }}</td>
                            <td class="text-center">
                                <!-- Tombol View Detail Pengumuman -->
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#detailPengumumanModal" data-id="{{ $p->id }}">View</button>

                                <form action="{{ route('koor-pengumuman.destroy', $p->id) }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .table td {
            word-wrap: break-word;
            white-space: normal;
            max-width: 100%;
            font-size: 15px;
        }

        .table {
            table-layout: fixed; 
            width: 100%;
        }

        .table th, .table td {
            padding: 12px;
            vertical-align: middle;
        }

        label {
            font-size: 19px;
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>

    <!-- Include Modal CRUD Pengajuan -->
    @include('koor.pengumuman.crud_pengumuman');

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var detailModal = new bootstrap.Modal(document.getElementById('detailPengumumanModal'));

            document.querySelectorAll('.btn-warning[data-toggle="modal"][data-target="#detailPengumumanModal"]')
                .forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        var pengumumanId = this.getAttribute('data-id');
                        fetchPengumumanDetail(pengumumanId);
                    });
                });

            function fetchPengumumanDetail(id) {
                fetch('/detail-pengumuman/' + id, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('judul').textContent = data.pengumuman.judul;
                    document.getElementById('isi').textContent = data.pengumuman.isi;
                    document.getElementById('user').textContent = data.pengumuman.user;
                    document.getElementById('published_at').textContent = data.pengumuman.published_at;
                    detailModal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data pengumuman.');
                });
            }

            document.getElementById('detailPengumumanModal').addEventListener('hidden.bs.modal', function() {
                console.log('Modal hidden event triggered');
                document.body.classList.remove('modal-open');
                console.log('modal-open class removed from body');
                removeBackdrop();
            });

            function removeBackdrop() {
                console.log('Attempting to remove backdrop');
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    console.log('Backdrop found, removing');
                    backdrop.remove();
                } else {
                    console.log('No backdrop found');
                }
            }

            document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(function(button) {
                button.addEventListener('click', function() {
                    detailModal.hide();
                });
            });

            setTimeout(function() {
                var successAlert = document.getElementById('success-alert');
                if (successAlert) {
                    successAlert.style.display = 'none';
                }
            }, 3000);
            
            $('#tabelPengumuman').DataTable({
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(difilter dari total _MAX_ data)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    },
                }
            });
        });
    </script>

    @include('koor.pengumuman.crud_pengumuman');
@endsection