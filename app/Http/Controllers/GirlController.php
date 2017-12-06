<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Canton;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\SpokenLanguage;

class GirlController extends Controller
{
	public function getIndex(Request $request)
	{
		$services = Service::with('users')->get();
		$spokenLanguages = SpokenLanguage::with('users')->get();
		$maxPrice = \DB::table('prices')->max('service_price');
		$cantons = Canton::with('users')->get();

		$users = DB::table('users')->leftJoin('prices', 'users.id', '=', 'prices.user_id');

		if ($request->has('canton')) {
			$users = $users->leftJoin('cantons', 'users.canton_id', '=', 'cantons.id')
			->whereIn('cantons.id', $request->canton);
		}

		if ($request->has('services')) {
			$users = $users->leftJoin('user_service', 'users.id', '=', 'user_service.user_id')
			->whereIn('user_service.service_id', $request->services)
			->groupBy('users.username');
		}

		if ($request->has('languages')) {
			$users = $users->leftJoin('user_spoken_language', 'users.id', '=', 'user_spoken_language.user_id')
			->whereIn('user_spoken_language.spoken_language_id', $request->languages);
		}

		if ($request->has('type')) {
			$users = $users->whereIn('users.type', $request->type);
		}

		if ($request->has('price_type')) {
			$users = $users->whereNotNull('users.' . $request->price_type . '_type');
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

		if ($request->has('price_from') && $request->has('price_to')) {
			$inputPriceFrom = $request->price_from;
			$inputPriceTo = $request->price_to;
			if ($inputPriceFrom == 0 && $inputPriceTo == $maxPrice) {
				$users = $users;
			} else {
				$users->whereBetween('prices.service_price', [$inputPriceFrom, $inputPriceTo]);
			}
		}
		
		$users = $users->where('users.approved', '=', '1')
		->where('users.is_active_d_package', '=', '1')
		->select('users.*', 'prices.*')
		->groupBy('users.username');

		$orderBy = $request->order_by ? $request->order_by : null;
		$show = $request->show ? $request->show : null;

		$users = isset($orderBy) ? $users->orderBy(getBeforeLastChar($orderBy, '_'), getAfterLastChar($orderBy, '_')) : $users;
		$users = isset($show) ? $users->paginate($show) : $users->paginate(9);

		$request->flash();

		return view('pages.girls.index', compact('services', 'users', 'cantons', 'spokenLanguages', 'pricesTypes', 'maxPrice'));
	}

	public function getGirl($nickname)
	{
		$user = User::with('services', 'country', 'prices')->nickname($nickname)->approved()->first();

		if (!$user) {
			redirect()->url('/');
		}

		return view('pages.girls.single', compact('user'));
	}

	public function getPriceRanges(Request $request)
	{
		if ($request->ajax()) {
			$url = urldecode(route('girls', $request->query(), false));
			return response()->json([
				'url' => $url
			]);
		}
	}
}
