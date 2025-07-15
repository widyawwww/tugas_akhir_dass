<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubskalaHasil extends Model
{
    protected $table = 'subskala_hasil';

    protected $fillable = [
        'hasil_tes_id',
        'subskala_id',
        'skor',
        'tingkatan',
    ];

    public function hasilTes()
    {
        return $this->belongsTo(HasilTes::class);
    }

    public function subskala()
    {
        return $this->belongsTo(Subskala::class);
    }
}
