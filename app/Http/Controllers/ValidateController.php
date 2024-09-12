<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Services\Validate\ValidateService;

class ValidateController extends Controller
{
    public function validate (Request $request) 
    {
        if (!Auth::user()) { 
            ValidateService::validate_user_token();
            return response('Unauthorized', 401)->header('Content-Type', 'text/plain');
        }

        return response('OK', 200)->header('Content-Type', 'text/plain');
    }
}
