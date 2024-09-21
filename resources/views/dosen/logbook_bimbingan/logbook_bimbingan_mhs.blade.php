@extends('dosen.layouts.main')
@section('title', 'Logbook Mahasiswa Bimbingan')
@section('content')

    <!--Dialog Info Logbook-->
    @include('dosen.logbook_bimbingan.detail_logbook')

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

            <h3 class="mb-3"><b>Daftar Logbook Mahasiswa Bimbingan</b></h3>
            <p class="mb-5 d-flex justify-content-between align-items-center">
                Berikut merupakan daftar logbook mahasiswa bimbingan
            </p>
            <div class="table-container table-logbook">
                <table class="table table-bordered" id="table-log">
                    <thead class="table-header">
                    <th class="align-middle">No</th>
                    <th class="align-middle">NIM</th>
                    <th class="align-middle">Nama Mahasiswa</th>
                    <th class="align-middle">Jumlah Bimbingan</th>
                    <th class="align-middle">Bab Terakhir</th>
                    <th class="align-middle">Folder KP</th>
                    <th class="align-middle">Logbook</th>
                    </thead>
                    <tbody>
                    @foreach($status as $st)
                        <tr class="centered-column">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $st->mahasiswa->nim }}</td>
                            <td>{{ $st->mahasiswa->nama }}</td>
                            <td>{{ $st->jml_bimbingan }}</td>
                            <td>{{ $st->bab_terakhir }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm me-2">
                                    <i class="fa-regular fa-folder-open"></i> Folder
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal"
                                        data-bs-target="#dialogDetailLogbook" data-id="{{ $st->id_mhs }}">
                                    <i class="fa-solid fa-file-lines"></i> Logbook
                                </button>
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

    <script>
        $(document).ready(function () {
                $('#dialogDetailLogbook').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var mhsId = button.data('id');
                    console.log(mhsId)
                    var modal = $(this);
                    console.log(modal)

                    $.ajax({
                        url: '/logbookBimbinganList/' + mhsId,
                        method: 'GET',
                        success: function (data) {
                            console.log(data);
                            $('#mahasiswaLogbookList').empty();

                            if (data.length > 0) {
                                data.forEach(function (logbook, index) {
                                    let rowHtml = `
                                        <tr>
                                            <td class="centered-column">${index + 1}</td>
                                            <td class="col-2 centered-column">${logbook.tanggal}</td>
                                            <td class="centered-column">${logbook.bab}</td>
                                            <td class="content-column">${logbook.uraian}</td>
                                            <td class="content-column"><a href="${logbook.dokumen}" target="_blank">${logbook.dokumen}</a></td>
                                            <td class="centered-column">`;

                                    if (logbook.status === 'PENDING') {
                                        rowHtml += `
                                        <form class="d-flex justify-content-center" action="/accLogbook" method="post">
                                            @csrf
                                        <input type="hidden" name="id_logbook" value="${logbook.id}">
                                            <button type="submit" name="status" class="btn btn-success" value="ACC">
                                            <i class="fa-regular fa-circle-check"></i> ACC
                                            </button>
                                        </form>`;
                                    }
                                    if (logbook.status === 'ACC') {
                                        rowHtml += `<button type="status" class="btn btn-success" disabled>ACC</button>`;
                                    }

                                    rowHtml += `</td></tr>`;
                                    $('#mahasiswaLogbookList').append(rowHtml);
                                });
                            } else {
                                $('#mahasiswaLogbookList').append(
                                    '<tr><td colspan="10" class="text-center">Tidak ada data logbook bimbingan</td></tr>'
                                );
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX Error:', error);
                            console.log('XHR:', xhr);
                            console.log('Status:', status);
                        }
                    });
                });
            }
        );

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

    <script>
        // Inisialisasi DataTables
        $(document).ready(function () {
            $('#table-log').DataTable();
        });
    </script>
@endsection

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#table-log').DataTable();
    });
</script> --}}




