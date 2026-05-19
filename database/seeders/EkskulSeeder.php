<?php

namespace Database\Seeders;

use App\Models\Ekskul;
use Illuminate\Database\Seeder;

class EkskulSeeder extends Seeder
{
    public function run(): void
    {
        $ekskuls = [
            [
                'nama'      => 'Musik',
                'slug'      => 'musik',
                'icon'      => '🎵',
                'deskripsi' => 'Mengasah bakat vokal dan instrumen musik. Cocok untuk kamu yang suka berekspresi lewat melodi.',
            ],
            [
                'nama'      => 'Seni Rupa',
                'slug'      => 'seni',
                'icon'      => '🎨',
                'deskripsi' => 'Wadah mengembangkan bakat melukis, menggambar, dan seni visual lainnya.',
            ],
            [
                'nama'      => 'Olahraga',
                'slug'      => 'olahraga',
                'icon'      => '⚽',
                'deskripsi' => 'Berprestasi di berbagai cabang olahraga dan mengembangkan jiwa sportivitas.',
            ],
            [
                'nama'      => 'Teknologi / IT Club',
                'slug'      => 'teknologi',
                'icon'      => '💻',
                'deskripsi' => 'Mengembangkan skill coding, desain digital, dan inovasi teknologi masa depan.',
            ],
            [
                'nama'      => 'Tari',
                'slug'      => 'tari',
                'icon'      => '💃',
                'deskripsi' => 'Belajar seni gerak dan tari, tampil percaya diri di atas panggung.',
            ],
            [
                'nama'      => 'Sastra & Jurnalistik',
                'slug'      => 'sastra',
                'icon'      => '📖',
                'deskripsi' => 'Mengasah kemampuan menulis, bercerita, dan jurnalistik sekolah.',
            ],
            [
                'nama'      => 'Fotografi',
                'slug'      => 'fotografi',
                'icon'      => '📷',
                'deskripsi' => 'Belajar seni fotografi dan mendokumentasikan cerita lewat gambar.',
            ],
            [
                'nama'      => 'Teater',
                'slug'      => 'teater',
                'icon'      => '🎭',
                'deskripsi' => 'Mengembangkan kepercayaan diri dan kemampuan akting di atas panggung.',
            ],
            [
                'nama'      => 'Pramuka',
                'slug'      => 'pramuka',
                'icon'      => '⛺',
                'deskripsi' => 'Membentuk karakter, kepemimpinan, dan jiwa petualang yang tangguh.',
            ],
        ];

        foreach ($ekskuls as $data) {
            Ekskul::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}