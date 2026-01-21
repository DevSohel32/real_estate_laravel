<?php

namespace App\Http\Controllers\Admin;

use App\Models\Amenity;
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
            'name' => 'required|unique:locations|max:255',
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
        $type = Amenity::findOrFail($id);

        $type->delete();

        return redirect()->back()->with('success', 'Amenity deleted successfully');
    }
}
