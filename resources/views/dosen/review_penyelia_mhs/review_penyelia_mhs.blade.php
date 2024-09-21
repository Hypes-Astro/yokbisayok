@extends('dosen.layouts.main')
@section('title', 'Daftar Review Penyelia')
@section('content')
<div class="container">
    <h4 class="mb-4">Review Penilaian Penyelia Mahasiswa Kerja Praktek</h4>

    <p class="mb-2 d-flex justify-content-between align-items-center">
        {{-- <blockquote class="blockquote-primary">
            <p class="mb-3">Klik tombol <button type="button" class="btn btn-primary"><i class="lni lni-empty-file"></i></button> untuk melihat detail Review Penyelia mahasiswa</p>
        </blockquote> --}}
        Berikut merupakan daftar Detail Penilaian Mahasiswa
    </p>
    <div class="table-container table-logbook">
        <table class="table table-bordered">
            <thead class="table-header">
                <tr>
                    <th class="align-middle">No.</th>
                    <th class="align-middle">NIM</th>
                    <th class="align-middle">Nama Mahasiswa</th>
                    <th class="align-middle">Review Penyelia</th>
                    <th class="align-middle">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detail_penilaians as $review)
                <tr id="review-row-{{ $review->id }}">
                    <td class="centered-column">{{ $loop->iteration }}</td>
                    <td class="centered-column">{{ $review->mahasiswa->nim }}</td>
                    <td class="centered-column">{{ $review->mahasiswa->nama }}</td>
                    <td class="centered-column">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $review->id }}">
                            Lihat Detail
                        </button>
                    </td>
                    <td class="centered-column">
                        @if ($review->status == 'ACC')
                            <button class="btn btn-success" disabled>
                                Status Selesai
                            </button>
                        @else
                            <div class="d-flex justify-content-center">
                                <form action="{{ route('updateReview', $review->id) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="status" value="ACC">
                                    <button type="submit" class="btn btn-success acc-btn">
                                        <i class="fa-regular fa-circle-check"></i> ACC
                                    </button>
                                </form>
                            </div>
                        @endif
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <nav aria-label="pageNavigationReviewPenyelia">
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

<!-- Dialog Modal Detail Review dan Penyelia -->
@foreach($detail_penilaians as $review)
<div class="modal fade" id="detailModal{{ $review->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $review->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="detailModalLabel{{ $review->id }}">Detail Penilaian dan Penyelia</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="accordionExample{{ $review->id }}">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne{{ $review->id }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $review->id }}" aria-expanded="true" aria-controls="collapseOne{{ $review->id }}">
                                Detail Penyelia
                            </button>
                        </h2>
                        <div id="collapseOne{{ $review->id }}" class="accordion-collapse collapse show" aria-labelledby="headingOne{{ $review->id }}" data-bs-parent="#accordionExample{{ $review->id }}">
                            <div class="accordion-body">
                                <p><strong>Nama:</strong> {{ $review->penyelia->nama }}</p>
                                <p><strong>Posisi:</strong> {{ $review->penyelia->posisi }}</p>
                                <p><strong>Departemen:</strong> {{ $review->penyelia->departemen }}</p>
                                <p><strong>Perusahaan:</strong> {{ $review->penyelia->perusahaan }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo{{ $review->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo{{ $review->id }}" aria-expanded="false" aria-controls="collapseTwo{{ $review->id }}">
                                Detail Penilaian
                            </button>
                        </h2>
                        <div id="collapseTwo{{ $review->id }}" class="accordion-collapse collapse" aria-labelledby="headingTwo{{ $review->id }}" data-bs-parent="#accordionExample{{ $review->id }}">
                            <div class="accordion-body">
                                <p><strong>Deskripsi Pekerjaan:</strong> {{ $review->deskripsi_pekerjaan }}</p>
                                <p><strong>Prestasi dan Kontribusi:</strong> {{ $review->prestasi_kontribusi }}</p>
                                <p><strong>Keterampilan dan Kemampuan:</strong> {{ $review->keterampilan_kemampuan }}</p>
                                <p><strong>Kerjasama dan Keterlibatan:</strong> {{ $review->kerjasama_keterlibatan }}</p>
                                <p><strong>Komentar:</strong> {{ $review->komentar }}</p>
                                <p><strong>Perkembangan:</strong> {{ $review->perkembangan }}</p>
                                <p><strong>Kesimpulan dan Saran:</strong> {{ $review->kesimpulan_saran }}</p>
                                <p><strong>Score:</strong> {{ $review->score }}</p>
                                <p><strong>File:</strong> {{ $review->file_path }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.acc-btn, .tolak-btn').on('click', function() {
            var reviewId = $(this).data('review-id');
            var status = $(this).hasClass('acc-btn') ? 'ACC' : 'TOLAK';
            $.ajax({
                url: '{{ route('updateReview', '') }}/' + reviewId,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    $('#review-row-' + reviewId).fadeOut();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
