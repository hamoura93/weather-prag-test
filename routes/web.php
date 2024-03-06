<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\weatherController;
use App\Services\WeatherService; // Add the missing import statement
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
    return view('welcome');
});


Route::get('/weather', [weatherController::class, 'getWeatherForm']);
Route::get('/weather', [weatherController::class, 'getWeatherFormLangLong']);
Route::get('/weather', [weatherController::class, 'getCurrentWeather']);
Route::get('/', [weatherController::class, 'getCurrentWeather']);
Route::post('/weatheres', [weatherController::class, 'getWeather']);
Route::post('/weatherforecast', [weatherController::class, 'getForecast']); 

