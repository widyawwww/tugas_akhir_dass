<?php

namespace App\Models;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;

class Tips extends Model
{
    protected $table = 'tips';

    protected $fillable = [
        'nama',
        'deskripsi_singkat',
        'daftar_tips',
        'gambar',
        'gambar_url'
    ];

    public function getGambarAttribute($value)
    {
        // $value adalah nilai asli dari kolom 'gambar' di database
        // (contoh: 'tips/gambar-stres.jpg')

        if ($value) {
            // Fungsi url() akan membuat URL lengkap berdasarkan APP_URL Anda
            // dan menggabungkannya dengan path ke storage.
            return url('storage/' . $value);
        }

        // Jika kolom 'gambar' kosong (null), kembalikan null.
        return null;
    }

    public function instrumen()
    {
        return $this->belongsToMany(InstrumenTes::class, 'instrumen_tes_tips', 'tips_id', 'instrumen_tes_id');
    }

}
