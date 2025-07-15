<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanKonsultasiPsikiater extends Model
{
    protected $table = 'pesan_konsultasi_psikiater';

    protected $fillable = [
        'user_id',
        'psikiater_id',
        'slot_psikiater_jam_id',
        'status',
    ];

        public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function psikiater()
    {
        return $this->belongsTo(Psikiater::class, 'psikiater_id');
    }

    public function slotJam()
    {
        return $this->belongsTo(SlotKonsultasiPsikiaterJam::class, 'slot_psikiater_jam_id');
    }
}
