<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function make_slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }

    public function index()
    {
        $subcategories = SubCategory::latest()->get();
        return view('backend.admin.sub_category.index',compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.admin.sub_category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sub_categories,name',
            'category_id' => 'required'
        ]);
        $subCat = new SubCategory();
        $subCat->name = $request->name;
        $subCat->category_id = $request->category_id;
        $subCat->slug = $this->make_slug($request->name);
        $subCat->meta_title = $request->meta_title;
        $subCat->meta_description = $request->meta_description;
        $subCat->save();
        Toastr::success('SubCategory Created Successfully','Success');
        return  redirect()->route("admin.subcategory.index");
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $category = Category::all();
        $subcategory = SubCategory::find($id);
        return view('backend.admin.sub_category.edit', compact('category','subcategory'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:sub_categories,name,'.$id,
            'category_id' => 'required'
        ]);
        $subCat =  SubCategory::find($id);
        $subCat->name = $request->name;
        $subCat->category_id = $request->category_id;
        $subCat->slug = $this->make_slug($request->name);
        $subCat->meta_title = $request->meta_title;
        $subCat->meta_description = $request->meta_description;
        $subCat->save();
        Toastr::success('SubCategory Updated Successfully','Success');
        return  redirect()->route("admin.subcategory.index");
    }

    public function destroy($id)
    {
        SubCategory::destroy($id);
        Toastr::success('SubCategory Deleted Successfully','Success');
        return  redirect()->route("admin.subcategory.index");
    }
}
