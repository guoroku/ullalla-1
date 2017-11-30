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
use App\Models\ContactOption;
use App\Models\ServiceOption;
use App\Models\SpokenLanguage;
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
        $contactOptions = ContactOption::all();
        $serviceOptions = ServiceOption::all();
        $spokenLanguages = SpokenLanguage::all();
        $prices = Price::where('user_id', $user->id)->get();

        return view('pages.profile.create', compact('packages', 'cantons', 'countries', 'services', 'user', 'prices', 'contactOptions', 'serviceOptions', 'spokenLanguages'));
    }

    public function postCreate(Request $request)
    {
        // define inputs
        $defaultPackageInput = request('ullalla_package')[0];
        $monthGirlPackageInput = request('ullalla_package_month_girl');

        // get working time
        $workingTime = getWorkingTime(
            $request->days, 
            $request->available_24_7, 
            $request->time_from, 
            $request->time_from_m, 
            $request->time_to, 
            $request->time_to_m, 
            $request->available_24_7_night_escort, 
            $request->night_escorts
        );

        // $result = DB::transaction(function () use ($totalAmount, $defaultPackageInput, $monthGirlPackageInput, $workingTime) {

        // get default package obj and activation date input
        $defaultPackage = Package::findOrFail($defaultPackageInput);
        $defaultPackageActivationDateInput = request('default_package_activation_date')[$defaultPackage->id];
                // format default packages dates with carbon
        $carbonDate = Carbon::parse($defaultPackageActivationDateInput);
        $defaultPackageActivationDate = $carbonDate->format('Y-m-d H:i:s');
        $defaultPackageExpiryDate = $carbonDate->addDays(daysToAddToExpiry($defaultPackage->id))->format('Y-m-d H:i:s');

        if ($monthGirlPackageInput) {
            $monthGirlPackage = Package::findOrFail($monthGirlPackageInput[0]);
            $monthGirlActivationDateInput = request('month_girl_package_activation_date')[$monthGirlPackage->id];
            // format dates with carbon
            $carbonDate = Carbon::parse($monthGirlActivationDateInput);
            $monthGirlActivationDate = $carbonDate->format('Y-m-d H:i:s');
            $monthGirlExpiryDate = $carbonDate->addDays(daysToAddToExpiry($monthGirlPackage->id))->format('Y-m-d H:i:s');
        }

        // calculate the total amount
        $totalAmount = (int) filter_var($defaultPackage->package_price, FILTER_SANITIZE_NUMBER_INT);
        if (isset($monthGirlPackage)) {
            $totalAmount += (int) filter_var($monthGirlPackage->package_price, FILTER_SANITIZE_NUMBER_INT);
        }

            // create profile
        $incallType = null;
        $outcallType = null;
            // get incall type
        $incallOption = request('incall_option');
        $outcallOption = request('outcall_option');
        if ($incallOption) {
            if ($incallOption != 'define_yourself') {
                $incallType = array_search_reverse($incallOption, getIncallOptions());
            } elseif (request('incall_define_yourself')) {
                $incallType = request('incall_define_yourself');
            }
        }
            // get outcall type
        if ($outcallOption) {
            if ($outcallOption != 'define_yourself') {
                $outcallType = array_search_reverse($outcallOption, getOutcallOptions());
            } elseif(request('outcall_define_yourself')) {
                $outcallType = request('outcall_define_yourself');
            }
        }

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
            $user->website = request('website');
            $user->phone = request('phone');
            $user->mobile = request('mobile');
            $user->prefered_contact_option = request('prefered_contact_option');
            $user->skype_name = request('skype_name');
            $user->no_withheld_numbers = request('no_withheld_numbers') ? '1' : '0';
            $user->canton_id = request('canton');
            $user->city = request('city');
            $user->zip_code = request('zip_code');
            $user->address = request('address');
            $user->club_name = request('address');
            $user->incall_type = $incallType;
            $user->outcall_type = $outcallType;
            $user->working_time = $workingTime;
            $user->package1_id = $defaultPackage->id;
            $user->is_active_d_package = 1;
            $user->package1_activation_date = $defaultPackageActivationDate;
            $user->package1_expiry_date = $defaultPackageExpiryDate;
            if (isset($monthGirlPackage)) {
                $user->package2_id = $monthGirlPackage->id;
                $user->is_active_gotm_package = 1;
                $user->package2_activation_date = $monthGirlActivationDate;
                $user->package2_expiry_date = $monthGirlExpiryDate;
            }
            $user->save();

            // define languages input
            $spokenLanguages = array_filter(request('spoken_language'), function($value) { return $value != '0' && $value != null; });
            // define levels
            $levels = array_map(function($languageLevel) {
                return ['language_level' => $languageLevel];
            }, $spokenLanguages);
            // get combined data
            $syncData = array_combine(array_keys($spokenLanguages), $levels);

            // sync services to the user
            $user->services()->sync(request('services'));
            $user->service_options()->sync(request('service_options'));
            $user->contact_options()->sync(request('contact_options'));
            $user->spoken_languages()->sync($syncData);
            $user->save();

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }

            // stripe
            // try {
            //     // create a customer
            //     $customer = Customer::create([
            //         'email' => request('stripeEmail'),
            //         'source' => request('stripeToken'),
            //     ]);
            //     $user->stripe_id = $customer->id;
            //     $user->save();             
            // } catch (\Exception $e) {
            //     return response()->json([
            //         'status' => $e->getMessage()
            //     ], 422);
            // }

        //     return true;
        // });

        // if ($result !== true) {
        //     return redirect('/')->with('error', 'There was an error');
        // }

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
        $workingTime = getWorkingTime(
            $request->days, 
            $request->available_24_7, 
            $request->time_from, 
            $request->time_from_m, 
            $request->time_to, 
            $request->time_to_m, 
            $request->available_24_7_night_escort, 
            $request->night_escorts
        );

        $user->working_time = $workingTime;
        $user->save();

        return redirect()->back()->with('success', 'Work time successfully updated.');
    }

    public function getLanguages()
    {
        $user = Auth::user();
        $spokenLanguages = SpokenLanguage::all();

        return view('pages.profile.languages', compact('user', 'spokenLanguages'));
    }

    public function postLanguages(Request $request)
    {
        $user = Auth::user();

        $user->save();

        return redirect()->back()->with('success', 'Languages successfully updated.');
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

    /**
    * Insert activation and expiry dates if both packages are chosen and billing the user.
    * If one of them is chosen then insert only that one and bill him.
    */
    public function postPackages(Request $request)
    {
        $user = Auth::user();

        $totalAmount = 0;
        $defaultPackageActivationDateInput = request('default_package_activation_date');
        $monthGirlActivationDateInput = request('month_girl_package_activation_date');

        if ($monthGirlActivationDateInput && !$defaultPackageActivationDateInput) {
            // validate
            $validator = Validator::make($request->all(), [
                'ullalla_package_month_girl' => 'required'
            ]);
            // check if validator passed or not
            if ($validator->passes()) {
                $monthGirlPackageInput = request('ullalla_package_month_girl');
                if ($monthGirlPackageInput) {
                    // get package
                    $monthGirlPackage = Package::find($monthGirlPackageInput[0]);
                    // get activation date and expiry date
                    if ($monthGirlPackage) {
                        $monthGirlActivationDateInput = $monthGirlActivationDateInput[$monthGirlPackage->id];
                        // format dates with carbon
                        $carbonDate = Carbon::parse($monthGirlActivationDateInput);
                        $monthGirlActivationDate = $carbonDate->format('Y-m-d H:i:s');
                        $monthGirlExpiryDate = $carbonDate->addDays(daysToAddToExpiry($monthGirlPackage->id))->format('Y-m-d H:i:s');

                        $totalAmount += (int) filter_var($monthGirlPackage->package_price, FILTER_SANITIZE_NUMBER_INT);

                        $user->package2_id = $monthGirlPackage->id;
                        $user->is_active_gotm_package = 1;
                        $user->package2_activation_date = $monthGirlActivationDate;
                        $user->package2_expiry_date = $monthGirlExpiryDate;
                        $user->save();
                    }
                }
            } else {
                return response()->json([
                    'errors' => [
                        'month_girl_package_error' => $validator->getMessageBag()
                    ]
                ]);
            }
        } elseif ($defaultPackageActivationDateInput) {
            // validate
            $validator = Validator::make($request->all(), [
                'ullalla_package' => 'required'
            ]);

            if ($validator->passes()) {
                // get default package input
                $defaultPackageInput = request('ullalla_package')[0];

                // get default package obj and activation date input
                $defaultPackage = Package::find($defaultPackageInput);
                if ($defaultPackage) {
                    $defaultPackageActivationDateInput = $defaultPackageActivationDateInput[$defaultPackage->id];
                    // format default packages dates with carbon
                    $carbonDate = Carbon::parse($defaultPackageActivationDateInput);
                    $defaultPackageActivationDate = $carbonDate->format('Y-m-d H:i:s');
                    $defaultPackageExpiryDate = $carbonDate->addDays(daysToAddToExpiry($defaultPackage->id))->format('Y-m-d H:i:s');

                    $totalAmount += (int) filter_var($defaultPackage->package_price, FILTER_SANITIZE_NUMBER_INT);

                    $user->package1_id = $defaultPackage->id;
                    $user->is_active_d_package = 1;
                    $user->package1_activation_date = $defaultPackageActivationDate;
                    $user->package1_expiry_date = $defaultPackageExpiryDate;

                }

                if ($monthGirlActivationDateInput) {
                    $monthGirlPackageInput = request('ullalla_package_month_girl');
                    if ($monthGirlPackageInput) {
                        // get package
                        $monthGirlPackage = Package::find($monthGirlPackageInput[0]);
                        // get activation date and expiry date
                        if ($monthGirlPackage) {
                            $monthGirlActivationDateInput = $monthGirlActivationDateInput[$monthGirlPackage->id];
                        // format dates with carbon
                            $carbonDate = Carbon::parse($monthGirlActivationDateInput);
                            $monthGirlActivationDate = $carbonDate->format('Y-m-d H:i:s');
                            $monthGirlExpiryDate = $carbonDate->addDays(daysToAddToExpiry($monthGirlPackage->id))->format('Y-m-d H:i:s');

                            $totalAmount += (int) filter_var($monthGirlPackage->package_price, FILTER_SANITIZE_NUMBER_INT);

                            $user->package2_id = $monthGirlPackage->id;
                            $user->is_active_gotm_package = 1;
                            $user->package2_activation_date = $monthGirlActivationDate;
                            $user->package2_expiry_date = $monthGirlExpiryDate;
                        }
                    }
                }

                $user->save();
            } else {
                return response()->json([
                    'errors' => [
                        'default_package_error' => $validator->getMessageBag()
                    ]
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


            // charge a customer
            Charge::create([
                'customer' => $user->stripe_id,
                'amount' => $totalAmount * 100,
                'currency' => 'chf',
            ]);

            // approve the user
            $user->approved = '1';
            $user->save();

        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getMessage()
            ], 422);
        }

        Session::flash('success', 'Packages successfully updated.');
    }

    public function postNewPrice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_duration' => 'required|numeric',
            'service_price' => 'required|numeric',
            'price_type' => 'required',
            'service_price_unit' => 'required',
            'service_price_currency' => 'required',
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
                $price->service_price_currency = $request->service_price_currency;
                $price->service_price_unit = $request->service_price_unit;
                $price->save();

                return response()->json([
                    'success' => true,
                    'user' => $user->id,
                    'newPriceID' => $price->id,
                    'serviceDuration' => $price->service_duration,
                    'servicePrice' => $price->service_price,
                    'priceType' => $price->price_type,
                    'servicePriceUnit' => $price->service_price_unit,
                    'servicePriceCurrency' => $price->service_price_currency,
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
