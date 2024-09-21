@foreach($mahasiswas as $mahasiswa)
    <div class="modal fade" id="dialogHapusMhs_{{ $mahasiswa->id }}" tabindex="-1" aria-labelledby="dialogHapusMhs_{{ $mahasiswa->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dialogHapusMhs_{{ $mahasiswa->id }}">Hapus Data Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin untuk menghapus data mahasiswa ini?
                </div>
                <form method="POST" action="{{ route('hapusMhs', ['id' => $mahasiswa->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach