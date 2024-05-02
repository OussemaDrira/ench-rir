<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScategorieController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\EnchereController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('api')->group(function () {
    Route::resource('s_categories', SCategorieController::class); 
    });
    Route::middleware('api')->group(function () {
        Route::resource('categories', CategorieController::class); 
        });
        Route::middleware('api')->group(function () {
            Route::resource('encheres', EnchereController::class); 
            });
            Route::middleware('api')->group(function () {
                Route::resource('users', UserController::class); 
                });
 Route::middleware('api')->group(function () {
Route::resource('produits', ProduitController::class); 
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/login', [LoginController::class, 'login']);

Route::get('/ProduitNonApprouve', [ProduitController::class, 'ProduitNonEncoreApprouve']);
Route::put('/RefuseProduit/{id}', [ProduitController::class, 'RefuserProduit']);
Route::put('/ValiderProduit', [ProduitController::class, 'validerProduit']);
Route::get('/getUserByProduct/{id}', [ProduitController::class, 'getUserByProduct']);
Route::get('/getPriceByProduct/{id}', [ProduitController::class, 'getPriceByProduct']);
Route::get('/getSC/{id}', [SCategorieController::class, 'getScategorieByCategorie']);
Route::put('/changerStatu/{id}', [ProduitController::class, 'changerStatu']);

Route::put('/Encherer/{id}/{idUser}/{NewPrix}', [EnchereController::class, 'Encherer']);
Route::put('/Banner/{id}', [LoginController::class, 'Banner']);
Route::get('/ListUser', [LoginController::class, 'ListUser']);


Route::get('/nbreProduitEnchere', [ProduitController::class, 'nbreProduitEnchere']);
Route::get('/nbreProduitRefuse', [ProduitController::class, 'nbreProduitRefuse']);
Route::get('/nbreProduitNonValide', [ProduitController::class, 'nbreProduitNonValide']);
Route::get('/nbreProduitVendu', [ProduitController::class, 'nbreProduitVendu']);
Route::get('/nbreProduitNonVendu', [ProduitController::class, 'nbreProduitNonVendu']);

Route::get('/countEnchereEnCours', [EnchereController::class, 'countEnchereEnCours']);
Route::get('/countEnchereTermine', [EnchereController::class, 'countEnchereTermine']);
Route::middleware('auth:sanctum')->post(
    '/logout',
    [LoginController::class, 'logout']
);