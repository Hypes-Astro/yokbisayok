<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DosenPembimbing extends Model
{
    use HasFactory;

    protected $table = 'dosen_pembimbings';
    protected $fillable = [
        'id_dsn',
        'kuota',
        'jumlah_ajuan',
        'ajuan_diterima',
        'sisa_kuota',
        'status'
    ];

    public function dosen(){
        return $this->belongsTo(Dosen::class, 'id_dsn', 'id');
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'id_dsn', 'id');
    }
}
