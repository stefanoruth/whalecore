<?php

namespace App\Http\Middleware;

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

        if (is_null($session)) {
            throw new \Exception('A project has not been selected', 403);
        }

        if (is_null(auth()->user()->projects()->find($session))) {
            throw new \Exception('Project is unauthorized', 403);
        }

        return $next($request);
    }
}
