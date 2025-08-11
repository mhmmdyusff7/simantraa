<?php


use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\{
    DashboardController,
    OpdController,
    PerangkatjaringanController,
    PerangkatkerasController,
    PerangkatkeamananController,
    BandwidthController,
    PrintdataController,
    SdmtikController,
    ProfileController,
    PerangkatUmurController,
};

Route::prefix('admin')->middleware('auth', 'auth.session')->group(function () {
    Route::get('/dashboard', DashboardController::class);
    Route::get('/data_opd', OpdController::class);
    Route::get('/perangkatjaringan', PerangkatjaringanController::class);
    Route::get('/perangkatkeras', PerangkatkerasController::class);
    Route::get('/perangkatkeamanan', PerangkatkeamananController::class);
    Route::get('/perangkatbandwidth', BandwidthController::class);
    Route::get('/sdmtik', SdmtikController::class);
    Route::get('/cetak/{section?}', PrintdataController::class);
    Route::get('/profile', ProfileController::class);
    Route::get('/perangkat_umur', PerangkatUmurController::class);
});

