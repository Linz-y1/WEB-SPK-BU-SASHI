<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\HasilRekomendasi;
use App\Models\KuisJawaban;
use App\Models\KuisSoal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EkskulController extends Controller
{

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

        // Reset ulang kuis ketika siswa memilih ekskul kembali,
        // sehingga soal baru dari admin bisa muncul kembali.
        $siswa->kuisJawabans()->delete();
        $siswa->hasilRekomendasi()->delete();

        return redirect()->route('ekskul.kuis');
    }

    // ─── HALAMAN KUIS ────────────────────────────────────────────

    public function kuis()
    {
        /** @var Siswa|null $siswa */
        $siswa = Auth::guard('siswa')->user();

        $soalKuis = KuisSoal::orderBy('order')->get();
        if ($soalKuis->isEmpty()) {
            $soalKuis = collect(KuisSoal::defaultQuestions());
        }

        // Ambil nomor soal berikutnya yang belum dijawab
        $sudahDijawab = $siswa->kuisJawabans()->pluck('nomor_soal')->toArray();
        $totalSoal    = count($soalKuis);
        $nomorBerikut = null;

        if ($totalSoal > 0) {
            $semuaNomorSoal = $soalKuis->keys()->toArray();
            $belumDijawab = array_values(array_filter($semuaNomorSoal, function ($nomor) use ($sudahDijawab) {
                return ! in_array($nomor, $sudahDijawab, true);
            }));

            $nomorBerikut = $belumDijawab[0] ?? null;
        }

        // Semua soal sudah dijawab atau tidak ada soal tersedia → ke halaman terima kasih
        if ($nomorBerikut === null) {
            return redirect()->route('ekskul.terimakasih');
        }

        $soal        = $soalKuis[$nomorBerikut];
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

        $soalKuis = KuisSoal::orderBy('order')->get();
        if ($soalKuis->isEmpty()) {
            $soalKuis = collect(KuisSoal::defaultQuestions());
        }

        // Skor dari jawaban kuis
        foreach ($siswa->kuisJawabans as $jawaban) {
            $nomor = $jawaban->nomor_soal;
            $idx   = $jawaban->jawaban;
            $slug  = data_get($soalKuis->get($nomor), 'jawaban_map.' . $idx);

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