<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alaouy\Youtube\Facades\Youtube;

class YoutubeAnalysisController extends Controller
{
    static function getChannelInfo($channel)
    {
        if($channel){
            try{
                return Youtube::getChannelByName($channel);
            }catch(\Exception $e){
                return $e->getMessage();
            }
        }
    
    }
}
