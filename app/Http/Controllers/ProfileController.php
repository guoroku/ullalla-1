<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Models\Price;
use App\Models\Canton;
use App\Models\Service;
use App\Models\Country;
use App\Models\Package;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUpdate()
    {
        $cantons = Canton::all();
        $packages = Package::all();
        $services = Service::all();
        $countries = Country::all();
        $user = Auth::user();

        return view('pages.profile.edit', compact('packages', 'cantons', 'countries', 'services', 'user'));
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



    public function postProfile()
    {
    	
    }

    public function postNewPrice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_duration' => 'required',
            'service_price' => 'required',
        ]);

        $user = Auth::user();
        
        if ($request->ajax()) {
            if ($validator->passes()) {
                // insert new price
                $price = new Price;
                $price->user_id = $user->id;
                $price->service_duration = $request->service_duration;
                $price->service_price = $request->service_price;
                $price->save();

                return response()->json([
                    'success' => true,
                    'user' => $user->id,
                    'newPriceID' => $price->id,
                    'serviceDuration' => $price->service_duration,
                    'servicePrice' => $price->service_price,
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
