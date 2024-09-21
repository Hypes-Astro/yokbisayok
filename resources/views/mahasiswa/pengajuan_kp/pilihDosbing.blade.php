@extends('mahasiswa.layouts.main')
@section('title', 'Dashboard Mahasiswa')
@section('content')
    <div class="container">
        <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
            <li class="nav-item">
                <a data-toggle="pill" href="#nav-tab-dosbing" class="nav-link active rounded-pill">
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
                <a data-toggle="pill" href="#nav-tab-draft" class="nav-link rounded-pill">
                    <i class="fas fa-book-open"></i>
                    Draft Pengajuan
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="nav-tab-dosbing" class="tab-pane fade show active">
                <div class="container">
                    <h4 class="mb-4">Pemilihan Dosen Pembimbing</h4>
                    <p class="mb-2">Berikut ini adalah daftar dosen pembimbing yang tersedia</p>
                    <blockquote class="blockquote-primary">
                        <p class="mb-3">Klik tombol panah <button type="button" class="btn btn-warning"><i
                                    class="fas fa-chevron-circle-right"></i></button> untuk memilih dosen pembimbing</p>
                    </blockquote>
                    <div class="table-container table-dosbing">
                        <table id="data-dosen" class="table table-bordered mb-1">
                            <thead class="table-header">
                                <th>No</th>
                                <th>NPP</th>
                                <th>Nama Dosen</th>
                                <th>Sisa Kuota</th>
                                <th>Jumlah Ajuan</th>
                                <th>Aksi</th>
                            </thead>
                            @foreach($filteredDosen as $dos)
                            <tr>
                                <td class="centered-column">{{ $loop->iteration }}</td>
                                <td class="centered-column">{{ $dos->npp }}</td>
                                <td class="centered-column">{{ $dos->nama }}</td>
                                <td class="centered-column">{{ $dos->dosen->sisa_kuota }}</td>
                                <td class="centered-column">{{ $dos->dosen->jumlah_ajuan }}</td>

                            <form action="{{ route('form-pengajuan-mahasiswa') }}" method="GET">
                                @csrf
                                <input type="hidden" name="id_dsn" value="{{ $dos->id }}">
                                <input type="hidden" name="kategori_bidang">
                                <input type="hidden" name="judul">
                                <input type="hidden" name="perusahaan">
                                <input type="hidden" name="posisi">
                                <input type="hidden" name="deskripsi">
                                <input type="hidden" name="durasi">
                                <td class="centered-column">
                                    <!-- button info dosbing -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#infoDosbingModal" data-id="{{ $dos->id }}"><i
                                            class="fas fa-info-circle"></i></button>
                                    <button type="submit" class="btn btn-warning" value="{{ $dos->id }}"><i
                                            class="fas fa-chevron-circle-right"></i></button>
                                </td>
                            </form>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    @if ($status->id_dospem != 0)
                        <h4 class="mb-4 mt-4">Dosen yang Dipilih</h4>
                        <div class="table-container">
                            <table class="table table-bordered">
                                <thead class="table-header">
                                    <th>NPP</th>
                                    <th>Nama Dosen</th>
                                    <th>Aksi</th>
                                </thead>
                                <tr id="dosen-dipilih">
                                    <td class="centered-column" id="npp">{{ $dos->npp }}</td>
                                    <td id="nama">{{ $dos->nama }}</td>
                                    <td class="centered-column"><button type="button" class="btn btn-danger"
                                            id="hapusDosenBtn"><i class="fas fa-trash" data-bs-toggle="modal"
                                                data-bs-target="#hapusDosbingModal"></i></button></td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Modal Info Dosbing -->
    <div class="modal fade" id="infoDosbingModal" tabindex="-1" aria-labelledby="infoDosbingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoDosbingModalLabel">Info Dosen Pembimbing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="col-sm-12 d-flex justify-content-center">
                            <img src="https://via.placeholder.com/200x300" id="profile" alt="scholar"
                                class="image mb-3">
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label mb-3">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" id="nama" value="" class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="npp" class="col-sm-2 col-form-label mb-3">NPP</label>
                            <div class="col-sm-10">
                                <input type="text" name="npp" id="npp" value="" class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="npp" class="col-sm-2 col-form-label mb-3">Bidang Kajian</label>
                            <div class="col-sm-10">
                                <input type="text" name="bidang_kajian" id="bidang_kajian" value=""
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="npp" class="col-sm-2 col-form-label mb-3">Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" id="email" value="" class="form-control"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="npp" class="col-sm-2 col-form-label mb-3">No Hp</label>
                            <div class="col-sm-10">
                                <input type="text" name="telp_dosen" id="telp_dosen" value=""
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="scholar" class="col-sm-2 col-form-label mb-3">Scholar</label>
                            <div class="col-sm-10">
                                <a href="https://scholar.google.com/" class="btn btn-primary" role="button"
                                    id="scholar" aria-disabled="true" target="_blank">Go to Scholar</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var pilihModal = document.querySelector('#pilihDosbingModal');
    
            pilihModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var dosenId = button.getAttribute('data-id');
                console.log(dosenId);
    
                fetch('/dosen/' + dosenId)
                    .then(response => response.json())
                    .then(data => {
                        pilihModal.querySelector('#nama').value = data.nama;
                        pilihModal.querySelector('#npp').value = data.npp;
                        pilihModal.querySelector('#bidang_kajian').value = data.bidang_kajian;
                        pilihModal.querySelector('#email').value = data.email;
                        pilihModal.querySelector('#telp_dosen').value = data.telp;
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#data-dosen').DataTable();
    });
