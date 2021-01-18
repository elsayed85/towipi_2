<?php

namespace App\Http\Middleware\Site;

use Closure;

class SiteStatusMiddleware
{
    public function handle($request, Closure $next)
    {
        if (isSiteIsLocked()) {
            if (isSiteInMaintenanceMode()) {
                return response()->view('site.maintenance');
            } elseif (isSiteInVacationMode()) {
                return response()->view('site.vacation');
            }
        }
        return $next($request);
    }
}
