<?php

use App\Http\Controllers\HeroesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group( function() {
    Route::get('getHeroes', [HeroesController::class, 'index']);
    Route::get('getHeroById/{id}', [HeroesController::class, 'getHeroById']);
    Route::post('getHeroByName', [HeroesController::class, 'getHeroByName']);
    Route::get('getStoriesByHeroId/{id}', [HeroesController::class, 'getStoriesByHeroId']);
});

