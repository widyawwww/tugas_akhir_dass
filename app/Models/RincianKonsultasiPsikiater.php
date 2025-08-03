<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RincianKonsultasiPsikiater extends Model
{
    protected $table = 'rincian_konsultasi_psikiater';

    protected $fillable = [
        'slot_konsultasi_psikiater_jam_id',
        'jumlah_slot',
        'slot_tersisa',
    ];

    public function slotJam()
    {
        return $this->belongsTo(SlotKonsultasiPsikiaterJam::class, 'slot_konsultasi_psikiater_jam_id');
    }


    public function slotKonsultasi()
    {
        return $this->belongsTo(SlotKonsultasiPsikiaterJam::class, 'slot_konsultasi_psikiater_jam_id');
    }
}
