<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InstrumenTes extends Model
{
    protected $table = 'instrumen_tes';
    protected $fillable = ['nama', 'pembuat', 'tahun', 'deskripsi', 'gambar', 'gambar_url', 'instrumen_tes_artikel_id', 'instrumen_tes_tips_id'];

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class, 'instrumen_tes_id')->orderBy('id', 'asc');
    }
    public function subskala()
    {
        return $this->hasMany(Subskala::class, 'instrumen_tes_id');
    }

    public function opsiJawaban()
    {
        return $this->hasMany(OpsiJawaban::class, 'instrumen_tes_id');
    }

    public function artikel()
    {
        return $this->belongsToMany(Artikel::class, 'instrumen_tes_artikel', 'instrumen_tes_id', 'artikel_id');
    }

    public function tips()
    {
        return $this->belongsToMany(Tips::class, 'instrumen_tes_tips', 'instrumen_tes_id', 'tips_id');
    }

}
