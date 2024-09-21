{{-- @extends('mahasiswa.layouts.main')
@section('title', 'Form Mahasiswa')
@section('content')
<div class="container">
    <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-dosbing" class="nav-link rounded-pill">
                <i class="fas fa-chalkboard-teacher"></i>
                Dosen Pembimbing
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link rounded-pill">
                <i class="fas fa-edit"></i>
                Form Pengajuan
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-draft" class="nav-link active rounded-pill">
                <i class="fas fa-book-open"></i>
                Draft Pengajuan
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="nav-tab-draft" class="tab-pane fade show active">
            <div class="container">
                <h4 class="mb-4">Pengajuan Kerja Praktek Ke-1</h4>
                
                @if ($data)
                    @if ($pengajuan && $pengajuan->status == 'DRAFT')
                        <blockquote class="blockquote-primary">
                            <p class="mb-3"><b>Status: Draft</b> - Untuk mengajukan Kerja Praktek ke dosen pembimbing, klik tombol Ajukan di bawah</p>
                        </blockquote>
                    @elseif ($pengajuan && $pengajuan->status == 'PENDING')
                        <blockquote class="blockquote-pengajuan">
                            <p class="mb-3"><b>Status: Pengajuan</b> - Proposal telah diajukan pada tanggal [{{ $pengajuan->created_at }} WIB] </p>
                        </blockquote>
                    @else
                        <blockquote class="blockquote-primary">
                            <p class="mb-3"><b>Status: Disetujui</b> - Untuk tahap selanjutnya, silahkan melakukan bimbingan dengan dosen pembimbing dengan melakukan pengisian logbook bimbingan </p>
                        </blockquote>
                    @endif

                    <table class="table table-bordered mb-5">
                        <tbody>
                        <tr>
                            <td>Judul</td>
                            <td>{{ $data['judul'] }}</td>
                        </tr>
                        <tr>
                            <td>Nama Perusahaan</td>
                            <td>{{ $data['perusahaan'] }}</td>
                        </tr>
                        <tr>
                            <td>Jobdesk</td>
                            <td>{{ $data['posisi'] }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td>{{ $data['tanggal_mulai'] }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>{{ $data['tanggal_selesai'] }}</td>
                        </tr>
                        <tr>
                            <td>Usulan Dosen Pembimbing</td>
                            <td>{{ $dospil->nama }}</td>
                        </tr>
                        </tbody>
                    </table>
                @else
                    @if ($pengajuan && $pengajuan->status == 'PENDING')
                        <blockquote class="blockquote-pengajuan">
                            <p class="mb-3"><b>Status: Pengajuan</b> - Proposal telah diajukan pada tanggal [{{ $pengajuan->created_at }} WIB] </p>
                        </blockquote>
                    @else
                        <blockquote class="blockquote-primary">
                            <p class="mb-3"><b>Status: Disetujui</b> - Untuk tahap selanjutnya, silahkan melakukan bimbingan dengan dosen pembimbing dengan melakukan pengisian logbook bimbingan </p>
                        </blockquote>
                    @endif

                    <table class="table table-bordered mb-5">
                        <tbody>
                        <tr>
                            <td>Judul</td>
                            <td>{{ $pengajuan->judul }}</td>
                        </tr>
                        <tr>
                            <td>Nama Perusahaan</td>
                            <td>{{ $pengajuan->perusahaan }}</td>
                        </tr>
                        <tr>
                            <td>Jobdesk</td>
                            <td>{{ $pengajuan->posisi }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td>{{ $pengajuan->tanggal_mulai }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>{{ $pengajuan->tanggal_selesai }}</td>
                        </tr>
                        <tr>
                            <td>Usulan Dosen Pembimbing</td>
                            <td>{{ $dospil->nama }}</td>
                        </tr>
                        </tbody>
                    </table>
                @endif

                @if (count($history) > 0)
                    <p class="mb-2">Histori Penolakan Pengajuan Kerja Praktek</p>
                    <div class="table-container table-tolak">
                        <table class="table table-bordered">
                            <thead class="table-header">
                            <th>Tanggal Pengajuan</th>
                            <th>Dosen Ajuan</th>
                            <th>Alasan</th>
                            </thead>
                            @foreach ($history as $hs)
                                <tr>
                                    <td class="centered-column">{{ $hs->created_at }}</td>
                                    <td class="centered-column">{{ $hs->dosen->nama }}</td>
                                    <td class="centered-column">{{ $hs->alasan }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endif

                @if ($data)
                    <div class="form-group row mb-3 justify-content-end"></div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('pengajuan-mahasiswa') }}" class="btn btn-danger me-2">Hapus</a>
                        <form action="{{ route('form-pengajuan-mahasiswa') }}" method="GET">
                            @csrf
                            <input type="hidden" name="judul" value="{{ $data['judul'] }}">
                            <input type="hidden" name="perusahaan" value="{{ $data['perusahaan'] }}">
                            <input type="hidden" name="posisi" value="{{ $data['posisi'] }}">
                            <input type="hidden" name="tanggal_mulai" value="{{ $data['tanggal_mulai'] }}">
                            <input type="hidden" name="tanggal_selesai" value="{{ $data['tanggal_selesai'] }}">
                            <input type="hidden" name="id_dsn" value="{{ $data['id_dospem'] }}">
                            <button type="submit" class="btn btn-warning me-2">Edit</button>
                        </form>                        
                        <form action="{{ route('mahasiswa-pengajuan-submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="judul" value="{{ $data['judul'] }}">
                            <input type="hidden" name="perusahaan" value="{{ $data['perusahaan'] }}">
                            <input type="hidden" name="posisi" value="{{ $data['posisi'] }}">
                            <input type="hidden" name="tanggal_mulai" value="{{ $data['tanggal_mulai'] }}">
                            <input type="hidden" name="tanggal_selesai" value="{{ $data['tanggal_selesai'] }}">
                            <input type="hidden" name="id_dsn" value="{{ $data['id_dospem'] }}">
                            <button type="submit" class="btn btn-primary me-2">Ajukan</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection --}}







@extends('mahasiswa.layouts.main')
@section('title', 'Draft Pengajuan')
@section('content')
<div class="container">
    <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-dosbing" class="nav-link rounded-pill">
                <i class="fas fa-chalkboard-teacher"></i>
                Dosen Pembimbing
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link rounded-pill">
                <i class="fas fa-edit"></i>
                Form Pengajuan
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-draft" class="nav-link active rounded-pill">
                <i class="fas fa-book-open"></i>
                Draft Pengajuan
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="nav-tab-draft" class="tab-pane fade show active">
            <div class="container">
                <h4 class="mb-4">Pengajuan Kerja Praktek Ke-1</h4>
                
                @if ($data)
                    @if ($pengajuan && $pengajuan->status == 'DRAFT')
                        <blockquote class="blockquote-primary">
                            <p class="mb-3"><b>Status: Draft</b> - Untuk mengajukan Kerja Praktek ke dosen pembimbing, klik tombol Ajukan di bawah</p>
                        </blockquote>
                    @elseif ($pengajuan && $pengajuan->status == 'PENDING')
                        @if ($status->id_dsn != 0)
                            <blockquote class="blockquote-primary">
                                <p class="mb-3"><b>Status: Disetujui</b> - Untuk tahap selanjutnya, silahkan melakukan bimbingan dengan dosen pembimbing dengan melakukan pengisian logbook bimbingan </p>
                            </blockquote>
                        @else 
                            <blockquote class="blockquote-pengajuan">
                                <p class="mb-3"><b>Status: Pengajuan</b> - Proposal telah diajukan pada tanggal [{{ $pengajuan->created_at }} WIB] </p>
                            </blockquote>
                        @endif
                    @else
                        @if (!$pengajuan && $status->id_dsn != 0)  
                            <blockquote class="blockquote-primary">
                                <p class="mb-3"><b>Status: Disetujui</b> - Silahkan Lengkapi Pengajuan Dengan Klik Edit </p>
                            </blockquote>
                        @elseif (!$pengajuan)
                            <blockquote class="blockquote-primary">
                                <p class="mb-3"><b>Status: Draft</b> - Untuk mengajukan Kerja Praktek ke dosen pembimbing, klik tombol Ajukan di bawah</p>
                            </blockquote>
                        @else
                            <blockquote class="blockquote-primary">
                                <p class="mb-3"><b>Status: Disetujui</b> - Untuk tahap selanjutnya, silahkan melakukan bimbingan dengan dosen pembimbing dengan melakukan pengisian logbook bimbingan </p>
                            </blockquote>
                        @endif
                    @endif

                    <table class="table table-bordered mb-5">
                        <tbody>
                        <tr>
                            <td>Judul</td>
                            <td>{{ $data['judul'] ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td>Nama Perusahaan</td>
                            <td>{{ $data['perusahaan'] ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td>Jobdesk</td>
                            <td>{{ $data['posisi'] ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td>{{ $data['tanggal_mulai'] ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>{{ $data['tanggal_selesai'] ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td>Dosen Pembimbing</td>
                            <td>{{ $dospil->nama }}</td>
                        </tr>
                        </tbody>
                    </table>
                @else
                    @if ($pengajuan && $pengajuan->status == 'PENDING')
                        <blockquote class="blockquote-pengajuan">
                            <p class="mb-3"><b>Status: Pengajuan</b> - Proposal telah diajukan pada tanggal [{{ $pengajuan->created_at }} WIB] </p>
                        </blockquote>
                    @else
                        <blockquote class="blockquote-primary">
                            <p class="mb-3"><b>Status: Disetujui</b> - Untuk tahap selanjutnya, silahkan melakukan bimbingan dengan dosen pembimbing dengan melakukan pengisian logbook bimbingan </p>
                        </blockquote>
                    @endif

                    <table class="table table-bordered mb-5">
                        <tbody>
                        <tr>
                            <td>Judul</td>
                            <td>{{ $pengajuan->judul ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td>Nama Perusahaan</td>
                            <td>{{ $pengajuan->perusahaan ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td>Jobdesk</td>
                            <td>{{ $pengajuan->posisi ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td>{{ $pengajuan->tanggal_mulai ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td>{{ $pengajuan->tanggal_selesai ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td>Dosen Pembimbing</td>
                            <td>{{ $dospil->nama }}</td>
                        </tr>
                        </tbody>
                    </table>
                @endif

                @if (count($history) > 0)
                    <p class="mb-2">Histori Penolakan Pengajuan Kerja Praktek</p>
                    <div class="table-container table-tolak">
                        <table class="table table-bordered">
                            <thead class="table-header">
                            <th>Tanggal Pengajuan</th>
                            <th>Dosen Ajuan</th>
                            <th>Alasan</th>
                            </thead>
                            @foreach ($history as $hs)
                                <tr>
                                    <td class="centered-column">{{ $hs->created_at }}</td>
                                    <td class="centered-column">{{ $hs->dosen->nama }}</td>
                                    <td class="centered-column">{{ $hs->alasan }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endif

                <div class="form-group row mb-3 justify-content-end"></div>
                <div class="d-flex justify-content-end">
                    @if ($data)
                        @if (!$pengajuan) 
                            @if ($checkDosen)
                                <a href="{{ route('pengajuan-mahasiswa') }}" class="btn btn-danger me-2">Hapus</a>
                            @endif
                            <form action="{{ route('form-pengajuan-mahasiswa') }}" method="GET">
                                @csrf
                                <input type="hidden" name="judul" value="{{ $data['judul'] }}">
                                <input type="hidden" name="perusahaan" value="{{ $data['perusahaan'] }}">
                                <input type="hidden" name="posisi" value="{{ $data['posisi'] }}">
                                <input type="hidden" name="tanggal_mulai" value="{{ $data['tanggal_mulai'] }}">
                                <input type="hidden" name="tanggal_selesai" value="{{ $data['tanggal_selesai'] }}">
                                <input type="hidden" name="id_dsn" value="{{ $data['id_dospem'] }}">
                                <button type="submit" class="btn btn-warning me-2">Edit</button>
                            </form>
                            @if ($checkDosen)
                                <form action="{{ route('mahasiswa-pengajuan-submit') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="judul" value="{{ $data['judul'] }}">
                                    <input type="hidden" name="perusahaan" value="{{ $data['perusahaan'] }}">
                                    <input type="hidden" name="posisi" value="{{ $data['posisi'] }}">
                                    <input type="hidden" name="tanggal_mulai" value="{{ $data['tanggal_mulai'] }}">
                                    <input type="hidden" name="tanggal_selesai" value="{{ $data['tanggal_selesai'] }}">
                                    <input type="hidden" name="id_dsn" value="{{ $data['id_dospem'] }}">
                                    <button type="submit" class="btn btn-primary me-2">Ajukan</button>
                                </form>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
