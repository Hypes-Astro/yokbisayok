<!-- Modal Tambah Pengumuman -->
<div class="modal fade" id="tambahPengumumanModal" tabindex="-1" role="dialog" aria-labelledby="tambahPengumumanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPengumumanModalLabel">Tambah Pengumuman Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formPengumuman" action="{{ route('koor-pengumuman.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judulPengumuman">Judul Pengumuman</label>
                        <input type="text" class="form-control" name="judul" id="judulPengumuman" required>
                    </div>
                    <div class="form-group">
                        <label for="senderPengumuman">Sender Pengumuman</label>
                        <input type="text" class="form-control" name="sender" id="senderPengumuman" required>
                    </div>
                    <div class="form-group">
                        <label for="isiPengumuman">Isi Pengumuman</label>
                        <textarea class="form-control" name="isi" id="isiPengumuman" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pengumuman</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal View Detail Pengumuman -->
<div class="modal fade" id="detailPengumumanModal" tabindex="-1" aria-labelledby="detailPengumumanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailPengumumanModalLabel">Detail Pengumuman</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead class="table-header">
                        <tr>
                            <th>Judul Pengumuman</th>
                            <th>Isi Pengumuman</th>
                            <th>Sender</th>
                            <th>Tanggal dan Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="judul"></td>
                            <td id="isi"></td>
                            <td class="text-center" id="user"></td>
                            <td class="text-center" id="published_at"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>