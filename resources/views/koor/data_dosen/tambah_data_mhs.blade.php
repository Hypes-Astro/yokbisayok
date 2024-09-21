<div class="modal fade" id="dialogTambahDataMhs_{{ $dosen->id }}" tabindex="-1" aria-labelledby="dialogTambahDataMhs_{{ $dosen->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogTambahDataMhs_{{ $dosen->id }}Label">Tambah Data Mahasiswa untuk Dosen {{ $dosen->dosen->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form method="POST" action="{{ route('simpanMhsKeDosen') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Pastikan id_dsn dikirim dengan benar -->
                        <input type="hidden" name="id_dsn" value="{{ $dosen->id_dsn }}">

                        @for($i = 1; $i <= 5; $i++)
                        <div class="form-group row mb-3">
                            <label for="mahasiswa{{ $i }}" class="col-sm-2 col-form-label">Pilih Mahasiswa {{ $i }}</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="mahasiswa_id[]" id="mahasiswa">
                                    <option value="">Pilih Mahasiswa</option>
                                    @foreach($mahasiswas as $mahasiswa)
                                        <option value="{{ $mahasiswa->id }}">
                                            {{ $mahasiswa->nim }} - {{ $mahasiswa->nama }} (Status: {{ $mahasiswa->status_kp }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endfor

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
