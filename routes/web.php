<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\MasjidController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserProfilController;
use App\Http\Middleware\EnsureDataMasjidCompleted;

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

Route::get('logout-user', function () {
    Auth::logout();
    return redirect('/');
})->name('logout-user');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::resource('masjid', MasjidController::class);

    Route::middleware(EnsureDataMasjidCompleted::class)->group(function () {
        Route::resource('profil', ProfilController::class);
        Route::resource('kas', KasController::class);
        Route::resource('userprofil', UserProfilController::class);
        Route::get('/home', [HomeController::class, 'index'])->name('home');
    });
});
