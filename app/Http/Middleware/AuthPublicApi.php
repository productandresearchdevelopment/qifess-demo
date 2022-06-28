<?php
/*
 * https://www.phpencode.org/
 */
namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\SystemModels\Auth\User;
use Request;
use Closure;

class AuthPublicApi
{
    public function handle($request, Closure $next)
    {
        $key = $request->header('key');
        $key = $key ? $key : $request->input('key');
        if($key) {
            if ($user = User::where('token', $key)->where('role_id', 20)->first()) {
                Auth::guard()->login($user);
                $user->update(['last_ip' => Request::ip(), 'last_active' => date('Y-m-d H:i:s')]);
                return $next($request);
            }
        }
        return abort(403);
    }
}
