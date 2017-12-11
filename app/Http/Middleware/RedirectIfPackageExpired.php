<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Carbon\Carbon;

class RedirectIfPackageExpired
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

        $package2ExpiryDate = Carbon::parse($user->package2_expiry_date)->format('Y-m-d');
        if (Carbon::now() >= $package2ExpiryDate) {
            $user->is_active_gotm_package = 0;
            $user->save();
        }

        $package1ExpiryDate = Carbon::parse($user->package1_expiry_date)->format('Y-m-d');
        if (Carbon::now() >= $package1ExpiryDate) {
            $user->is_active_d_package = 0;
            $user->save();
            return redirect()->action('ProfileController@getPackages', ['username' => $user->username])
                            ->with('expired_package_info', 'Please upgrade your account.');
        }

        return $next($request);
    }
}
