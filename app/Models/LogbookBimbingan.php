<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogbookBimbingan extends Model
{
    use HasFactory;
    protected $table = 'logbook_bimbingans';
    protected $fillable = [
        'id_mhs',
        'id_dsn',
        'tanggal',
        'bab',
        'uraian',
        'dokumen',
        'status',
    ];
    public function mahasiswa()
    {
        return $this->belongsTo(StatusMahasiswa::class, 'id_mhs', 'id');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dsn', 'id');
    }
}
