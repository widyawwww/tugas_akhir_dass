<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpsiJawaban extends Model
{
    protected $table = 'opsi_jawaban';
    protected $fillable = ['instrumen_tes_id', 'teks_opsi', 'skor'];

    public function instrumen()
    {
        return $this->belongsTo(\App\Models\InstrumenTes::class);
    }

}

