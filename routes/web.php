<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchConsoleController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\YoutubeAnalysisController;
use App\Http\Controllers\GoogleAdsController;

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

Route::get('/gconsolesearch', [SearchConsoleController::class, 'index']);

Route::get('/gconsolesearch/data', [SearchConsoleController::class, 'showData']);

Route::get('/analytics', [AnalyticsController::class, 'index']);

Route::get('/youtube', [YoutubeAnalysisController::class, 'index']);

Route::get('/google-ads', [GoogleAdsController::class, 'index']);