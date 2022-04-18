<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SearchConsole;
use App\Http\Controllers\AuthController\GoogleAuthController;
use SchulzeFelix\SearchConsole\Period as searchConsolePeriod;
use Carbon\Carbon;
use DatePeriod;
use Google_Service_Webmasters_SearchAnalyticsQueryRequest;


class SearchConsoleController extends Controller
{
    static $sites;
    // static $siteData;

    static function index()
    {

        if(!isset($_SESSION['access_token'])) {
            // die(print_r($_GET) . '<small style="color: red"> stap 2 </small>');
            GoogleAuthController::authentication();

            // if(isset($_GET['code'])){
            // }
            
            // die(print_r($_GET));
            // if(isset($_GET['code'])){
            // } else{
            //     GoogleAuthController::authentication();
            // }

        }else{
            header('Location: http://127.0.0.1:8000/auth');
            exit;
        }

    }

    static function showData()
    {
        if(!isset($_SESSION)){
            session_start();
        };

        try{
            if(isset($_SESSION['access_token'])) {

                $token =  $_SESSION['access_token']['access_token'];
                // self::$sites = SearchConsole::setAccessToken($token)->listSites();
                self::$sites = SearchConsole::setAccessToken($token)->setQuotaUser('oticacristal.com.br/')->listSites();
                // self::$sites = SearchConsole::getWebmastersService();

                // self::$siteData = SearchConsole::setAccessToken($token)->setQuotaUser('uniqueQuotaUserString')
                // ->searchAnalyticsQuery(
                //     'https://oticacristal.com',
                //     searchConsolePeriod::create(Carbon::now()->subDays(30), Carbon::now()->subDays(2)),
                //     ['query', 'page', 'country', 'device', 'date'],
                //     [['dimension' => 'query', 'operator' => 'notContains', 'expression' => 'cheesecake']],
                //     1000,
                //     'web',
                //     'all',
                //     'auto'
                // );
    
            }

        }catch(\Google\Service\Exception $e){

            //talvez isso gere um loop resultando em um erro "to many request"
            if($e->getMessage()){

                session_destroy();

                echo '<h3 style="color: red">Token invalido</h3>';
                echo '<hr>';
                echo $e->getMessage();
                echo '<hr>';
                echo '<a href="/gconsolesearch">Tap Get Token</a>';

            }
            
        }
        
        return self::$sites;
        // die(var_dump(self::$siteData));
    }

}
