<?php
// routes/web.php

use App\Http\Controllers\OtpVerificationController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/', [StudentController::class, 'home'])->name('home');


Route::prefix('student')->name('student.')->group(function () {
    

    Route::middleware('guest')->group(function () {
        // Registration
        Route::get('/register', [StudentAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [StudentAuthController::class, 'register'])->name('register.submit');
        
        // Login
        Route::get('/login', [StudentAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [StudentAuthController::class, 'login'])->name('login.submit');
        
    });
    
   
    Route::middleware(['auth', 'prevent.back'])->group(function () {
        
 
        Route::get('/verify-otp', [OtpVerificationController::class, 'showVerifyForm'])->name('otp.verify');
        Route::post('/verify-otp', [OtpVerificationController::class, 'verifyOtp'])->name('otp.verify.submit');
        Route::post('/resend-otp', [OtpVerificationController::class, 'resendOtp'])->name('otp.resend');
        
        // Skip verification (Development only)
        Route::get('/skip-verification', [OtpVerificationController::class, 'skipVerification'])->name('otp.skip');
        

        Route::post('/update-parent-info', [StudentController::class, 'updateParentInfo'])->name('update.parent');
        
  
        Route::middleware(['check.mobile.verified'])->group(function () {
            
            // Dashboard
            Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
            
            // Application Management
            Route::get('/edit-application', [StudentController::class, 'editApplication'])->name('edit.application');
            Route::post('/update-application', [StudentController::class, 'updateApplication'])->name('update.application');
            Route::get('/download-acknowledgement', [StudentController::class, 'downloadAcknowledgement'])->name('download.acknowledgement');
            
            // Additional Features (Future)
            Route::get('/invitation', [StudentController::class, 'downloadInvitation'])->name('download.invitation');
            Route::get('/certificate', [StudentController::class, 'downloadCertificate'])->name('download.certificate');
            
            // Profile Settings
            Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
            Route::post('/profile/update', [StudentController::class, 'updateProfile'])->name('profile.update');
        });
        

        Route::post('/logout', [StudentAuthController::class, 'logout'])->name('logout');
    });
});



Route::prefix('api')->name('api.')->group(function () {
    // Location APIs (Used in registration forms)
    Route::get('/districts/{divisionId}', [StudentController::class, 'getDistricts'])->name('districts');
    Route::get('/upazilas/{districtId}', [StudentController::class, 'getUpazilas'])->name('upazilas');
    
});