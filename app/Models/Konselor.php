<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Konselor extends Authenticatable
{
    protected $table = 'konselor';

    protected $fillable = [
        'nama_lengkap',
        'username',
        'email',
        'password',
        'gambar',
        'tanggal_lahir',
        'jenis_kelamin',
        'spesialisasi',
        'nomor_lisensi',
    ];
}
