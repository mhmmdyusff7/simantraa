<?php


use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\{
    ManajemenController,
    DashboardController,
    OpdController,
    PerangkatController,
    PerangkatjaringanController,
    PerangkatkerasController,
    PerangkatkeamananController,
    BandwidthController,
    PrintdataController,
    SdmtikController,
};
use App\Livewire\AuthController;
use Livewire\Livewire;

Route::get('/', function () {
    return view('welcome');
});

// Routing livewire
Livewire::setScriptRoute(function ($handle) {
    return Route::get('/simantra/livewire/livewire.js', $handle);
});
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/simantra/livewire/update', $handle);
});

// Auth
Route::get('/', AuthController::class)->name('login');
Route::get('/admin/logout', AuthController::class)->name('logout');
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', DashboardController::class);
    Route::get('/data_opd', OpdController::class);
    Route::get('/perangkatjaringan', PerangkatjaringanController::class);
    Route::get('/perangkatkeras', PerangkatkerasController::class);
    Route::get('/perangkatkeamanan', PerangkatkeamananController::class);
    Route::get('/perangkatbandwidth', BandwidthController::class);
    Route::get('/sdmtik', SdmtikController::class);

    Route::get('/cetak/{section?}', PrintdataController::class);

});
// rute buat dasboard, function di rute livewire get mengambil semua function yang dibuat (getpostputdeleteupdate)dicontroleer terkait
