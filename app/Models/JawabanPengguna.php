<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanPengguna extends Model
{
    protected $table = 'jawaban_pengguna';
    protected $fillable = ['hasil_tes_id', 'pertanyaan_id', 'opsi_jawaban_id', 'opsi_jawaban_pertanyaan_id'];

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

    public function opsiJawabanPertanyaan()
    {
        return $this->belongsTo(OpsiJawabanPertanyaan::class, 'opsi_jawaban_pertanyaan_id');
    }
}

