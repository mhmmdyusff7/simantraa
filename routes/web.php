<?php


use App\Livewire\Admin\ManajemenController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\DashboardController;
use App\Livewire\Admin\DataOpdController;
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

// admin dashboard controller
Route::get('admin/dashboard', DashboardController::class);
Route::get('admin/manajemen_jaringan', ManajemenController::class);
Route::get('admin/data_opd', DataOpdController::class);
