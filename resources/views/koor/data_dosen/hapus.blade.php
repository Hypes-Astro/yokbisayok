@foreach($dosens as $dosen)
    <div class="modal fade" id="dialogHapusDosen_{{ $dosen->id }}" tabindex="-1" aria-labelledby="dialogHapusDosen_{{ $dosen->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dialogHapusDosen_{{ $dosen->id }}">Hapus Data Dosen Pembimbing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin untuk menghapus data dosbing ini?
                </div>
                <form method="POST" action="{{ route('hapusDosen', ['id' => $dosen->id]) }}" enctype="multipart/form-data">
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