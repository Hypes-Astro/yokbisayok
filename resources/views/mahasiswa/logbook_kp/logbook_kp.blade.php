@extends('mahasiswa.layouts.main')
@section('title', 'Logbook Bimbingan Kerja Praktek')
@section('content')

    {{-- @if(session('success'))
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
    @endif --}}
    
    <div class="container">
        
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

        <h4 class="mb-4">Bimbingan Kerja Praktek</h4>
        @if($status->id_dsn == 0)
            <div class="alert alert-warning" role="alert">
                Anda belum memiliki dosen pembimbing. Silahkan melakukan pengajuan KP terlebih dahulu.
            </div>
        @else
            <p class="mb-2 d-flex justify-content-between align-items-center">
                Berikut merupakan daftar progres bimbingan yang sudah dilakukan oleh mahasiswa dengan dosen pembimbing
            </p>
            <div class="form-group row align-items-center">
                <label for="folder" class="col-sm-2 col-form-label">Link Folder KP Anda<span class="required"> *</span></label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <form action="{{ route('mahasiswa-logbook-folder') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_mhs" value="{{$status->id_mhs}}">
                            <div class="input-group">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="logbook" placeholder="Masukkan Link Folder KP" value="{{ $status->logbook }}"/>
                                    <button class="btn btn-primary" type="submit"><i class="lni lni-plus"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if($status->logbook != null)
                <hr>
                <div class="mb-2 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogTambahLogbook">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
                <div class="table-container table-logbook">
                    <table id="table-log" class="table table-bordered">
                        <thead class="table-header">
                            <th class="align-middle">No.</th>
                            <th class="align-middle">Tanggal</th>
                            <th class="align-middle">Uraian Bimbingan</th>
                            <th class="align-middle">Bab Terakhir Bimbingan</th>
                            <th class="align-middle">Status</th>
                            <th class="align-middle">Aksi</th>
                        </thead>
                        @foreach ($logbook as $lb)
                            <tr>
                                <td class="centered-column">{{ $loop->iteration }}</td>
                                <td class="centered-column">{{ $lb->tanggal }}</td>
                                <td class="content-column">{{ $lb->uraian }}</td>
                                <td class="centered-column">{{ $lb->bab }}</td>
                                <td class="centered-column">
                                    @if ($lb->status == 'ACC')
                                        <button type="status" class="btn btn-success rounded-5">ACC</button>
                                    @elseif ($lb->status == 'REVISI')
                                        <button type="status" class="btn btn-danger rounded-5">REVISI</button>
                                    @else
                                        <button type="status" class="btn btn-warning rounded-5">PENDING</button>
                                    @endif
                                </td>
                                <td class="centered-column">
                                    <button type="info" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogDetailLogbook" data-id="{{ $lb->id }}"><i class="fas fa-info-circle"></i></button>
                                    @if ($lb->status == 'PENDING')
                                        <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#dialogEditLogbook" data-id="{{ $lb->id }}"><i class="far fa-edit"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    Anda belum menambahkan link folder KP di atas, silahkan diisi terlebih dahulu untuk melanjutkan pengisian logbook
                </div>
            @endif
        @endif
    </div>

    <!-- Dialog Tambah Logbook -->
    @include('mahasiswa.logbook_kp.tambah_logbook')

    <!-- Dialog Edit Logbook -->
    @include('mahasiswa.logbook_kp.edit_logbook')

    <!-- Dialog Info Logbook -->
    @include('mahasiswa.logbook_kp.detail_logbook')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var detailModal = document.querySelector('#dialogDetailLogbook');

            detailModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var logbookId = button.getAttribute('data-id');
                console.log(logbookId);

                fetch('/logbook/' + logbookId)
                    .then(response => response.json())
                    .then(data => {
                        detailModal.querySelector('.date').textContent = data.tanggal;
                        detailModal.querySelector('.uraian').textContent = data.uraian;
                        detailModal.querySelector('.bab').textContent = data.bab;
                        detailModal.querySelector('.status').textContent = data.status;
                        detailModal.querySelector('.dokumen').textContent = data.dokumen;

                        var linkDokumen = detailModal.querySelector('#linkDokumen');
                        linkDokumen.setAttribute('href', data.dokumen)
                    })
                    .catch(error => console.error('Error:', error));
            });

            var editModal = document.querySelector('#dialogEditLogbook');

            editModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var logbookId = button.getAttribute('data-id');
                console.log(logbookId);

                editModal.querySelector('#logbook_id').value = logbookId;

                fetch('/logbook/' + logbookId)
                    .then(response => response.json())
                    .then(data => {
                        editModal.querySelector('#inputTanggal').value = data.tanggal;
                        editModal.querySelector('#inputCatatan').value = data.uraian;
                        editModal.querySelector('#inputBidang').value = data.bab;
                        editModal.querySelector('#inputDok').value = data.dokumen;
                    })
                    .catch(error => console.error('Error:', error));
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
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#table-log').DataTable();
    });
