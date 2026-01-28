<?php

namespace App\Http\Controllers\Admin;

use index;
use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPropertyController extends Controller
{
    public function index()
    {
        $properties = Property::orderBy('id', 'asc')->get();
        return view('admin.property.index', compact('properties'));
    }

    public function details($id)
    {
        $properties = Property::orderBy('id', 'asc')->get();
        return view('admin.property.detail', compact('properties'));
    }


   public function edit($id)
    {
        $property = Property::findOrFail($id);
        return view('admin.property.edit', compact('property'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:properties,id',
            'status' => 'required|unique:properties|max:255',
        ]);

        $property = Property::findOrFail($request->id);
        $property->status = $request->status;
        $property->update();


        return redirect()->route('admin_property_index')->with('success', 'Property status updated successfully');
    }
}
