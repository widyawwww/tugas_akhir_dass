<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';
    protected $fillable = ['instrumen_tes_id', 'teks_pertanyaan', 'urutan', 'subskala_id'];

    public function opsiJawaban()
    {
        return $this->hasMany(OpsiJawaban::class);
    }

    public function instrumenTes()
    {
        return $this->belongsTo(InstrumenTes::class);
    }

    public function subskala()
    {
        return $this->belongsTo(Subskala::class);
    }
}

