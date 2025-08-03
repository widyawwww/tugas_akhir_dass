<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';
    protected $fillable = ['nama', 'gambar', 'gambar_url', 'deskripsi_singkat', 'deskripsi'];

    public function instrumenTes()
    {
        return $this->belongsToMany(InstrumenTes::class, 'instrumen_tes_artikel', 'artikel_id', 'instrumen_tes_id');
    }

}
