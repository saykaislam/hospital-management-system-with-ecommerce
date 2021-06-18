<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\SubCategory;
use App\SubSubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubSubCategoryController extends Controller
{
    public function make_slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }

    public function index()
    {
        $subsubcategories = SubSubCategory::latest()->get();
        return view('backend.admin.sub_sub_category.index',compact('subsubcategories'));
    }

    public function create()
    {
        $subcategories = SubCategory::all();
        return view('backend.admin.sub_sub_category.create', compact('subcategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sub_sub_categories,name',
            'sub_category_id' => 'required'
        ]);
        $subsubCat = new SubSubCategory();
        $subsubCat->name = $request->name;
        $subsubCat->sub_category_id = $request->sub_category_id;
        $subsubCat->slug = $this->make_slug($request->name);
        $subsubCat->meta_title = $request->meta_title;
        $subsubCat->meta_description = $request->meta_description;
        $subsubCat->save();
        Toastr::success('SubSubCategory Created Successfully','Success');
        return  redirect()->route("admin.subsubcategory.index");
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $subcategory = SubCategory::all();
        $subsubcategory = SubSubCategory::find($id);
        return view('backend.admin.sub_sub_category.edit', compact('subcategory','subsubcategory'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:sub_sub_categories,name,'.$id,
            'sub_category_id' => 'required'
        ]);
        $subsubCat = SubSubCategory::find($id);
        $subsubCat->name = $request->name;
        $subsubCat->sub_category_id = $request->sub_category_id;
        $subsubCat->slug = $this->make_slug($request->name);
        $subsubCat->meta_title = $request->meta_title;
        $subsubCat->meta_description = $request->meta_description;
        $subsubCat->save();
        Toastr::success('SubSubCategory Updated Successfully','Success');
        return  redirect()->route("admin.subsubcategory.index");
    }

    public function destroy($id)
    {
        SubSubCategory::destroy($id);
        Toastr::success('SubSubCategory Deleted Successfully','Success');
        return  redirect()->route("admin.subsubcategory.index");
    }
}
