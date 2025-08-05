<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RincianKonsultasiPsikologKlinis extends Model
{
    protected $table = 'rincian_konsultasi_psikolog_klinis';

    protected $fillable = [
        'slot_konsultasi_psikolog_klinis_jam_id',
        'jumlah_slot',
        'slot_tersisa',
    ];

    public function slotJam()
    {
        return $this->belongsTo(SlotKonsultasiPsikologKlinisJam::class, 'slot_konsultasi_psikolog_klinis_jam_id');
    }


    public function slotKonsultasi()
    {
        return $this->belongsTo(SlotKonsultasiPsikologKlinisJam::class, 'slot_konsultasi_psikolog_klinis_jam_id');
    }
}
