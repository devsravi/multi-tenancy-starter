<?php

use App\Http\Controllers\Central\TenantController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::domain(config('app.domain'))->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::middleware(['auth:admin', 'verified'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Add the following routes for tenant
        Route::resource('tenants', TenantController::class);
    });

    require __DIR__ . '/auth.php';
});
