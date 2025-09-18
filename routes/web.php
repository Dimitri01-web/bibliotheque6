<?php
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\AuteurController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\DashboardController;



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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('categories', CategorieController::class);
Route::resource('auteurs', AuteurController::class);
Route::resource('livres', LivreController::class);
Route::resource('membres', MembreController::class);
Route::resource('emprunts', EmpruntController::class);
Route::post('emprunts/{emprunt}/retour', [EmpruntController::class, 'retour'])->name('emprunts.retour');
 // Page principale des rapports (menu avec formulaires)
    Route::get('/rapports', [RapportController::class, 'index'])
        ->name('rapports.index');

    // Rapports d’emprunts par période
    Route::get('/rapports/emprunts/periode', [RapportController::class, 'parPeriode'])
        ->name('rapports.emprunts.periode');

    // Rapports d’emprunts par catégorie
    Route::get('/rapports/emprunts/categorie', [RapportController::class, 'parCategorie'])
        ->name('rapports.emprunts.categorie');

    // Rapports d’emprunts par membre
    Route::get('/rapports/emprunts/membre', [RapportController::class, 'parMembre'])
        ->name('rapports.emprunts.membre');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');




