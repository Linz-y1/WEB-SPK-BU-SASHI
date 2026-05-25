@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'DASHBOARD')
@section('page-subtitle', 'Ringkasan data ekstrakurikuler sekolah')

@section('content')

{{-- Floating Decorations --}}
<div class="deco-layer" aria-hidden="true">
    {{-- Bubbles --}}
    <div class="bubble b1"></div>
    <div class="bubble b2"></div>
    <div class="bubble b3"></div>
    <div class="bubble b4"></div>
    <div class="bubble b5"></div>
    <div class="bubble b6"></div>

    {{-- Stars --}}
    <div class="star s1">✦</div>
    <div class="star s2">✧</div>
    <div class="star s3">✦</div>
    <div class="star s4">✧</div>
    <div class="star s5">⋆</div>
    <div class="star s6">✦</div>

    {{-- Sticker blobs --}}
    <div class="sticker sticker-cherry">🌸</div>
    <div class="sticker sticker-leaf">🍃</div>
    <div class="sticker sticker-sparkle">✨</div>
    <div class="sticker sticker-flower">🌺</div>
    <div class="sticker sticker-blossom">🌷</div>

    {{-- Petal rain --}}
    <div class="petal p1">🌸</div>
    <div class="petal p2">🌸</div>
    <div class="petal p3">🌸</div>
    <div class="petal p4">🌸</div>
    <div class="petal p5">🌸</div>
</div>

<style>
/* ─── Root Palette ─── */
:root {
    --sakura-100: #fff0f5;
    --sakura-200: #ffd6e7;
    --sakura-300: #ffb3c6;
    --sakura-400: #ff85a1;
    --sakura-500: #f4587a;
    --sage-100:   #edf7f0;
    --sage-200:   #c3e8cc;
    --sage-300:   #8ecf9e;
    --sage-400:   #5ab47a;
    --peach-100:  #fff4ed;
    --peach-200:  #ffd9be;
    --sky-100:    #eaf4ff;
    --sky-200:    #bde0ff;
    --sky-400:    #60b8f5;
    --cream:      #fffbf6;
    --text-dark:  #3a2a35;
    --text-mid:   #7a5f6e;
    --text-soft:  #b49aaa;
    --shadow-pink: 0 8px 32px rgba(244,88,122,0.12);
    --shadow-sage: 0 8px 32px rgba(90,180,122,0.12);
}

