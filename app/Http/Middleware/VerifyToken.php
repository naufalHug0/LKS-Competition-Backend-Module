<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\societies;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;

class VerifyToken
{
    public function handle(Request $request, Closure $next)
    {
        $user = empty($request->token) ? null : societies::where('login_tokens', $request->token)->first();

        if ($user) {
            $request->merge(array('user' => $user));
            return $next($request);
        }
        
        return ApiFormatter::createApi(401, ['message'=>'Unauthorized user']);

    }
}
