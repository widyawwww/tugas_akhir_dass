<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Psikiater extends Model
{
    protected $table = 'psikiater';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'gambar',
        'spesialisasi',
        'nomor_lisensi',
        'biaya_layanan',
        'lokasi_pelayanan',
    ];
}
