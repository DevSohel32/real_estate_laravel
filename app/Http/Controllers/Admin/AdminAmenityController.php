<?php

namespace App\Http\Controllers\Admin;

use App\Models\Amenity;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminAmenityController extends Controller
{
    public function index()
    {
        $amenities = Amenity::orderBy('id', 'asc')->get();
        return view('admin.amenity.index', compact('amenities'));
    }
    public function create()
    {
        return view('admin.amenity.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:amenities|max:255',
        ]);
        $type = new Amenity();
        $type->name = $request->name;
        $type->save();
        return redirect()->route('admin_amenity_index')->with('success', 'Amenity created successfully!');
    }

    public function edit($id)
    {
        $amenity = Amenity::findOrFail($id);
        return view('admin.amenity.edit', compact('amenity'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:amenities,id',
            'name' => 'required|unique:amenities|max:255',
        ]);

        $amenity = Amenity::findOrFail($request->id);
        $amenity->name = $request->name;
        $amenity->update();
        return redirect()->route('admin_amenity_index')->with('success', 'Amenity created successfully');
    }

    public function destroy($id)
    {
        $amenity = Amenity::findOrFail($id);
        $properties = Property::get();
        $allAmenities = [];
        foreach ($properties as $item) {
            if (!$item->amenities) {
                continue;
            }
            $amenitiesArray = explode(',', $item->amenities);
            foreach ($amenitiesArray as $temp_item) {
                $allAmenities[] = $temp_item;
            }
        }
        if (in_array($amenity->name, $allAmenities)) {
            return redirect()->route('admin_amenity_index')
                ->with('error', 'Amenity cannot be deleted as it is associated with a property');
        }

        $amenity->delete();
        return redirect()->back()->with('success', 'Amenity deleted successfully');
    }
}
