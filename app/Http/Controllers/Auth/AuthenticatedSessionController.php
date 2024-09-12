<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Route;
use Cookie;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request, Response $response): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        DB::delete("DELETE FROM personal_access_tokens WHERE tokenable_id = ?", [Auth::user()->id]);

        $user = User::where('email', $request->email)->first();
 
        $token = $user->createToken('auth_token')->plainTextToken;

        $token_id = DB::select("SELECT max(id) AS t_id FROM personal_access_tokens WHERE tokenable_id = ?",[$user->id]);

        if ($token_id && $token_id[0] && $token_id[0]->t_id) {

            $uid = uniqid("flkjz-", true);
            
            DB::insert("INSERT INTO real_access_tokens (real_token, token_id, cookie_user_token) VALUES (?, ?, ?)", [$token, $token_id[0]->t_id, $uid]);

            return redirect()->back()->withCookie(Cookie::make('x-user-token', $uid));
        }

        return redirect()->route('signin');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
