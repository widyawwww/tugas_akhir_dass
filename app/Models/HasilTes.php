<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilTes extends Model
{
    protected $table = 'hasil_tes';
    protected $fillable = ['user_id', 'instrumen_tes_id', 'skor_total', 'tingkatan', 'status', 'tanggal_tes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instrumenTes()
    {
        return $this->belongsTo(InstrumenTes::class);
    }

    public function jawabanPengguna()
    {
        return $this->hasMany(JawabanPengguna::class);
    }
}

