<?php /** @noinspection PhpSuperClassIncompatibleWithInterfaceInspection */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Kwitansi extends Model
{
    use HasFactory;

    protected $table='kwitansi';
    public $incrementing = false;

    protected $fillable = [
        'uang_harian',
        'mata_anggaran_1',
        'mata_anggaran_2',
        'nomor_bukti'
    ];

    public function sppd() {
        return $this->belongsTo(PerjalananDinasUser::class, 'perjalanan_dinas_user_id', 'id');
    }
}
