<?php

namespace App\Http\Middleware;

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
        $user = auth()->user();

        // dd($user);

        if ($user->approved != 1) {
            if ($user->package1_id) {
                return redirect()->action('HomeController@getIndex')->with('not_approved', 'Your account is not approved yet.');
            }
            return redirect()->action('ProfileController@getCreate', ['username' => $user->username]);
        } 

        return $next($request);
    }
}
