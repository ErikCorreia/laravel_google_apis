<?php

use Illuminate\Support\Facades\Route;


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

    // die(print_r($_GET) . '<small style="color: red"> stap 1 </small>');
    if(!isset($_SESSION['access_token'])){
        SearchConsoleController::index();
    }else{
        header('Location:/auth' );
    }

});
Route::post('/{code?}{scope?}', function ($code = null, $scope = null) {
    die(print_r($_GET) . '<small style="color: red"> stap 2 </small>');
    !isset($_SESSION['access_token']) ? SearchConsoleController::index() :  header('Location:/auth' );

});

Route::get('/auth{code?}{scope?}', function ($code = null, $scope = null) {

    session_start();
    // die(print_r($_GET) . '<small style="color: red"> stap 3 </small>');
    
    if(isset($_SESSION['access_token'])){

        $dataFromGoogleSearchConsole = SearchConsoleController::showData(); 
        $dataFromYoutubeChannel = YoutubeAnalysisController::index();
        $dataFromGoogleAnalytics =  AnalyticsController::index();

        $getAllSiteAnalysis = [
            'Google_Console_Search' => $dataFromGoogleSearchConsole,
            'Google_Youtube_Analysis' => $dataFromYoutubeChannel,
            'Google_Analytics' => $dataFromGoogleAnalytics
        ];
    
        echo '<pre>';
        echo '<h3 style="color: green">Dados do Google Search Console</h3>';
        print_r(($getAllSiteAnalysis['Google_Console_Search']));
        echo '<hr>';
        echo '<h3 style="color: red">Dados do Canal Do Youtube</h3>';
        print_r($getAllSiteAnalysis['Google_Youtube_Analysis']);
        echo '<hr>';
        echo '<h3 style="color: yellow">Dados do Google Analytics</h3>';
        print_r($getAllSiteAnalysis['Google_Analytics']);
        echo '</pre>';

    }else{
        // die(print_r($_GET) . '<small style="color: red"> stap 3 </small>');
        header('Location:/?code='. $_GET['code'] .'&scope='.$_GET['scope']);
        exit;
    }

    return view('welcome', [
        //array para percorrer na view
        'Google_Console_Search' => $getAllSiteAnalysis['Google_Console_Search'],
        'Google_Youtube_Analysis' => $getAllSiteAnalysis['Google_Youtube_Analysis'],
        'Google_Analytics' => $getAllSiteAnalysis['Google_Analytics'],
    ]);
});

Route::get('/testview', function () {

    $arr = [1,2,3,4,5];

    return view('testeview', ['data' => $arr]);
});

Route::get('/gconsolesearch', [SearchConsoleController::class, 'index']);

Route::get('/gconsolesearch/data', [SearchConsoleController::class, 'showData']);

// Route::get('/google-ads', [GoogleAdsController::class, 'index']);
