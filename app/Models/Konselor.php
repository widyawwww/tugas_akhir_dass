<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// 2. EXTENDS Authenticatable
class Konselor extends Authenticatable
{
    // 3. GUNAKAN TRAITS YANG SAMA SEPERTI USER
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'konselor';

    protected $fillable = [
        'nama_lengkap',
        'username',
        'email',
        'password',
        'gambar',
        'spesialisasi',
        'gambar_url',
    ];

    public function slotKonsultasi()
    {
        return $this->hasMany(SlotKonsultasiKonselor::class, 'konselor_id');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atribut yang harus di-cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // <-- Penting agar password otomatis di-hash
    ];
}
