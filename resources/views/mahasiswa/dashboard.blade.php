@extends('mahasiswa.layouts.main')
@section('title', 'Dashboard Mahasiswa')
@section('content')

    <div class="container-dashboard">
        <h1>Welcome,</h1>
        <h1>{{ $mahasiswa->nama }}</h1>
        <p>Siap untuk kerja praktek hari ini?</p>
    </div>

    @if(session('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <main class="container-border">
        @if ($checkNull)
            <div class="container">
                <form action="{{ route('updateDataMhs') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h4 class="text-center">Lengkapi Data Diri</h4>
                    <hr>
                    <div class="form-group row mb-3">
                        <label for="inputTelp" class="col-sm-2 col-form-label">Nomor Telepon <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control @error('telp_mhs') is-invalid @enderror" name="telp_mhs" id="inputTelp" placeholder="Masukkan Nomor Telepon" value="{{ old('telp_mhs') ? old('telp_mhs') : $mahasiswa->telp_mhs }}">
                            @error('telp_mhs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputIPK" class="col-sm-2 col-form-label">IPK <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('ipk') is-invalid @enderror" name="ipk" id="inputIPK" placeholder="Masukkan IPK" value="{{ old('ipk') ? old('ipk') : $mahasiswa->ipk }}">
                            @error('ipk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputTranskrip" class="col-sm-2 col-form-label">Upload Link Transkrip Nilai <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('transkrip_nilai') is-invalid @enderror" name="transkrip_nilai" id="inputTranskrip" placeholder="Masukkan Link Transkrip" value="{{ old('transkrip_nilai') ? old('transkrip_nilai') : $mahasiswa->transkrip_nilai }}">
                            @error('transkrip_nilai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-sm-10 offset-sm-2 text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        @else
            @foreach ($pengumumans as $info)
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-info-circle"></i> {{ $info->judul }}
                    </div>
                    <div class="card-body">
                        <p>{{ $info->isi }}</p>
                        <small>Published by: {{ $info->user }} on {{ \Carbon\Carbon::parse($info->published_at)->format('d M Y, H:i') }}</small>
                    </div>
                </div>
            @endforeach   
            <hr>
            <div class="row">
                @if($status->id_dsn == 0)
                    <div class="alert alert-warning mt-1">
                        Anda belum memiliki dosen pembimbing. Silahkan melakukan pengajuan KP terlebih dahulu.
                    </div>
                    <div class="mb-4">
                        <a href="{{ route('pengajuan-mahasiswa') }}" class="btn btn-primary w-100">
                            <i class="fas fa-angle-right"></i>
                            Pengajuan Dosen Pembimbing
                        </a>
                    </div>
                @else
                    <div class="col-md-8">
                        <h1><i class="far fa-calendar-check"></i> Aktivitas Terbaru</h1>
                        <div class="table-container table-aktivitas">
                            <table class="table table-bordered">
                                <thead class="table-header">
                                    <tr>
                                        <th class="align-middle">No.</th>
                                        <th class="align-middle">Aktivitas</th>
                                        <th class="align-middle">Tanggal Pengajuan</th>
                                        <th class="align-middle">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengajuans as $index => $pengajuan)
                                        <tr>
                                            <td class="centered-column">{{ $index + 1 }}</td>
                                            <td class="content-column">Pengajuan Bimbingan Kerja Praktek</td>
                                            <td class="centered-column">{{ $pengajuan->created_at->format('d M Y') }}</td>
                                            <td class="centered-column">
                                                @if ($pengajuan->status == 'ACC')
                                                    <button type="status" class="btn btn-success rounded-5">Diterima
                                                        <i class="fas icon-dark-acc"></i>
                                                    </button>
                                                @elseif ($pengajuan->status == 'TOLAK')
                                                    <button type="status" class="btn btn-danger rounded-5">Ditolak
                                                        <i class="fas icon-dark-no"></i>
                                                    </button>
                                                @else
                                                    <button type="status" class="btn btn-warning rounded-5">Belum ACC
                                                        <i class="fas icon-dark-pending"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>  
                    <div class="col-md-4 py-5">
                        <h1><i class="fas fa-bell"></i> Notifikasi</h1>
                        <p>Dosen Pembimbing telah menerima topikmu! Silahkan ke halaman Logbook untuk mengisi catatan
                            bimbingan.
                        </p>
                        <a href="{{ route('mahasiswa-logbook') }}" class="btn btn-primary"><i
                                class="fas fa-chevron-right"></i>Menuju ke
                            Halaman</a>
                    </div>
                @endif
            </div>
        @endif
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var successAlert = document.getElementById('success-alert');
                if (successAlert) {
                    successAlert.style.display = 'none';
                }

                var errorAlert = document.getElementById('error-alert');
                if (errorAlert) {
                    errorAlert.style.display = 'none';
                }
            }, 3000);
        });
    </script>
@endsection


