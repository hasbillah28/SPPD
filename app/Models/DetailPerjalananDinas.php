<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPerjalananDinas extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'detail_perjalanan_dinas';

    protected $fillable = [
        'perjalanan_dinas_id',
        'tiba_di',
        'tiba_di_tanggal',
        'berangkat_ke',
        'berangkat_ke_tanggal'
    ];

    public function perjalanan() {
        return $this->belongsTo(PerjalananDinas::class, 'perjalanan_dinas_id');
    }
}
