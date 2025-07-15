<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subskala extends Model
{
    protected $table = 'subskala';

    protected $fillable = [
        'instrumen_tes_id',
        'nama',
    ];

    public function instrumenTes()
    {
        return $this->belongsTo(InstrumenTes::class);
    }

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }
}
