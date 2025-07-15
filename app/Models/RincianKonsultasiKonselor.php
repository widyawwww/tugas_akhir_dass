<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RincianKonsultasiKonselor extends Model
{
    protected $table = 'rincian_konsultasi_konselor';

    protected $fillable = [
        'slot_konsultasi_konselor_jam_id',
        'jumlah_slot',
        'slot_tersisa',
    ];

    public function slotJam()
    {
        return $this->belongsTo(SlotKonsultasiKonselorJam::class, 'slot_konsultasi_konselor_jam_id');
    }

    public function slotKonsultasi()
    {
        return $this->belongsTo(SlotKonsultasiKonselor::class, 'slot_konsultasi_konselor_id');
    }


}
