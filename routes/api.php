<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\RoomController;

// 🛠 Rota protegida para obter usuário autenticado
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['guest'])->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('register');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('login');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('/rooms')->group(function () {
        Route::post('/create', [RoomController::class, 'store'])
            ->name('room.store');
        Route::put('/{id}/update', [RoomController::class, 'update'])
            ->name('room.update');
        Route::patch('/{id}/toggle-status', [RoomController::class, 'toggleStatusRoom'])
            ->name('box.toggle-status');

    });

    Route::prefix('/meeting')->group(function () {
        Route::post('/create', [MeetingController::class, 'store'])
            ->name('meeting.store');
        Route::put('/{id}/update', [MeetingController::class, 'update'])
            ->name('meeting.update');


    });
});