<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;

class GirlController extends Controller
{
	public function __construct()
	{

	}

	public function getIndex(Request $request)
	{
		$services = Service::with('users')->get();
		$users = DB::table('users')->leftJoin('prices', 'users.id', '=', 'prices.user_id');

		if ($request->has('services')) {
			$inputServices = $request->services;	
			$users = $users->leftJoin('user_service', 'users.id', '=', 'user_service.user_id')
			->whereIn('user_service.service_id', $request->services)
			->select('users.*')
			->groupBy('users.username');
		}

		if ($request->has('type')) {
			$users = $users->whereIn('users.type', $request->type);
		}

		if ($request->has('hair_color')) {
			$users = $users->whereIn('users.hair_color', $request->hair_color);
		}

		if ($request->has('breast_size')) {
			$users = $users->whereIn('users.breast_size', $request->breast_size);
		}

		if ($request->has('age')) {
			$inputAges = $request->age;
			foreach ($request->age as $key => $startAndEndAges) {
				$agesStrings = explode('-', $startAndEndAges);
				$startAge = $agesStrings[0];
				$endAge = $agesStrings[1];
				$users = $users->whereBetween('users.age', [$startAge, $endAge]);
			}
		}

		$orderBy = $request->order_by ? $request->order_by : null;
		$show = $request->show ? $request->show : null;

		$users = $users->where('users.approved', '=', '1')->where('users.is_active_d_package', '=', '1');
		$users = isset($orderBy) ? $users->orderBy(getBeforeLastChar($orderBy, '_'), getAfterLastChar($orderBy, '_')) : $users;
		$users = isset($show) ? $users->paginate($show) : $users->paginate(9);

		$request->flash();

		return view('pages.girls.index', compact('services', 'users', 'currentQueries'));
	}

	public function getGirl($nickname)
	{
		$user = User::with('services', 'country', 'prices')->nickname($nickname)->approved()->first();

		return view('pages.girls.single', compact('user'));
	}
}
