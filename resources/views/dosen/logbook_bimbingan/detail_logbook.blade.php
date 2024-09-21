<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<div class="modal fade" id="dialogDetailLogbook" tabindex="-1" aria-labelledby="dialogDetailLogbookLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogDetailLogbookLabel">History Logbook</h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h4 class="mb-4">Logbook Bimbingan</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-5">
                            <thead class="table-header">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Bab</th>
                                <th>Uraian Bimbingan</th>
                                <th>Dokumen</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody id="mahasiswaLogbookList">
                            
                            </tbody>
                            {{-- <tbody>
                                @foreach($logbooks as $key => $logbook)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $logbook->tanggal }}</td>
                                        <td>{{ $logbook->bab }}</td>
                                        <td>{{ $logbook->uraian }}</td>
                                        <td>{{ $logbook->dokumen }}</td>
                                        <td>
                                            <button type="submit" name="status" class="btn btn-success" value="ACC">
                                                <i class="fa-regular fa-circle-check"></i> ACC
                                            </button>
                                            <button type="submit" name="status "class="btn btn-danger delete-button" value="TOLAK">
                                                <i class="fa-regular fa-circle-xmark"></i> TOLAK
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody> --}}
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>