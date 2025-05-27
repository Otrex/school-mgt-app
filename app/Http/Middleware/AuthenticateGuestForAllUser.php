<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateGuestForAllUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $status = true;

        if((auth()->guest() == false) && (auth('community')->guest() == true))
            $status = false;

        if((auth('community')->guest() == false) && (auth()->guest() == true))
            $status = false;

        if (!$status) {

            return redirect()->route('index');
        }

        return $next($request);
    }
}
