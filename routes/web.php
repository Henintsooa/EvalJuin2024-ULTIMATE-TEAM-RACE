<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;



Route::get('/classementCoureurEtape', [AdminController::class, 'classementCoureurEtape'])->name('classementCoureurEtape'); 
Route::get('/classementCoureur', [AdminController::class, 'classementCoureur'])->name('classementCoureur'); 


Route::get('/sommePointJoueur', [AdminController::class, 'sommePointJoueur'])->name('sommePointJoueur');
Route::get('/pdfCertificat', [AdminController::class, 'pdfCertificat'])->name('pdfCertificat');

Route::get('/showCertificat', [AdminController::class, 'showCertificat'])->name('showCertificat');

Route::post('/supprimerPenalite', [AdminController::class, 'supprimerPenalite'])->name('supprimerPenalite'); 
Route::post('/insertPenalite', [AdminController::class, 'insertPenalite'])->name('insertPenalite'); 
Route::get('/penalite', [AdminController::class, 'penalite'])->name('penalite'); 

Route::post('/genereCategorie', [AdminController::class, 'genereCategorie'])->name('genereCategorie'); 
Route::get('/genererCategorie', [AdminController::class, 'genererCategorie'])->name('genererCategorie'); 


Route::post('/importPoints', [ImportController::class, 'importPoints'])->name('importPoints');
Route::post('/importCsv', [ImportController::class, 'importCsv'])->name('importCsv');

Route::get('/importDonnee', [ImportController::class, 'importDonnee'])->name('importDonnee'); 


Route::post('/insertCoureur', [AdminController::class, 'insertCoureur'])->name('insertCoureur');
Route::get('/coureur', [AdminController::class, 'coureur'])->name('coureur'); 

Route::post('/insertEtape', [AdminController::class, 'insertEtape'])->name('insertEtape');

Route::get('/classementEquipe', [HomeController::class, 'classementEquipe'])->name('classementEquipe');
Route::get('/classement', [HomeController::class, 'classement'])->name('classement');

Route::post('/getCoureursByEtape', [AdminController::class, 'getCoureursByEtape'])->name('getCoureursByEtape');
Route::post('/affecterTemps', [AdminController::class, 'affectationTemps'])->name('affecterTemps'); 
Route::get('/affecterTemps', [AdminController::class, 'affecterTemps'])->name('affecterTemps'); 
Route::get('/indexEquipe', [HomeController::class, 'indexEquipe'])->name('indexEquipe');
Route::post('/affecterCoureur', [EquipeController::class, 'affectationCoureur'])->name('affecterCoureur'); 
Route::get('/affecterCoureur', [EquipeController::class, 'affecterCoureur'])->name('affecterCoureur'); 
Route::post('/loginEquipe', [HomeController::class, 'loginEquipe'])->name('loginEquipe'); 
Route::post('/reset-database', [HomeController::class, 'reset']);
Route::get('/dashboard_user', [HomeController::class, 'user'])->name('dashboard_user'); 
Route::get('/dashboard_admin', [HomeController::class, 'admin'])->name('dashboard_admin'); 

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
