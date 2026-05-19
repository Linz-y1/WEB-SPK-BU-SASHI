<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Ekskul extends Model
{
    protected $fillable = ['nama', 'slug', 'icon', 'deskripsi', 'quota', 'approved_count'];
 
    public function siswas()
    {
        return $this->belongsToMany(Siswa::class, 'siswa_ekskul');
    }
}
