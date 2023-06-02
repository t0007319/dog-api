<?php

use App\Http\Controllers\BreedController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'user'], static function () {
    Route::post('/{user}/associate', 'UserController@associateType');
});

Route::post('/park/{parkId}/breed', [BreedController::class, 'linkBreedToPark']);

Route::group(['prefix' => 'breed'], static function () {
    Route::get('/', [BreedController::class, 'index']);
    Route::get('/random', [BreedController::class, 'getRandomDogImage']);
    Route::get('/{id}', [BreedController::class, 'show']);
    Route::get('/{id}/image', [BreedController::class, 'image']);
});
