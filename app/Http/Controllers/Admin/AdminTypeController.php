<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminTypeController extends Controller
{

    public function index()
    {
        $types = Type::orderBy('id', 'asc')->get();
        return view('admin.type.index', compact('types'));
    }
    public function create()
    {
        return view('admin.type.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:locations|max:255',
        ]);

        $type = new Type();
        $type->name = $request->name;
        $type->save();

        return redirect()->route('admin_types_index')->with('success', 'Type created successfully!');
    }

    public function edit($id)
    {
        $type = Type::findOrFail($id);
        return view('admin.type.edit', compact('type'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:types,id',
            'name' => 'required|unique:types|max:255',
        ]);

        $type = Type::findOrFail($request->id);
        $type->name = $request->name;
        $type->update();


        return redirect()->route('admin_types_index')->with('success', 'Type created successfully');
    }

    public function destroy($id)
    {
        $type = Type::findOrFail($id);

        $type->delete();

        return redirect()->back()->with('success', 'Type deleted successfully');
    }
}
