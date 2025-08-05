<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotKonsultasiPsikologKlinisJam extends Model
{
    protected $table = 'slot_konsultasi_psikolog_klinis_jam';

    protected $fillable = [
        'slot_konsultasi_psikolog_klinis_id',
        'jam_id',
    ];

    public function slotKonsultasi()
    {
        return $this->belongsTo(SlotKonsultasiPsikologKlinis::class, 'slot_konsultasi_psikolog_klinis_id');
    }

    public function jam()
    {
        return $this->belongsTo(Jam::class, 'jam_id');
    }

    public function rincian()
    {
        return $this->hasOne(RincianKonsultasiPsikologKlinis::class, 'slot_konsultasi_psikolog_klinis_jam_id');
    }
}
