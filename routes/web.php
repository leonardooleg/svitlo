<?php

use App\Http\Controllers\AddressesController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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
    Route::post('/profile/theme', [ProfileController::class, 'theme_update'])->name('profile.theme');

    Route::get('/addresses', [AddressesController::class, 'edit'])->name('addresses.edit');
    Route::patch('/addresses', [AddressesController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses', [AddressesController::class, 'destroy'])->name('addresses.destroy');
    Route::post('/addresses/theme', [AddressesController::class, 'theme_update'])->name('addresses.theme');
});


require __DIR__.'/auth.php';
