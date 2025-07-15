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

    public function psikiater() {
        return $this->belongsTo(Psikiater::class);
    }

    public function slotJam() {
        return $this->hasMany(SlotKonsultasiPsikiaterJam::class);
    }
    
}
