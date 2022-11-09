<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisiteurController;
use \App\Http\Controllers\FraisController;
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
    return view('home');
});

Route::get('/seConnecter', [VisiteurController::class, 'getLogin']);
Route::post('/login', [VisiteurController::class , 'signIn']);
Route::get('/seDeconnecter', [VisiteurController::class, 'signOut']);

Route::get('/getListeFrais', [FraisController::class, 'getFraisVisiteur']);
Route::get('/listerFrais', [FraisController::class, 'getFraisVisiteur']);


Route::get('/modifierFrais/{id}', [FraisController::class, 'updateFrais']);
Route::post('/validerFrais', [FraisController::class, 'validateFrais']);


Route::get('/ajouterFrais', [FraisController::class, 'addFrais']);
Route::post('/validerFrais', [FraisController::class, 'validateFrais']);

Route::get('/supprimerFrais/{id}', [FraisController::class, 'supprimeFrais']);

//Frais Hors Forfait
Route::get('/listeFraisHorsForfait/{id}', [FraisController::class, 'getFraisVisiteurHorsForfait']);

Route::get('/modifierFraisHorsForfait/{id}', [FraisController::class, 'updateFraisHosForfait']);
Route::post('/validerFraisHorsForfait', [FraisController::class, 'validateFraisHorsForfait']);

Route::get('/ajouterFraisHorsForfait/{id}', [FraisController::class, 'addFraisHorsForfait']);
Route::post('/validerFraisHorsForfait/{id}', [FraisController::class, 'validateFraisHorsForfait']);
