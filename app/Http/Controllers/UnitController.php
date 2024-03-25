<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Unit;


class UnitController extends Controller
{
    public function all()
    {
        $units = Unit::all();
        return view('admin.unit.all', compact('units'));
    }
    public function add()
    {

        return view('admin.unit.add');
    }
    public function store(Request $request)
    {

        Unit::insert([
            'name' => $request->name,


        ]);
        $notification = array(
            'message' => 'Unit Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.all')->with($notification);
    }
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('admin.unit.edit', compact('unit'));
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        $role = Unit::find($id);
        $role->update($data);

        $notification = array(
            'message' => 'Unit Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('unit.all')->with($notification);
    }
    public function delete($id)
    {

        $unit = Unit::findOrFail($id);
        $unit->delete();
        $notification = array(
            'message' => 'Unit Deleted Successfully',
            'alert-type' => 'Warning'
        );

        return redirect()->route('unit.all')->with($notification);
    }
}
