@foreach($dosens as $dosen)
    <!-- Modal Detail Dosen -->
    <div class="modal fade" id="dialogDetailDataDosen_{{ $dosen->id }}" tabindex="-1" aria-labelledby="dialogDetailDataDosen_{{ $dosen->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dialogDetailDataDosen_{{ $dosen->id }}Label">Detail Dosen Pembimbing: {{ $dosen->dosen->nama }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-header">
                            <tr>
                                <th class="align-middle">No.</th>
                                <th class="align-middle">NIM</th>
                                <th class="align-middle">Nama Mahasiswa</th>
                                {{-- <th class="align-middle">Bab Terakhir</th>
                                <th class="align-middle">Jumlah Bimbingan</th> --}}
                                <th class="align-middle">Status KP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dosen->dosen->mahasiswa as $index => $mahasiswa)
                            <tr>
                                <td class="centered-column">{{ $index + 1 }}</td>
                                <td class="centered-column">{{ $mahasiswa->nim }}</td>
                                <td class="centered-column">{{ $mahasiswa->nama }}</td>
                                <td class="centered-column">{{ $mahasiswa->status_kp }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada mahasiswa yang terdaftar</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dialogTambahDataMhs_{{ $dosen->id }}">
                        <i class="fas fa-plus"></i>Tambah Data Mahasiswa
                    </a>
                </div>
                <!-- Pagination, if needed -->
                {{-- <nav aria-label="pageNavigationLogbook">
                    <ul class="pagination custom-left-shift">
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
                </nav> --}}
            </div>
        </div>
    </div>
<!-- Include the modal for adding mahasiswa -->
@include('koor.data_dosen.tambah_data_mhs')
@endforeach
