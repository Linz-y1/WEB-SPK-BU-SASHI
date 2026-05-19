<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\HasilRekomendasi;
use App\Models\KuisSoal;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalEkskul = Ekskul::count();
        $totalSiswa = DB::table('siswas')->count();
        $totalKuis = DB::table('kuis_jawabans')->distinct('siswa_id')->count('siswa_id');
        $totalRekomendasi = DB::table('hasil_rekomendasis')->count();
        $recentSiswa = \App\Models\Siswa::with(['kuisJawabans', 'hasilRekomendasi'])
            ->latest('created_at')
            ->limit(5)
            ->get();
        $ekskulPopuler = Ekskul::withCount(['siswas as total'])->orderBy('total', 'desc')->limit(4)->get();

        return view('admin.dashboard', compact(
            'totalEkskul',
            'totalSiswa',
            'totalKuis',
            'totalRekomendasi',
            'recentSiswa',
            'ekskulPopuler'
        ));
    }

    // List siswa
    public function siswaIndex()
    {
        $siswas = \App\Models\Siswa::with(['kuisJawabans', 'hasilRekomendasi', 'ekskuls'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('admin.siswa.index', compact('siswas'));
    }

    public function siswaShow(Siswa $siswa)
    {
        $siswa->load(['kuisJawabans', 'hasilRekomendasi', 'ekskuls']);

        return view('admin.siswa.show', compact('siswa'));
    }

    public function approve(Request $request, int $pivotId)
    {
        $pivot = DB::table('siswa_ekskul')->where('id', $pivotId)->first();
        if (! $pivot) {
            return redirect()->back()->with('error', 'Pendaftaran tidak ditemukan.');
        }

        $ekskul = Ekskul::find($pivot->ekskul_id);
        if ($ekskul) {
            if ($ekskul->quota > 0 && $ekskul->approved_count >= $ekskul->quota) {
                return redirect()->back()->with('error', 'Kuota penuh untuk ekskul ini.');
            }
        }

        DB::table('siswa_ekskul')->where('id', $pivotId)->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        if ($ekskul) {
            $ekskul->increment('approved_count');
        }

        return redirect()->back()->with('success', 'Pendaftaran disetujui.');
    }

    public function reject(Request $request, int $pivotId)
    {
        $pivot = DB::table('siswa_ekskul')->where('id', $pivotId)->first();
        if (! $pivot) {
            return redirect()->back()->with('error', 'Pendaftaran tidak ditemukan.');
        }

        // jika sebelumnya approved, decrement count
        if ($pivot->status === 'approved') {
            $ekskul = Ekskul::find($pivot->ekskul_id);
            if ($ekskul && $ekskul->approved_count > 0) {
                $ekskul->decrement('approved_count');
            }
        }

        DB::table('siswa_ekskul')->where('id', $pivotId)->update([
            'status' => 'rejected',
        ]);

        return redirect()->back()->with('success', 'Pendaftaran ditolak.');
    }

    // Ekskul CRUD
    public function ekskulIndex()
    {
        $ekskuls = Ekskul::withCount(['siswas as siswas_count'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.ekskul.index', compact('ekskuls'));
    }

    public function createEkskul()
    {
        return view('admin.ekskul.create');
    }

    public function storeEkskul(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:ekskuls,slug',
            'icon' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'quota' => 'nullable|integer|min:0',
        ]);

        Ekskul::create($data);
        return redirect()->route('admin.ekskul.index')->with('success', 'Ekskul dibuat.');
    }

    public function editEkskul(Ekskul $ekskul)
    {
        return view('admin.ekskul.edit', compact('ekskul'));
    }

    public function updateEkskul(Request $request, Ekskul $ekskul)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:ekskuls,slug,' . $ekskul->id,
            'icon' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'quota' => 'nullable|integer|min:0',
        ]);

        $ekskul->update($data);
        return redirect()->route('admin.ekskul.index')->with('success', 'Ekskul diperbarui.');
    }

    public function destroyEkskul(Ekskul $ekskul)
    {
        $ekskul->delete();
        return redirect()->route('admin.ekskul.index')->with('success', 'Ekskul dihapus.');
    }

    public function kuisIndex()
    {
        $kuisSoals = KuisSoal::orderBy('order')->paginate(12);

        return view('admin.kuis.index', compact('kuisSoals'));
    }

    public function kuisCreate()
    {
        return view('admin.kuis.create');
    }

    public function kuisStore(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:1000',
            'pilihan' => 'required|array|size:4',
            'pilihan.*' => 'required|string|max:255',
            'jawaban_map' => 'required|array|size:4',
            'jawaban_map.*' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
        ]);

        KuisSoal::create([
            'pertanyaan' => $request->input('pertanyaan'),
            'pilihan' => $request->input('pilihan'),
            'jawaban_map' => $request->input('jawaban_map'),
            'order' => $request->input('order'),
        ]);

        return redirect()->route('admin.kuis.index')->with('success', 'Soal kuis berhasil ditambahkan.');
    }

    public function kuisEdit(KuisSoal $kuisSoal)
    {
        return view('admin.kuis.edit', compact('kuisSoal'));
    }

    public function kuisUpdate(Request $request, KuisSoal $kuisSoal)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:1000',
            'pilihan' => 'required|array|size:4',
            'pilihan.*' => 'required|string|max:255',
            'jawaban_map' => 'required|array|size:4',
            'jawaban_map.*' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
        ]);

        $kuisSoal->update([
            'pertanyaan' => $request->input('pertanyaan'),
            'pilihan' => $request->input('pilihan'),
            'jawaban_map' => $request->input('jawaban_map'),
            'order' => $request->input('order'),
        ]);

        return redirect()->route('admin.kuis.index')->with('success', 'Soal kuis berhasil diperbarui.');
    }

    public function kuisDestroy(KuisSoal $kuisSoal)
    {
        $kuisSoal->delete();
        return redirect()->route('admin.kuis.index')->with('success', 'Soal kuis berhasil dihapus.');
    }

    public function hasilIndex()
    {
        $totalRekomendasi = DB::table('hasil_rekomendasis')->count();
        return view('admin.hasil.index', compact('totalRekomendasi'));
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
