<?php

use App\Http\Controllers\AddressesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TelegramController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



Route::get('/', [DashboardController::class, 'user_demo'])->name('welcome');
Route::get('/faqs', function () {
    return view('pages-faqs');
});
Route::get('/forms', function () {
    return view('forms');
});
Route::post('/forms', [ProfileController::class, 'user_form']);

Route::get('/api/{url_address}', [AddressesController::class, 'show']);
Route::get('/dim/{link_address}/{date_select?}', [DashboardController::class, 'link_address']);

Route::get('/dashboard/{user_url}/{address_id}/{date_select?}', [DashboardController::class, 'show'])->name('dashboard_id');
Route::get('/dashboard/{user_url}', [DashboardController::class, 'index'])->name('user_dashboard');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/all/{address_id?}/{date_select?}', [DashboardController::class, 'dashboard_all'])->name('dashboard_all');


Route::get('/grafik/{cherga_id?}', [GrafikController::class, 'cherga'])->name('cherga');

Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/theme', [ProfileController::class, 'theme_update'])->name('profile.theme');
    Route::post('/profile/public', [ProfileController::class, 'public'])->name('profile.public');

    Route::post('/addresses/update/{id}', [AddressesController::class, 'update']);
    Route::post('/addresses/add', [AddressesController::class, 'store']);
    Route::post('/addresses/delete/{id}', [AddressesController::class, 'destroy']);



});

Route::post('/telegram/webhook', [TelegramController::class, 'handle']);




require __DIR__.'/auth.php';