</script>












{{-- @extends('mahasiswa.layouts.main')
@section('title', 'Dashboard Mahasiswa')
@section('content')
    <div class="container">
        <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
            <li class="nav-item">
                <a data-toggle="pill" href="#nav-tab-dosbing" class="nav-link active rounded-pill">
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
                <a data-toggle="pill" href="#nav-tab-draft" class="nav-link rounded-pill">
                    <i class="fas fa-book-open"></i>
                    Draft Pengajuan
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="nav-tab-dosbing" class="tab-pane fade show active">
                <div class="container">
                    <h4 class="mb-4">Pemilihan Dosen Pembimbing</h4>
                    <p class="mb-2">Berikut ini adalah daftar dosen pembimbing yang tersedia</p>
                    <blockquote class="blockquote-primary">
                        <p class="mb-3">Klik tombol panah <button type="button" class="btn btn-warning"><i class="fas fa-chevron-circle-right"></i></button> untuk memilih dosen pembimbing</p>
                    </blockquote>
                    <div class="input-group justify-content-end mb-3">
                        <input type="text" class="form-control" placeholder="Cari Dosen">
                        <div class="input-group-append"><button class="btn btn-primary"><i class="fas fa-search"></i></button></div>
                    </div>
                    <div class="table-container table-dosbing">
                        <table class="table table-bordered mb-1" id="dosbingList">
                            <thead class="table-header">
                                <tr>
                                    <th>No</th>
                                    <th>NPP</th>
                                    <th>Nama Dosen</th>
                                    <th>Sisa Kuota</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dosens as $dosen)
                                    <tr>
                                        <td class="centered-column">{{ $loop->iteration }}</td>
                                        <td class="centered-column">{{ $dosen->npp }}</td>
                                        <td>{{ $dosen->nama }}</td>
                                        <td class="centered-column">{{ $dosen->sisa_kuota }}</td>
                                        <td class="centered-column"><button type="button" class="btn btn-warning btn-pilih-dosbing" data-bs-toggle="modal" data-bs-target="#pilihDosbingModal"><i class="fas fa-chevron-circle-right"></i></button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="pageNavigationDosbing">
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

                    <!-- Hidden initially -->
                    <h4 class="mb-4 mt-5" id="selectedDosbingTitle" style="display: none;">Dosen Pembimbing Terpilih</h4>
                    <div class="table-container table-dosbing" id="selectedDosbingContainer" style="display: none;">
                        <table class="table table-bordered mb-1" id="selectedDosbingList">
                            <thead class="table-header">
                                <tr>
                                    <th>No</th>
                                    <th>NIDN</th>
                                    <th>Nama Dosen</th>
                                    <th>Sisa Kuota</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Selected supervisors will appear here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group row mb-3 justify-content-end" id="continueButtonContainer" style="display: none;">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('formPengajuan') }}" class="btn btn-primary">
                                <i class="fas fa-chevron-right"></i>Lanjutkan
                            </a>
                            {{-- <button type="submit" class="btn btn-primary"><i class="fas fa-chevron-right"></i>Lanjutkan</button> --}}
                        {{-- </div>
                    </div>
                </div> --}}

                <!-- Modal Pilih Dosbing -->
                {{-- <div class="modal fade" id="pilihDosbingModal" tabindex="-1" aria-labelledby="pilihDosbingModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="pilihDosbingModalLabel">Pilih Dosen Pembimbing</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Yakin untuk memilih dosen pembimbing ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                <button type="button" class="btn btn-primary" id="konfirmasiPilihDosbing">Ya</button>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Modal Hapus Dosbing -->
                {{-- <div class="modal fade" id="hapusDosbingModal" tabindex="-1" aria-labelledby="hapusDosbingModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="hapusDosbingModalLabel">Hapus Dosen Pembimbing</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Yakin untuk menghapus dosen pembimbing ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                <button type="button" class="btn btn-primary" id="konfirmasiHapusDosbing">Ya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dosbingList = document.getElementById('dosbingList').querySelector('tbody');
            const selectedDosbingList = document.getElementById('selectedDosbingList').querySelector('tbody');
            const selectedDosbingContainer = document.getElementById('selectedDosbingContainer');
            const selectedDosbingTitle = document.getElementById('selectedDosbingTitle');
            const continueButtonContainer = document.getElementById('continueButtonContainer');
            let dosbingToBeAdded = null;
            let dosbingToBeRemoved = null;
            const pilihDosbingModalElement = document.getElementById('pilihDosbingModal');
            const hapusDosbingModalElement = document.getElementById('hapusDosbingModal');
            const pilihDosbingModal = new bootstrap.Modal(pilihDosbingModalElement);
            const hapusDosbingModal = new bootstrap.Modal(hapusDosbingModalElement);

            // Function to update display status
            function updateDisplayStatus() {
                const savedSelectedDosbings = JSON.parse(localStorage.getItem('selectedDosbings')) || [];
                if (savedSelectedDosbings.length > 0) {
                    selectedDosbingContainer.style.display = 'block';
                    selectedDosbingTitle.style.display = 'block';
                    continueButtonContainer.style.display = 'block';
                } else {
                    selectedDosbingContainer.style.display = 'none';
                    selectedDosbingTitle.style.display = 'none';
                    continueButtonContainer.style.display = 'none';
                }
            }

            updateDisplayStatus();

            // Hide selected dosbing section and continue button by default
            selectedDosbingContainer.style.display = 'none';
            selectedDosbingTitle.style.display = 'none';
            continueButtonContainer.style.display = 'none';

            // Handle selecting a dosbing to add
            document.querySelectorAll('.btn-pilih-dosbing').forEach(button => {
                button.addEventListener('click', function() {
                    dosbingToBeAdded = this.closest('tr');
                });
            });

            document.getElementById('konfirmasiPilihDosbing').addEventListener('click', function() {
                if (dosbingToBeAdded) {
                    // Show selected dosbing section and continue button
                    selectedDosbingContainer.style.display = 'block';
                    selectedDosbingTitle.style.display = 'block';
                    continueButtonContainer.style.display = 'block';
                    
                    // Clone the row and update its buttons
                    const clonedRow = dosbingToBeAdded.cloneNode(true);
                    const btn = clonedRow.querySelector('.btn-pilih-dosbing');
                    btn.classList.remove('btn-warning', 'btn-pilih-dosbing');
                    btn.classList.add('btn-danger', 'btn-hapus-dosen');
                    btn.innerHTML = '<i class="fas fa-trash"></i>';
                    btn.removeAttribute('data-bs-toggle');
                    btn.removeAttribute('data-bs-target');
                    btn.setAttribute('data-bs-toggle', 'modal');
                    btn.setAttribute('data-bs-target', '#hapusDosbingModal');
                    clonedRow.querySelector('.btn-hapus-dosen').addEventListener('click', function() {
                        dosbingToBeRemoved = this.closest('tr');
                    });

                    // Add the cloned row to the selected list
                    selectedDosbingList.appendChild(clonedRow);

                    // Remove the original row from the available list
                    dosbingToBeAdded.remove();
                    dosbingToBeAdded = null;

                    updateSelectedDosbingNumbers();

                    // Show selected dosbing section
                    selectedDosbingContainer.style.display = 'block';
                    selectedDosbingTitle.style.display = 'block';
                    continueButtonContainer.style.display = 'block';

                    // Close the modal
                    pilihDosbingModal.hide();

                    // Clear modal backdrop and remove focus from modal
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                    $('body').css('padding-right', '');
                    $('.modal').removeClass('show');
                    $('.modal').attr('aria-modal', 'false');
                    $('.modal').attr('aria-hidden', 'true');

                    // Set focus back to main content
                    document.getElementById('nav-tab-dosbing').scrollIntoView();
                }
            });

            // Confirm removing dosbing
            document.getElementById('konfirmasiHapusDosbing').addEventListener('click', function() {
                if (dosbingToBeRemoved) {
                    // Revert the row back to the available list
                    const clonedRow = dosbingToBeRemoved.cloneNode(true);
                    const btn = clonedRow.querySelector('.btn-hapus-dosen');
                    btn.classList.remove('btn-danger', 'btn-hapus-dosen');
                    btn.classList.add('btn-warning', 'btn-pilih-dosbing');
                    btn.innerHTML = '<i class="fas fa-chevron-circle-right"></i>';
                    btn.removeAttribute('data-bs-toggle');
                    btn.removeAttribute('data-bs-target');
                    btn.setAttribute('data-bs-toggle', 'modal');
                    btn.setAttribute('data-bs-target', '#pilihDosbingModal');
                    clonedRow.querySelector('.btn-pilih-dosbing').addEventListener('click', function() {
                        dosbingToBeAdded = this.closest('tr');
                    });

                    dosbingList.appendChild(clonedRow);
                    dosbingToBeRemoved.remove();
                    dosbingToBeRemoved = null;

                    updateSelectedDosbingNumbers();

                    // Hide selected dosbing section if there are no selected dosbings
                    if (selectedDosbingList.querySelectorAll('tr').length === 0) {
                        selectedDosbingContainer.style.display = 'none';
                        selectedDosbingTitle.style.display = 'none';
                        continueButtonContainer.style.display = 'none';
                    }

                    // Close the modal
                    hapusDosbingModal.hide();

                    // Clear modal backdrop and remove focus from modal
                    $('.modal-backdrop').remove();
                    $('body').removeClass('modal-open');
                    $('body').css('padding-right', '');
                    $('.modal').removeClass('show');
                    $('.modal').attr('aria-modal', 'false');
                    $('.modal').attr('aria-hidden', 'true');

                    // Set focus back to main content
                    document.getElementById('nav-tab-dosbing').scrollIntoView();
                }
            });

            function updateSelectedDosbingNumbers() {
                const selectedRows = selectedDosbingList.querySelectorAll('tr');
                selectedRows.forEach((row, index) => {
                    row.querySelector('.centered-column:first-child').textContent = index + 1;
                });
            }

            // Remove the modal from the DOM after it's hidden
            pilihDosbingModal.addEventListener('hidden.bs.modal', function () {
                // Remove the modal from the DOM
                pilihDosbingModalElement.remove();
            });

            hapusDosbingModal.addEventListener('hidden.bs.modal', function () {
                // Remove the modal from the DOM
                hapusDosbingModalElement.remove();
            });
        });
    </script>

@endsection  --}}