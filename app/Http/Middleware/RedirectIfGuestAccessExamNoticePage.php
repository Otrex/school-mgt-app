<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfGuestAccessExamNoticePage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth_user = false;

        $student_is_logged_in = Auth::check();

        $community_member_is_logged_in = Auth::guard('community')->check();

        if($student_is_logged_in)
            $auth_user = true;

        if($community_member_is_logged_in)
            $auth_user = true;

        if (!$auth_user || !session()->has('take_test')) {

            return redirect()->route('index');
        }

        return $next($request);
    }
}
