<?php

namespace App\Http\Middleware\Livewire;

use Closure;

class LivewireLocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        $livewireLocale = $request->get('data')['livewireLocale'] ?? null;

        if ($livewireLocale) {
            if (in_array($livewireLocale, config('languages.allowed_languages'))) {
                app()->setLocale($livewireLocale);
                session()->put('locale', $livewireLocale);
            }
        }
        return $next($request);
    }
}
