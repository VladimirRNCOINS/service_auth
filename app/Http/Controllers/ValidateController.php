<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Crypt;
use App\Resources\Logger;
use Cookie;

class ValidateController extends Controller
{
    public function validate (Request $request) 
    {
        if (!Auth::user()) {
            $xut = Cookie::get('x-user-token');
            if (isset($xut)) {
                $cokie_token = DB::select("SELECT token_id FROM real_access_tokens WHERE cookie_user_token = ?", [$xut]);
                if ($cokie_token && $cokie_token[0] && $cokie_token[0]->token_id) {
                    DB::delete("DELETE FROM personal_access_tokens WHERE id = ?", [$cokie_token[0]->token_id]);
                }
            }
            
            return response('Unauthorized', 401)->header('Content-Type', 'text/plain');
        }

        return response('OK', 200)->header('Content-Type', 'text/plain');
    }
}
