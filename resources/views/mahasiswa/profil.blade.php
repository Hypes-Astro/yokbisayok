@extends('mahasiswa.layouts.main')
@section('title', 'Profile Mahasiswa')
@section('content')

    <div class="container mt-5">
        <h1 class="text-center mb-4">Profil Mahasiswa</h1>

        <!-- Tampilkan foto profil di bagian atas jika ada -->
        {{-- @if($mahasiswa->foto)
            <div class="text-center mb-4 profile-pic-container">
                <img src="{{ asset('storage/app/public/' . $mahasiswa->foto) }}" alt="Foto Profil"
                     class="profile-pic"
                     id="profile-pic" onclick="openModal(this)">
            </div>
        @else
            <div class="text-center mb-4 profile-pic-container">
                <img src="{{ asset('assets/default-profile.jpg') }}" alt="Foto Profil" class="profile-pic"
                     id="profile-pic" onclick="openModal(this)">
            </div>
        @endif --}}

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informasi Pribadi</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text"><strong>Nama: {{ $mhs['nama'] }}</strong> </p>
                        <p class="card-text"><strong>NIM: {{ $mhs['nim' ]}}</strong> </p>
                        <p class="card-text"><strong>Jurusan:</strong> Teknik Informatika</p>
                        <p class="card-text"><strong>IPK: {{ $mhs['ipk'] }}</strong> </p>
                    </div>
                    <div class="col-md-6">
                        <p class="card-text"><strong>Telepon: {{ $mhs['telp_mhs'] }}</strong> </p>
                        <p class="card-text"><strong>Email: {{ $mhs['email'] }}</strong> </p>
                        {{-- <p class="card-text"><strong>Dosen Wali: {{ $mhs['dosen_wali'] }}</strong></p> --}}
                    </div>
                </div>

                <!-- Tombol untuk membuka modal upload foto -->
                <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    Unggah Foto Profil
                </button>
            </div>
        </div>
    </div>

    <!-- Modal upload foto -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Unggah Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="upload-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="foto">Pilih Foto:</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Unggah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk memperbesar gambar -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Foto Profil" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    {{-- <script>
        function openModal(element) {
            $('#modalImage').attr('src', element.src);
            $('#imageModal').modal('show');
        }

        $(document).ready(function () {
            $('#upload-form').submit(function (e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('mahasiswa.upload_foto') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success) {
                            $('#uploadModal').modal('hide');
                            $('#profile-pic').attr('src', response.foto);
                            // Automatically refresh the page after successful upload
                            location.reload();
                        } else {
                            console.error('Error:', response.error);
                        }
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script> --}}

    <style>
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --background-color: #f8f9fa;
            --text-color: #212529;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .card-title {
            color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .profile-pic-container {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .profile-pic-container:hover {
            transform: scale(1.05);
        }

        .profile-pic {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .modal-content {
            border-radius: 15px;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-title {
            color: var(--primary-color);
        }

        .btn-close {
            background-color: var(--primary-color);
            color: #fff;
        }

        .btn-close:hover {
            background-color: var(--secondary-color);
        }
    </style>

@endsection
