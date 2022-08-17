<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LocalizationController;

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


// Gestion de la langue
Route::get('lang/{locale}', [LocalizationController::class, 'index'])->name('lang');


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


// Authentifier un utilisateur
Route::get('login', [AuthController::class, 'index'])->name('auth.login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('custom.login');
// Enregistrer un nouvel utilisateur
Route::get('registration', [AuthController::class, 'create'])->name('auth.registration');
Route::post('custom-registration', [AuthController::class, 'store'])->name('custom.registration');
// Dashboard
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('auth.dashboard');
// Logout
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');


// Gestion Article
Route::get('articles', [ArticleController::class, 'index'])->name('article.index');
// Ajouter un article
Route::get('article-create', [ArticleController::class, 'create'])->name('article.create');
Route::post('article-create', [ArticleController::class, 'store'])->name('article.create.post');
// Afficher un article
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('article.show');
// Modifier un article
Route::get('article-edit/{article}', [ArticleController::class, 'edit'])->name('article.edit');
Route::put('article-edit/{article}', [ArticleController::class, 'update'])->name('article.update');
// Supprimer un article
Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('article.delete');


// Gestion Documents
Route::get('documents', [DocumentController::class, 'index'])->name('document.index');
// Ajouter un document
Route::get('document-create', [DocumentController::class, 'create'])->name('document.create');
Route::post('document-create', [DocumentController::class, 'store'])->name('document.create.upload');
// Afficher un document
Route::get('documents/{document}', [DocumentController::class, 'show'])->name('document.show');
// Modifier un document
Route::get('document-edit/{document}', [DocumentController::class, 'edit'])->name('document.edit');
Route::put('document-edit/{document}', [DocumentController::class, 'update'])->name('document.update');
// Download un document
Route::get('documents-download/{document}', [DocumentController::class, 'download'])->name('document.download');
// Supprimer un article
Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('document.delete');