@extends('mahasiswa.layouts.main')
@section('title', 'Review Penyelia')
@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-dosbing" class="nav-link active rounded-pill">
                <i class="fas fa-chalkboard-teacher"></i>
                Profil Penyelia
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link rounded-pill">
                <i class="fas fa-edit"></i>
                Detail Penilaian
            </a>
        </li>
        <li class="nav-item">
            <a data-toggle="pill" href="#nav-tab-pengajuan" class="nav-link rounded-pill">
                <i class="fas fa-book-open"></i>
                Draft Review Penialaian
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="nav-tab-dosbing" class="tab-pane fade show active">
            @include('mahasiswa.review_penyelia.tambah_penyelia')
        </div>
        <div id="nav-tab-pengajuan" class="tab-pane fade">
            @include('mahasiswa.review_penyelia.detail_penilaian')
        </div>
        <div id="nav-tab-draft" class="tab-pane fade">
            @include('mahasiswa.review_penyelia.draft_penilaian')
        </div>
    </div>
</div>
@endsection