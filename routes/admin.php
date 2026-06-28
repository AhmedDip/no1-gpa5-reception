<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ApplicationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| All admin routes are prefixed with /admin and named with admin.*
| Authentication: Uses the AdminAuthenticate middleware
| Permission: Uses the MenuPermission middleware for sub-menu access control
|
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // ─── Public (Guest) Routes ───────────────────────────────────────────────
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    });

    // ─── Authenticated Admin Routes ──────────────────────────────────────────
    Route::middleware(['auth', 'admin.auth', 'prevent.back'])->group(function () {

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // ─── Dashboard ───────────────────────────────────────────────────────
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware('menu.permission:dashboard.overview,read')
            ->name('dashboard');

        Route::get('/dashboard/stats', [DashboardController::class, 'stats'])
            ->middleware('menu.permission:dashboard.statistics,read')
            ->name('dashboard.stats');

        // ─── Applications ────────────────────────────────────────────────────
        Route::prefix('applications')->name('applications.')->group(function () {

            Route::get('/', [ApplicationController::class, 'index'])
                ->middleware('menu.permission:applications.list,read')
                ->name('index');

            Route::get('/{id}', [ApplicationController::class, 'show'])
                ->middleware('menu.permission:applications.list,read')
                ->name('show');

            Route::post('/{id}/approve', [ApplicationController::class, 'approve'])
                ->middleware('menu.permission:applications.list,update')
                ->name('approve');

            Route::post('/{id}/reject', [ApplicationController::class, 'reject'])
                ->middleware('menu.permission:applications.list,update')
                ->name('reject');

            Route::post('/bulk-approve', [ApplicationController::class, 'bulkApprove'])
                ->middleware('menu.permission:applications.list,update')
                ->name('bulk-approve');

            Route::get('/export', [ApplicationController::class, 'export'])
                ->middleware('menu.permission:reports.export,read')
                ->name('export');
        });

        Route::get('/no-permission', [DashboardController::class, 'NoPermission'])->name('no-permission');


    });

});
