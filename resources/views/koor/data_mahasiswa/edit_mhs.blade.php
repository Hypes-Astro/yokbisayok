@foreach($mahasiswas as $mahasiswa)
    <div class="modal fade" id="dialogEditMhs_{{ $mahasiswa->id }}" tabindex="-1" aria-labelledby="dialogEditMhsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dialogEditMhsLabel">Edit Data Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="{{ route('updateMhs', ['id' => $mahasiswa->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row mb-3">
                                <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim" value="{{ old('nim') ? old('nim') : $mahasiswa->nim }}">
                                    @error('nim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="nama" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') ? old('nama') : $mahasiswa->nama }}">
                                    @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row mb-3">
                                <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('ipk') is-invalid @enderror" name="ipk" id="ipk" value="{{ old('ipk') ? old('ipk') : $mahasiswa->ipk }}">
                                    @error('ipk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> --}}
                            {{-- <div class="form-group row mb-3">
                                <label for="transkrip_nilai" class="col-sm-2 col-form-label">Transkrip Nilai</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('transkrip_nilai') is-invalid @enderror" name="transkrip_nilai" id="transkrip_nilai" value="{{ old('transkrip_nilai') ? old('transkrip_nilai') : $mahasiswa->transkrip_nilai }}">
                                    @error('transkrip_nilai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> --}}
                            {{-- <div class="form-group row mb-3">
                                <label for="telp_mhs" class="col-sm-2 col-form-label">Telp Mahasiswa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('telp_mhs') is-invalid @enderror" name="telp_mhs" id="telp_mhs" value="{{ old('telp_mhs') ? old('telp_mhs') : $mahasiswa->telp_mhs }}">
                                    @error('telp_mhs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-group row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') ? old('email') : $mahasiswa->email }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="status_kp" class="col-sm-2 col-form-label">Status KP</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('status_kp') is-invalid @enderror" name="status_kp" id="inputStatusKP_{{ $mahasiswa->id }}">
                                        <option value="BARU" {{ (old('status_kp') === 'BARU' || $mahasiswa->status_kp == 'BARU') ? 'selected' : '' }}>BARU</option>
                                        <option value="ULANG" {{ (old('status_kp') === 'ULANG' || $mahasiswa->status_kp == 'ULANG') ? 'selected' : '' }}>ULANG</option>
                                    </select>
                                    @error('status_kp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row mb-3">
                                <label for="dosen_wali" class="col-sm-2 col-form-label">Dosen Wali</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('dosen_wali') is-invalid @enderror" name="dosen_wali" id="dosen_wali" value="{{ old('dosen_wali') ? old('dosen_wali') : $mahasiswa->dosen_wali }}">
                                    @error('dosen_wali')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
