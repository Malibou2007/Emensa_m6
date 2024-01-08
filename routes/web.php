<?php

use App\Http\Controllers\WunschgerichtController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

// Route für die Wurzel-URL, die auf HomeController@index zeigt
Route::get('/', [HomeController::class, 'index']);

// Authentifizierungsrouten
Auth::routes();

// Route für die /home-URL
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::middleware('auth')->group(function () {
    Route::get('/wunschgericht', [WunschgerichtController::class, 'wunschgericht'])->name('wunschgericht');
});
Route::post('/wunschverify', [WunschgerichtController::class, 'wunschverify'])->name('wunschverify')->middleware('auth');
Route::post('/profil', [HomeController::class, 'profil'])->name('profil');

