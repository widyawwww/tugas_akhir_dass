<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotKonsultasiKonselor extends Model
{
    protected $table = 'slot_konsultasi_konselor';

    protected $fillable = [
        'konselor_id',
        'tanggal',
    ];

    public function konselor()
    {
        return $this->belongsTo(Konselor::class, 'konselor_id');
    }

    public function jamSlot()
    {
        return $this->hasMany(SlotKonsultasiKonselorJam::class);
    }

    public function slotJam()
    {
        return $this->hasMany(\App\Models\SlotKonsultasiKonselorJam::class, 'slot_konsultasi_konselor_id');
    }

    public function jamSlots()
    {
        return $this->hasMany(SlotKonsultasiKonselorJam::class, 'slot_konsultasi_konselor_id');
    }
}
