<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjalananDinasUser extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;

    protected $table='perjalanan_dinas_user';
    protected $primaryKey = ['user_id', 'perjalanan_dinas_id'];
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'perjalanan_dinas_id',
        'no_sppd',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function perjalanan() {
        return $this->belongsTo(PerjalananDinas::class, 'perjalanan_dinas_id');
    }

    public function kwitansi() {
        return $this->hasOne(Kwitansi::class, 'perjalanan_dinas_user_id','id');
    }
}
