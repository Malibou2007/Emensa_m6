<?php

use App\Http\Controllers\BewertungController;
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
    Route::post('/bewertung', [BewertungController::class, 'bewertung'])->name('bewertung');
    Route::get('/bewertung', [HomeController::class, 'index'])->name('bewertung');
});
Route::post('/bewertung', [BewertungController::class, 'bewertung'])->name('bewertung');
Route::post('/bewertungsverify', [BewertungController::class, 'bewertungsverify'])->name('bewertungsverify')->middleware('auth');
Route::post('/wunschverify', [WunschgerichtController::class, 'wunschverify'])->name('wunschverify')->middleware('auth');
Route::any('/profil', [HomeController::class, 'profil'])->name('profil');
Route::post('/deleteWunschgericht', [WunschgerichtController::class, 'destroy'])->name('deleteWunschgericht');
Route::post('/deleteBewertung', [BewertungController::class, 'destroy'])->name('deleteBewertung');
Route::post('/acceptBewertung', [BewertungController::class, 'accept'])->name('acceptBewertung');
Route::post('/reacceptBewertung', [BewertungController::class, 'reaccept'])->name('reacceptBewertung');
Route::get('/bewertungen', [BewertungController::class, 'bewertungsübersicht'])->name('bewertungen');

