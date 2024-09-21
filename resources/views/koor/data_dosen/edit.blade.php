@foreach($dosens as $dosen)
    <div class="modal fade" id="dialogEditDosen_{{ $dosen->id }}" tabindex="-1" aria-labelledby="dialogEditDosenLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dialogEditDosenLabel">Edit Data Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('updateDosen', ['id' => $dosen->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id_dsn" value="{{ $dosen->id }}">
                        <div class="form-group row mb-3">
                            <label for="inputNPP_{{ $dosen->id }}" class="col-sm-2 col-form-label">NPP <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('npp') is-invalid @enderror" name="npp" id="inputNPP_{{ $dosen->id }}" value="{{ old('npp') ? old('npp') : $dosen->dosen->npp }}">
                                @error('npp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputNama_{{ $dosen->id }}" class="col-sm-2 col-form-label">Nama Dosbing <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="inputNama_{{ $dosen->id }}" value="{{ old('nama') ? old('nama') : $dosen->dosen->nama }}">
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputBidangKajian_{{ $dosen->id }}" class="col-sm-2 col-form-label">Bidang Kajian <span class="required">*</span></label>
                            <div class="col-sm-4">
                                <select class="form-select @error('bidang_kajian') is-invalid @enderror" name="bidang_kajian" id="inputBidangKajian_{{ $dosen->id }}">
                                    <option value="RPLD" {{ (old('bidang_kajian') == 'RPLD' || $dosen->dosen->bidang_kajian == 'RPLD') ? 'selected' : '' }}>RPLD</option>
                                    <option value="SC" {{ (old('bidang_kajian') == 'SC' || $dosen->dosen->bidang_kajian == 'SC') ? 'selected' : '' }}>SC</option>
                                </select>
                                @error('bidang_kajian')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group row mb-3">
                            <label for="inputKuota_{{ $dosen->id }}" class="col-sm-2 col-form-label">Kuota Mhs TA (Baru) <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('kuota') is-invalid @enderror" name="kuota" id="inputKuota_{{ $dosen->id }}" value="{{ old('kuota') ? old('kuota') : $dosen->kuota }}">
                                @error('kuota')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="form-group row mb-3">
                            <label for="inputEmail_{{ $dosen->id }}" class="col-sm-2 col-form-label">Email Dosen<span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="inputEmail_{{ $dosen->id }}" value="{{ old('email') ? old('email') : $dosen->dosen->email }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputTelp_{{ $dosen->id }}" class="col-sm-2 col-form-label">Telepon Dosen<span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control @error('telp') is-invalid @enderror" name="telp" id="inputTelp_{{ $dosen->id }}" value="{{ old('telp') ? old('telp') : $dosen->dosen->telp }}">
                                @error('telp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach