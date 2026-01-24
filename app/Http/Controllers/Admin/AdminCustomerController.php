<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCustomerController extends Controller
{
     public function index()
    {
        $customers = User::orderBy('id', 'asc')->get();
        return view('admin.customers.index', compact('customers'));
    }
    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:locations|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $customer = new User();
        $customer->name = $request->name;
       

        if ($request->photo) {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $final_name = 'location_' . time() . '.' . $request->photo->extension();
            if ($customer->photo != '') {
                unlink(public_path('uploads/' . $customer->photo));
            }
            $request->photo->move(public_path('uploads'), $final_name);
            $customer->photo = $final_name;
        }

        $customer->save();

        return redirect()->route('admin_customers_index')->with('success', 'Location created successfully!');
    }

public function edit($id)
{
    $customer = User::findOrFail($id);
    return view('admin.customers.edit', compact('customer'));
}


    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:locations,id',
            'name' => 'required|unique:locations|max:255',
        ]);

        $location = User::findOrFail($request->id);
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


        return redirect()->route('admin_customers_index')->with('success', 'Location created successfully');
    }

    public function destroy($id)
    {
       $customer = User::findOrFail($id);

    if ($customer->photo && file_exists(public_path('uploads/' . $customer->photo))) {
        unlink(public_path('uploads/' . $customer->photo));
    }

    $customer->delete();

    return redirect()->back()->with('success', 'Location deleted successfully');}
}
