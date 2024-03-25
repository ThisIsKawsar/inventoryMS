<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;

class PropductController extends Controller
{

    public function all()
    {
        $products = Product::all();
        return view('admin.product.all', compact('products'));
    }
    public function add()
    {
        $supplier = Supplier::all();
        $category = Category::all();
        $unit = Unit::all();
        return view('admin.product.add', compact('supplier', 'category', 'unit'));
    }
    public function store(Request $request)
    {

        Product::insert([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'quantity' => 0,

            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification);
    }
    public function edit($id)
    {
        $supplier = Supplier::all();
        $category = Category::all();
        $unit = Unit::all();
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product', 'supplier', 'category', 'unit'));
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        $role = Product::find($id);
        $role->update($data);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification);
    }
    public function delete($id)
    {

        $product = Product::findOrFail($id);
        $product->delete();
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'Warning'
        );

        return redirect()->route('product.all')->with($notification);
    }
}
