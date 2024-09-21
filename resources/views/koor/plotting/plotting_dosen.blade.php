@extends('koor.layouts.main')
@section('title', 'Data Dosen Pembimbing')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5">Plotting Dosen Pembimbing</h2>
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h4 class="mb-4">Dosen Yang Tersedia</h4>
            <div class="input-group mb-4">
                <input type="text" id="search-dosen" class="form-control" placeholder="Cari Nama Dosen">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>

            <form id="plotting-form">
                @csrf
                <table class="table table-hover align-middle">
                    <thead class="table-header">
                        <tr>
                            <th></th>
                            <th>Nama Dosen</th>
                            <th class="text-center">Kuota Tersedia</th>
                        </tr>
                    </thead>
                    <tbody id="dosen-list">
                        @foreach($dsnStatus as $dosen)
                            <tr class="dosen-row" data-dosen-id="{{ $dosen->dosen->id }}" data-dosen-name="{{ strtolower($dosen->dosen->nama) }}">
                                <td class="text-center">
                                    <span class="toggle-icon" data-dosen-id="{{ $dosen->dosen->id }}" style="cursor:pointer;">&#9654;</span>
                                </td>
                                <td>{{ $dosen->dosen->nama }}</td>
                                <td class="text-center">{{ $dosen->sisa_kuota }}</td>
                            </tr>
                            <tr id="mahasiswa-list-{{ $dosen->dosen->id }}" class="mahasiswa-list-row" style="display: none;">
                                <td colspan="4">
                                    <table class="table table-sm table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nama Mahasiswa</th>
                                                <th>NIM</th>
                                                <th class="text-center">Pilih</th>
                                                <th class="text-end">
                                                    <button type="button" class="btn btn-success plot-dosen" data-dosen-id="{{ $dosen->dosen->id }}">
                                                        Plotting
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($mahasiswa as $mhs)
                                                <tr>
                                                    <td>{{ $mhs->mahasiswa->nama }}</td>
                                                    <td>{{ $mhs->mahasiswa->nim }}</td>
                                                    <td class="text-center">
                                                        <input type="checkbox" name="mhs_id[{{ $dosen->dosen->id }}][]" value="{{ $mhs->id_mhs }}" class="form-check-input select-mhs-{{ $dosen->dosen->id }}">
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Search dosen function
        document.getElementById('search-dosen').addEventListener('keyup', function () {
            const searchValue = this.value.toLowerCase();
            document.querySelectorAll('.dosen-row').forEach(function (row) {
                const dosenName = row.getAttribute('data-dosen-name');
                if (dosenName.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Toggle display of mahasiswa rows
        document.querySelectorAll('.dosen-row').forEach(function (row) {
            row.addEventListener('click', function () {
                const dosenId = this.dataset.dosenId;
                const mahasiswaRow = document.getElementById('mahasiswa-list-' + dosenId);
                const toggleIcon = this.querySelector('.toggle-icon');

                mahasiswaRow.style.display = (mahasiswaRow.style.display === 'none' || mahasiswaRow.style.display === '') 
                    ? 'table-row' 
                    : 'none';
                
                toggleIcon.innerHTML = (mahasiswaRow.style.display === 'none') ? '&#9654;' : '&#9660;';
            });
        });

        // Plotting action
        document.querySelectorAll('.plot-dosen').forEach(function (button) {
            button.addEventListener('click', function () {
                const dosenId = this.dataset.dosenId;
                const selectedMahasiswa = Array.from(document.querySelectorAll('.select-mhs-' + dosenId + ':checked')).map(checkbox => checkbox.value);

                if (selectedMahasiswa.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak ada mahasiswa yang dipilih',
                        text: 'Pilih setidaknya satu mahasiswa.',
                    });
                    return;
                }

                $.ajax({
                    url: '{{ route("koor-plotting-dosbing-post") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        dosenId: dosenId,
                        mhs_id: selectedMahasiswa
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi kesalahan',
                            text: xhr.responseText,
                        });
                    }
                });
            });
        });
    });
</script>

@endsection
