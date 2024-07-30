<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ValidateController extends Controller
{
    public function validate () {
        if (Auth::user()) {
            return response('OK', 200)->header('Content-Type', 'text/plain');
        }
        
        return response('Unauthorized', 401)->header('Content-Type', 'text/plain');
    }
}
