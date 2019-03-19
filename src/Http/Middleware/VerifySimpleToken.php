<?php

namespace Daikazu\SimpleTokenMiddleware\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifySimpleToken
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('token')) {
            if ($request->get('token') === config('simple-token-middleware.token')) {
                return $next($request);
            }
        }
        return response('Unauthorized.', 401);
    }
}
