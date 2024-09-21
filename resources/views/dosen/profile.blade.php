@extends('dosen.layouts.main')
@section('title', 'Profile Dosen pembimbing')
@section('content')
    <style>
        /* Add some basic styling to make the form look good */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            position: relative; 
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
            background: none;
            border: none;
            color: #000;
        }
    </style>

    <div class="wrapper d-flex flex-column min-vh-100">
        <div class="container flex-grow-1">
            {{-- <img src="{{$foto}}" alt="Image" class="image mt-5"> --}}
            <button class="close-btn" onclick="window.close()">&times;</button>

            <div class="form">
                <form class="">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" value="{{$dosen->nama}}" class="form-control" disabled>
                    </div>
                    {{--                    <div class="form-group">--}}
                    {{--                        <label for="nidn">NIDN</label>--}}
                    {{--                        <input type="text" id="nidn" value="" class="form-control" disabled>--}}
                    {{--                    </div>--}}
                    <div class="form-group">
                        <label for="npp">NPP</label>
                        <input type="text" id="npp" value="{{$dosen->npp}}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="bidang_kajian">Bidang Kajian</label>
                        <input type="text" id="bidang_kajian" value="{{$dosen->bidang_kajian}}" class="form-control"
                               disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" value="{{$dosen->email}}" class="form-control"
                               disabled>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" id="telepon" value="{{$dosen->telp}}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="scholar">Scholar</label>
                        <a id="scholar" href="https://scholar.google.com/citations?user=hJuwBL8AAAAJ&hl=en&oi=ao"
                           class="form-control" target="_blank">
                            https://scholar.google.com/citations?user=hJuwBL8AAAAJ&hl=en&oi=ao
                        </a>
                    </div>
                    {{--                    <div class="form-group">--}}
                    {{--                        <label for="bio">Deskripsi Bio</label>--}}
                    {{--                        <textarea id="bio" class="form-control" disabled> No description bio yet</textarea>--}}
                    {{--                    </div>--}}
                </form>
            </div>
        </div>
    </div>

    <script>
        // Add this script to handle the close button click if window.close() doesn't work
        document.querySelector('.close-btn').addEventListener('click', function() {
            if (!window.close()) {
                window.history.back();
            }
        });
    </script>
@endsection
