<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    protected $table = 'jam';

    protected $fillable = [
        'jam_mulai',
        'jam_selesai',
    ];
}
