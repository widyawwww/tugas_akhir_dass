<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotKonsultasiPsikiaterJam extends Model
{
    protected $table = 'slot_konsultasi_psikiater_jam';

    protected $fillable = [
        'slot_konsultasi_psikiater_id',
        'jam_id',
    ];

    public function slotKonsultasi()
    {
        return $this->belongsTo(SlotKonsultasiPsikiater::class, 'slot_konsultasi_psikiater_id');
    }

    public function jam()
    {
        return $this->belongsTo(Jam::class, 'jam_id');
    }

    public function rincian()
    {
        return $this->hasOne(RincianKonsultasiPsikiater::class, 'slot_konsultasi_psikiater_jam_id');
    }
}
