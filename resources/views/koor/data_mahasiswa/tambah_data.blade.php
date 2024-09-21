<div class="modal fade" id="dialogTambah" tabindex="-1" aria-labelledby="dialogTambah" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogTambah">Tambah Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <blockquote class="blockquote-primary">
                        <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
                    </blockquote>
                    <form method="POST" action="{{ route('simpanMhs') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-3">
                            <label for="inputNIM" class="col-sm-2 col-form-label">NIM <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="inputNIM" value="{{ old('nim') }}">
                                @error('nim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputNama" class="col-sm-2 col-form-label">Nama <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="inputNama" value="{{ old('nama') }}">
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group row mb-3">
                            <label for="inputIPK" class="col-sm-2 col-form-label">IPK <span
                                    class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" name="ipk" class="form-control" id="inputIPK">
                            </div>
                        </div> --}}
                        {{-- <div class="form-group row mb-3">
                            <label for="inputTranskrip" class="col-sm-2 col-form-label">Transkrip Nilai <span
                                    class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="transkrip_nilai" class="form-control" id="inputTranskrip" />
                            </div>
                        </div> --}}
                        {{-- <div class="form-group row mb-3">
                            <label for="inputTelp" class="col-sm-2 col-form-label">Telp Mhs <span
                                    class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="tel" name="telp_mhs" class="form-control" id="inputTelp">
                            </div>
                        </div> --}}
                        <div class="form-group row mb-3">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputStatusKP" class="col-sm-2 col-form-label">Status KP <span
                                    class="required">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-select @error('status_kp') is-invalid @enderror" name="status_kp" id="inputStatusKP" aria-label="Status KP">
                                    <option disabled selected hidden>Pilih Status Kerja Praktek</option>
                                    <option value="BARU" {{ old('status_kp') === 'BARU' ? 'selected' : '' }}>BARU</option>
                                    <option value="ULANG" {{ old('status_kp') === 'ULANG' ? 'selected' : '' }}>ULANG</option>
                                </select>
                                @error('status_kp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group row mb-3">
                            <label for="inputDoswal" class="col-sm-2 col-form-label">Dosen Wali <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('dosen_wali') is-invalid @enderror" name="dosen_wali" id="inputDoswal" value="{{ old('dosen_wali') }}">
                                @error('dosen_wali')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
