<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PlanetController;
use App\Http\Controllers\SpeciesController;

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

// public endpoints
Route::get('/hello', function () {
    return ':)';
});

//Keycloak protected endpoints
Route::group(['middleware' => 'auth:api'], function (){
    Route::get('/people', [PeopleController::class, 'index']);
    Route::get('/people/{id}', [PeopleController::class, 'show']);

    Route::get('/planets', [PlanetController::class, 'index']);
    Route::get('/planets/{id}', [PlanetController::class, 'show']);

    Route::get('/species', [SpeciesController::class, 'index']);
    Route::get('/species/{id}', [SpeciesController::class, 'show']);
});

