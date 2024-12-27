<?php

declare(strict_types=1);

use App\Http\Controllers\App\ProfileController;
use App\Http\Controllers\App\UserController;
use App\Http\Middleware\TenantFinderMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\App\API\AuthenticationController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    TenantFinderMiddleware::class,
    PreventAccessFromCentralDomains::class
])->group(function () {
    Route::get('/', function () {
        return view('app.welcome');
    });
    require __DIR__ . '/tenant-auth.php';
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', function () {
            return view('app.dashboard');
        })->name('tenant.dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('tenant.profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('tenant.profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('tenant.profile.destroy');

        // Add the following routes for tenant
        Route::resource('users', UserController::class);
    });
});

Route::group(
    [
        'prefix' => config('sanctum.prefix', 'api')
    ],
    static function () {
        Route::post('/tenant', [AuthenticationController::class, 'store']);
        Route::post('/login', [AuthenticationController::class, 'authenticateUser'])
            ->middleware([
                'api',
                InitializeTenancyByRequestData::class // Use tenancy initialization middleware of your choice
            ]);
    }
);
