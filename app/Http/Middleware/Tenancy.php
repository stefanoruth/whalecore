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
        $cookie = $request->cookie('tenant');

        if (is_null($cookie)) {
            throw new SiteSpecificAreaException("A Site has not been selected", 403);
        }

        return $next($request);
    }
}
