<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KoorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\PenyeliaController;
use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\DetailLogbookController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\DosenPembimbingController;
use App\Http\Controllers\DospemBimbinganController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PengajuanSidangController;
use App\Http\Controllers\MahasiswaBimbinganController;
use App\Http\Controllers\MahasiswaBimbinganControlller;
use App\Http\Controllers\KoorMonitoringSidangController;
use App\Http\Controllers\KoorPengajuanMhsController;
use App\Http\Controllers\PlottingDosbingController;
use App\Http\Controllers\UploadPenyeliaController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginPost');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [PasswordResetController::class, 'requestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');

// Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('dashboardMahasiswa');
    // Route::get('/pengumuman', [MahasiswaController::class, 'index'])->name('dashboardMahasiswa');
    // Route::post('/update-mhs/{id}', [MahasiswaController::class, 'update'])->name('updateMhs');
    Route::post('/update-mhs', [MahasiswaController::class, 'update'])->name('updateDataMhs');
    Route::get('/pengajuanKP', [MahasiswaController::class, 'pengajuan_kp'])->name('halamanPengajuan');
    Route::get('/pilih-dosbing', [MahasiswaController::class, 'pilih_dosbing'])->name('pilihDosbingPage');
    Route::get('/form-pengajuan', [MahasiswaController::class, 'formPengajuan'])->name('formPengajuan');
    Route::post('/storePengajuan', [MahasiswaController::class, 'storePengajuan'])->name('SimpanPengajuan');
    Route::get('/draft/{id}', [MahasiswaController::class, 'draft_kp'])->name('draftKP');
    // Route::post('/draft/update', [MahasiswaController::class, 'updatePengajuan'])->name('updatePengajuan');
    // Route::post('/draft/delete', [MahasiswaController::class, 'deletePengajuan'])->name('deletePengajuan');
    // Route::post('/draft/submit', [MahasiswaController::class, 'submitPengajuan'])->name('submitPengajuan');
    // Route::get('/logbook', [MahasiswaController::class, 'logbook'])->name('halamanLogbook');
    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan-mahasiswa');
    Route::get('/pengajuan-form', [PengajuanController::class, 'form'])->name('form-pengajuan-mahasiswa');
    Route::get('/pengajuan-draft', [PengajuanController::class, 'draft'])->name('draft-pengajuan-mahasiswa');
    Route::post('/pengajuan-save-draft', [PengajuanController::class, 'saveDraft'])->name('save-draft-pengajuan-mahasiswa');
    Route::post('/pengajuan-submit', [PengajuanController::class, 'store'])->name('mahasiswa-pengajuan-submit');
    Route::get('/dosen/{id}', [PengajuanController::class, 'show'])->name('mahasiswa-pengajuan-detail-dosen');
    Route::get('/logbook', [LogbookController::class, 'index'])->name('mahasiswa-logbook');
    Route::post('/logbook', [LogbookController::class, 'store'])->name('mahasiswa-logbook-create');
    Route::post('/updateFolder', [LogbookController::class, 'updateFolder'])->name('mahasiswa-logbook-folder');
    Route::get('/logbook/{id}', [DetailLogbookController::class, 'show'])->name('mahasiswa-logbook-detail');
    Route::post('/logbook/{id}', [DetailLogbookController::class, 'update'])->name('mahasiswa-logbook-update');
    Route::post('/updatePengajuan', [MahasiswaBimbinganController::class, 'update'])->name('update-mahasiswa-bimbingan');

    // Route::get('/draft', [MahasiswaController::class, 'draft_penilaian']);
    Route::get('/Profil/{id}', [MahasiswaController::class, 'profil'])->name('halamanProfil');
    Route::get('/riwayat', [MahasiswaController::class, 'riwayat'])->name('riwayatPengajuan');
    Route::get('/profilmhs', [MahasiswaController::class, 'datadiri']);
    Route::get('/pengajuan_sidang', [MahasiswaController::class, 'penilaian_sidang'])->name('pengajuanSidang');

    Route::get('/profile-penyelia', [MahasiswaController::class, 'profile_penyelia'])->name('profile_penyelia');
    Route::post('/tambah_penyelia', [MahasiswaController::class, 'tambah_penyelia'])->name('halaman_tambah_penyelia');

    Route::get('/detail-penilaian', [MahasiswaController::class, 'detail_penilaian'])->name('detail_penilaian');
    Route::post('/storeDetail', [MahasiswaController::class, 'store_detail_penilaian'])->name('store_detail_penilaian');

    // Route::get('/draft_review', [MahasiswaController::class, 'draft_review'])->name('draft_review');
    Route::post('/submit_draft_review', [MahasiswaController::class, 'submit_review'])->name('submit_review');
    Route::get('/form-sidang', [PengajuanSidangController::class, 'form_sidang'])->name('form_pengajuan');
    Route::get('/draft-sidang', [PengajuanSidangController::class, 'draft_sidang'])->name('draft_sidang');
    Route::post('/submit-sidang', [PengajuanSidangController::class, 'pengajuan_sidang'])->name('submit_sidang');

    //upload penyelia 
    Route::get('/detail-penyelia', [UploadPenyeliaController::class, 'index'])->name('detail_penyelia');
    Route::post('/add-penyelia', [UploadPenyeliaController::class, 'add_penyelia'])->name('page-add-penyelia');

    Route::get('/det-penilaian', [UploadPenyeliaController::class, 'show'])->name('penilaian');
    Route::post('/store-penilaian', [UploadPenyeliaController::class, 'store'])->name('store_penilaian');
    Route::post('/submit-draft-penilaian', [UploadPenyeliaController::class, 'submit_penilaian'])->name('submit_penilaian');

    Route::get('/tentang', [MahasiswaController::class, 'tentang'])->name('halamanTentang');
});

