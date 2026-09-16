<?php

use App\Http\Controllers\InvitationLetterController;
use App\Http\Controllers\OtpVerificationController;
use App\Http\Controllers\PreviousYearController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentNotificationController;
use App\Http\Controllers\StudentPasswordResetController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/', [StudentController::class, 'home'])->name('home');

// Route::get('/clear-cache', function () {
//     Artisan::call('optimize:clear');

//     return 'Laravel cache cleared successfully!';
// });


// Previous Year
Route::get('/previous-year', [PreviousYearController::class, 'index'])->name('previous-year.index');

Route::get('/qr-code', [QrCodeController::class, 'index'])->name('qrcode.index')->middleware('auth', 'admin.auth');
Route::get('/qr-code/latest-scans', [QrCodeController::class, 'latestScans'])->name('qrcode.latest-scans')->middleware('auth', 'admin.auth');


Route::get('/qr-code/scan/{mobile}', [QrCodeController::class, 'scanStudentQrCode'])
    ->name('qrcode.student.scan')->middleware('auth', 'admin.auth');

Route::get('/qr-code/{mobile}', [QrCodeController::class, 'showStudentQrCode'])
    ->name('qrcode.student.show')->middleware('auth', 'admin.auth');

Route::prefix('student')->name('student.')->group(function () {
    Route::middleware('guest')->group(function () {
        // Registration
        Route::get('/register', [StudentAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [StudentAuthController::class, 'register'])->name('register.submit');

        // Login
        Route::get('/login', [StudentAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [StudentAuthController::class, 'login'])->name('login.submit');

        // Forgot Password
        Route::get('/forgot-password', [StudentPasswordResetController::class, 'showForgotForm'])->name('password.forgot');
        Route::post('/forgot-password', [StudentPasswordResetController::class, 'sendOtp'])->name('password.forgot.submit');

        Route::get('/reset-password/otp', [StudentPasswordResetController::class, 'showOtpForm'])->name('password.reset.otp');
        Route::post('/reset-password/otp', [StudentPasswordResetController::class, 'verifyOtp'])->name('password.reset.otp.verify');
        Route::post('/reset-password/otp/resend', [StudentPasswordResetController::class, 'resendOtp'])->name('password.reset.otp.resend');

        Route::get('/reset-password', [StudentPasswordResetController::class, 'showResetForm'])->name('password.reset');
        Route::post('/reset-password', [StudentPasswordResetController::class, 'resetPassword'])->name('password.reset.submit');
    });


    Route::middleware(['auth', 'prevent.back'])->group(function () {

        Route::get('/verify-otp', [OtpVerificationController::class, 'showVerifyForm'])->name('otp.verify');
        Route::post('/verify-otp', [OtpVerificationController::class, 'verifyOtp'])->name('otp.verify.submit');
        Route::post('/resend-otp', [OtpVerificationController::class, 'resendOtp'])->name('otp.resend');


        Route::post('/update-parent-info', [StudentController::class, 'updateParentInfo'])->name('update.parent');



        Route::middleware(['check.mobile.verified'])->group(function () {

            //Change Password
            Route::post('/change-password', [StudentController::class, 'changePassword'])->name('password.update');

            // Dashboard
            Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');

            // Application Management
            Route::get('/edit-application', [StudentController::class, 'editApplication'])->name('edit.application');
            Route::post('/update-application', [StudentController::class, 'updateApplication'])->name('update.application');
            Route::get('/download-acknowledgement', [StudentController::class, 'downloadAcknowledgement'])->name('download.acknowledgement');

            // Download Invitation Letter and Certificate
            //Invitation Letter
            Route::get('/invitation-letter', [InvitationLetterController::class, 'index'])->name('invitation.index');
            // Route::get('/invitation/download', [StudentController::class, 'downloadInvitation'])->name('invitation.download');

            //Professional Certificate
            Route::get('/certificate', [StudentController::class, 'certificate'])->name('certificate.index');

            // Download certificate PDF
            Route::get('/certificate/download', [StudentController::class, 'downloadCertificate'])
                ->name('certificate.download');

            // Profile Settings
            Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
            Route::post('/profile/update', [StudentController::class, 'updateProfile'])->name('profile.update');

            // Notifications
            Route::get('/notifications', [StudentNotificationController::class, 'index'])->name('notifications.index');
            Route::post('/notifications/{id}/read', [StudentNotificationController::class, 'markRead'])->name('notifications.read');
            Route::post('/notifications/mark-all-read', [StudentNotificationController::class, 'markAllRead'])->name('notifications.read-all');

            Route::get('/ceremony/verify', [QrCodeController::class, 'verify'])->name('ceremony.verify');
            Route::get('/ceremony/history', [QrCodeController::class, 'history'])->name('ceremony.history');
        });


        Route::post('/logout', [StudentAuthController::class, 'logout'])->name('logout');
    });
});



Route::prefix('api')->name('api.')->group(function () {
    Route::get('/districts/{divisionId}', [StudentController::class, 'getDistricts'])->name('districts');
    Route::get('/upazilas/{districtId}', [StudentController::class, 'getUpazilas'])->name('upazilas');
});


require __DIR__ . '/admin.php';
