{{-- @extends('dosen.layouts.main')
@section('title', 'Daftar Bimbingan Kerja Praktek')
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

            <h3 class="mb-3"><b>Daftar Pengajuan Mahasiswa Bimbingan</b></h3>
            <p class="mb-2">Berikut ini adalah daftar pengajuan mahasiswa bimbingan</p>
            <!-- <div class="table-container table-dosbing">
                <table class="table table-bordered mb-1" id="table-log">
                    <thead class="table-header">
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Foto</th>
                        <th>IPK</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Status Magang</th>
                    </thead>
                    @foreach ($statusMahasiswa as $status)
                        <tr class="centered-column">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $status->mahasiswa->nim }}</td>
                            <td>{{ $status->mahasiswa->nama }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#fotoModal_{{ $status->mahasiswa->id }}">
                                    <i class="fa-solid fa-images"></i>
                                </button>
                            </td>
                            <td>{{ $status->mahasiswa->ipk }}</td>
                            @foreach ($status->pengajuans as $pj) 
                                <td>{{ $pj->judul }}</td>
                            @endforeach
                            <td class="centered-column">
                                @if ($status->status == 'ACC')
                                    <button class="btn btn-success" value="ACC">
                                        Status Diterima
                                    </button>
                                @elseif ($status->status == 'TOLAK')
                                    <button class="btn btn-danger" value="TOLAK">
                                        Status Ditolak
                                    </button>
                                @else
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('update-mahasiswa-bimbingan') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $status->id }}">
                                            <button type="submit" name="status" class="btn btn-success" value="ACC">
                                                <i class="fa-regular fa-circle-check"></i> ACC
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-danger ms-2 delete-button" data-id="{{ $status->id }}">
                                            <i class="fa-regular fa-circle-xmark"></i> TOLAK
                                        </button>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($status->status == 'PENDING' || $status->status == 'TOLAK')
                                <button type="button" class="btn btn-success" disabled>
                                    <i class="fa-regular fa-circle-check"></i> Selesai
                                </button>
                                @else
                                    @if($status->mahasiswa->statusMahasiswa->status_magang == 'SELESAI')
                                        <button type="button" class="btn btn-success" disabled>
                                            <i class="fa-regular fa-circle-check"></i> Selesai
                                        </button>
                                    @else
                                        <form action="{{ route('update-selesai-magang') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $status->id_mhs }}">
                                            <button type="submit" name="status_magang" class="btn btn-success" value="SELESAI">
                                                <i class="fa-regular fa-circle-check"></i> Selesai
                                            </button>
                                        </form>
                                    @endif
                                @endif 
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div> -->
            <div class="table-container table-dosbing">
                <table class="table table-bordered mb-1" id="table-log">
                    <thead class="table-header">
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Foto</th>
                        <th>IPK</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Status Magang</th>
                    </thead>
                    <tbody>
                    @foreach ($combinedData as $index => $item)
                        <tr class="centered-column">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->mahasiswa->nim }}</td>
                            <td>{{ $item->mahasiswa->nama }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#fotoModal_{{ $item->mahasiswa->id }}">
                                    <i class="fa-solid fa-images"></i>
                                </button>
                            </td>
                            <td>{{ $item->mahasiswa->ipk }}</td>
                            <td>
                                @if($item instanceof \App\Models\StatusMahasiswa)
                                    @foreach ($item->pengajuans as $pj) 
                                        {{ $pj->judul }}
                                    @endforeach
                                @else
                                    {{ $item->judul }}
                                @endif
                            </td>
                            <td class="centered-column">
                                @if($item instanceof \App\Models\StatusMahasiswa)
                                    @if ($item->status == 'ACC')
                                        <button class="btn btn-success" value="ACC">Status Diterima</button>
                                    @elseif ($item->status == 'TOLAK')
                                        <button class="btn btn-danger" value="TOLAK">Status Ditolak</button>
                                    @else
                                        <div class="d-flex justify-content-center">
                                            <form action="{{ route('update-mahasiswa-bimbingan') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button type="submit" name="status" class="btn btn-success" value="ACC">
                                                    <i class="fa-regular fa-circle-check"></i> ACC
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-danger ms-2 delete-button" data-id="{{ $item->id }}">
                                                <i class="fa-regular fa-circle-xmark"></i> TOLAK
                                            </button>
                                        </div>
                                    @endif
                                @else
                                    <div class="d-flex justify-content-center">
                                        <form action="{{ route('update-mahasiswa-bimbingan') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button type="submit" name="status" class="btn btn-success" value="ACC">
                                                <i class="fa-regular fa-circle-check"></i> ACC
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-danger ms-2 delete-button" data-id="{{ $item->id }}">
                                            <i class="fa-regular fa-circle-xmark"></i> TOLAK
                                        </button>
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($item instanceof \App\Models\StatusMahasiswa)
                                    @if($item->status == 'PENDING' || $item->status == 'TOLAK')
                                        <button type="button" class="btn btn-success" disabled>
                                            <i class="fa-regular fa-circle-check"></i> Selesai
                                        </button>
                                    @else
                                        @if($item->mahasiswa->statusMahasiswa->status_magang == 'SELESAI')
                                            <button type="button" class="btn btn-success" disabled>
                                                <i class="fa-regular fa-circle-check"></i> Selesai
                                            </button>
                                        @else
                                            <form action="{{ route('update-selesai-magang') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id_mhs }}">
                                                <button type="submit" name="status_magang" class="btn btn-success" value="SELESAI">
                                                    <i class="fa-regular fa-circle-check"></i> Selesai
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                @else
                                    <button type="button" class="btn btn-secondary" disabled>Belum Disetujui</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
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

    <!-- Modal Alasan Penolakan -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Alasan Penolakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="rejectForm">
                        <input type="hidden" name="id" id="rejectId">
                        <div class="mb-3">
                            <label for="reason" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="reason" name="alasan" rows="3" required></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var deleteButtons = document.querySelectorAll('.delete-button');
            var rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
            var rejectForm = document.getElementById('rejectForm');

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var id = this.id.split('_')[1]; // Ambil ID pengajuan dari ID tombol
                    document.getElementById('rejectId').value = id;
                    rejectModal.show();
                });
            });

            rejectForm.addEventListener('submit', function (event) {
                event.preventDefault();
                var id = document.getElementById('rejectId').value;
                var reason = document.getElementById('reason').value;

                if (reason) {
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Alasan penolakan: " + reason,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, tolak!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log({id: id, status: 'TOLAK', alasan: reason})
                            fetch('/update-pengajuan', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({id: id, status: 'TOLAK', alasan: reason})
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
                } else {
                    Swal.fire('Error!', 'Alasan penolakan harus diisi.', 'error');
                }
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
@endsection --}}











@extends('dosen.layouts.main')
@section('title', 'Daftar Bimbingan Kerja Praktek')
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

            <h3 class="mb-3"><b>Daftar Pengajuan Mahasiswa Bimbingan</b></h3>
            <p class="mb-2">Berikut ini adalah daftar pengajuan mahasiswa bimbingan</p>

            <div class="table-container table-dosbing">
                <table class="table table-bordered mb-1" id="table-log">
                    <thead class="table-header">
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Foto</th>
                        <th>IPK</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Status Magang</th>
                    </thead>
                    <tbody>
                    @foreach ($combinedData as $index => $item)
                        <tr class="centered-column">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->mahasiswa->nim }}</td>
                            <td>{{ $item->mahasiswa->nama }}</td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#fotoModal_{{ $item->mahasiswa->id }}">
                                    <i class="fa-solid fa-images"></i>
                                </button>
                            </td>
                            <td>{{ $item->mahasiswa->ipk }}</td>
                            <td>
                                @if($item instanceof \App\Models\StatusMahasiswa)
                                    @foreach ($item->pengajuans as $pj) 
                                        {{ $pj->judul }}
                                    @endforeach
                                @else
                                    {{ $item->judul }}
                                @endif
                            </td>
                            
                                    <td class="centered-column">
                                        @php
                                            // Cek kuota dosen
                                            $dosenPembimbing = \App\Models\DosenPembimbing::where('id_dsn', $item->id_dsn)->first();
                                        @endphp
                                        @if ($item->status == 'ACC')
                                            <!-- Status sudah ACC, tampilkan status diterima tanpa perlu perubahan -->
                                            <button class="btn btn-success" value="ACC" >Status Diterima</button>
                                        @elseif ($item->status == 'TOLAK')
                                            <!-- Status sudah TOLAK, tampilkan status ditolak -->
                                            <button class="btn btn-danger" value="TOLAK" >Status Ditolak</button>
                                        @elseif ($dosenPembimbing && $dosenPembimbing->sisa_kuota <= 0)
                                            <!-- Jika kuota penuh, tolak pengajuan -->
                                            @php
                                                // Update status pengajuan menjadi "TOLAK" jika kuota penuh
                                                \App\Models\Pengajuan::where('id', $item->id)->update(['status' => 'TOLAK']);
                                            @endphp
                                            <button type="button" class="btn btn-secondary" disabled>
                                                <i class="fa-regular fa-circle-check"></i> Kuota Penuh
                                            </button>
                                        @else
                                            <!-- Jika kuota masih tersedia dan belum ada keputusan -->
                                            <div class="d-flex justify-content-center">
                                                <form action="{{ route('update-mahasiswa-bimbingan') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button type="submit" name="status" class="btn btn-success" value="ACC">
                                                        <i class="fa-regular fa-circle-check"></i> ACC
                                                    </button>
                                                </form>
                                                <button type="button" class="btn btn-danger ms-2 delete-button" data-id="{{ $item->id }}">
                                                    <i class="fa-regular fa-circle-xmark"></i> TOLAK
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                            
                                        {{-- @else
                                            <div class="d-flex justify-content-center">
                                                <form action="{{ route('update-mahasiswa-bimbingan') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <button type="submit" name="status" class="btn btn-success" value="ACC">
                                                        <i class="fa-regular fa-circle-check"></i> ACC
                                                    </button>
                                                </form>
                                                <button type="button" class="btn btn-danger ms-2 delete-button" data-id="{{ $item->id }}">
                                                    <i class="fa-regular fa-circle-xmark"></i> TOLAK
                                                </button>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    <!-- Jika tidak ada data dosen -->
                                    <button type="button" class="btn btn-secondary" disabled>
                                        <i class="fa-regular fa-circle-check"></i> Tidak Ada Data Dosen
                                    </button>
                                @endif --}}
                            </td>                            
                            
                            <td>
                                @if($item instanceof \App\Models\StatusMahasiswa)
                                    @if($item->status == 'PENDING' || $item->status == 'TOLAK')
                                        <button type="button" class="btn btn-success" disabled>
                                            <i class="fa-regular fa-circle-check"></i> Selesai
                                        </button>
                                    @else
                                        @if($item->mahasiswa->statusMahasiswa->status_magang == 'SELESAI')
                                            <button type="button" class="btn btn-success" disabled>
                                                <i class="fa-regular fa-circle-check"></i> Selesai
                                            </button>
                                        @else
                                            <form action="{{ route('update-selesai-magang') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id_mhs }}">
                                                <button type="submit" name="status_magang" class="btn btn-success" value="SELESAI">
                                                    <i class="fa-regular fa-circle-check"></i> Selesai
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                @else
                                    <button type="button" class="btn btn-secondary" disabled>Belum Disetujui</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
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

    <!-- Modal Alasan Penolakan -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Alasan Penolakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="rejectForm">
                        <input type="hidden" name="id" id="rejectId">
                        <div class="mb-3">
                            <label for="reason" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="reason" name="alasan" rows="3" required></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var deleteButtons = document.querySelectorAll('.delete-button');
            var rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
            var rejectForm = document.getElementById('rejectForm');

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var id = this.dataset.id;
                    document.getElementById('rejectId').value = id;
                    rejectModal.show();
                });
            });

            rejectForm.addEventListener('submit', function (event) {
                event.preventDefault();
                var id = document.getElementById('rejectId').value;
                var reason = document.getElementById('reason').value;

                if (reason) {
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Alasan penolakan: " + reason,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, tolak!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('/update-pengajuan', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({id: id, status: 'TOLAK', alasan: reason})
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.status === 'success') {
                                        Swal.fire('Success!', 'Pengajuan berhasil ditolak', 'success').then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire('Error!', 'Terjadi kesalahan saat menolak pengajuan.', 'error');
                                    }
                                });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire('Canceled!', 'Pengajuan belum ditolak.', 'info');
                        }
                    });
                } else {
                    Swal.fire('Error!', 'Silakan isi alasan penolakan.', 'error');
                }
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