<?php

namespace App\Models;
use App\Models\Ekskul;
use App\Models\KuisJawaban;
use App\Models\HasilRekomendasi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'nomor_siswa',
        'password',
        'kelas',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke ekskul yang dipilih (many-to-many)
    public function ekskuls()
    {
        return $this->belongsToMany(Ekskul::class, 'siswa_ekskul');
    }

    // Relasi ke jawaban kuis
    public function kuisJawabans()
    {
        return $this->hasMany(KuisJawaban::class);
    }

    // Relasi ke hasil rekomendasi
    public function hasilRekomendasi()
    {
        return $this->hasOne(HasilRekomendasi::class);
    }
}
