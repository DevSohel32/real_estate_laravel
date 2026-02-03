<?php

namespace App\Http\Controllers\Front;

use App\Models\Agent;
use App\Models\Package;
use App\Models\Location;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\PropertyPhoto;
use App\Models\PropertyVideo;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index()
    {
        $properties = Property::where('status', 'Active')->orderBy('id', 'asc')->take(6)->get();
        $agents = Agent::where('status', '1')->orderBy('id', 'asc')->take(9)->get();
        // get total propertywise locations

        $locations = location::withCount(['properties' => function ($query) {
            $query->where('status', 'Active');
        }])->orderBy('properties_count', 'desc')->get();

        return view('front.home', compact('properties', 'agents', 'locations'));
    }

    public function property_detail($slug)
    {
        $location = Property::where('slug', $slug)->first();
        if (!$location) {
            return redirect()->back()->with('error', 'Property not found!');
        }
        return view('front.property_detail', compact('location'));
    }
    public function contact()
    {
        return view('front.contact');
    }

    public function select_user()
    {
        return view('front.select_user');
    }
    public function pricing()
    {
        $packages = Package::all();
        return view('front.pricing', compact('packages'));
    }

    public function locations()
    {
        $locations = location::withCount(['properties' => function ($query) {
            $query->where('status', 'Active');
        }])->orderBy('properties_count', 'desc')->get();
        return view('front.locations', compact('locations'));
    }
    public function location($slug)
    {
        $location = Location::where('slug', $slug)->first();
        if (!$location) {
            return redirect()->back()->with('error', 'Location not found!');
        }
        $properties = Property::where('location_id', $location->id)->where('status', 'Active')->orderBy('id', 'asc')->get();
        return view('front.location', compact('location', 'properties'));
    }
}
