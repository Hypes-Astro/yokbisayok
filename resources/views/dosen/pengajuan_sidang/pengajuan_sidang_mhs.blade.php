@extends('dosen.layouts.main')
@section('title', 'Daftar Pengajuan Sidang')
@section('content')
<div class="wrapper d-flex flex-column min-vh-100">
    <div class="container flex-grow-1">
        <h3 class="mb-3"><b>Daftar Pengajuan Sidang Mahasiswa</b></h3>
        <p class="mb-2">Berikut ini adalah daftar pengajuan Sidang Mahasiswa Kerja Praktek</p>
        <div class="input-group justify-content-end mb-3">
            <input class="form-control" type="text" placeholder="Search here..." aria-label="Search for..."
                   aria-describedby="btnNavbarSearch" />
            <button class="btn" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
        <div class="table-container table-dosbing">
            <table class="table table-bordered mb-1">
                <thead class="table-header">
                    <tr>
                        <th class="align-middle">No</th>
                        <th class="align-middle">NIM</th>
                        <th class="align-middle">Nama</th>
                        <th class="align-middle">File</th>
                        <th class="align-middle">Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($pengajuan_sidangs as $ps)
                    <tr class="centered-column">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ps->mahasiswa->mahasiswa->nim }}</td>
                        <td>{{ $ps->mahasiswa->mahasiswa->nama }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $ps->id }}">
                                Lihat Detail
                            </button>
                        </td>
                        <td>
                            <button class="btn 
                                @if($ps->statusPengajuan == 'ACC') btn-success
                                @elseif($ps->statusPengajuan == 'TOLAK') btn-danger
                                @elseif($ps->statusPengajuan == 'PROSES') btn-warning
                                @endif">
                                {{ ucfirst($ps->statusPengajuan) }}
                            </button>
                        </td>
                        {{-- <td class="centered-column">
                            @if ($ps->statusPengajuan == 'ACC')
                                <button class="btn btn-success">Status Diterima</button>
                            @elseif ($ps->statusPengajuan == 'TOLAK')
                                <button class="btn btn-danger">Status Ditolak</button>
                            @else
                            <div class="btn-group">
                                <form action="{{ route('updateACCSidang', $ps->id) }}" method="post">
                                    @csrf
                                    <button type="submit" name="status" class="btn btn-success me-2" value="ACC">
                                        <i class="fa-regular fa-circle-check"></i> ACC
                                    </button>
                                </form>
                                <form action="{{ route('updateACCSidang', $ps->id) }}" method="post">
                                    @csrf
                                    <button type="submit" name="status" class="btn btn-danger" value="TOLAK">
                                        <i class="fa-regular fa-circle-xmark"></i> TOLAK
                                    </button>
                                </form>
                            </div>                            
                            @endif
                        </td> --}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <nav aria-label="pageNavigationPengajuanSidang">
            <ul class="pagination justify-content-end">
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
        </nav>
    </div>
</div>

<!-- Modal Detail Pengajuan Sidang -->
@foreach($pengajuan_sidangs as $ps)
<div class="modal fade" id="detailModal{{ $ps->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $ps->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="detailModalLabel{{ $ps->id }}">Detail Pengajuan Sidang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Judul:</strong> {{ $ps->judul }}</p>
                <p><strong>Bidang Kajian:</strong> {{ $ps->bidang_kajian }}</p>
                <p><strong>Dokumen Logbook:</strong> <a href="{{ $ps->dokumen }}" target="_blank">Lihat Dokumen</a></p>
                <p><strong>Dokumen Validasi Dosen:</strong> <a href="{{ $ps->validasi }}" target="_blank">Lihat Dokumen</a></p>
                <p><strong>Nilai Penyelia:</strong> {{ $ps->nilaiPenyelia }}</p>
                <p><strong>Nilai Pembimbing:</strong> <input type="text" id="nilaiPembimbing{{ $ps->id }}" class="form-control w-25 d-inline" value="{{ $ps->nilaiPembimbing ?? '' }}"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update-btn" data-pengajuan-id="{{ $ps->id }}">Simpan Nilai Pembimbing</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Pesan Sukses -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="successModalLabel">Berhasil</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <p>Nilai pembimbing berhasil diperbarui.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk menampilkan modal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.update-btn').on('click', function() {
            var $this = $(this);
            var pengajuanId = $this.data('pengajuan-id');
            var nilaiPembimbing = $('#nilaiPembimbing' + pengajuanId).val();

            $this.prop('disabled', true);

            $.ajax({
                url: '{{ route('updatePengajuanSidang', '') }}/' + pengajuanId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    nilaiPembimbing: nilaiPembimbing
                },
                success: function(response) {
                    $('#successModal').modal('show');
                    $('#detailModal' + pengajuanId).modal('hide');
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                },
                complete: function() {
                    $this.prop('disabled', false);
                }
            });
        });
    });
</script>
@endsection
