<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuisSoal extends Model
{
    protected $fillable = [
        'pertanyaan',
        'pilihan',
        'jawaban_map',
        'order',
    ];

    protected $casts = [
        'pilihan' => 'array',
        'jawaban_map' => 'array',
    ];

    public static function defaultQuestions(): array
    {
        return [
            [
                'pertanyaan' => 'Di waktu luang, kamu lebih suka melakukan apa?',
                'pilihan' => [
                    'Mendengarkan atau memainkan musik',
                    'Menggambar atau melukis',
                    'Bermain olahraga bersama teman',
                    'Ngoding atau main game',
                ],
                'jawaban_map' => ['musik', 'seni', 'olahraga', 'teknologi'],
                'order' => 1,
            ],
            [
                'pertanyaan' => 'Saat kerja kelompok, peran apa yang paling cocok untukmu?',
                'pilihan' => [
                    'Membuat presentasi yang menarik',
                    'Jadi pemimpin yang mengatur strategi',
                    'Mendokumentasikan kegiatan (foto/video)',
                    'Penulis laporan dan naskah',
                ],
                'jawaban_map' => ['seni', 'olahraga', 'fotografi', 'sastra'],
                'order' => 2,
            ],
            [
                'pertanyaan' => 'Kalau kamu punya energi lebih di sore hari, kamu akan...',
                'pilihan' => [
                    'Latihan atau ikut kompetisi',
                    'Berlatih alat musik atau menyanyi',
                    'Eksplorasi teknologi atau aplikasi baru',
                    'Menonton film atau pertunjukan seni',
                ],
                'jawaban_map' => ['olahraga', 'musik', 'teknologi', 'teater'],
                'order' => 3,
            ],
            [
                'pertanyaan' => 'Prestasi yang paling ingin kamu raih adalah...',
                'pilihan' => [
                    'Juara olimpiade olahraga',
                    'Pentas seni di depan banyak orang',
                    'Buat aplikasi yang dipakai orang lain',
                    'Terbit tulisan atau foto di majalah',
                ],
                'jawaban_map' => ['seni', 'olahraga', 'teknologi', 'sastra'],
                'order' => 4,
            ],
            [
                'pertanyaan' => 'Teman-temanmu sering memujimu karena...',
                'pilihan' => [
                    'Kreatif dan punya selera seni',
                    'Jago teknologi dan problem solving',
                    'Lincah dan semangat bergerak',
                    'Pandai bercerita dan mengekspresikan diri',
                ],
                'jawaban_map' => ['seni', 'teknologi', 'olahraga', 'teater'],
                'order' => 5,
            ],
        ];
    }
}