// Dosen
Route::middleware(['auth', 'role:dosen'])->group(function () {
    // Route::get('/dosen', [DosenPembimbingController::class, 'index'])->name('dashboardDosen');
    Route::get('/dosen', [DosenPembimbingController::class, 'dash'])->name('dashboardDosen');
    Route::post('/update-dosen', [DosenPembimbingController::class, 'updateDataDiri'])->name('updateDataDosen');
    Route::get('/load-notifikasi', [DosenPembimbingController::class, 'loadNotif'])->name('dosen-dashboard-notif');
    Route::post('/notifikasi/{id}/mark-as-read', [DosenPembimbingController::class, 'markAsRead'])->name('dosen-dashboard-notif-mark');
    Route::post('/notifikasi/mark-all-read', [DosenPembimbingController::class, 'markAllRead'])->name('dosen-dashboard-notif-mark-all');
    Route::get('/daftar_bimbingan', [DosenPembimbingController::class, 'daftar_mhs_bimbingan'])->name('pageDaftarMhsBimbingan');
    Route::post('/updatePengajuan', [DosenPembimbingController::class, 'update_pengajuan'])->name('update-mahasiswa-bimbingan');
    Route::get('/logbook_mhs', [DosenPembimbingController::class, 'logbook_bimbingan_mhs'])->name('pageLogbook');
    Route::get('/logbookBimbinganList/{id}', [DosenPembimbingController::class, 'detail'])->name('dosbing-logbook-list');
    // Route::post('/update-dosbing-logbook', [DosenPembimbingController::class, 'update'])->name('update-dosbing-logbook');
    Route::get('/logbook_mhs/{id}', [DosenPembimbingController::class, 'show'])->name('dosbing-logbook-detail');
    Route::post('/accLogbook', [DosenPembimbingController::class, 'update'])->name('update-dosbing-logbook');

    Route::get('/review_mhs', [DosenPembimbingController::class, 'review_penyelia'])->name('pageReviewPenyelia');
    Route::get('/pengajuan_mhs', [DosenPembimbingController::class, 'pengajuan_sidang_mhs'])->name('pagePengajuanSidang');
    Route::get('/logbookBimbingan', [DospemBimbinganController::class, 'index'])->name('dosbing-logbook');
    Route::get('/dosen/review_penyelia', [DosenPembimbingController::class, 'review_penyelia'])->name('review_penyelia');
    Route::post('/review/update/{id}', [ReviewController::class, 'updateReview'])->name('updateReview');
    Route::post('/dosen/review_penyelia/hapus/{id}', [DosenPembimbingController::class, 'hapusMhs'])->name('hapusMhs');
    Route::post('/update-nilai-pembimbing/{id}', [PengajuanSidangController::class, 'updateNilaiPembimbing'])->name('updateNilaiPembimbing');
    Route::post('/pengajuan-sidang/update/{id}', [PengajuanSidangController::class, 'update'])->name('updatePengajuanSidang');
    Route::post('/update-pengajuan-sidang/{id}', [PengajuanSidangController::class, 'updatePengajuanSidang'])->name('updatePengajuanSidang');
    Route::post('/updateACCSidang/{id}', [PengajuanSidangController::class, 'updateStatus'])->name('updateACCSidang');
    Route::post('/update-pengajuan', [BimbinganController::class, 'update'])->name('update-bimbingan-mhs');
    Route::post('/update-magang', [BimbinganController::class, 'selesaiMagang'])->name('update-selesai-magang');
    Route::get('/profile', [DospemBimbinganController::class, 'profileDospem']);
});

