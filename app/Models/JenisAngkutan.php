<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAngkutan extends Model
{
    use HasFactory;

    protected $table= 'jenis_angkutan';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama_angkutan'
    ];
}
