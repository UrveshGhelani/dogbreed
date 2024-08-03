<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BreedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParkController;

/**
     * Run the migrations.
     *
*/
Route::prefix('breed')->group(function () {
    Route::get('/', [BreedController::class, 'getAllBreeds']);
    Route::get('/random', [BreedController::class, 'getRandomBreed']);
    Route::get('/{id}', [BreedController::class, 'getBreed']);
    Route::get('/{id}/image', [BreedController::class, 'getBreedImage']);
});

Route::get('/update-breeds', [BreedController::class, 'getAllBreedsCronJob']);
Route::post('/user/{id}/associate', [UserController::class, 'getAssociateUser']);

Route::post('/park/{id}/breed', [ParkController::class, 'getAssociateBreed']);

Route::get('/showbreed/{breed}', [BreedController::class, 'show']);