</script>










{{-- @extends('mahasiswa.layouts.main')
@section('title', 'Logbook Bimbingan Kerja Praktek')
@section('content')
<div class="container">
    <h4 class="mb-4">Bimbingan Kerja Praktek</h4>

    @php
        if ($status->id_dsn == 0) {
            echo '<div class="alert alert-warning" role="alert">
                Anda belum memiliki dosen pembimbing. Silahkan melakukan pengajuan KP terlebih dahulu.
            </div>';
        } else {
            echo '<p class="mb-2 d-flex justify-content-between align-items-center">
        Berikut merupakan daftar progres bimbingan yang sudah dilakukan oleh mahasiswa dengan dosen pembimbing
        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogTambahLogbook"> <i
                class="fas fa-plus"></i>Tambah</button>
    </p>';
        }
    @endphp
    <div class="table-container table-logbook">
        <table class="table table-bordered">
            <thead class="table-header">
                <th class="align-middle">No.</th>
                <th class="align-middle">Tanggal</th>
                <th class="align-middle">Uraian Bimbingan</th>
                <th class="align-middle">Bab Terakhir Bimbingan</th>
                <th class="align-middle">Status</th>
                <th class="align-middle">Aksi</th>
            </thead>
            @foreach ($logbook as $lb)
                <tr>
                    <td class="centered-column">{{ $loop->iteration }}</td>
                    <td class="centered-column">{{ $lb->tanggal }}</td>
                    <td class="content-column">{{ $lb->uraian }}</td>
                    <td class="centered-column">{{ $lb->bab }}</td>
                    <td class="centered-column">
                        @if ($lb->status_logbook == 'ACC')
                            <button type="status" class="btn btn-success rounded-5">ACC
                            </button>
                        @elseif ($lb->status_logbook == 'REVISI')
                            <button type="status" class="btn btn-danger rounded-5">REVISI
                            </button>
                        @else
                            <button type="status" class="btn btn-warning rounded-5">PENDING
                            </button>
                        @endif
                    </td>
                    <td class="centered-column">
                        <button type="info" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#dialogDetailLogbook" data-id="{{ $lb->id_logbook }}"><i
                                class="fas fa-info-circle"></i></button>
                        @if ($lb->status_logbook == 'PENDING')
                            <button type="submit" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#dialogEditLogbook" data-id="{{ $lb->id_logbook }}"><i
                                    class="far fa-edit"></i></button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{ $logbook->links() }}
    
</div>

<!--Dialog Tambah Logbook-->
@include('mahasiswa.logbook_kp.tambah_logbook')

<!--Dialog Edit Logbook-->
@include('mahasiswa.logbook_kp.edit_logbook')

<!--Dialog Info Logbook-->
@include('mahasiswa.logbook_kp.detail_logbook')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var detailModal = document.querySelector('#dialogDetailLogbook');

        detailModal.addEventListener('show.bs.modal', function(event) {
            // Tombol yang memicu modal
            var button = event.relatedTarget;
            // Ambil id logbook dari atribut data-id
            var logbookId = button.getAttribute('data-id');
            console.log(logbookId);

            // Kirim permintaan ke backend untuk mengambil data logbook berdasarkan id
            fetch('/logbook/' + logbookId)
                .then(response => response.json())
                .then(data => {
                    // Update konten modal dengan data yang diterima dari backend
                    detailModal.querySelector('.date').textContent = data.tanggal;
                    detailModal.querySelector('.uraian').textContent = data.uraian;
                    detailModal.querySelector('.bab').textContent = data.bab;
                    detailModal.querySelector('.status').textContent = data.status_logbook;
                    detailModal.querySelector('.dokumen').textContent = data.dokumen;

                    var linkDokumen = detailModal.querySelector('#linkDokumen');
                    linkDokumen.setAttribute('href', data.dokumen)
                })
                .catch(error => console.error('Error:', error));
        });

        var editModal = document.querySelector('#dialogEditLogbook');

        editModal.addEventListener('show.bs.modal', function(event) {

            var button = event.relatedTarget;

            var logbookId = button.getAttribute('data-id');
            console.log(logbookId);

            editModal.querySelector('#logbook_id').value = logbookId;

            fetch('/logbook/' + logbookId)
                .then(response => response.json())
                .then(data => {
                    editModal.querySelector('#inputTanggal').value = data.tanggal;
                    editModal.querySelector('#inputCatatan').value = data.uraian;
                    editModal.querySelector('#inputBidang').value = data.bab;
                    editModal.querySelector('#inputDok').value = data.dokumen;
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>

@endsection --}}








{{-- @extends('mahasiswa.layouts.main')
@section('title', 'Logbook Bimbingan Kerja Praktek')
@section('content')
<div class="container">
    <h4 class="mb-4">Bimbingan KP</h4>

    <p class="mb-2 d-flex justify-content-between align-items-center">
        Berikut merupakan daftar progres bimbingan yang sudah dilakukan oleh mahasiswa dengan dosen pembimbing
        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogTambahLogbook"> <i class="fas fa-plus"></i>Tambah</button>
    </p>
    <div class="table-container table-logbook">
        <table class="table table-bordered">
            <thead class="table-header">
                <th class="align-middle">No.</th>
                <th class="align-middle">Tanggal</th>
                <th class="align-middle">Uraian Bimbingan</th>
                <th class="align-middle">Bab Terakhir Bimbingan</th>
                <th class="align-middle">Status</th>
                <th class="align-middle">Aksi</th>
            </thead>
            <tr>
                <td class="centered-column">1</td>
                <td class="centered-column">30 April 2024</td>
                <td class="content-column">Membahas coding</td>
                <td class="centered-column">Bab I</td>
                <td class="centered-column">
                    <button type="status" class="btn btn-success rounded-5">ACC
                        <i class="fas fa-check icon-dark-acc"></i>
                    </button>
                    <!--
                    <button type="status" class="btn btn-danger rounded-5">Belum ACC
                        <i class="fas fa-times icon-dark-no"></i>
                    </button>
                    -->
                </td>
                <td class="centered-column">
                    <button type="info" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogDetailLogbook"><i class="fas fa-info-circle"></i></button>
                    <button type="submit" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#dialogEditLogbook"><i class="far fa-edit"></i></button>
                </td>
            </tr>
        </table>
    </div>
    <nav aria-label="pageNavigationLogbook">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link active" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
    <!--
    <button type="submit" class="btn btn-primary"><i class="fas fa-chevron-right"></i>Pengajuan Sidang</button>
    -->
</div>

<!--Dialog Tambah Logbook-->
@include('mahasiswa.logbook_kp.tambah_logbook')

<!--Dialog Edit Logbook-->
@include('mahasiswa.logbook_kp.edit_logbook')

<!--Dialog Info Logbook-->
@include('mahasiswa.logbook_kp.detail_logbook')
@endsection --}}