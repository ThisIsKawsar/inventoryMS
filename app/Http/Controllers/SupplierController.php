<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function all()
    {
        $suppliers = Supplier::all();
        return view('admin.supplier.all', compact('suppliers'));
    }
    public function add()
    {

        return view('admin.supplier.add');
    }
    public function store(Request $request)
    {

        Supplier::insert([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,

            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Supplier Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('supplier.all')->with($notification);
    }
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.supplier.edit', compact('supplier'));
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        $role = Supplier::find($id);
        $role->update($data);

        $notification = array(
            'message' => 'Supplier Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('supplier.all')->with($notification);
    }
    public function delete($id)
    {

        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        $notification = array(
            'message' => 'Supplier Deleted Successfully',
            'alert-type' => 'Warning'
        );

        return redirect()->route('supplier.all')->with($notification);
    }
}
