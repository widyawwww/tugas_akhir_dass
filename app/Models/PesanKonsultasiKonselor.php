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

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function konselor()
    {
        return $this->belongsTo(Konselor::class, 'konselor_id');
    }
    public function slotJam()
    {
        return $this->belongsTo(SlotKonsultasiKonselorJam::class, 'slot_konsultasi_konselor_jam_id');
    }

    //  satu sesi konsultasi punya banyak pesan chat
    public function pesanChats()
    {
        return $this->hasMany(PesanChat::class, 'pesan_konsultasi_konselor_id');
    }
}
