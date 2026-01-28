<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLocationController extends Controller
{
    public function index()
    {
        $locations = Location::orderBy('id', 'asc')->get();
        return view('admin.location.index', compact('locations'));
    }
    public function create()
    {
        return view('admin.location.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:locations|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $location = new Location();
        $location->name = $request->name;

        if ($request->slug) {
            $location->slug = Str::slug($request->slug);
        } else {
            $location->slug = Str::slug($request->name);
        }

        if ($request->photo) {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $final_name = 'location_' . time() . '.' . $request->photo->extension();
            if ($location->photo != '') {
                unlink(public_path('uploads/' . $location->photo));
            }
            $request->photo->move(public_path('uploads'), $final_name);
            $location->photo = $final_name;
        }

        $location->save();

        return redirect()->route('admin_locations_index')->with('success', 'Location created successfully!');
    }

    public function edit($id)
    {
        $location = Location::findOrFail($id);
        return view('admin.location.edit', compact('location'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:locations,id',
            'name' => 'required|unique:locations|max:255',
        ]);

        $location = Location::findOrFail($request->id);
        $location->name = $request->name;

        if ($request->slug) {
            $location->slug = Str::slug($request->slug);
        } else {
            $location->slug = Str::slug($request->name);
        }
        if ($request->photo) {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $final_name = 'location_' . time() . '.' . $request->photo->extension();
            if ($location->photo != '') {
                unlink(public_path('uploads/' . $location->photo));
            }
            $request->photo->move(public_path('uploads'), $final_name);
            $location->photo = $final_name;
        }

        $location->update();


        return redirect()->route('admin_locations_index')->with('success', 'Location created successfully');
    }

    public function destroy($id)
    {
        $location = Location::findOrFail($id);

        if ($location->photo && file_exists(public_path('uploads/' . $location->photo))) {
            unlink(public_path('uploads/' . $location->photo));
        }

        $location->delete();

        return redirect()->back()->with('success', 'Location deleted successfully');
    }
}
