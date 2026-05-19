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
        Route::post('/siswa/{pivot}/approve', [AdminController::class, 'approve'])->name('siswa.approve');
        Route::post('/siswa/{pivot}/reject', [AdminController::class, 'reject'])->name('siswa.reject');

        // Ekskul management
        Route::get('/ekskul', [AdminController::class, 'ekskulIndex'])->name('ekskul.index');
        Route::get('/ekskul/create', [AdminController::class, 'createEkskul'])->name('ekskul.create');
        Route::post('/ekskul', [AdminController::class, 'storeEkskul'])->name('ekskul.store');
        Route::get('/ekskul/{ekskul}/edit', [AdminController::class, 'editEkskul'])->name('ekskul.edit');
        Route::put('/ekskul/{ekskul}', [AdminController::class, 'updateEkskul'])->name('ekskul.update');
        Route::delete('/ekskul/{ekskul}', [AdminController::class, 'destroyEkskul'])->name('ekskul.destroy');

    });
