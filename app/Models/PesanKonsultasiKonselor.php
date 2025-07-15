<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanKonsultasiKonselor extends Model
{
    protected $table = 'pesan_konsultasi_konselor';

    protected $fillable = [
        'user_id',
        'konselor_id',
        'slot_konsultasi_konselor_jam_id',
        'status',
    ];
}
