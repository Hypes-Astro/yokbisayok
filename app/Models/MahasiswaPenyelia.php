<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaPenyelia extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_penyelia';

    protected $fillable = [
        'mahasiswaId',
        'penyeliaId'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function penyelia()
    {
        return $this->belongsTo(Penyelia::class);
    }

    public function profil_penyelia()
    {
        return $this->belongsTo(ProfilPenyelia::class);
    }
}
