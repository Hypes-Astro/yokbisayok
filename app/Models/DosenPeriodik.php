<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenPeriodik extends Model
{
    use HasFactory;
    protected $table = 'dsn_periodik';
    protected $fillable = [
        'id_periode',
        'id_dsn',
    ];
    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode', 'id');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dsn', 'id');
    }
    public function status()
    {
        return $this->hasOne(StatusDosen::class, 'id_period', 'id');
    }
}