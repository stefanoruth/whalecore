<?php

namespace App\Http\Middleware;

use App\Exceptions\SiteSpecificAreaException;
use Closure;

class Tenancy
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
        $session = session('tenant');
        // dump($session);

        if (is_null($session)) {
            throw new SiteSpecificAreaException("A Site has not been selected", 403);
        }

        if (is_null(auth()->user()->sites()->find($session))) {
            throw new SiteSpecificAreaException("Site is unauthorized", 403);
        }

        return $next($request);
    }
}
