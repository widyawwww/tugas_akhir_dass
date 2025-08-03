<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasis';
    protected $fillable = [
        'gambar',
        'gambar_url',
        'logo',
        'logo_url',
        'nama',
        'tentang',
        'alamat',
        'telepon',
        'email',
        'visi',
        'misi',
        'instagram',
        'tiktok',
    ];
}
