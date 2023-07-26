<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PlayerController;
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

Route::redirect('/', '/login');

Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
    
    //player
    Route::resource('/player', App\Http\Controllers\Admin\PlayerController::class);
    Route::post('/player/search', [App\Http\Controllers\Admin\PlayerController::class, 'search'])->name('admin.player.search');

    // profile
    Route::get('/playerInfo', [App\Http\Controllers\Admin\ProfileController::class, 'playerInfo'])->name('admin.player.profile');
});
