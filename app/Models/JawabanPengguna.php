<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanPengguna extends Model
{
    protected $table = 'jawaban_pengguna';
    protected $fillable = ['hasil_tes_id', 'pertanyaan_id', 'opsi_jawaban_id'];

    public function hasilTes()
    {
        return $this->belongsTo(HasilTes::class);
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }

    public function opsiJawaban()
    {
        return $this->belongsTo(OpsiJawaban::class);
    }
}

