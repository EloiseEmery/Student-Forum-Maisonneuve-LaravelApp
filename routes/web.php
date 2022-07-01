<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;

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

// Gestion de la page d'accueil
Route::get('/', function () {
    return view('home');
})->name('pages.home');

// Gestion des pages en construction
Route::get('a-venir', function () {
    return view('wip-page');
})->name('pages.a-venir');

// Lister tous les étudiants
Route::get('etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
// Afficher un étudiant
Route::get('etudiants/{etudiant}', [EtudiantController::class, 'show'])->name('etudiant.show');

// Ajouter un étudiant
Route::get('etudiant-create', [EtudiantController::class, 'create'])->name('etudiant.create');
Route::post('etudiant-create', [EtudiantController::class, 'store'])->name('etudiant.create.post');

// Modifier un étudiant
Route::get('etudiant-edit/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiant.edit');
Route::put('etudiant-edit/{etudiant}', [EtudiantController::class, 'update'])->name('etudiant.update');


// Supprimer un étudiant
Route::delete('etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.delete');
