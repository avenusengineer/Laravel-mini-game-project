<?php

use App\Http\Controllers\Analytics\AnalyticsEventController;
use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('games', 'GameFlavorController@getGameFlavorsForCriteria')->name('game_flavors.get');
Route::post("/analytics/store", [AnalyticsEventController::class, 'store']);
Route::post("/analytics/store/icsee", [AnalyticsEventController::class, 'storeICSeeEvent']);
Route::post("/analytics/store/newsum", [AnalyticsEventController::class, 'storeNewsumEvent']);