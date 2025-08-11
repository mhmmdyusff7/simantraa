<?php


use Illuminate\Support\Facades\Route;
use App\Livewire\AuthController;
use Livewire\Livewire;


// Auth
Route::get('/', AuthController::class)->name('login');

include 'opd.php';
include 'admin.php';

// Routing livewire
Livewire::setScriptRoute(function ($handle) {
    return Route::get('/simantra/livewire/livewire.js', $handle);
});
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/simantra/livewire/update', $handle);
});