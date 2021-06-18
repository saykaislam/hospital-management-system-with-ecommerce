<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function make_slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }

    public function index()
    {
        $brands = Brand::latest()->get();
        return view('backend.admin.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('backend.admin.brand.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:brands,name'
        ]);
        $dept = new Brand();
        $dept->name = $request->name;
        $dept->slug = $this->make_slug($request->name);
        $dept->meta_title = $request->meta_title;
        $dept->meta_description = $request->meta_description;
        if($request->hasFile('logo')){
            $dept->logo = $request->logo->store('uploads/brands/logo');
            //ImageOptimizer::optimize(base_path('public/').$product->thumbnail_img);
        }
        $dept->save();
        Toastr::success('Brand Created Successfully','Success');
        return  redirect()->route("admin.brands.index");
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:brands,name,'.$id
        ]);
        $dept =  Brand::findOrFail($id);
        $dept->name = $request->name;
        $dept->slug = $this->make_slug($request->name);
        $dept->meta_title = $request->meta_title;
        $dept->meta_description = $request->meta_description;
        $dept->logo = $request->previous_thumbnail_img;
        if($request->hasFile('logo')){
            $dept->logo = $request->logo->store('uploads/brands/logo');
            //ImageOptimizer::optimize(base_path('public/').$product->thumbnail_img);
        }
        $dept->save();
        Toastr::success('Brand Updated Successfully','Success');
        return  redirect()->route("admin.brands.index");
    }

    public function destroy($id)
    {
        Brand::destroy($id);
        Toastr::success('Brand Deleted Successfully','Success');
        return  redirect()->route("admin.brands.index");
    }
}
