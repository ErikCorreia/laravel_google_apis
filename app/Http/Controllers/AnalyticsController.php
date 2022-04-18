<?php

namespace App\Http\Controllers;

use Analytics;
use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use App\Http\Controllers\AuthController\GoogleAuthController;

class AnalyticsController extends Controller
{
    static function index()
    {
        // session_start();

        // if(!$_SESSION['access_token']) {
        //     GoogleAuthController::authentication();
        // }else{
        //     echo 'ok';
        //     header('Location: /analytics/data');
        //     exit;
        // }

        // $analyticsDataPerformQuery = Analytics::performQuery(
        //     Period::years(1),
        //     'ga:sessions',
        //     [
        //         'metrics' => 'ga:sessions, ga:pageviews',
        //         'dimensions' => 'ga:yearMonth'
        //     ]
        // );

        $analysis = Analytics::fetchMostVisitedPages(Period::days(7));

        return $analysis;
    }
}
