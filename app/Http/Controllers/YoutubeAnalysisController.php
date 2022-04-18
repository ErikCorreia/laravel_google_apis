<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alaouy\Youtube\Facades\Youtube;

class YoutubeAnalysisController extends Controller
{
    static function index()
    {
        $channel = Youtube::getChannelByName('maxmrm');
        return $channel;
    }
}
