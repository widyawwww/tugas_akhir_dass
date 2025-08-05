<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotKonsultasiPsikologKlinis extends Model
{
    protected $table = 'slot_konsultasi_psikolog_klinis';

    protected $fillable = [
        'psikolog_klinis_id',
        'tanggal',
    ];

    public function psikologKlinis()
    {
        return $this->belongsTo(PsikologKlinis::class, 'psikolog_klinis_id');
    }

    public function jamSlot()
    {
        return $this->hasMany(SlotKonsultasiPsikologKlinisJam::class);
    }

    public function slotJam()
    {
        return $this->hasMany(\App\Models\SlotKonsultasiPsikologKlinisJam::class, 'slot_konsultasi_psikolog_klinis_id');
    }

    // --- PERBAIKAN DI SINI ---
    // Kita gunakan satu nama relasi yang konsisten, yaitu 'jamSlots'.
    // Ini akan cocok dengan API Controller untuk konselor yang sudah ada.
    public function jamSlots()
    {
        return $this->hasMany(SlotKonsultasiPsikologKlinisJam::class, 'slot_konsultasi_psikolog_klinis_id');
    }
}