{{-- @extends('mahasiswa.layouts.main')
@section('title', 'Dashboard Mahasiswa')
@section('content')
    <div class="container-dashboard">
        <h1>Hi, {{ $mahasiswa->nama }}</h1>
        <div class="type">
            <h1></h1>
        </div>
        <p>Siap untuk kerja praktek hari ini?</p>
    </div>

    @if (Session::get('success'))
        <div class="alert alert-success mt-3">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::get('error'))
        <div class="alert alert-danger mt-3">
            {{ Session::get('error') }}
        </div>
    @endif

    <main class="container-border">
        <div class="container">
            @if(!$isCompleted)
                <form action="{{ route('updateMhs', ['id' => $mahasiswa->id]) }}" method="POST">
                    @csrf
                    <h4 class="text-center">Lengkapi Data Diri</h4>
                    <hr>
                    <div class="form-group row mb-3">
                        <label for="inputTelp" class="col-sm-2 col-form-label">Nomor Telepon <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control @error('telp_mhs') is-invalid @enderror" name="telp_mhs" id="inputTelp" placeholder="Masukkan Nomor Telepon" value="{{ old('telp_mhs') ? old('telp_mhs') : $mahasiswa->telp_mhs }}">
                            @error('telp_mhs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputIPK" class="col-sm-2 col-form-label">IPK <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('ipk') is-invalid @enderror" name="ipk" id="inputIPK" placeholder="Masukkan IPK" value="{{ old('ipk') ? old('ipk') : $mahasiswa->ipk }}">
                            @error('ipk')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputTranskrip" class="col-sm-2 col-form-label">Upload Link Transkrip Nilai <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('transkrip_nilai') is-invalid @enderror" name="transkrip_nilai" id="inputTranskrip" placeholder="Masukkan Link Transkrip" value="{{ old('transkrip_nilai') ? old('transkrip_nilai') : $mahasiswa->transkrip_nilai }}">
                            @error('transkrip_nilai')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-sm-10 offset-sm-2 text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
        <div class="row">
            <div class="col-md-8 py-5">
                <h1><i class="far fa-calendar-check"></i> Aktivitas Terbaru</h1>
                <div class="table-container table-aktivitas">
                    <table class="table table-bordered">
                        <thead class="table-header">
                            <th class="align-middle">No.</th>
                            <th class="align-middle">Aktivitas</th>
                            <th class="align-middle">Tanggal Pengajuan</th>
                            <th class="align-middle">Status</th>
                        </thead>
                        <tr>
                            <td class="centered-column">1</td>
                            <td class="content-column">Pengajuan Bimbingan Kerja Praktek</td>
                            <td class="centered-column">05 April 2024</td>
                            <td class="centered-column">
                                <button type="status" class="btn btn-danger rounded-5">ditolak
                                    <i class="fas fa- icon-dark-acc"></i>
                                </button>
                                <!--
                                <button type="status" class="btn btn-danger rounded-5">Belum ACC
                                    <i class="fas fa-times icon-dark-no"></i>
                                </button>
                                -->
                            </td>
                        </tr>
                        <tr>
                            <td class="centered-column">2</td>
                            <td class="content-column">Pengajuan Bimbingan Kerja Praktek</td>
                            <td class="centered-column">30 April 2024</td>
                            <td class="centered-column">
                                <button type="status" class="btn btn-success rounded-5">diterima
                                    <i class="fas  icon-dark-acc"></i>
                                </button>
                                <!--
                                <button type="status" class="btn btn-danger rounded-5">Belum ACC
                                    <i class="fas fa-times icon-dark-no"></i>
                                </button>
                                -->
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 py-5">
                <h1><i class="far fa-calendar-check"></i> Aktivitas Terbaru</h1>
                <div class="table-container table-aktivitas">
                    <table class="table table-bordered">
                        <thead class="table-header">
                            <th class="align-middle">No.</th>
                            <th class="align-middle">Aktivitas</th>
                            <th class="align-middle">Tanggal Pengajuan</th>
                            <th class="align-middle">Status</th>
                        </thead>
                        <tbody>
                        @foreach ($pengajuans as $index => $pengajuan)
                            <tr>
                                <td class="centered-column">{{ $index + 1 }}</td>
                                <td class="content-column">Pengajuan Bimbingan Kerja Praktek</td>
                                <td class="centered-column">{{ $pengajuan->created_at->format('d M Y') }}</td>
                                <td class="centered-column">
                                    @if ($pengajuan->status == 'diterima')
                                        <button type="status" class="btn btn-success rounded-5">Diterima
                                            <i class="fas icon-dark-acc"></i>
                                        </button>
                                    @elseif ($pengajuan->status == 'ditolak')
                                        <button type="status" class="btn btn-danger rounded-5">Ditolak
                                            <i class="fas icon-dark-no"></i>
                                        </button>
                                    @else
                                        <button type="status" class="btn btn-warning rounded-5">Belum ACC
                                            <i class="fas icon-dark-pending"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection --}}
