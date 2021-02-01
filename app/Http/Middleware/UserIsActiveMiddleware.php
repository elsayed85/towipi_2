<?php

namespace App\Http\Middleware;

use Closure;

class UserIsActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->is_active) {
            auth()->logout();
            return redirect(route('login'))->withFailed(trans('site.msg.account_is_not_active'));
        }
        return $next($request);
    }
}
