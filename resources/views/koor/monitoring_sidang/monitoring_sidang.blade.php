@extends('koor.layouts.main')
@section('title', 'Monitoring Sidang Kerja Praktek')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Monitoring Sidang Kerja Praktek</h1>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="sidang-kp" role="tabpanel">
                <div class="table-responsive">
                    <table id="monitoringTableKP" class="table table-bordered table-striped">
                        <thead class="table-header">
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul Laporan KP</th>
                                <th>Dokumen</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($sidangKP1->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data Sidang KP</td>
                                </tr>
                            @else
                                @foreach($sidangKP1 as $index => $sidang)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $sidang->mahasiswa->mahasiswa->nim }}</td>
                                        <td>{{ $sidang->mahasiswa->mahasiswa->nama }}</td>
                                        <td style="word-wrap: break-word; white-space: normal;">
                                            {{ $sidang->judul }}
                                        </td>
                                        <td>
                                            <ul class="list-unstyled">
                                                <li class="text-start"><a href="{{ $sidang->dokumen }}" target="_blank">Dokumen Tugas Akhir</a></li>
                                                <li class="text-start"><a href="{{ $sidang->validasi }}" target="_blank">Lembar Persetujuan</a></li>
                                            </ul>
                                        </td>
                                        <td>{{ $sidang->statusPengajuan }}</td>
                                        <td>
                                            <form action="{{ route('koor-monitoring-sidang-update') }}" method="POST"
                                                  id="form{{ $sidang->mahasiswa->id }}">
                                                @csrf
                                                <input type="hidden" name="id_mhs" value="{{ $sidang->mahasiswa->id }}">
                                                <input type="radio" name="aksi" value="ACC"
                                                       id="acc{{ $sidang->mahasiswa->id }}"
                                                       onchange="submitForm('{{ $sidang->mahasiswa->id }}');" {{ $sidang->statusPengajuan == 'ACC' ? 'checked' : '' }}>
                                                <label for="acc{{ $sidang->mahasiswa->id }}">ACC</label>
                                                <input type="radio" name="aksi" value="TOLAK"
                                                       id="tolak{{ $sidang->mahasiswa->id }}"
                                                       onchange="submitForm('{{ $sidang->mahasiswa->id }}');" {{ $sidang->statusPengajuan == 'TOLAK' ? 'checked' : '' }}>
                                                <label for="tolak{{ $sidang->mahasiswa->id }}">REVISI</label>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#monitoringTableKP').DataTable();
        });

        function submitForm(id) {
            $.ajax({
                url: document.getElementById('form' + id).action,
                method: 'POST',
                data: $('#form' + id).serialize(),
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Terjadi kesalahan saat menghubungi server: ' + error,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            });
        }
    </script>
@endsection
