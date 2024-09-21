<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyelia extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama',
        'posisi',
        'departemen',
        'perusahaan',
    ];

    public function detailPenilaians()
    {
        return $this->hasMany(detailPenilaian::class);
    }

    public function mahasiswaPenyelia()
    {
        return $this->hasOne(MahasiswaPenyelia::class);
    }
}
