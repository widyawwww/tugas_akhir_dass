<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsikologKlinis extends Model
{
    protected $table = 'psikolog_klinis';

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
        return $this->hasMany(SlotKonsultasiPsikologKlinis::class, 'psikolog_klinis_id');
    }
}
