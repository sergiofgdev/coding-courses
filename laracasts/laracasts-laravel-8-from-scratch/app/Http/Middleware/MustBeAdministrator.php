<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/*
 * Esta clase será añadida como middleware personalizado a app/http/kernel.php
 */
class MustBeAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()?->username !== 'sergio') {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
