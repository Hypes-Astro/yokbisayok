@extends('mahasiswa.layouts.main')
@section('title', 'Halaman Tentang')
@section('content')
    <div class="text-center">
        <h1>
            Tentang Kami
        </h1>
    </div>
    <div class="row border rounded-5 p-3 bg-white shadow box-area content-about">
        <p class="text-center">
            BENGKEL KODING - PROJECT KERJA PRAKTEK TEAM
        </p>
    </div>
    <div class="text-center">
        <h4>
            Pojok Developer
        </h4>
        <div class="scroller" data-speed="fast">
            <ul class="tag-list scroller__inner">
                <li>
                    <div class="nama">Yoga Adi Pratama</div>
                    <div class="nim">A11.2021.13472</div>
                </li>
                <li>
                    <div class="nama">Surinanda</div>
                    <div class="nim">A11.2021.13489</div>
                </li>
                <li>
                    <div class="nama">Nikolas Adi Kurniatmaja Sijabat</div>
                    <div class="nim">A11.2021.13800</div>
                </li>
            </ul>
        </div>
    </div>
@endsection