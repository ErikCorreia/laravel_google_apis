<?php

namespace App\Http\Controllers\AuthController;

use Google_Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleAuthController extends Controller
{
    public static function authentication()
    {
        try {

            $client = new Google_Client();
            $client->setAuthConfig(storage_path('app/google-apis-credentials/oauth-account-credentials.json'));
            $client->addScope("https://www.googleapis.com/auth/webmasters");
            $client->setLoginHint('erik.netpixel@gmail.com');
            
            if (!isset($_GET['code'])) {
                
                $redirect_uri = 'http://127.0.0.1:8000/gconsolesearch';
                $auth_url = $client->createAuthUrl();
                header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
                
            } else {
                
                session_start();

                $client->authenticate($_GET['code']);
                $_SESSION['access_token'] = $client->getAccessToken();
                $redirect_uri = 'http://127.0.0.1:8000/gconsolesearch/data';
                header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));

            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        exit;

    }
}
