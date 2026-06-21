<?php


use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('dashboard.')->group(function ()
{
    Route::get('/dashboard', [DashboardController::class, 'home'])->name('home');
});



