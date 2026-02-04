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
        $properties = Property::where('status', 'Active')->orderBy('id', 'asc')->take(3)->get();
        $agents = Agent::where('status', '1')->orderBy('id', 'asc')->take(4)->get();
        // get total propertywise locations

        $locations = Location::withCount(['properties' => function ($query) {
            $query->where('status', 'Active');
        }])->orderBy('properties_count', 'desc')->take(4)->get();

        return view('front.home', compact('properties', 'agents', 'locations'));
    }

    public function property_detail($slug)
    {
        $property = Property::where('slug', $slug)->first();
        if (!$property) {
            return redirect()->back()->with('error', 'Property not found!');
        }
        return view('front.property_detail', compact('property'));
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
        $locations = Location::withCount(['properties' => function ($query) {
            $query->where('status', 'Active');
        }])->orderBy('properties_count', 'desc')->paginate(12);
        return view('front.locations', compact('locations'));
    }
    public function location($slug)
    {
        $location = Location::where('slug', $slug)->first();
        if (!$location) {
            return redirect()->back()->with('error', 'Location not found!');
        }
        $properties = Property::where('location_id', $location->id)->where('status', 'Active')->orderBy('id', 'asc')->paginate(9);
        return view('front.location', compact('location', 'properties'));
    }

    public function agents()
    {
        $agents = Agent::where('status', '1')->orderBy('id', 'asc')->paginate(12);
        return view('front.agents', compact('agents'));
    }
     public function agent($id)
    {
        $agent = Agent::where('id', $id)->first();
        if (!$agent) {
            return redirect()->back()->with('error', 'Agent not found!');
        }
        $properties = Property::where('agent_id', $agent->id)->where('status', 'Active')->orderBy('id', 'asc')->paginate(9);
        return view('front.agent', compact('agent', 'properties'));
    }
        
}
