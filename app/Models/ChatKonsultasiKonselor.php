<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatKonsultasiKonselor extends Model
{
    protected $table = 'chat_konsultasi_konselor';

    protected $fillable = [
        'pesan_konsultasi_konselor_id',
    ];
}
