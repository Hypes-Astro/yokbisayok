@extends('mahasiswa.layouts.main')
@section('title', 'Draft Pengajuan Sidang KP')
@section('content')
    <div class="container">
        <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
            <li class="nav-item">
                <a data-toggle="pill" class="nav-link rounded-pill">
                    <i class="fas fa-edit"></i>
                    Form Pengajuan
                </a>
            </li>
            <li class="nav-item">
                <a data-toggle="pill" class="nav-link active rounded-pill">
                    <i class="fas fa-book-open"></i>
                    Draft Pengajuan
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="nav-tab-draft" class="tab-pane fade show active">
                <div class="container">
                    @if ($data)
                        <blockquote class="blockquote-primary">
                            <p class="mb-3"><b>Status: Draft</b> - Untuk mengajukan Penilaian Penyelia ke dosen pembimbing, klik tombol Ajukan di bawah</p>
                        </blockquote>
                        <table class="table table-bordered mb-5">
                            <tbody>
                                <tr>
                                    <td>Judul</td>
                                    <td>{{ $data['judul'] }}</td>
                                </tr>
                                <tr>
                                    <td>Bidang Kajian</td>
                                    <td>{{ $data['bidang_kajian'] }}</td>
                                </tr>          
                                <tr>
                                    <td>Dokumen Tugas Akhir</td>
                                    <td>{{ $data['dokumen'] }}</td>
                                </tr>
                                <tr>
                                    <td>Validasi Dosen</td>
                                    <td>{{ $data['validasi'] }}</td>
                                </tr>
                                <tr>
                                    <td>Nilai Penyelia</td>
                                    <td>{{ $data['nilaiPenyelia'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        @if ($sidang && $sidang->status == 'PENDING')
                            <blockquote class="blockquote-pengajuan">
                                <p class="mb-3"><b>Status: Pengajuan</b> - Pengajuan sidang telah diajukan pada tanggal [{{ $sidang->created_at }} WIB]</p>
                            </blockquote>
                        @elseif ($sidang)
                            <blockquote class="blockquote-primary">
                                <p class="mb-3"><b>Status: Disetujui</b> - Untuk tahap selanjutnya, silahkan menunggu informasi dari dosen pembimbing </p>
                            </blockquote>
                        @endif
                        <table class="table table-bordered mb-5">
                            <tbody>
                                <tr>
                                    <td>Judul</td>
                                    <td>{{ $sidang->judul ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Bidang Kajian</td>
                                    <td>{{ $sidang->bidang_kajian ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Dokumen Tugas Akhir</td>
                                    <td>{{ $sidang->dokumen ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Validasi Dosen</td>
                                    <td>{{ $sidang->validasi ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Nilai Penyelia</td>
                                    <td>{{ $sidang->nilaiPenyelia ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
    
                    @if ($data)
                        <div class="form-group row mb-3 justify-content-end"></div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('form_pengajuan') }}" class="btn btn-danger me-2">Hapus</a>
                            <form action="{{ route('form_pengajuan') }}" method="GET">
                                @csrf
                                <input type="hidden" name="judul" value="{{ $data['judul'] }}">
                                <input type="hidden" name="bidang_kajian" value="{{ $data['bidang_kajian'] }}">
                                <input type="hidden" name="dokumen" value="{{ $data['dokumen'] }}">
                                <input type="hidden" name="validasi" value="{{ $data['validasi'] }}">
                                <input type="hidden" name="nilaiPenyelia" value="{{ $data['nilaiPenyelia'] }}">
                                <button type="submit" class="btn btn-warning me-2">Edit</button>
                            </form>
                            <form action="{{ route('submit_sidang') }}" method="POST">
                                @csrf
                                <input type="hidden" name="judul" value="{{ $data['judul'] }}">
                                <input type="hidden" name="bidang_kajian" value="{{ $data['bidang_kajian'] }}">
                                <input type="hidden" name="dokumen" value="{{ $data['dokumen'] }}">
                                <input type="hidden" name="validasi" value="{{ $data['validasi'] }}">
                                <input type="hidden" name="nilaiPenyelia" value="{{ $data['nilaiPenyelia'] }}">
                                <button type="submit" class="btn btn-primary me-2">Ajukan</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection