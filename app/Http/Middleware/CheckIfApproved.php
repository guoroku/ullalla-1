<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckIfApproved
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
        $user = Auth::user();
        if ($user->approved != '1') {
            return redirect()->action('HomeController@getIndex');
        }

        return $next($request);
    }
}
