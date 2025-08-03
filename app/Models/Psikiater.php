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
        'gambar_url',
        'spesialisasi',
        'sipp',
        'biaya_layanan',
        'lokasi_pelayanan',
    ];

    public function slotKonsultasi()
    {
        return $this->hasMany(SlotKonsultasiPsikiater::class, 'psikiater_id');
    }
}
