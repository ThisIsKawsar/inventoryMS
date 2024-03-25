<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function all()
    {
        $categorys = Category::all();
        return view('admin.category.all', compact('categorys'));
    }
    public function add()
    {

        return view('admin.category.add');
    }
    public function store(Request $request)
    {

        Category::insert([
            'name' => $request->name,


        ]);
        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category.all')->with($notification);
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->all();
        $role = Category::find($id);
        $role->update($data);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category.all')->with($notification);
    }
    public function delete($id)
    {

        $category = Category::findOrFail($id);
        $category->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'Warning'
        );

        return redirect()->route('category.all')->with($notification);
    }
}
