<?php

namespace App\Http\Controllers\Auth;

use DB;
use Auth;
use Mail;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserType;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\ActivationMail;
use App\Events\PackageExpired;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\SignInRequest;
use App\Http\Controllers\Controller;
use App\Events\MonthOfTheGirlPackageExpired;

class AuthController extends Controller
{
	public function __construct() 
	{
		$this->middleware('guest', ['except' => 'getSignout']);
	}

	public function getSignup() 
	{
		$userTypes = UserType::all();
		return view('auth.signup', compact('userTypes'));
	}

	public function postSignup(SignUpRequest $request) 
	{
		// create a new user
		$user = new User;
		$user->username = $request->username;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->user_type_id = $request->user_type;
		$user->save();

		// generate token
		$token = str_random(40);

        // insert data in user_activations table
		DB::table('user_activations')->insert(['user_id' => $user->id, 'token' => $token]);

        // get the token from the user_activations table
		$userActivation = DB::table('user_activations')->where('token', $token)->first();

        //send an email with the activation token used from user_activations table
		Mail::to($user->email)->send(new ActivationMail($userActivation));

		Session::flash('success', __('messages.success_check_activation_link'));

		return redirect()->action('Auth\AuthController@getSignin');
	}

	public function getSignin()
	{
		return view('auth.signin');
	}

	public function postSignin(SignInRequest $request)
	{
		if (Auth::attempt($request->only(['username', 'password']))) {
			$user = Auth::user();
			if ($user->activated == '0') {
				Auth::logout();
				return redirect()->back()->with('error', __('messages.error_activate_account'));
			}

			if ($user->isAdmin()) {
				return redirect()->action('AdminController@getInactiveUsers');
			}

            // user can sign in
			if ($user->package1_id) {

				// get expiry date days before expiration
				$expiryDateDefaultPackage = getPackageExpiryDate(getDaysForExpiry($user->package1_id));
				$expiryDateGirlOfTheMonthPackage = getPackageExpiryDate(getDaysForExpiry($user->package2_id));
				// get expiry dates from db
				$package1ExpiryDate = Carbon::parse($user->package1_expiry_date)->format('Y-m-d');
				$package2ExpiryDate = Carbon::parse($user->package2_expiry_date)->format('Y-m-d');

				// deactivate packages if it they are expired
				if (Carbon::now() >= $package2ExpiryDate) {
					$user->is_active_gotm_package = 0;
					$user->save();
					if (Carbon::now() < $package1ExpiryDate) {
						$url = url('@' . $user->username . '/packages');
						Session::flash('gotm_expired_package_info', 
							__('messages.error_gotm_package_expired', ['url' => $url]));
					}
				}
				if (Carbon::now() >= $package1ExpiryDate) {
					$user->is_active_d_package = 0;
					$user->save();
					return redirect()->action('ProfileController@getPackages', ['username' => $user->username])
					->with('expired_package_info', __('messages.error_default_package_expired'));
				}

				// package expiry notifications
				if ($package1ExpiryDate < $expiryDateDefaultPackage) {
					event(new PackageExpired($user));
					Session::flash('defaultGirlPackageExpired', __('messages.default_package_about_to_expire'));					
				}

				if ($package2ExpiryDate < $expiryDateGirlOfTheMonthPackage) {
					event(new MonthOfTheGirlPackageExpired($user));
					Session::flash('gotmPackageExpired', __('messages.gotm_package_about_to_expire'));
				}

				// $diff=date_diff(Carbon::now(), date_create($user->package1_expiry_date));
				// dd($diff->days);
				return redirect('/');
			} else {
				return redirect()->action('ProfileController@getCreate', ['username' => $user->username]);
			}
		}

		return redirect()->back()->with('error', __('messages.wrong_credentials'));
	}

	public function getSignout() {
		Auth::logout();
		return redirect('/signin');
	}

	public function userActivation($token)
	{
		$check = DB::table('user_activations')->where('token', $token)->first();

		if (!is_null($check)) {

			$user = User::find($check->user_id);

			if ($user->activated == '1') {
				return redirect('signin')->with('error', __('messages.account_already_activated'));
			}

			$user = User::find($user->id);
			$user->activated = '1';
			$user->save();

			redirect()->action('Auth\AuthController@getSignin')->with('success', 
				('messages.account_activated'));

		}

		return redirect()->action('Auth\AuthController@getSignin')->with('error', __('messages.error_somethings_wrong'));
	}
}
