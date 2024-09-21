<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenPembimbingsTable extends Migration
{
    public function up()
    {
        Schema::create('dosen_pembimbings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dsn');
            $table->integer('kuota');
            $table->integer('jumlah_ajuan')->default(0);
            $table->integer('ajuan_diterima')->default(0);
            $table->integer('sisa_kuota')->default(0);
            $table->enum('status', ['Penuh', 'Tersedia'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dosen_pembimbings');
    }
}