{{-- @extends('dosen.layouts.main')
// @section('title', 'Daftar Bimbingan Kerja Praktek')
// @section('content')

//     <!--Dialog Info Logbook-->
//     @include('dosen.logbook_bimbingan.detail_logbook')

//     <div class="wrapper d-flex flex-column min-vh-100">
//         <div class="container flex-grow-1">
//             <h3 class="mb-3"><b>Daftar Logbook Mahasiswa Bimbingan</b></h3>
//             <p class="mb-5 d-flex justify-content-between align-items-center">
//                 Berikut merupakan daftar logbook mahasiswa bimbingan
//             </p>
//             <div class="table-container table-logbook">
//                 <table class="table table-bordered">
//                     <thead class="table-header">
//                     <th class="align-middle">No</th>
//                     <th class="align-middle">NIM</th>
//                     <th class="align-middle">Nama Mahasiswa</th>
//                     <th class="align-middle">Jumlah Bimbingan</th>
//                     <th class="align-middle">Bab Terakhir</th>
//                     <th class="align-middle">Logbook</th>
//                     </thead>

//                     <tr class="centered-column">
//                         <td>1</td>
//                         <td>A11.2021.13472</td>
//                         <td>Yoga Adi Pratama</td>
//                         <td>3</td>
//                         <td>2</td>
//                         <td>
//                             <a href="#" data-bs-toggle="modal" data-bs-target="#dialogDetailLogbook">Dokumen</a>
//                         </td>
//                     </tr>
//                 </table>
//             </div>

            // {{-- {{ $logbook->links() }} --}}

{{-- @endsection --}}



{{-- @extends('dosen.layouts.main')
// @section('title', 'Daftar Bimbingan Kerja Praktek')
// @section('content')
// <div class="container">
//     <h4 class="mb-4">Daftar Logbook Mahasiswa Kerja Praktek</h4>

//     <p class="mb-2 d-flex justify-content-between align-items-center">
//         Berikut merupakan daftar Logbook bimbingan mahasiswa
//     </p>
//     <div class="table-container table-logbook">
//         <table class="table table-bordered">
//             <thead class="table-header">
//                 <th class="align-middle">No.</th>
//                 <th class="align-middle">Tanggal</th>
//                 <th class="align-middle">NIM</th>
//                 <th class="align-middle">Nama Mahasiswa</th>
//                 <th class="align-middle">Uraian Bimbingan</th>
//                 <th class="align-middle">Bab Terakhir</th>
//                 <th class="align-middle">Dokumen</th>
//                 <th class="align-middle">Status</th>
//             </thead>
//             </thead>
//             <tr>
//                 <td class="centered-column">1</td>
//                 <td class="centered-column">2024-05-23</td>
//                 <td class="centered-column">A11.2021.13489</td>
//                 <td class="centered-column">Surinanda</td>
//                 <td class="centered-column">cape bat anying</td>
//                 <td class="centered-column">Bab 1</td>
//                 <td class="centered-column"><a href="https://drive.google.com/drive/folders/1NSgwE4CEOqnPBZrfcoIu7wSFYuvvCu-O?usp=drive_link" target="_blank">Dokumen</a></td>
//                 <td class="centered-column">
//                     <button type="info" class="btn btn-success"><i class="fas fa-check-circle"></i></button>
//                     <button type="info" class="btn btn-danger"><i class="fas fa-times-circle"></i></button>
//                 </td>
//             </tr>
//         </table>
//     </div>
//     <nav aria-label="pageNavigationLogbook">
//         <ul class="pagination justify-content-end">
//             <li class="page-item disabled">
//                 <a class="page-link" href="#" tabindex="-1">Previous</a>
//             </li>
//             <li class="page-item"><a class="page-link active" href="#">1</a></li>
//             <li class="page-item"><a class="page-link" href="#">2</a></li>
//             <li class="page-item"><a class="page-link" href="#">3</a></li>
//             <li class="page-item">
//                 <a class="page-link" href="#">Next</a>
//             </li>
//         </ul>
//     </nav>
//     <!--
//     <button type="submit" class="btn btn-primary"><i class="fas fa-chevron-right"></i>Pengajuan Sidang</button>
//     -->
// </div>

// <!--Dialog Detail Logbook-->
// @include('dosen.logbook_bimbingan.detail_logbook')
// @endsection --}} 