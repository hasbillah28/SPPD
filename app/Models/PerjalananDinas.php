<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjalananDinas extends Model
{
    use HasFactory;

    protected $table='perjalanan_dinas';
    public $timestamp = false;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'jenis_angkutan_id',
        'deskripsi',
        'status',
        'tempat',
        'tanggal_berangkat',
        'tanggal_kembali',
        'tempat_berangkat',
        'no_surat_tugas',
        'tempat_tujuan',
        'user_id'
    ];

    public function angkutan()
    {
        return $this->belongsTo(JenisAngkutan::class, 'jenis_angkutan_id');
    }

    public function anggotas()
    {
        return $this->hasMany(PerjalananDinasUser::class, 'perjalanan_dinas_id');
    }

    public function riwayat()
    {
        return $this->hasMany(DetailPerjalananDinas::class, 'perjalanan_dinas_id');
    }
}
