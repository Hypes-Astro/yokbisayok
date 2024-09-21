@foreach($mahasiswas as $mahasiswa)
    <div class="modal fade" id="dialogDetailDataMahasiswa_{{ $mahasiswa->id }}" tabindex="-1" aria-labelledby="dialogDetailDataMahasiswa_{{ $mahasiswa->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dialogDetailDataMahasiswa_{{ $mahasiswa->id }}Label">Data Dosbing Dari Mahasiswa: {{ $mahasiswa->nama }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-header">
                            <tr>
                                <th class="align-middle">No.</th>
                                <th class="align-middle">NPP</th>
                                <th class="align-middle">Dosen Pembimbing</th>
                                <th class="align-middle">Email</th>
                                <th class="align-middle">Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($mahasiswa->statusMahasiswa && $mahasiswa->statusMahasiswa->dospem)
                                <tr>
                                    <td class="centered-column">1</td>
                                    <td class="centered-column">{{ $mahasiswa->statusMahasiswa->dospem->npp }}</td>
                                    <td class="centered-column">{{ $mahasiswa->statusMahasiswa->dospem->nama }}</td>
                                    <td class="centered-column">{{ $mahasiswa->statusMahasiswa->dospem->email }}</td>
                                    <td class="centered-column">{{ $mahasiswa->statusMahasiswa->dospem->telp }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada dosen pembimbing untuk mahasiswa ini.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach
