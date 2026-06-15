<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentController;


Route::get('/', function () {
    return view('frontend.pages.home');
})->name('home');


// API routes for dependent dropdowns
Route::prefix('api')->group(function () {
    Route::get('/districts/{divisionId}', [StudentController::class, 'getDistricts']);
    Route::get('/upazilas/{districtId}', [StudentController::class, 'getUpazilas']);
});

// Student routes
Route::prefix('student')->name('student.')->group(function () {
    
    Route::middleware('guest')->group(function () {
        Route::get('/register', [StudentAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [StudentAuthController::class, 'register'])->name('register.submit');
        Route::get('/login', [StudentAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [StudentAuthController::class, 'login'])->name('login.submit');
    });
    
    Route::middleware(['auth', 'prevent.back'])->group(function () {
        Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
        Route::post('/update-parent-info', [StudentController::class, 'updateParentInfo'])->name('update.parent');
        Route::post('/logout', [StudentAuthController::class, 'logout'])->name('logout');
        
        Route::middleware(['check.parent.info', 'check.deadline'])->group(function () {
            Route::get('/edit-application', [StudentController::class, 'editApplication'])->name('edit.application');
            Route::post('/update-application', [StudentController::class, 'updateApplication'])->name('update.application');
            Route::get('/download-acknowledgement', [StudentController::class, 'downloadAcknowledgement'])->name('download.acknowledgement');
        });
    });
});