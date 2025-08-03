<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanChat extends Model
{
    use HasFactory;
    protected $table = 'pesan_chat';
    protected $fillable = ['pesan_konsultasi_konselor_id', 'pengirim_id', 'tipe_pengirim', 'pesan'];

    // Relasi untuk mendapatkan data pengirim (bisa User atau Konselor)
    public function pengirim()
    {
        return $this->morphTo();
    }
}
