<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotKonsultasiPsikiater extends Model
{
    protected $table = 'slot_konsultasi_psikiater';

    protected $fillable = [
        'psikiater_id',
        'tanggal',
    ];

    public function psikiater()
    {
        return $this->belongsTo(Psikiater::class, 'psikiater_id');
    }

    public function jamSlot()
    {
        return $this->hasMany(SlotKonsultasiPsikiaterJam::class);
    }

    public function slotJam()
    {
        return $this->hasMany(\App\Models\SlotKonsultasiPsikiaterJam::class, 'slot_konsultasi_psikiater_id');
    }

    // --- PERBAIKAN DI SINI ---
    // Kita gunakan satu nama relasi yang konsisten, yaitu 'jamSlots'.
    // Ini akan cocok dengan API Controller untuk konselor yang sudah ada.
    public function jamSlots()
    {
        return $this->hasMany(SlotKonsultasiPsikiaterJam::class, 'slot_konsultasi_psikiater_id');
    }
}