// Koordinator
Route::middleware(['auth', 'role:koor'])->group(function () {
    // dashboard
    Route::get('/koor', [KoorController::class, 'index'])->name('dashboardKoor');

    // Koor untuk Dosen
    Route::get('/data_dosen', [KoorController::class, 'daftar_data_dosen'])->name('HalamanKoorDosen');
    Route::post('/import-dosen', [KoorController::class, 'importDosen'])->name('importDosen');
    Route::get('/template-dosen', [KoorController::class, 'downloadTemplateDosen'])->name('templateDosen');
    Route::post('/store-dosen', [KoorController::class, 'storeDosen'])->name('simpanDosen');
    Route::get('/edit-dosen/{id}', [KoorController::class, 'editDosen'])->name('editDosen');
    Route::put('/update-dosen/{id}', [KoorController::class, 'updateDosen'])->name('updateDosen');
    Route::post('/update-kuota/{id}', [KoorController::class, 'updateKuota'])->name('updateKuota');
    Route::post('delete-dosen/{id}', [KoorController::class, 'deleteDosen'])->name('hapusDosen');

    // Koor untuk Mahasiswa
    Route::get('/data_mhs', [KoorController::class, 'daftar_mhs'])->name('halamanKoorMhs');
    Route::post('/import-mhs', [KoorController::class, 'importMhs'])->name('importMhs');
    Route::get('/template-mahasiswa', [KoorController::class, 'downloadTemplateMahasiswa'])->name('templateMahasiswa');
    Route::post('/store-mhs', [KoorController::class, 'storeMhs'])->name('simpanMhs');
    Route::post('/simpan-mhs-ke-dosen', [KoorController::class, 'simpanMhsKeDosen'])->name('simpanMhsKeDosen');

    // Route::get('/edit-mhs/{id}', [KoorController::class, 'editMhs'])->name('editMhs');
    Route::put('/update-mhs/{id}', [KoorController::class, 'updateMhs'])->name('updateMhs');
    Route::post('delete-mhs/{id}', [KoorController::class, 'deleteMhs'])->name('hapusMhs');
    Route::get('/penyelia-mhs', [KoorController::class, 'penyeliaMhs'])->name('penyeliaMhs');

    // koor untuk penyelia
    Route::post('/update-review-koor/{id}', [ReviewController::class, 'showReviewPenilaian'])->name('updateReviewKoor');

    // koor pengumuman
    Route::get('/koor-pengumuman', [PengumumanController::class, 'index'])->name('koor-pengumuman');
    Route::post('/koor-pengumuman', [PengumumanController::class, 'store'])->name('koor-pengumuman.store');
    Route::get('/detail-pengumuman/{id}', [PengumumanController::class, 'show'])->name('koor-pengumuman.show');
    // Route::put('/koor-pengumuman/{id}', [PengumumanController::class, 'update'])->name('koor-pengumuman.update');
    Route::delete('/koor-pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('koor-pengumuman.destroy');

    // koor log mahasiswa dan dosen
    Route::get('/log-dosen', [LogController::class, 'LogDosen'])->name('log_dosen');
    Route::get('/log-mhs', [LogController::class, 'LogMahasiswa'])->name('log_mhs');
    Route::get('/koor-monitoring-sidang', [KoorMonitoringSidangController::class, 'index'])->name('koor-monitoring-sidang');
    Route::post('/koor-monitoring-sidang/update', [KoorMonitoringSidangController::class, 'updateStatus'])->name('koor-monitoring-sidang-update');
    Route::get('/plotting', [PlottingDosbingController::class, 'index'])->name('koor-plotting');
    Route::post('/plotting-dosbing', [PlottingDosbingController::class, 'setDosbing'])->name('koor-plotting-dosbing-post');

    // koor pengajuan mhs
    Route::get('/daftar-mhs', [KoorPengajuanMhsController::class, 'index'])->name('koor-list-mhs');
    Route::post('/update-mahasiswa', [KoorPengajuanMhsController::class, 'update'])->name('update-list');

    //koor history
    Route::get('/history-mhs', [HistoryController::class, 'index'])->name('koor-history-mhs');
    Route::post('/update-history', [HistoryController::class, 'update'])->name('update-history');
});

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard-Admin', [AdminController::class, 'index'])->name('dashboardAdmin');
    // Route::get('/user_mhs', [AdminController::class, 'log_mhs'])->name('DataMahasiswa');
    // Route::get('/user_dosen', [AdminController::class, 'log_dosbing'])->name('DataDosbing');
    // Route::get('/data_user_mhs', [AdminController::class, 'user_mhs'])->name('dataMhs');
    // Route::get('/data_user_dosen', [AdminController::class, 'user_dosen'])->name('dataDosen');
    // Route::get('/data_user_koor', [AdminController::class, 'user_koor'])->name('dataKoor');
});

//review
Route::post('/submit_review', [ReviewController::class, 'store']);
Route::post('/submit', [PenyeliaController::class, 'store'])->name('submit');
// review penyelia mahasiswa
// Route::get('/Review', [SidebarMahasiswaController::class, 'review_penyelia']);
// Route::get('/detail', [SidebarMahasiswaController::class, 'detail']);



// Export
Route::get('/pengajuan-export', [HistoryController::class, 'export'])->name('pengajuan.export');
