@extends('admin.layouts.main')
@section('title', 'Log Dosen Pembimbing')
@section('content')

    <div class="wrapper d-flex flex-column min-vh-100">
        <div class="container flex-grow-1">
            <h4 class="mb-4">Log Dosen Pembimbing</h4>
            <p class="mb-5">Berikut log aktivitas Dosen Pembimbing</p>
            <div class="table-container table-admin">
                <table class="table table-bordered mb-1" id="table-log">
                    <thead class="table-header">
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Nama Dosen</th>
                        <th>Aktivitas</th>
                        <th>Target Log</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="centered-column">1</td>
                        <td class="centered-column">dd-MM-yyyy HH:mm</td>
                        <td>DANANG WAHYU UTOMO, M.Kom</td>
                        <td class="centered-column">Sedang melakukan bimbingan</td>
                        <td class="centered-column">null</td>
                    </tr>
                    <tr>
                        <td class="centered-column">2</td>
                        <td class="centered-column">dd-MM-yyyy HH:mm</td>
                        <td>EGIA ROSI SUBHIYAKTO, M.Kom</td>
                        <td class="centered-column">Sedang melakukan bimbingan</td>
                        <td class="centered-column">null</td>
                    </tr>
                    <tr>
                        <td class="centered-column">3</td>
                        <td class="centered-column">dd-MM-yyyy HH:mm</td>
                        <td>FAHRI FIRDAUSILLAH, S.Kom, M.CS</td>
                        <td class="centered-column">Sedang melakukan bimbingan</td>
                        <td class="centered-column">null</td>
                    </tr>
                    <tr>
                        <td class="centered-column">4</td>
                        <td class="centered-column">dd-MM-yyyy HH:mm</td>
                        <td>JUNTA ZENIARJA, M.Kom</td>
                        <td class="centered-column">Sedang melakukan bimbingan</td>
                        <td class="centered-column">null</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        // Inisialisasi DataTables
        $(document).ready(function () {
            $('#table-log').DataTable();
        });
    </script>

{{--    <script>--}}
{{--        document.addEventListener('DOMContentLoaded', function() {--}}
{{--            var deleteButtons = document.querySelectorAll('.delete-button');--}}
{{--            deleteButtons.forEach(function(button) {--}}
{{--                button.addEventListener('click', function(event) {--}}
{{--                    Swal.fire({--}}
{{--                        title: 'Apakah data ingin dihapus?',--}}
{{--                        text: "Data yang dihapus tidak dapat dikembalikan!",--}}
{{--                        icon: 'warning',--}}
{{--                        showCancelButton: true,--}}
{{--                        confirmButtonColor: '#3085d6',--}}
{{--                        cancelButtonColor: '#d33',--}}
{{--                        confirmButtonText: 'Ya, hapus!',--}}
{{--                        cancelButtonText: 'Batal'--}}
{{--                    }).then((result) => {--}}
{{--                        if (result.isConfirmed) {--}}
{{--                            // Proses penghapusan data di sini--}}
{{--                            Swal.fire(--}}
{{--                                'Deleted!',--}}
{{--                                'Data berhasil dihapus.',--}}
{{--                                'success'--}}
{{--                            );--}}
{{--                        } else if (result.dismiss === Swal.DismissReason.cancel) {--}}
{{--                            // Batalkan penghapusan--}}
{{--                            Swal.fire(--}}
{{--                                'Canceled!',--}}
{{--                                'Data gagal dihapus',--}}
{{--                                'error'--}}
{{--                            );--}}
{{--                        }--}}
{{--                    });--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection