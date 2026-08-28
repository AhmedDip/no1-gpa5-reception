<?php
// routes/admin.php

use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\AuditReportController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuPermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SmsLogController;
use App\Http\Controllers\Admin\SubMenuController;
use App\Http\Controllers\Admin\UpazilaManagerAssignmentController;
use App\Http\Controllers\Admin\UpazilaManagerImportController;
use App\Http\Controllers\Admin\WebMenuController;
use App\Http\Controllers\Admin\WebMenuGroupController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware(['auth', 'admin.auth', 'prevent.back'])->group(function () {

        Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('password.update');

        Route::prefix('menu-management')->name('menu-management.')->group(function () {

            Route::prefix('groups')->name('groups.')->group(function () {
                Route::get('/', [WebMenuGroupController::class, 'index'])
                    ->middleware('menu.permission:settings.menu-groups,read')->name('index');
                Route::post('/', [WebMenuGroupController::class, 'store'])
                    ->middleware('menu.permission:settings.menu-groups,create')->name('store');
                Route::put('/{group}', [WebMenuGroupController::class, 'update'])
                    ->middleware('menu.permission:settings.menu-groups,update')->name('update');
                Route::delete('/{group}', [WebMenuGroupController::class, 'destroy'])
                    ->middleware('menu.permission:settings.menu-groups,delete')->name('destroy');
            });

            Route::prefix('web-menus')->name('web-menus.')->group(function () {
                Route::get('/', [WebMenuController::class, 'index'])
                    ->middleware('menu.permission:settings.web-menus,read')->name('index');
                Route::post('/', [WebMenuController::class, 'store'])
                    ->middleware('menu.permission:settings.web-menus,create')->name('store');
                Route::put('/{menu}', [WebMenuController::class, 'update'])
                    ->middleware('menu.permission:settings.web-menus,update')->name('update');
                Route::delete('/{menu}', [WebMenuController::class, 'destroy'])
                    ->middleware('menu.permission:settings.web-menus,delete')->name('destroy');
            });

            Route::prefix('sub-menus')->name('sub-menus.')->group(function () {
                Route::get('/', [SubMenuController::class, 'index'])
                    ->middleware('menu.permission:settings.sub-menus,read')->name('index');
                Route::post('/', [SubMenuController::class, 'store'])
                    ->middleware('menu.permission:settings.sub-menus,create')->name('store');
                Route::put('/{subMenu}', [SubMenuController::class, 'update'])
                    ->middleware('menu.permission:settings.sub-menus,update')->name('update');
                Route::delete('/{subMenu}', [SubMenuController::class, 'destroy'])
                    ->middleware('menu.permission:settings.sub-menus,delete')->name('destroy');
            });

            Route::prefix('permissions')->name('permissions.')->group(function () {
                Route::get('/', [MenuPermissionController::class, 'index'])
                    ->middleware('menu.permission:settings.permissions,read')->name('index');
                Route::get('/{group}/edit', [MenuPermissionController::class, 'edit'])
                    ->middleware('menu.permission:settings.permissions,read')->name('edit');
                Route::post('/{group}', [MenuPermissionController::class, 'update'])
                    ->middleware('menu.permission:settings.permissions,update')->name('update');
            });
        });

        Route::prefix('upazila-managers')->name('upazila-managers.')->group(function () {
            Route::get('/', [UpazilaManagerImportController::class, 'index'])->name('index');
        });

        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

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
                ->middleware('menu.permission:applications.list,read')
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

            Route::post('/bulk/approve-multiple', [ApplicationController::class, 'bulkApprove'])
                ->middleware('menu.permission:applications.list,update')
                ->name('bulk-approve-multiple');

            Route::post('/bulk/reject-multiple', [ApplicationController::class, 'bulkReject'])
                ->middleware('menu.permission:applications.list,update')
                ->name('bulk-reject-multiple');

            Route::post('/bulk/notify-multiple', [ApplicationController::class, 'bulkNotify'])
                ->middleware('menu.permission:applications.list,update')
                ->name('bulk-notify-multiple');
        });

        Route::get('/sms-logs', [SmsLogController::class, 'index'])
            ->middleware('menu.permission:settings.upazila-manager-assignments,read')
            ->name('sms-logs.index');

        Route::get('/no-permission', [DashboardController::class, 'NoPermission'])->name('no-permission');

        Route::prefix('upazila-manager-assignments')->name('upazila-manager-assignments.')->group(function () {
            Route::get('/', [UpazilaManagerAssignmentController::class, 'index'])->name('index');
            Route::get('/export', [UpazilaManagerAssignmentController::class, 'export'])->name('export');
            Route::post('/', [UpazilaManagerAssignmentController::class, 'store'])->name('store');
            Route::put('/{assignment}', [UpazilaManagerAssignmentController::class, 'update'])->name('update');
            Route::delete('/{assignment}', [UpazilaManagerAssignmentController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('reports/audit-approvals')->name('reports.audit-approvals.')->group(function () {
            Route::get('/', [AuditReportController::class, 'index'])
                ->name('index');

            Route::get('/export/rm', [AuditReportController::class, 'exportRmApproved'])
                ->name('export.rm');

            Route::get('/export/wm', [AuditReportController::class, 'exportWmApproved'])
                ->name('export.wm');
        });
        });
    });
