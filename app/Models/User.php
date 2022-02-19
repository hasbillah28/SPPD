<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'nip',
        'no_hp',
        'jabatan_id',
        'golongan_id',
        'pangkat_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the jabatan that owns the User
     *
     * @return BelongsTo
     */
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    /**
     * Get the golongan that owns the User
     *
     * @return BelongsTo
     */
    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id');
    }

    /**
     * Get the pangkat that owns the User
     *
     * @return BelongsTo
     */
    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'pangkat_id');
    }


        public function routeNotificationForWhatsapp()
        {
            $noHp = $this->no_hp;

            if ($noHp[0] !== '+') {
                $noHp = "62".intval($noHp);
            }

            return ($noHp);
        }
    /*public function hasRole($role)
    {
        if ($role === $this->jabatan->nama_jabatan) {
            return true;
        }

        return false;
    }*/
   /* public function perjalanan()
    {
        return $this->hasMany(PerjalananDinas::class,'user_id', 'id');
    }*/
}
