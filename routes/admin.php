<?php
// routes/admin.php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ApplicationController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    // ─── Public (Guest) ──────────────────────────────────────────────────────
    Route::middleware('guest')->group(function () {
        Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    });

    // ─── Authenticated Admin ──────────────────────────────────────────────────
    Route::middleware(['auth', 'admin.auth', 'prevent.back'])->group(function () {

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware('menu.permission:dashboard.overview,read')
            ->name('dashboard');

        Route::get('/dashboard/stats', [DashboardController::class, 'stats'])
            ->middleware('menu.permission:dashboard.statistics,read')
            ->name('dashboard.stats');

        // Applications
        Route::prefix('applications')->name('applications.')->group(function () {

            Route::get('/', [ApplicationController::class, 'index'])
                ->middleware('menu.permission:applications.list,read')
                ->name('index');

            Route::get('/export', [ApplicationController::class, 'export'])
                ->middleware('menu.permission:reports.export,read')
                ->name('export');

            Route::get('/{id}', [ApplicationController::class, 'show'])
                ->middleware('menu.permission:applications.list,read')
                ->name('show');

            // Single approve / reject
            Route::post('/{id}/approve', [ApplicationController::class, 'approve'])
                ->middleware('menu.permission:applications.list,update')
                ->name('approve');

            Route::post('/{id}/reject', [ApplicationController::class, 'reject'])
                ->middleware('menu.permission:applications.list,update')
                ->name('reject');

            // Single send notification
            Route::post('/{id}/notify', [ApplicationController::class, 'sendNotification'])
                ->middleware('menu.permission:applications.list,update')
                ->name('notify');

            Route::post('/bulk/approve', [ApplicationController::class, 'bulkApprove'])
                ->middleware('menu.permission:applications.list,update')
                ->name('bulk-approve');

            Route::post('/bulk/reject', [ApplicationController::class, 'bulkReject'])
                ->middleware('menu.permission:applications.list,update')
                ->name('bulk-reject');

            Route::post('/bulk/notify', [ApplicationController::class, 'bulkNotify'])
                ->middleware('menu.permission:applications.list,update')
                ->name('bulk-notify');
        });

        Route::get('/no-permission', [DashboardController::class, 'NoPermission'])->name('no-permission');
    });
});
