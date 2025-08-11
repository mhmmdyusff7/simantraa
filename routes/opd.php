<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Opd\{
    DashboardController,
    PerangkatjaringanController,
    PerangkatkerasController,
    PerangkatkeamananController,
    BandwidthController,
    PrintdataController,
    SdmtikController,
    ProfileController,
    PerangkatUmurOpdController,
};

Route::prefix('opd')->middleware('auth:opd', 'auth.session')->group(function () {
    Route::get('/dashboard', DashboardController::class);
    Route::get('/perangkatjaringan', PerangkatjaringanController::class);
    Route::get('/perangkatkeras', PerangkatkerasController::class);
    Route::get('/perangkatkeamanan', PerangkatkeamananController::class);
    Route::get('/perangkatbandwidth', BandwidthController::class);
    Route::get('/sdmtik', SdmtikController::class);
    Route::get('/profile', ProfileController::class);
    Route::get('/perangkat_umur_opd', PerangkatUmurOpdController::class);

    // PERBAIKAN: Hapus parameter {opd_id?} dari rute cetak
    // opd_id akan diambil langsung dari user yang terautentikasi di dalam PrintdataController
    Route::get('/cetak/{section}', PrintdataController::class)->name('cetak');
});
