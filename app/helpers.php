<?php

use App\Models\Portal;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

if (!function_exists('is_url')) {
    function is_url(mixed $url)
    {
        $is_link = URL::isValidUrl($url);
        return $is_link;
    }
}

if (!function_exists('is_portal_on')) {
    function is_portal_on()
    {
        $status = false;

        $portal = Portal::all()->first();

        if (is_null($portal)) {
            $status = false;
        } elseif ($portal->is_on) {
            return $status = true;
        } else {
            $status = false;
        }

        return $status;
    }
}

// check if the currently authenticated administrator
// is a 'super admin'
if (!function_exists('is_superAdmin')) {

    function is_superAdmin() {

        $status = auth('admin')->user()
        ->roles->contains('name', 'super_admin');

        return $status;
    }
}

// check if the currently authenticated administrator
// is an 'admin'
if (!function_exists('is_admin')) {

    function is_admin() {

        $status = auth('admin')->user()
        ->roles->contains('name', 'admin');

        return $status;
    }
}

// check if the currently authenticated administrator
// is a 'content creator'
if (!function_exists('is_contentCreator')) {

    function is_contentCreator() {

        $status = auth('admin')->user()
        ->roles->contains('name', 'content_creator');

        return $status;
    }
}

if (!function_exists('is_guests')) {

    function is_guests() {

        $status = true;

        if((auth()->guest() == false) && (auth('community')->guest() == true))
            $status = false;

        if((auth('community')->guest() == false) && (auth()->guest() == true))
            $status = false;

        return $status;
    }
}

if (!function_exists('is_completed')) {

    function is_completed($course_id, $series_id) {

        /**
         * variable to hold completed series by
         * authenticated user; null on initialization
         */
        $completed_series = null;

        // if student club member is logged in; fetch and assigned to $completed_series
        if(auth()->check())
            $completed_series = auth()->user()->finishes();

        // if community member is logged in; fetch and assigned to $completed_series
        if(auth('community')->check())
            $completed_series = auth('community')->user()->finishes();

        /**
         * if $completed_series is null(i.e no authenticated user)
         * set $status to false else return whatever is the result
         * of the boolean operation
         */
        $status = is_null($completed_series) ? false : $completed_series->where([
            'course_id' => $course_id,
            'course_series_id' => $series_id
        ])->get()->count() > 0;

        return $status;
    }
}

if (!function_exists('is_staging')) {

    function is_staging()
    {
        $current_url = url()->current();
        $get_url_name = explode('://', $current_url);
        $split_url_name = explode('.', $get_url_name[1]);

        if($split_url_name[0] == 'staging')
            return true;
        else
            return false;
    }
}

if (!function_exists('title')) {

    function title($name = '')
    {
        seo()->title("Blip Computer School - {$name}");
    }
}

if (!function_exists('quotientAndRemainder')) {
    function quotientAndRemainder($dividend, $divisor) {
        $quotient = intdiv($dividend, $divisor); // Whole number part
        $remainder = $dividend % $divisor;       // Remainder part

        return [
            'quotient' => $quotient,
            'remainder' => $remainder,
        ];
    }
}