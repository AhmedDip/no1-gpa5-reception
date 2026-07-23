<?php

use App\Http\Controllers\InvitationLetterController;
use App\Http\Controllers\OtpVerificationController;
use App\Http\Controllers\PreviousYearController;
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


// Previous Year
Route::get('/previous-year', [PreviousYearController::class, 'index'])->name('previous-year.index');

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

        //Invitation Letter
        Route::get('/invitation-letter', [InvitationLetterController::class, 'index'])->name('invitation.letter');

        //Professional Certificate
        Route::get('/acknowledgment-certificate', [StudentController::class, 'certificate'])->name('certificate');

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
            Route::get('/invitation', [StudentController::class, 'downloadInvitation'])->name('download.invitation');
            Route::get('/certificate', [StudentController::class, 'certificate'])->name('download.certificate');

            // Profile Settings
            Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
            Route::post('/profile/update', [StudentController::class, 'updateProfile'])->name('profile.update');

            // Notifications
            Route::get('/notifications', [StudentNotificationController::class, 'index'])->name('notifications.index');
            Route::post('/notifications/{id}/read', [StudentNotificationController::class, 'markRead'])->name('notifications.read');
            Route::post('/notifications/mark-all-read', [StudentNotificationController::class, 'markAllRead'])->name('notifications.read-all');
        });


        Route::post('/logout', [StudentAuthController::class, 'logout'])->name('logout');
    });
});



Route::prefix('api')->name('api.')->group(function () {
    Route::get('/districts/{divisionId}', [StudentController::class, 'getDistricts'])->name('districts');
    Route::get('/upazilas/{districtId}', [StudentController::class, 'getUpazilas'])->name('upazilas');
});


require __DIR__ . '/admin.php';


// TEMPORARY — remove after debugging
Route::get('/debug-sms-test', function () {
    $mobile = '01998663117'; // আপনার নিজের নম্বর দিন
    $mobile2 = '01969917144'; // আপনার নিজের নম্বর দিন

    try {
        $response = \Illuminate\Support\Facades\Http::timeout(15)
            ->acceptJson()
            ->asJson()
            ->post(config('services.banglalink.sms_url'), [
                'username'      => config('services.banglalink.username'),
                'password'      => config('services.banglalink.password'),
                'apicode'       => config('services.banglalink.apicode'),
                'msisdn'        => ['880' . ltrim($mobile, '0')],
                'countrycode'   => config('services.banglalink.country_code'),
                'cli'           => config('services.banglalink.cli'),
                'messagetype'   => '1',
                'message'       => 'Local test ' . now()->format('His'),
                'clienttransid' => 'T' . now()->timestamp . rand(100, 999),
                'bill_msisdn'   => '880' . ltrim($mobile2, '0'),
                'tran_type'     => 'T',
                'request_type'  => 'S',
                'rn_code'       => config('services.banglalink.rn_code'),
            ]);

        return response()->json([
            'http_status'    => $response->status(),
            'successful'     => $response->successful(),
            'raw_body'       => $response->json(),
            'config_used'    => [
                'url'      => config('services.banglalink.sms_url'),
                'username' => config('services.banglalink.username'),
                'cli'      => config('services.banglalink.cli'),
            ],
        ]);
    } catch (\Illuminate\Http\Client\ConnectionException $e) {
        return response()->json([
            'error' => 'CONNECTION_FAILED — network/DNS/firewall issue, could not even reach Banglalink server',
            'message' => $e->getMessage(),
        ], 500);
    } catch (\Throwable $e) {
        return response()->json([
            'error' => 'UNEXPECTED_EXCEPTION',
            'message' => $e->getMessage(),
        ], 500);
    }
});
