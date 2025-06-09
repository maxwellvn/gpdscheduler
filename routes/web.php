<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Schedule routes
    Route::resource('schedules', ScheduleController::class);
    Route::patch('/schedules/{schedule}/complete', [ScheduleController::class, 'complete'])->name('schedules.complete');
    Route::get('/kingschat-notifications', [ScheduleController::class, 'kingsChatNotifications'])->name('schedules.kingschat');
});

require __DIR__.'/auth.php';
