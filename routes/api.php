<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\weatherController; // Add the missing import statement for WeatherController

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/**Route::get('/', [weatherController::class, 'getCurrentWeather']);
Route::get('/weather', [weatherController::class, 'getWeatherByCity']);
Route::get('/forecast', [weatherController::class, 'getForecast']);
**/