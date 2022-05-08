<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    private $period;
    private $analytics = [];

    public function setIndex($siteId){
        
        try{
             //seta o valor de view_id em config/analytics.php com o valor passado na url
            Config::set('analytics.view_id', $siteId);

            $startDate = isset($_GET['startdate']) ? Carbon::createFromFormat('d-m-Y', $_GET['startdate']) : Carbon::now()->subDays(30);
            $endDate = isset($_GET['enddate']) ? Carbon::createFromFormat('d-m-Y', $_GET['enddate']) : Carbon::now();
            $this->period = Period::create($startDate, $endDate);
            
        }catch(\Exception $e){
            return $e->getMessage();
        }
        
    }
    public function getAllAnalytics()
    {

        try {

            $this->analytics = [
                    'most_visited_pages' =>[
                        'results' => Analytics::fetchMostVisitedPages($this->period),
                    ],

                    'total_visitors_and_page_views' => [
                        'results' => Analytics::fetchUserTypes($this->period),
                    ],

                    'site_reference' => [
                        // 'mesage' => 'Results between: ' . $startDate->format('d-m-Y') . ' and ' . $endDate->format('d-m-Y'),
                        'results' => Analytics::fetchTopReferrers($this->period),
                    ],
                ];

                // echo '<pre>';
                // die(var_dump($this->analytics));
                return $this->analytics;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
