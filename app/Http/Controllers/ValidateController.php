<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Crypt;
use App\Resources\Logger;

class ValidateController extends Controller
{
    public function validate (Request $request) {
        /*$req_service_auth_sessions = $request->cookie('service_auth_session');
        if (isset($req_service_auth_sessions)) {
            $service_auth_session = Crypt::decryptString($req_service_auth_sessions);
            Logger::log($req_service_auth_sessions);
        }*/
        
        if (!Auth::user()) {
            return response('Unauthorized', 401)->header('Content-Type', 'text/plain');
        }

        return response('OK', 200)->header('Content-Type', 'text/plain');
    }
}
