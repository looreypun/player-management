<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function(){
    Route::redirect('/', '/admin/dashboard');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');

    //player
    Route::resource('/player', App\Http\Controllers\Admin\PlayerController::class);
    Route::post('/player/search', [App\Http\Controllers\Admin\PlayerController::class, 'search'])->name('admin.player.search');

    // profile
    Route::get('/playerInfo', [App\Http\Controllers\Admin\ProfileController::class, 'playerInfo'])->name('admin.player.profile');
});
