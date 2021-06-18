<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function make_slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }

    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.admin.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $this->make_slug($request->name);
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->featured = 0;
        $category->top = 0;
        $category->is_home = 0;
        $image = $request->file('icon');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for hospital and upload
            $proImage = Image::make($image)->resize(64, 64)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/categories/' . $imagename, $proImage);

        }else {
            $imagename = "default.png";
        }
        $category->icon = $imagename;
        $category->save();
        Toastr::success('Category Created Successfully','Success');
        return  redirect()->route("admin.category.index");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name,'.$id,
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = $this->make_slug($request->name);
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->featured = 0;
        $category->top = 0;
        $category->is_home = 0;
        $image = $request->file('icon');
        if (isset($image)) {
            //make unique name for image
            if(Storage::disk('public')->exists('uploads/categories/'.$category->icon))
            {
                Storage::disk('public')->delete('uploads/categories/'.$category->icon);
            }
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for hospital and upload
            $proImage = Image::make($image)->resize(64, 64)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/categories/' . $imagename, $proImage);

        }else {
            $imagename = $category->icon;
        }
        $category->icon = $imagename;
        $category->save();
        Toastr::success('Category Updated Successfully','Success');
        return  redirect()->route("admin.category.index");
    }

    public function destroy($id)
    {
        Category::destroy($id);
        Toastr::success('Category Deleted Successfully','Success');
        return  redirect()->route("admin.category.index");
    }
}
