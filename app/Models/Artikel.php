<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';
    protected $fillable = ['nama', 'gambar', 'deskripsi_singkat', 'deskripsi'];
}

