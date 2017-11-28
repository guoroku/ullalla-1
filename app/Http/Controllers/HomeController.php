<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function getIndex()
	{
		$user = Auth::user();
		$defaultPackageExpired = null;
		
		if ($user) {
			$expiryDatePackage = getPackageExpiryDate(getDaysForExpiry($user->package1_id));
			$defaultPackageExpired = DB::table('users')
			->leftJoin('notifications', 'users.id', '=', 'notifications.notifiable_id')
			->where('users.id', $user->id)
			->where('notifications.title', 'Default Package Expiration')
			->whereBetween('users.package1_expiry_date', [Carbon::now(), $expiryDatePackage])->first();

			$expiryDatePackage = getPackageExpiryDate(getDaysForExpiry($user->package2_id));
			$gotmPackageExpired = DB::table('users')
			->leftJoin('notifications', 'users.id', '=', 'notifications.notifiable_id')
			->where('users.id', $user->id)
			->where('notifications.title', 'Girl of The Month Package Expiration')
			->whereBetween('users.package2_expiry_date', [Carbon::now(), $expiryDatePackage])->first();
		}

		// dd($defaultPackageExpired);

		return view('pages.index', compact('defaultPackageExpired', 'gotmPackageExpired'));
	}
}
