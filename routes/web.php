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

    Route::post('/addresses/update/{id}', [AddressesController::class, 'update']);


});


require __DIR__.'/auth.php';
