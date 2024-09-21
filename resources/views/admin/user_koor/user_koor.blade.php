@extends('admin.layouts.main')
@section('title', 'User Dosen')
@section('content')
<div class="container">
    <h4 class="mb-4">Daftar User Koor</h4>

    <form action="" method="GET" class="d-flex justify-content-end mb-4">
        <div class="input-group" style="max-width: 300px;">
            <input type="text" name="query" class="form-control" placeholder="Cari username">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    <div class="table-container table-logbook">
        <table class="table table-bordered">
            <thead class="table-header">
                <th class="align-middle">No.</th>
                <th class="align-middle">Username</th>
                <th class="align-middle">Password</th>
                <th class="align-middle">Aksi</th>
                
            </thead>
            </thead>
            <tr>
                <td class="centered-column">1</td>
                <td class="centered-column">koor@.dinus.ac.id</td>
                <td class="centered-column">.................</td>
                <td class="centered-column">
                    <button type="button" class="btn btn-info btn-sm">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                </td>
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
</div>

<!--Dialog Tambah Logbook-->
{{-- @include('admin.user.detail_bimbingan') --}}

@endsection