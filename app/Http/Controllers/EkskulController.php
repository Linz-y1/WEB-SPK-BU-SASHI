<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\HasilRekomendasi;
use App\Models\KuisJawaban;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EkskulController extends Controller
{
    // Data soal kuis (bisa dipindah ke config/database kalau mau)
    private array $soalKuis = [
        [
            'pertanyaan' => 'Di waktu luang, kamu lebih suka melakukan apa?',
            'pilihan'    => [
                'Mendengarkan atau memainkan musik',
                'Menggambar atau melukis',
                'Bermain olahraga bersama teman',
                'Ngoding atau main game',
            ],
        ],
        [
            'pertanyaan' => 'Saat kerja kelompok, peran apa yang paling cocok untukmu?',
            'pilihan'    => [
                'Membuat presentasi yang menarik',
                'Jadi pemimpin yang mengatur strategi',
                'Mendokumentasikan kegiatan (foto/video)',
                'Penulis laporan dan naskah',
            ],
        ],
        [
            'pertanyaan' => 'Kalau kamu punya energi lebih di sore hari, kamu akan...',
            'pilihan'    => [
                'Latihan atau ikut kompetisi',
                'Berlatih alat musik atau menyanyi',
                'Eksplorasi teknologi atau aplikasi baru',
                'Menonton film atau pertunjukan seni',
            ],
        ],
        [
            'pertanyaan' => 'Prestasi yang paling ingin kamu raih adalah...',
            'pilihan'    => [
                'Juara olimpiade olahraga',
                'Pentas seni di depan banyak orang',
                'Buat aplikasi yang dipakai orang lain',
                'Terbit tulisan atau foto di majalah',
            ],
        ],
        [
            'pertanyaan' => 'Teman-temanmu sering memujimu karena...',
            'pilihan'    => [
                'Kreatif dan punya selera seni',
                'Jago teknologi dan problem solving',
                'Lincah dan semangat bergerak',
                'Pandai bercerita dan mengekspresikan diri',
            ],
        ],
    ];

    // Mapping jawaban ke slug ekskul
    private array $jawabanMap = [
        0 => ['musik',     'seni',     'olahraga', 'teknologi'],
        1 => ['seni',      'olahraga', 'fotografi','sastra'],
        2 => ['olahraga',  'musik',    'teknologi','teater'],
        3 => ['seni',      'olahraga', 'teknologi','sastra'],
        4 => ['seni',      'teknologi','olahraga', 'teater'],
    ];

    // ─── HALAMAN PILIH EKSKUL ────────────────────────────────────

    public function pilih()
    {
        /** @var Siswa|null $siswa */
        $siswa  = Auth::guard('siswa')->user();
        $ekskuls = Ekskul::all();
        $terpilih = $siswa->ekskuls->pluck('slug')->toArray();

        return view('ekskul.pilih', compact('ekskuls', 'terpilih'));
    }

    public function simpanPilihan(Request $request)
    {
        $request->validate([
            'ekskul_ids'   => ['required', 'array', 'min:1'],
            'ekskul_ids.*' => ['exists:ekskuls,id'],
        ], [
            'ekskul_ids.required' => 'Pilih minimal satu ekskul dulu ya!',
            'ekskul_ids.min'      => 'Pilih minimal satu ekskul dulu ya!',
        ]);

        /** @var Siswa|null $siswa */
        $siswa = Auth::guard('siswa')->user();
        $siswa->ekskuls()->sync($request->ekskul_ids);

        return redirect()->route('ekskul.kuis');
    }

    // ─── HALAMAN KUIS ────────────────────────────────────────────

    public function kuis()
    {
        /** @var Siswa|null $siswa */
        $siswa = Auth::guard('siswa')->user();

        // Ambil nomor soal berikutnya yang belum dijawab
        $sudahDijawab = $siswa->kuisJawabans()->pluck('nomor_soal')->toArray();
        $totalSoal    = count($this->soalKuis);
        $nomorBerikut = null;

        for ($i = 0; $i < $totalSoal; $i++) {
            if (!in_array($i, $sudahDijawab)) {
                $nomorBerikut = $i;
                break;
            }
        }

        // Semua soal sudah dijawab → ke halaman terima kasih
        if ($nomorBerikut === null) {
            return redirect()->route('ekskul.terimakasih');
        }

        $soal        = $this->soalKuis[$nomorBerikut];
        $progress    = (count($sudahDijawab) / $totalSoal) * 100;
        $nomor       = $nomorBerikut + 1;

        return view('ekskul.kuis', compact('soal', 'nomor', 'totalSoal', 'progress'));
    }

    public function simpanJawaban(Request $request)
    {
        $request->validate([
            'nomor_soal' => ['required', 'integer', 'min:0'],
            'jawaban'    => ['required', 'integer', 'min:0', 'max:3'],
        ]);

        /** @var Siswa|null $siswa */
        $siswa = Auth::guard('siswa')->user();

        KuisJawaban::updateOrCreate(
            ['siswa_id' => $siswa->id, 'nomor_soal' => $request->nomor_soal],
            ['jawaban'  => $request->jawaban]
        );

        return redirect()->route('ekskul.kuis');
    }

    // ─── HALAMAN TERIMA KASIH ────────────────────────────────────

    public function terimakasih()
    {
        return view('ekskul.terimakasih');
    }

    // ─── HALAMAN HASIL REKOMENDASI ───────────────────────────────

    public function hasil()
    {
        /** @var Siswa|null $siswa */
        $siswa = Auth::guard('siswa')->user();

        // Hitung atau ambil hasil yang sudah tersimpan
        $hasil = $siswa->hasilRekomendasi;

        if (!$hasil) {
            $rekomendasiSlug = $this->hitungRekomendasi($siswa);

            $hasil = HasilRekomendasi::create([
                'siswa_id'           => $siswa->id,
                'rekomendasi_ekskul' => $rekomendasiSlug,
            ]);
        }

        $ekskul = Ekskul::where('slug', $hasil->rekomendasi_ekskul)->first();

        return view('ekskul.hasil', compact('ekskul', 'siswa'));
    }

    // ─── LOGIC PERHITUNGAN ───────────────────────────────────────

    private function hitungRekomendasi(Siswa $siswa): string
{
    $skor = [];

    // Skor dari pilihan ekskul
    foreach ($siswa->ekskuls as $ekskul) {
        $skor[$ekskul->slug] = ($skor[$ekskul->slug] ?? 0) + 3;
    }

    // Skor dari jawaban kuis
    foreach ($siswa->kuisJawabans as $jawaban) {
        $nomor = $jawaban->nomor_soal;
        $idx   = $jawaban->jawaban;
        $slug  = $this->jawabanMap[$nomor][$idx] ?? null;

        if ($slug) {
            $skor[$slug] = ($skor[$slug] ?? 0) + 2;
        }
    }

    if (empty($skor)) {
        return 'musik';
    }

    arsort($skor);

    return array_key_first($skor);
}

}