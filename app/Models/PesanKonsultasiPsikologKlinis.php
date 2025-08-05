<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanKonsultasiPsikologKlinis extends Model
{
    protected $table = 'pesan_konsultasi_psikolog_klinis';

    protected $fillable = [
        'user_id',
        'psikolog_klinis_id',
        'slot_psikolog_klinis_jam_id',
        'status',
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function psikolog_klinis()
    {
        return $this->belongsTo(PsikologKlinis::class, 'psikolog_klinis_id');
}

    // --- PERBAIKAN DI SINI ---
    // Nama foreign key harus cocok dengan yang ada di $fillable dan migration.
    public function slotJam()
    {
        return $this->belongsTo(SlotKonsultasiPsikologKlinisJam::class, 'slot_psikolog_klinis_jam_id');
    }
}
