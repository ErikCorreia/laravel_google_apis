<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SearchConsole;
use App\Http\Controllers\AuthController\GoogleAuthController;
use SchulzeFelix\SearchConsole\Period as SearchConsolePeriod;
use Carbon\Carbon;

class SearchConsoleController extends Controller
{

    public function index()
    {


        if(!isset($_SESSION['access_token'])) {
            if(isset($_GET['code'])){
                
                GoogleAuthController::authentication();
            } else{

                GoogleAuthController::authentication();
            }

        }else{
            header('Location: /gconsolesearch/data');
            exit;
        }

    }

    public function showData()
    {

        session_start();

        try{
            if(isset($_SESSION['access_token'])) {
                // echo '<pre>';
                // die(print_r($_SESSION));
                // echo '</pre><hr>';
                $token =  $_SESSION['access_token']['access_token'];

                $sites = SearchConsole::setAccessToken($token)->listSites();
    
                // $oticacristalData = SearchConsole::setAccessToken($token)->setQuotaUser('uniqueQuotaUserString')
                // ->searchAnalyticsQuery(
                //     'https://oticacristal.com/',
                //     SearchConsolePeriod::create(Carbon::now()->subDays(30), Carbon::now()->subDays(2)),
                //     ['query', 'page', 'country', 'device', 'date'],
                //     [['dimension' => 'query', 'operator' => 'notContains', 'expression' => 'cheesecake']],
                //     1000,
                //     'web',
                //     'all',
                //     'auto'
                // );
    
                echo '<pre>';
                print_r($sites);
                echo '</pre><hr>';
                
                // echo '<pre>';
                // print_r($oticacristalData);
                // echo '</pre><hr>';
            }

        }catch(\Google\Service\Exception $e){

            if($e->getMessage()){
                // die($e->getMessage());
                session_destroy();

                echo '<h3 style="color: red">Token invalido</h3>';
                echo '<hr>';
                echo $e->getMessage();
                echo '<hr>';
                echo '<a href="/gconsolesearch">Tap Get Token</a>';

            }
            

        }

    }

}
