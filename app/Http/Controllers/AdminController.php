<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalEkskul = Ekskul::count();
        $totalSiswa = DB::table('siswas')->count();
        $pendaftaranPending = DB::table('siswa_ekskul')->where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalEkskul', 'totalSiswa', 'pendaftaranPending'));
    }

    // List pendaftaran (siswa_ekskul)
    public function siswaIndex()
    {
        $items = DB::table('siswa_ekskul')
            ->join('siswas', 'siswa_ekskul.siswa_id', '=', 'siswas.id')
            ->join('ekskuls', 'siswa_ekskul.ekskul_id', '=', 'ekskuls.id')
            ->select('siswa_ekskul.id as pivot_id', 'siswas.*', 'ekskuls.nama as ekskul_nama', 'siswa_ekskul.status')
            ->orderBy('siswa_ekskul.created_at', 'desc')
            ->get();

        return view('admin.siswa.index', compact('items'));
    }

    public function approve(Request $request, $pivotId)
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

    public function reject(Request $request, $pivotId)
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
        $ekskuls = Ekskul::orderBy('created_at', 'desc')->get();
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
}
