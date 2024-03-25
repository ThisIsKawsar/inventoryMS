<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Customer;


class CustomerController extends Controller
{
    public function all()
    {
        $customers = Customer::all();
        return view('admin.customer.all', compact('customers'));
    }
    public function add()
    {

        return view('admin.customer.add');
    }
    public function store(Request $request)
    {

        $image = $request->file('img');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // 343434.png

        $save_url = 'upload/' . $name_gen;
        $destinationPath = public_path('/upload');
        $image->move($destinationPath, $name_gen);
        Customer::insert([

            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'img' => $save_url,
            'email' => $request->email,
            'address' => $request->address,

            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Customer Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('customer.all')->with($notification);
    }
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customer.edit', compact('customer'));
    }
    public function update(Request $request)
    {
        $customer_id = $request->id;
        if ($request->file('img')) {

            $image = $request->file('img');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // 343434.png

            $save_url = 'upload/' . $name_gen;

            Customer::findOrFail($customer_id)->update([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,
                'img' => $save_url,
                'email' => $request->email,
                'address' => $request->address,

                'created_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'Customer Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('customer.all')->with($notification);
        } else {

            Customer::findOrFail($customer_id)->update([
                'name' => $request->name,
                'mobile_no' => $request->mobile_no,

                'email' => $request->email,
                'address' => $request->address,

                'created_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => 'Customer Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('customer.all')->with($notification);
        } // end else 
    }
    public function delete($id)
    {

        $customer = Customer::findOrFail($id);
        $img = $customer->img;
        unlink($img);
        $customer->delete();
        $notification = array(
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('customer.all')->with($notification);
    }
}
