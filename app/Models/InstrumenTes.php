<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstrumenTes extends Model
{
    protected $table = 'instrumen_tes';
    protected $fillable = ['nama', 'pembuat', 'tahun', 'deskripsi', 'gambar'];

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }

    public function subskala()
    {
        return $this->hasMany(Subskala::class);
    }

    public function opsiJawaban()
    {
        return $this->hasMany(\App\Models\OpsiJawaban::class);
    }

}

