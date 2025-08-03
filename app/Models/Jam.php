<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    protected $table = 'jam';

    protected $fillable = [
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    // Format jam agar lebih mudah dibaca di Flutter
    protected $casts = [
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
    ];
}
