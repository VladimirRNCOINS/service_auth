<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Auth;
use DB;

class AuthAccessController extends Controller
{
    public function api_access (Request $request)
    {
        $req_service_auth_sessions = $request->cookie('service_auth_session');
        
        if (isset($req_service_auth_sessions)) {
            $service_auth_session = Crypt::decryptString($req_service_auth_sessions);
        }
        
        if (isset($service_auth_session)) {
            $service_auth_session_arr = explode("|", $service_auth_session);
        }

        if (isset($service_auth_session_arr[1])) {
            $user_id = DB::select("SELECT user_id FROM sessions WHERE id = ?", [$service_auth_session_arr[1]]);   
        }

        if (!isset($user_id) || !isset($user_id[0]) || !isset($user_id[0]->user_id)) {
            return response()->json(false, 200);
        }

        $token = DB::select("SELECT rat.real_token AS token
                                    FROM personal_access_tokens pat
                                    JOIN real_access_tokens rat
                                    ON pat.id = rat.token_id
                                    WHERE pat.tokenable_id = ?", [$user_id[0]->user_id]);

        if (!isset($token) || !isset($token[0]) || !isset($token[0]->token)) {
            return response()->json(false, 200);
        }
        
        return response()->json($token[0]->token, 200);
    }

    public function error_401 (Request $request) 
    {
        $b_token = $request->bearerToken();
        if (!isset($b_token ) || !$b_token) {
            return false;
        }
        $b_token_arr = explode('|', $b_token);
        if (isset($b_token_arr[0])) {
            DB::update("UPDATE sessions SET user_id = ? WHERE user_id = ?", [NULL, $b_token_arr[0]]);
            DB::delete("DELETE FROM personal_access_tokens WHERE tokenable_id = ?", [$b_token_arr[0]]);
            return true;
        }
        
        return false;
    }
}
