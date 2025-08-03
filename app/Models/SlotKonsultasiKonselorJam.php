<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotKonsultasiKonselorJam extends Model
{
    protected $table = 'slot_konsultasi_konselor_jam';

    protected $fillable = [
        'slot_konsultasi_konselor_id',
        'jam_id',
    ];

    public function slotKonsultasi()
    {
        return $this->belongsTo(SlotKonsultasiKonselor::class, 'slot_konsultasi_konselor_id');
    }
    public function jam()
    {
        return $this->belongsTo(Jam::class, 'jam_id');
    }

    public function rincian()
    {
        return $this->hasOne(RincianKonsultasiKonselor::class, 'slot_konsultasi_konselor_jam_id');
    }
}
