<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tips extends Model
{
    protected $table = 'tips';

    protected $fillable = [
        'nama',
        'deskripsi_singkat',
        'daftar_tips',
        'gambar',
    ];
}

