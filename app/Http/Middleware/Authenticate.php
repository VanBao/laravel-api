<?php

namespace App\Http\Middleware;

use App\Booking;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if($request->has('booking_id') && Booking::where('id',$request->booking_id)->exists()) {
                session(['return_to_booking_id' => $request->booking_id]);
            }
            return route('login');
        }
    }
}
