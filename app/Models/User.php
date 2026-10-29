<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'nomor_telepon',
        'role',
        'status',
        'device_token',
        'tanda_tangan',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'role',
        'device_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute()
    {
        return $this->nama;
    }

    public function getTandaTanganUrlAttribute()
    {
        if (!empty($this->tanda_tangan)) {
            if (file_exists(public_path('images/signatures/' . $this->tanda_tangan))) {
                return asset('images/signatures/' . $this->tanda_tangan);
            }
            if (file_exists(public_path('images/' . $this->tanda_tangan))) {
                return asset('images/' . $this->tanda_tangan);
            }
        }

        // Fallback khusus untuk Namira jika belum mengunggah file baru
        if (($this->id == 8 || stripos($this->nama, 'Namira') !== false) && file_exists(public_path('images/ttd.png'))) {
            return asset('images/ttd.png');
        }

        return null;
    }
}
