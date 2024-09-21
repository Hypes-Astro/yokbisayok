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
        Schema::create('pengajuan_sidangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mhs');
            $table->string('judul');
            $table->enum('bidang_kajian', ['SC', 'RPLD', 'SKKKD']);
            $table->string('dokumen');
            $table->string('validasi');
            $table->string('nilaiPenyelia');
            $table->string('nilaiPembimbing');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_sidangs');
    }
};