<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('reservations', ReservationController::class);
    Route::resource('shops', ShopController::class);
    Route::post(
    '/reservations/{reservation}/confirm',
    [ReservationController::class, 'confirm']
    )->name('reservations.confirm');
    Route::post(
    '/reservations/{reservation}/complete',
    [ReservationController::class, 'complete']
    )->name('reservations.complete');
    Route::post(
    '/reservations/{reservation}/cancel',
    [ReservationController::class, 'cancel']
    )->name('reservations.cancel');
});




require __DIR__.'/auth.php';
