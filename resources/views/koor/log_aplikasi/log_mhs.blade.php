@extends('koor.layouts.main')
@section('title', 'Log Mahasiswa')
@section('content')

    <div class="wrapper d-flex flex-column min-vh-100">
        <div class="container flex-grow-1">
            <h4 class="mb-4">Log Mahasiswa</h4>
            <p class="mb-5">Berikut log aktivitas Mahasiswa</p>
            <div class="table-container table-admin">
                <table class="table table-bordered mb-1" id="table-log">
                    <thead class="table-header">
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Nama Mahasiswa</th>
                        <th>Aktivitas</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $act)
                        <tr>
                            <td class="centered-column">{{ $loop->iteration }}</td>
                            <td class="centered-column">{{ $act->created_at }}</td>
                            <td>{{ $act->causer->mahasiswa->nama }}</td>
                            <td class="centered-column">{{ $act->description }}</td>
                        </tr>
                    @endforeach
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
@endsection