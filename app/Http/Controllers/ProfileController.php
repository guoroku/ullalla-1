<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use DateTime;
use Validator;
use Carbon\Carbon;
use App\Models\Price;
use App\Models\Canton;
use App\Models\Service;
use App\Models\Country;
use App\Models\Package;
use App\Rules\OlderThanRule;
use Illuminate\Http\Request;
use Stripe\{Charge, Customer};

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('approved', ['except' => ['postCreate', 'getCreate', 'postNewPrice', 'deletePrice']]);
        $this->middleware('package.expiry', ['except' => ['getPackages', 'postPackages', 'getCreate', 'postCreate', 'postNewPrice', 'deletePrice']]);
    }

    public function getCreate()
    {
        $user = Auth::user();
        $cantons = Canton::all();
        $packages = Package::all();
        $services = Service::all();
        $countries = Country::all();
        $prices = Price::where('user_id', $user->id)->get();

        return view('pages.profile.create', compact('packages', 'cantons', 'countries', 'services', 'user', 'prices'));
    }

    public function postCreate(Request $request)
    {
        $defaultPackage = '';
        $monthGirlPackage = '';
        $workingTime = getWorkingTime($request->days, $request->available_24_7, $request->time_from, $request->time_from_m, $request->time_to, $request->time_to_m, $request->available_24_7_night_escort, $request->night_escorts);

        // get pacakges by id with previously defined session
        if (Session::has('default_package')) {
            $defaultPackage = Package::findOrFail(Session::get('default_package'));
        }
        if (Session::has('month_girl_package')) {
            $monthGirlPackage = Package::findOrFail(Session::get('month_girl_package'));
        }

        // calculate the total amount
        $totalAmount = (int) filter_var($defaultPackage->package_price, FILTER_SANITIZE_NUMBER_INT);
        if (!empty($monthGirlPackage)) {
            $totalAmount += (int) filter_var($monthGirlPackage->package_price, FILTER_SANITIZE_NUMBER_INT);
        }

        $result = DB::transaction(function () use ($totalAmount, $defaultPackage, $monthGirlPackage, $workingTime) {
            // create profile
            try {
                $user = Auth::user();
                $user->first_name = request('first_name');
                $user->last_name = request('last_name');
                $user->nickname = request('nickname');
                $user->age = request('age');
                $user->country_id = request('nationality_id');
                $user->sex = request('sex');
                $user->sex_orientation = request('sex_orientation');
                $user->height = request('height');
                $user->weight = request('weight');
                $user->type = request('type');
                $user->figure = request('figure');
                $user->breast_size = request('breast_size');
                $user->eye_color = request('eye_color');
                $user->hair_color = request('hair_color');
                $user->tattoos = request('tattoos');
                $user->piercings = request('piercings');
                $user->body_hair = request('body_hair');
                $user->intimate = request('intimate');
                $user->smoker = request('smoker');
                $user->alcohol = request('alcohol');
                $user->about_me = request('about_me');
                $user->photos = storeAndGetUploadCareFiles(request('photos'));
                $user->videos = storeAndGetUploadCareFiles(request('video'));
                $user->email = request('email');
                $user->phone = request('phone');
                $user->mobile = request('mobile');
                $user->canton_id = request('canton');
                $user->city = request('city');
                $user->zip_code = request('zip_code');
                $user->address = request('address');
                $user->working_time = $workingTime;
                $carbonDate = Carbon::parse(request('package_activation_date'));
                $user->package1_id = $defaultPackage->id;
                $user->is_active_d_package = 1;
                $user->package1_activation_date = $carbonDate->format('Y-m-d H:i:s');
                $user->package1_expiry_date = $carbonDate
                ->addDays(daysToAddToExpiry($defaultPackage->id))
                ->format('Y-m-d H:i:s');
                if (!empty(request('package_month_girl_activation_date')) && !empty($monthGirlPackage)) {
                    $carbonDate = Carbon::parse(request('package_month_girl_activation_date'));
                    $user->package2_id = $monthGirlPackage->id;
                    $user->is_active_gotm_package = 1;
                    $user->package2_activation_date = $carbonDate->format('Y-m-d H:i:s');
                    $user->package2_expiry_date = $carbonDate
                    ->addDays(daysToAddToExpiry($monthGirlPackage->id))
                    ->format('Y-m-d H:i:s');
                }
                $user->save();

                // sync services to the user
                if (request('services') != null) {
                    $user->services()->sync(request('services'));
                } else {
                    $user->services()->sync([]);
                }
                $user->save();

            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ]);
            }

            // stripe
            try {
                // create a customer
                $customer = Customer::create([
                    'email' => request('stripeEmail'),
                    'source' => request('stripeToken'),
                ]);
                $user->stripe_id = $customer->id;
                $user->save();             
            } catch (\Exception $e) {
                return response()->json([
                    'status' => $e->getMessage()
                ], 422);
            }

            return true;
        });

        if ($result !== true) {
            return redirect('/')->with('error', 'There was an error');
        }

        // Auth::logout();
        Session::flash('success', 'Profile Successfullt Created');
    }

    public function getBio()
    {
        $cantons = Canton::all();
        $packages = Package::all();
        $services = Service::all();
        $countries = Country::all();
        $user = Auth::user();

        return view('pages.profile.bio', compact('packages', 'cantons', 'countries', 'services', 'user'));
    }

    public function postBio(Request $request)
    {
        $this->validate($request, [
            'nickname' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required',
            'age' => ['required', 'numeric', new OlderThanRule],
        ]);

        $user = Auth::user();
        $user->nickname = $request->nickname;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->country_id = Country::where('id', $request->nationality)->value('id');
        $user->age = $request->age;
        $user->height = $request->height;
        $user->weight = $request->weight;
        $user->sex = checkIfItemExists(getSexes(), $request->sex);
        $user->sex_orientation = checkIfItemExists(getSexOrientations(), $request->sex_orientation);
        $user->type = checkIfItemExists(getTypes(), $request->type);
        $user->figure = checkIfItemExists(getFigures(), $request->figure);
        $user->breast_size = checkIfItemExists(getBreastSizes(), $request->breast_size);
        $user->eye_color = checkIfItemExists(getEyeColors(), $request->eye_color);
        $user->hair_color = checkIfItemExists(getHairColors(), $request->hair_color);
        $user->tattoos = checkIfItemExists(getAnswers(), $request->tattoos);
        $user->piercings = checkIfItemExists(getAnswers(), $request->piercings);
        $user->body_hair = checkIfItemExists(getShaveOptions(), $request->body_hair);
        $user->intimate = checkIfItemExists(getShaveOptions(), $request->intimate);
        $user->smoker = checkIfItemExists(getAnswers(), $request->smoker);
        $user->alcohol = checkIfItemExists(getAnswers(), $request->alcohol);

        $user->save();

        return redirect()->back()->with('success', 'Bio successfully saved.');
    }

    public function getAbout()
    {
        $user = Auth::user();

        return view('pages.profile.about', compact('user'));
    }

    public function postAbout()
    {
        $user = Auth::user();
        $user->about_me = request('about_me');
        $user->save();

        return redirect()->back()->with('success', 'Data successfully saved.');
    }

    public function getGallery()
    {
        $user = Auth::user();

        return view('pages.profile.gallery', compact('user'));
    }

    public function postGallery()
    {
        $user = Auth::user();
        $user->photos = storeAndGetUploadCareFiles(request('photos'));
        $user->videos = storeAndGetUploadCareFiles(request('video'));
        $user->save();
        
        return redirect()->back()->with('success', 'Gallery successfully updated.');
    }

    public function getContact()
    {
        $user = Auth::user();

        return view('pages.profile.contact', compact('user'));
    }

    public function postContact()
    {
        $user = Auth::user();
        $user->phone = request('phone');
        $user->mobile = request('mobile');
        $user->save();
        
        return redirect()->back()->with('success', 'Contact successfully updated.');
    }

    public function getServices()
    {
        $user = Auth::user();
        $services = Service::all();

        return view('pages.profile.services', compact('user', 'services'));
    }

    public function postServices()
    {
        $user = Auth::user();
        $user->services()->sync(request('services'));

        return redirect()->back()->with('success', 'Services successfully updated.');
    }

    public function getWorkplace()
    {
        $user = Auth::user();
        $cantons = Canton::all();

        return view('pages.profile.workplace', compact('user', 'cantons'));
    }

    public function postWorkplace()
    {
        $user = Auth::user();
        $user->canton_id = request('canton');
        $user->city = request('city');
        $user->address = request('address');
        $user->zip_code = request('zip_code');
        $user->save();

        return redirect()->back()->with('success', 'Workplace successfully updated.');
    }

    public function getWorkingTimes()
    {
        $user = Auth::user();

        return view('pages.profile.working_time', compact('user'));
    }

    public function postWorkingTimes(Request $request)
    {
        $user = Auth::user();
        $workingTime = getWorkingTime($request->days, $request->available_24_7, $request->time_from, $request->time_from_m, $request->time_to, $request->time_to_m, $request->available_24_7_night_escort, $request->night_escorts);

        $user->working_time = $workingTime;
        $user->save();

        return redirect()->back()->with('success', 'Work time successfully updated.');
    }

    public function getPrices()
    {
        $user = Auth::user();

        return view('pages.profile.prices', compact('user'));
    }

    public function getPackages()
    {
        $user = Auth::user();
        $packages = Package::all();
        // remove sessions if there are any
        if (Session::has('default_package')) {
            Session::forget('default_package');
        }
        if (Session::has('month_girl_package')) {
            Session::forget('month_girl_package');
        }

        $showDefaultPackages = false;
        $showGotmPackages = false;

        $expiredGirlPackage = null;
        $expiredGirlOfTheMonthPackage = null;

        $dayFromWhichDefaultPackagesShouldBeShown = Carbon::parse($user->package1_expiry_date)->subDays(getDaysForExpiry($user->package1_id))->format('Y-m-d');
        $dayFromWhichGotmPackagesShouldBeShown = Carbon::parse($user->package2_expiry_date)->subDays(getDaysForExpiry($user->package2_id))->format('Y-m-d');

        if (Carbon::now() >= $dayFromWhichDefaultPackagesShouldBeShown) {
            $showDefaultPackages = true;
        }
        if (Carbon::now() >= $dayFromWhichGotmPackagesShouldBeShown) {
            $showGotmPackages = true;
        }
        
        if ($user) {
            if ($user->is_active_d_package == 1) {
                $expiryDatePackage = getPackageExpiryDate(getDaysForExpiry($user->package1_id));
                $expiredGirlPackage = DB::table('users')
                ->leftJoin('notifications', 'users.id', '=', 'notifications.notifiable_id')
                ->where('users.id', $user->id)
                ->where('notifications.title', 'Default Package Expiration')
                ->whereBetween('package1_expiry_date', [Carbon::now(), $expiryDatePackage])->first();
            }

            if ($user->is_active_gotm_package) {
                $expiryDatePackage = getPackageExpiryDate(getDaysForExpiry($user->package2_id));
                $expiredGirlOfTheMonthPackage = DB::table('users')
                ->leftJoin('notifications', 'users.id', '=', 'notifications.notifiable_id')
                ->where('users.id', $user->id)
                ->where('notifications.title', 'Default Package Expiration')
                ->whereBetween('users.package2_expiry_date', [Carbon::now(), $expiryDatePackage])->first();
            }
        }

        return view('pages.profile.packages', compact('user', 'packages', 'expiredGirlPackage', 'expiredGirlOfTheMonthPackage', 'showDefaultPackages', 'showGotmPackages'));
    }

    public function postPackages(Request $request)
    {
        $user = Auth::user();
        $defaultPackage = '';
        $monthGirlPackage = '';

        // get pacakges by id with previously defined session
        if (Session::has('default_package')) {
            $defaultPackage = Package::findOrFail(Session::get('default_package'));
        }
        if (Session::has('month_girl_package')) {
            $monthGirlPackage = Package::findOrFail(Session::get('month_girl_package'));
        }

        // calculate the total amount
        $totalAmount = 0;
        if (!empty($defaultPackage)) {
            $validator = Validator::make($request->all(), [
                'ullalla_package' => 'required'
            ]);
            $totalAmount += (int) filter_var($defaultPackage->package_price, FILTER_SANITIZE_NUMBER_INT);
        }
        if (!empty($monthGirlPackage)) {
            $totalAmount += (int) filter_var($monthGirlPackage->package_price, FILTER_SANITIZE_NUMBER_INT);
        }

        // $result = DB::transaction(function () use ($user, $defaultPackage, $monthGirlPackage, $validator) {

        if (isset($validator)) {
            if ($validator->passes()) {
                try {
                    if (!empty(request('package_activation_date')) && !empty($defaultPackage)) {
                        $carbonDate = Carbon::parse(request('package_activation_date'));
                        $user->package1_id = $defaultPackage->id;
                        $user->is_active_d_package = 1;
                        $user->package1_activation_date = $carbonDate->format('Y-m-d H:i:s');
                        $user->package1_expiry_date = $carbonDate
                        ->addDays(daysToAddToExpiry($defaultPackage->id))
                        ->format('Y-m-d H:i:s');
                    }
                    if (!empty(request('package_month_girl_activation_date')) && !empty($monthGirlPackage)) {
                        $carbonDate = Carbon::parse(request('package_month_girl_activation_date'));
                        $user->is_active_gotm_package = 1;
                        $user->package2_id = $monthGirlPackage->id;
                        $user->package2_activation_date = $carbonDate->format('Y-m-d H:i:s');
                        $user->package2_expiry_date = $carbonDate
                        ->addDays(daysToAddToExpiry($monthGirlPackage->id))
                        ->format('Y-m-d H:i:s');;
                    }
                    $user->save();
                } catch (Exception $e) {
                    return response()->json([
                        'error' => 'User adding the packages'
                    ]);
                }
            } else {
                return response()->json([
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }
        } else {
            try {
                if (!empty(request('package_month_girl_activation_date')) && !empty($monthGirlPackage)) {
                    $carbonDate = Carbon::parse(request('package_month_girl_activation_date'));
                    $user->is_active_gotm_package = 1;
                    $user->package2_id = $monthGirlPackage->id;
                    $user->package2_activation_date = $carbonDate->format('Y-m-d H:i:s');
                    $user->package2_expiry_date = $carbonDate
                    ->addDays(daysToAddToExpiry($monthGirlPackage->id))
                    ->format('Y-m-d H:i:s');
                    $user->save();
                }
            } catch (Exception $e) {
                return response()->json([
                    'error' => 'Error adding the girl of the month package'
                ]);
            }
        }

        // stripe
        try {
            // create a customer
            $customer = Customer::create([
                'email' => request('stripeEmail'),
                'source' => request('stripeToken'),
            ]);
            $user->stripe_id = $customer->id;
            $user->save();             
        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 422);
        }

        //     return true;
        // });

        // if (!$result) {
        //     return redirect()->back('error', 'Something went wrong.');
        // }

        return redirect()->back()->with('success', 'Packages successfully updated.');
    }

    public function postNewPrice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_duration' => 'required',
            'service_price' => 'required',
            'price_type' => 'required',
        ]);

        $user = Auth::user();
        
        if ($request->ajax()) {
            if ($validator->passes()) {
                // insert new price
                $price = new Price;
                $price->user_id = $user->id;
                $price->service_duration = $request->service_duration;
                $price->service_price = $request->service_price;
                $price->price_type = $request->price_type;
                $price->save();

                return response()->json([
                    'success' => true,
                    'user' => $user->id,
                    'newPriceID' => $price->id,
                    'serviceDuration' => $price->service_duration,
                    'servicePrice' => $price->service_price,
                    'priceType' => $price->price_type,
                ]);
            } else {
                return response()->json([
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }
        }
    }

    public function deletePrice(Request $request)
    {
        $user = Auth::user();

        // insert new price
        $price = Price::where([
            ['id', $request->price_id],
            ['user_id', $user->id]
        ])->first();

        if ($price) {
            $price->delete();
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                ]);
            } else {
                return redirect()->back();
            }
        } else {
            if ($request->ajax()) {
                return response('Price doesn\'t exist.', 500)
                ->header('Content-Type', 'json/application');
            } else {
                return redirect()->action('ProfileController@getCreate', ['@username' => $user->username]);
            }
        }
    }
}
