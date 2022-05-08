<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\SearchConsoleController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\YoutubeAnalysisController;
// use App\Http\Controllers\GoogleAdsController;

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

//Routes to consult Google analytics API
//parameters: days
Route::get('/analytics/{siteid}', function($siteId) {
    $siteAnalytics = new AnalyticsController();
    $siteAnalytics->setIndex($siteId);

    return ['results' => $siteAnalytics->getAllAnalytics()];
});
// Route::get('/analytics/{siteid}', function($siteId) {
//     return AnalyticsController::index($siteId);
// });

Route::get('/youtube/{channel?}', function($channel = null){
    return [
        'message' => 'Youtube info from channel: ' . $channel,
        'results' => YoutubeAnalysisController::getChannelInfo($channel),
    ];
});