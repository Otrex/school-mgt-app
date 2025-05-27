<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthRoleSuperAdminOrAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $status = false;

        if(Auth::guard('admin')->user()->roles->contains('name', 'super_admin'))
            $status = true;

        if(Auth::guard('admin')->user()->roles->contains('name', 'admin'))
            $status = true;

        if (!$status) {

            abort(403, 'Unauthorize access to non admin');
        }

        return $next($request);
    }
}
