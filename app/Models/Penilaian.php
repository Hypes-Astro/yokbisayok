<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';

    protected $fillable = [
        'deskripsi_pekerjaan',
        'inovasi',
        'kerjasama',
        'kedisiplinan',
        'catatan',
        'score',
        'file_path',
        'mahasiswa_id',
        'penyelia_id',
        'status',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function penyelia()
    {
        return $this->belongsTo(ProfilPenyelia::class, 'penyelia_id', 'id');
    }
    
}
