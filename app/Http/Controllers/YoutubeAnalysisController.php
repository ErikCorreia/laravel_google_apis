<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alaouy\Youtube\Facades\Youtube;

class YoutubeAnalysisController extends Controller
{
    public function index()
    {
        $channel = Youtube::getChannelByName('maxmrm');
        echo '<pre>';
        print_r($channel);
    }
}
