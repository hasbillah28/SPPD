<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;

    protected $table= 'pangkat';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama_pangkat'
    ];
}
