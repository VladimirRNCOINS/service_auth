<?php

namespace App\Services\Validate;
use DB;
use Cookie;

class ValidateService
{
    public static function validate_user_token ()
    {
        $xut = Cookie::get('x-user-token');
        if (isset($xut)) {
            $cokie_token = DB::select("SELECT token_id FROM real_access_tokens WHERE cookie_user_token = ?", [$xut]);
            if ($cokie_token && $cokie_token[0] && $cokie_token[0]->token_id) {
                DB::delete("DELETE FROM personal_access_tokens WHERE id = ?", [$cokie_token[0]->token_id]);
            }
        }
    }
}