<?php

use App\Http\Controllers\Showmembre;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\AcheterController;
use App\Http\Controllers\PayerController;
use App\Http\Controllers\SuiviSeanceVisiteurController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get("/home", function(){
    return view('dashboard');
})->middleware('auth');

Auth::routes();

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::view('/login', 'auth.login-custom')->name('login');

require __DIR__.'/auth.php';

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');





//ROUTES POUR LE MEMBRE CONTROLLER
Route::resource('membres', MembreController::class);
Route::get('/membres/search', 'MembreController@search')->name('membres.search');
Route::get('/dashboard', [MembreController::class, 'dashboard'])->name('dashboard');


Route::get('/membre/{id}',  [Showmembre::class, 'prix']);
//ROUTES POUR LE VISITEUR CONTROLLER
Route::resource('visiteurs', VisiteurController::class);

//ROUTES POUR LE PRODUIT CONTROLLER
Route::resource('produits', ProduitController::class);

// ROUTES POUR LE TARIF CONTROLLER
Route::resource('tarifs', TarifController::class);
// web.php ou api.php
Route::get('tarifs/{tarif}', 'TarifController@show')->name('tarifs.show');


// ROUTES POUR LE ACHETER CONTROLLER
Route::resource('achats', AcheterController::class);

// // ROUTES POUR LE PAYERCONTROLLER
// Route::resource('payer', PayerController::class);

// ROUTES POUR LE PAYERCONTROLLER
Route::resource('payer', PayerController::class);
Route::get('/payer', [PayerController::class, 'index'])->name('payer.index');


Route::get('/tarifs/{type}', [TarifController::class, 'getTarifs']);

// // Route pour SUIVI SEANCE
// Route::resource('suivi-seances-visiteurs', SuiviSeanceVisiteurController::class);

Route::get('/suivi-seances-visiteurs', [SuiviSeanceVisiteurController::class, 'index'])->name('suivi_seances_visiteurs.index');
Route::post('suivi-seances-visiteurs', [SuiviSeanceVisiteurController::class, 'store'])->name('suivi_seances_visiteurs.store');

Route::get('/rapport', [RapportController::class, 'rapportJournalier'])->name('rapport.journalier');
Route::get('/dashboard', [RapportController::class, 'dashboard'])->name('dashboard');





// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
