<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class LogoutController extends Controller
{
    public function logout (Request $request)
    {
        if (Auth::user()) {
            $user_id = Auth::user()->id;

            Auth::logout();
    
            $request->session()->invalidate();
        
            $request->session()->regenerateToken();

            if (isset($user_id)) {
                DB::delete("DELETE FROM personal_access_tokens WHERE tokenable_id = ?", [$user_id]);
            }
        }
        
        return redirect()->away('http://api_gateway.local:81/signin');
    }
}