/* ─── Page Background ─── */
body, .page-content, .content-area {
    background: linear-gradient(160deg, #fff6f9 0%, #f0faf2 40%, #fff9f0 80%, #fdf3ff 100%) !important;
    position: relative;
    overflow-x: hidden;
}

/* ─── Decorative Layer ─── */
.deco-layer {
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 0;
    overflow: hidden;
}

/* Bubbles */
.bubble {
    position: absolute;
    border-radius: 50%;
    animation: floatBubble linear infinite;
    opacity: 0.45;
}
.b1 { width:80px;height:80px;  left:5%;  top:15%; background:radial-gradient(circle at 30% 30%, #ffd6e7, #ffb3c6); animation-duration:18s; animation-delay:0s; }
.b2 { width:50px;height:50px;  right:8%; top:30%; background:radial-gradient(circle at 30% 30%, #c3e8cc, #8ecf9e); animation-duration:22s; animation-delay:-5s; }
.b3 { width:120px;height:120px;left:55%; top:60%; background:radial-gradient(circle at 30% 30%, #bde0ff, #90c8f9); animation-duration:26s; animation-delay:-10s; }
.b4 { width:40px;height:40px;  left:20%; top:70%; background:radial-gradient(circle at 30% 30%, #ffd9be, #ffb385); animation-duration:15s; animation-delay:-3s; }
.b5 { width:70px;height:70px;  right:20%;top:10%; background:radial-gradient(circle at 30% 30%, #e8d5ff, #cfb0ff); animation-duration:20s; animation-delay:-8s; }
.b6 { width:55px;height:55px;  left:75%; top:80%; background:radial-gradient(circle at 30% 30%, #ffd6e7, #ffb3c6); animation-duration:24s; animation-delay:-14s; }

@keyframes floatBubble {
    0%   { transform: translateY(0)   scale(1)    rotate(0deg); }
    33%  { transform: translateY(-40px) scale(1.05) rotate(5deg); }
    66%  { transform: translateY(-20px) scale(0.97) rotate(-3deg); }
    100% { transform: translateY(0)   scale(1)    rotate(0deg); }
}

/* Stars */
.star {
    position: absolute;
    font-size: 18px;
    color: var(--sakura-400);
    animation: twinkle ease-in-out infinite;
    opacity: 0.7;
}
.s1 { top: 8%;  left: 18%; animation-duration:2.5s; animation-delay:0s;    font-size:14px; }
.s2 { top: 22%; right:15%; animation-duration:3.2s; animation-delay:0.6s;  font-size:20px; color: var(--sage-400); }
.s3 { top: 55%; left:10%;  animation-duration:2.8s; animation-delay:1.1s;  font-size:12px; }
.s4 { top: 65%; right:6%;  animation-duration:3.6s; animation-delay:0.3s;  font-size:16px; color: var(--sky-400); }
.s5 { top: 40%; left:48%;  animation-duration:2.2s; animation-delay:1.8s;  font-size:22px; color: #f9c6e0; }
.s6 { top: 85%; left:35%;  animation-duration:3.0s; animation-delay:0.9s;  font-size:10px; }

@keyframes twinkle {
    0%,100% { opacity:0.3; transform:scale(1)    rotate(0deg); }
    50%      { opacity:1;   transform:scale(1.3)  rotate(20deg); }
}

/* Stickers */
.sticker {
    position: absolute;
    font-size: 28px;
    animation: stickerFloat ease-in-out infinite;
    filter: drop-shadow(0 2px 4px rgba(244,88,122,0.25));
}
.sticker-cherry  { top:5%;  left:3%;   animation-duration:6s;  animation-delay:0s; }
.sticker-leaf    { top:88%; left:6%;   animation-duration:7s;  animation-delay:1s; }
.sticker-sparkle { top:45%; right:3%;  animation-duration:5s;  animation-delay:2s; }
.sticker-flower  { top:15%; right:2%;  animation-duration:8s;  animation-delay:0.5s; }
.sticker-blossom { top:70%; right:12%; animation-duration:6.5s;animation-delay:1.5s; }

@keyframes stickerFloat {
    0%,100% { transform:translateY(0)   rotate(-5deg); }
    50%      { transform:translateY(-12px) rotate(5deg); }
}

/* Falling petals */
.petal {
    position: absolute;
    top: -40px;
    font-size: 16px;
    opacity: 0;
    animation: petalFall linear infinite;
}
.p1 { left:12%; animation-duration:8s;  animation-delay:0s; }
.p2 { left:35%; animation-duration:10s; animation-delay:2s; }
.p3 { left:60%; animation-duration:9s;  animation-delay:4s; }
.p4 { left:78%; animation-duration:11s; animation-delay:1s; }
.p5 { left:90%; animation-duration:7s;  animation-delay:3s; }

@keyframes petalFall {
    0%   { top:-40px; opacity:0; transform:translateX(0)   rotate(0deg); }
    10%  { opacity:0.8; }
    90%  { opacity:0.6; }
    100% { top:110vh;  opacity:0; transform:translateX(80px) rotate(360deg); }
}

/* ─── Content sits above deco ─── */
.stat-grid, .card, .content-area > div {
    position: relative;
    z-index: 1;
}

/* ─── Stat Cards ─── */
.stat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 18px;
    margin-bottom: 24px;
}

.stat-card {
    background: rgba(255,255,255,0.82);
    backdrop-filter: blur(12px);
    border: 1.5px solid rgba(255,179,198,0.35);
    border-radius: 22px;
    padding: 22px 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    box-shadow: var(--shadow-pink);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    position: relative;
    overflow: hidden;
}
.stat-card::before {
    content:'';
    position:absolute;
    top:-30px; right:-30px;
    width:90px; height:90px;
    border-radius:50%;
    opacity:0.12;
    background: var(--blob-color, var(--sakura-300));
}
.stat-card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 16px 48px rgba(244,88,122,0.18);
}

.stat-icon {
    width: 52px; height: 52px;
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
}
.stat-icon.pink   { background: linear-gradient(135deg,#ffb3c6,#f4587a); color:#fff; --blob-color:var(--sakura-300); box-shadow:0 4px 16px rgba(244,88,122,0.35); }
.stat-icon.green  { background: linear-gradient(135deg,#8ecf9e,#5ab47a); color:#fff; --blob-color:var(--sage-300);   box-shadow:0 4px 16px rgba(90,180,122,0.35); }
.stat-icon.peach  { background: linear-gradient(135deg,#ffd9be,#ffaa70); color:#fff; --blob-color:var(--peach-200);  box-shadow:0 4px 16px rgba(255,170,112,0.35); }
.stat-icon.sky    { background: linear-gradient(135deg,#bde0ff,#60b8f5); color:#fff; --blob-color:var(--sky-200);    box-shadow:0 4px 16px rgba(96,184,245,0.35); }

.stat-value {
    font-size: 30px;
    font-weight: 700;
    color: var(--text-dark);
    line-height: 1;
    font-family: 'Poppins', 'Nunito', sans-serif;
}
.stat-label {
    font-size: 12px;
    color: var(--text-mid);
    font-weight: 500;
    margin-top: 4px;
    letter-spacing: 0.3px;
}
.stat-badge {
    display: inline-block;
    margin-top: 6px;
    font-size: 11px;
    background: linear-gradient(90deg,#ffd6e7,#ffb3c6);
    color: var(--sakura-500);
    border-radius: 20px;
    padding: 2px 10px;
    font-weight: 600;
}

/* ─── Cards ─── */
.card {
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(14px);
    border-radius: 24px;
    border: 1.5px solid rgba(255,179,198,0.25);
    box-shadow: 0 4px 24px rgba(244,88,122,0.08);
    overflow: hidden;
    position: relative;
}
.card::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #ffb3c6, #8ecf9e, #bde0ff, #ffd9be);
    border-radius: 24px 24px 0 0;
}

.card-header {
    padding: 18px 22px 14px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid rgba(255,179,198,0.2);
}
.card-header h3 {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-dark);
    display: flex;
    align-items: center;
    gap: 8px;
}
.card-header h3::before {
    content: '✦';
    font-size: 10px;
    color: var(--sakura-400);
}

.card-body { padding: 18px 22px; }

/* ─── Buttons ─── */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 18px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s ease;
    border: none;
}
.btn-primary {
    background: linear-gradient(135deg,#ffb3c6,#f4587a);
    color: #fff;
    box-shadow: 0 4px 14px rgba(244,88,122,0.35);
}
.btn-primary:hover { transform:translateY(-2px); box-shadow:0 8px 20px rgba(244,88,122,0.45); }

.btn-green {
    background: linear-gradient(135deg,#8ecf9e,#5ab47a);
    color: #fff;
    box-shadow: 0 4px 14px rgba(90,180,122,0.3);
}
.btn-green:hover { transform:translateY(-2px); }

.btn-outline {
    background: rgba(255,255,255,0.9);
    color: var(--sakura-500);
    border: 1.5px solid rgba(255,179,198,0.6);
    box-shadow: 0 2px 8px rgba(244,88,122,0.08);
}
.btn-outline:hover { background: var(--sakura-100); transform:translateY(-1px); }

.btn-sm { padding:6px 14px; font-size:12px; }
.btn-icon { padding:7px 10px; }

/* ─── Table ─── */
.table-wrap { overflow-x: auto; }
table { width:100%; border-collapse:collapse; font-size:13.5px; }
thead tr { background: linear-gradient(90deg,rgba(255,214,231,0.4),rgba(195,232,204,0.4)); }
th { padding:12px 16px; text-align:left; color:var(--text-mid); font-weight:700; font-size:12px; letter-spacing:0.5px; text-transform:uppercase; }
td { padding:13px 16px; color:var(--text-dark); border-bottom:1px solid rgba(255,179,198,0.12); }
tbody tr:hover { background: rgba(255,240,245,0.6); }

/* ─── Badges ─── */
.badge {
    display: inline-block;
    padding: 3px 12px;
    border-radius: 20px;
    font-size: 11.5px;
    font-weight: 600;
}
.badge-green { background:linear-gradient(90deg,#c3e8cc,#8ecf9e); color:#2a6e40; }
.badge-gray  { background:#f0ece8; color:#9a8a90; }
.badge-pink  { background:linear-gradient(90deg,#ffd6e7,#ffb3c6); color:#c0325a; }

/* ─── Ekskul list ─── */
.ekskul-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid rgba(255,179,198,0.12);
}
.ekskul-item:last-child { border-bottom: none; }
.ekskul-icon-wrap {
    width: 40px; height: 40px;
    border-radius: 12px;
    background: linear-gradient(135deg,#fff0f5,#ffd6e7);
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    border: 1.5px solid rgba(255,179,198,0.3);
}

/* ─── Section title ribbon ─── */
.section-ribbon {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 18px;
}
.section-ribbon-bar {
    height: 3px;
    flex: 1;
    border-radius: 2px;
    background: linear-gradient(90deg,#ffb3c6 0%,#8ecf9e 50%,transparent 100%);
}

/* ─── Avatar circle ─── */
.avatar {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg,#ffb3c6,#f4587a);
    display: flex; align-items: center; justify-content: center;
    color: #fff;
    font-weight: 700;
    font-size: 13px;
    border: 2px solid rgba(255,255,255,0.9);
    box-shadow: 0 2px 8px rgba(244,88,122,0.25);
    flex-shrink: 0;
}
</style>

{{-- Page heading decoration --}}
<div class="section-ribbon">
    <span style="font-size:11px;font-weight:700;color:var(--sakura-400);letter-spacing:1px;text-transform:uppercase;">Overview</span>
    <div class="section-ribbon-bar"></div>
    <span style="font-size:18px;">🌸</span>
</div>

{{-- Stat Cards --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon pink"><i class="fa-solid fa-user-graduate"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $totalSiswa ?? 0 }}</div>
            <div class="stat-label">Total Siswa</div>
            <span class="stat-badge">↑ Aktif</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fa-solid fa-star"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $totalEkskul ?? 0 }}</div>
            <div class="stat-label">Ekstrakurikuler</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon peach"><i class="fa-solid fa-clipboard-question"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $totalKuis ?? 0 }}</div>
            <div class="stat-label">Kuis Dikerjakan</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon sky"><i class="fa-solid fa-chart-bar"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $totalRekomendasi ?? 0 }}</div>
            <div class="stat-label">Rekomendasi Terkirim</div>
        </div>
    </div>
</div>

{{-- Content Grid --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;position:relative;z-index:1;">

    {{-- Recent Students --}}
    <div class="card" style="grid-column: 1 / -1;">
        <div class="card-header">
            <h3>Siswa Terbaru</h3>
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline btn-sm">
                Lihat Semua <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <div class="card-body" style="padding:0;">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Status Kuis</th>
                            <th>Rekomendasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentSiswa ?? [] as $siswa)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div class="avatar">{{ strtoupper(substr($siswa->name, 0, 1)) }}</div>
                                    <span style="font-weight:600;">{{ $siswa->name }}</span>
                                </div>
                            </td>
                            <td><span style="color:var(--text-mid);font-size:13px;">{{ $siswa->kelas ?? '-' }}</span></td>
                            <td>
                                @if($siswa->kuisJawaban->count() > 0)
                                    <span class="badge badge-green">✓ Sudah</span>
                                @else
                                    <span class="badge badge-gray">Belum</span>
                                @endif
                            </td>
                            <td>
                                @if($siswa->hasilRekomendasi)
                                    <span class="badge badge-pink">🌸 {{ $siswa->hasilRekomendasi->rekomendasi_ekskul ?? '-' }}</span>
                                @else
                                    <span style="color:#ddd;font-size:13px;">—</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.siswa.show', $siswa->id) }}" class="btn btn-outline btn-sm btn-icon">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align:center;padding:50px;color:var(--text-soft);">
                                <div style="font-size:36px;margin-bottom:10px;">🌸</div>
                                <div>Belum ada data siswa</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Ekskul Popular --}}
    <div class="card">
        <div class="card-header">
            <h3>Ekskul Populer</h3>
            <span style="font-size:18px;">🏆</span>
        </div>
        <div class="card-body">
            @forelse($ekskulPopuler ?? [] as $ekskul)
            <div class="ekskul-item">
                <div style="display:flex;align-items:center;gap:12px;">
                    <div class="ekskul-icon-wrap">{{ $ekskul->icon ?? '🎯' }}</div>
                    <span style="font-weight:600;font-size:14px;color:var(--text-dark);">{{ $ekskul->nama }}</span>
                </div>
                <span class="badge badge-pink">{{ $ekskul->total }} siswa</span>
            </div>
            @empty
            <div style="text-align:center;padding:30px 0;color:var(--text-soft);">
                <div style="font-size:32px;margin-bottom:8px;">🌷</div>
                <div>Belum ada data</div>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="card">
        <div class="card-header">
            <h3>Aksi Cepat</h3>
            <span style="font-size:18px;">⚡</span>
        </div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:12px;">
            <a href="{{ route('admin.ekskul.create') }}" class="btn btn-primary" style="justify-content:center;">
                <i class="fa-solid fa-plus"></i> Tambah Ekskul Baru
            </a>
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-green" style="justify-content:center;">
                <i class="fa-solid fa-users"></i> Kelola Siswa
            </a>
            <div style="margin-top:8px;padding:14px;background:linear-gradient(135deg,rgba(255,214,231,0.4),rgba(195,232,204,0.3));border-radius:16px;border:1px solid rgba(255,179,198,0.25);text-align:center;">
                <div style="font-size:22px;margin-bottom:4px;">🌸✨🌿</div>
                <div style="font-size:12px;color:var(--text-mid);font-weight:500;">Selamat datang di dashboard!</div>
            </div>
        </div>
    </div>

</div>

@endsection