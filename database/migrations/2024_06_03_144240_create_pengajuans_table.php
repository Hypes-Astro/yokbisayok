<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
     {
         Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mhs');
            $table->unsignedBigInteger('id_dsn');
            $table->enum('kategori_bidang', ['Web_Development', 'Application_Development', 'Game_Development', 'Data_Analysis', 'Artificial_Intelligence']);
            $table->string('judul')->nullable();
            $table->string('perusahaan');
            $table->string('posisi');
            // $table->longText('deskripsi')->nullable();
            $table->date('tanggal_mulai')->nullable(); 
            $table->date('tanggal_selesai')->nullable();
        //  $table->string('durasi');
            $table->enum('status', ['ACC', 'TOLAK', 'PENDING'])->default('PENDING');
            $table->longText('alasan')->nullable();
            $table->timestamps();
 
            //  $table->foreign('id_mhs')->references('id')->on('mahasiswa')->cascadeOnDelete();
            //  $table->foreign('id_dsn')->references('id')->on('dosen')->cascadeOnDelete();
         });
     }
    // public function up(): void
    // {
    //     Schema::create('pengajuans', function (Blueprint $table) {
    //         $table->id();
    //         $table->enum('kategori_bidang', ['Web Development', 'Application Development', 'Game Development', 'Data Analysis', 'Data Science', 'Artificial Intelligence', 'Graphic Design', 'Networking']);
    //         $table->string('judul');
    //         $table->string('perusahaan');
    //         $table->string('posisi');
    //         $table->text('deskripsi');
    //         $table->string('durasi');
    //         $table->timestamps();
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
