<?php

namespace App\Http\Middleware;

use App\Models\Course;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DenyAccessToLockCourseSeries
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth_user = null;

        // auh check for club member
        if (Auth::check()) {

            $auth_user = Auth::user();
        }

        // auth check for community member
        if(Auth::guard('community')->check()) {

            $auth_user = Auth::guard('community')->user();
        }

        $query_arrs = explode('/', request()->getUri());

        // Load completed
        if (!is_null($auth_user)) {

            $course = Course::where('slug', $query_arrs[4])->first();
            $last = $auth_user->finishes()->where('course_id', $course->id)->get()->last();
            $next_series = is_null($last) ? 1 : $last->serial_no + 1;
        } else {
            $next_series = 1;
        }

        $last_item_in_query = end($query_arrs);

        if ($last_item_in_query > $next_series) {

            abort(403, 'Request not allowed');
        }

        return $next($request);
    }
}
