<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class HasilRekomendasi extends Model
{
    protected $fillable = ['siswa_id', 'rekomendasi_ekskul'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
