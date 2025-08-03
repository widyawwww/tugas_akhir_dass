<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilTes extends Model
{
    protected $table = 'hasil_tes';
    protected $fillable = ['user_id', 'instrumen_tes_id', 'skor_total', 'tingkatan', 'status', 'tanggal_tes'];

    public function subskalaHasil()
    {
        return $this->hasMany(SubskalaHasil::class, 'hasil_tes_id');
    }
    public function instrumen()
    {
        return $this->belongsTo(InstrumenTes::class, 'instrumen_tes_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
