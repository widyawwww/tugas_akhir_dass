<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpsiJawabanPertanyaan extends Model
{
    protected $table = 'opsi_jawaban_pertanyaan';

    protected $fillable = [
        'pertanyaan_id',
        'teks_opsi',
        'skor',
    ];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }
}

