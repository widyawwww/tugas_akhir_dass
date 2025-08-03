<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';
    protected $fillable = ['instrumen_tes_id', 'teks_pertanyaan', 'urutan', 'subskala_id'];

    public function subskala()
    {
        return $this->belongsTo(Subskala::class, 'subskala_id');
    }

    // App/Models/Pertanyaan.php
    public function opsiJawabanPertanyaan()
    {
        return $this->hasMany(OpsiJawabanPertanyaan::class, 'pertanyaan_id');
    }

}
