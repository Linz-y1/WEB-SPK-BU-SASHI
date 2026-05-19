<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class KuisJawaban extends Model
{
    protected $fillable = ['siswa_id', 'nomor_soal', 'jawaban'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
