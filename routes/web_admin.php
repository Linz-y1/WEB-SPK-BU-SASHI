<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->group(function () {

        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        // Pendaftaran (siswa => ekskul)
        Route::get('/siswa', [AdminController::class, 'siswaIndex'])->name('siswa.index');
        Route::get('/siswa/{siswa}', [AdminController::class, 'siswaShow'])->name('siswa.show');
        Route::post('/siswa/{pivot}/approve', [AdminController::class, 'approve'])->name('siswa.approve');
        Route::post('/siswa/{pivot}/reject', [AdminController::class, 'reject'])->name('siswa.reject');

        // Ekskul management
        Route::get('/ekskul', [AdminController::class, 'ekskulIndex'])->name('ekskul.index');
        Route::get('/ekskul/create', [AdminController::class, 'createEkskul'])->name('ekskul.create');
        Route::post('/ekskul', [AdminController::class, 'storeEkskul'])->name('ekskul.store');
        Route::get('/ekskul/{ekskul}/edit', [AdminController::class, 'editEkskul'])->name('ekskul.edit');
        Route::put('/ekskul/{ekskul}', [AdminController::class, 'updateEkskul'])->name('ekskul.update');
        Route::delete('/ekskul/{ekskul}', [AdminController::class, 'destroyEkskul'])->name('ekskul.destroy');

        Route::get('/kuis', [AdminController::class, 'kuisIndex'])->name('kuis.index');
        Route::get('/kuis/create', [AdminController::class, 'kuisCreate'])->name('kuis.create');
        Route::post('/kuis', [AdminController::class, 'kuisStore'])->name('kuis.store');
        Route::get('/kuis/{kuisSoal}/edit', [AdminController::class, 'kuisEdit'])->name('kuis.edit');
        Route::put('/kuis/{kuisSoal}', [AdminController::class, 'kuisUpdate'])->name('kuis.update');
        Route::delete('/kuis/{kuisSoal}', [AdminController::class, 'kuisDestroy'])->name('kuis.destroy');

        Route::get('/hasil', [AdminController::class, 'hasilIndex'])->name('hasil.index');

    });
