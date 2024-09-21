<div class="modal fade" id="dialogTambah" tabindex="-1" aria-labelledby="dialogTambah" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dialogTambah">Tambah Data Dosbing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <blockquote class="blockquote-primary">
                        <p class="mb-3">Form dengan tanda asterik (<span class="required">*</span>) wajib diisi.</p>
                    </blockquote>
                    <form action="{{ route('simpanDosen') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="id_dsn" value="{{ $dosen->id }}"> <!-- Sesuaikan dengan apa yang Anda butuhkan --> --}}
                        <div class="form-group row mb-3">
                            <label for="inputNPP" class="col-sm-2 col-form-label">NPP <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('npp') is-invalid @enderror" name="npp" id="inputNPP" value="{{ old('npp') }}">
                                @error('npp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputNama" class="col-sm-2 col-form-label">Nama Dosbing <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="inputNama" value="{{ old('nama') }}">
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputBidangKajian" class="col-sm-2 col-form-label">Bidang Kajian <span class="required">*</span></label>
                            <div class="col-sm-4">
                                <select class="form-select @error('bidang_kajian') is-invalid @enderror" name="bidang_kajian" id="inputBidangKajian" aria-label="Bidang Kajian">
                                    <option disabled selected hidden>Pilih Bidang Kajian</option>
                                    <option value="SC" {{ old('bidang_kajian') === 'SC' ? 'selected' : '' }}>SC</option>
                                    <option value="RPLD" {{ old('bidang_kajian') === 'RPLD' ? 'selected' : '' }}>RPLD</option>
                                </select>
                                @error('bidang_kajian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputKuota" class="col-sm-2 col-form-label">Kuota Mhs Kerja Praktek (Baru) <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('kuota') is-invalid @enderror" name="kuota" id="inputKuota" value="{{ old('kuota') }}">
                                @error('kuota')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group row mb-3">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email Dosen<span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="form-group row mb-3">
                            <label for="inputTelp" class="col-sm-2 col-form-label">Telepon Dosen<span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control @error('telp') is-invalid @enderror" name="telp" id="inputTelp" value="{{ old('telp') }}">
                                @error('telp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
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
