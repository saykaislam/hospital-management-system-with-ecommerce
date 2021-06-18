<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ServiceCategory;
use App\ServiceSubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ServiceSubCategoryController extends Controller
{

    public function index()
    {
        $serviceSubCategories = ServiceSubCategory::latest()->get();
        return view('backend.admin.service.ServiceSubCategory.index',compact('serviceSubCategories'));
    }


    public function create()
    {
        $serviceCategories = ServiceCategory::all();
        return view('backend.admin.service.ServiceSubCategory.create',compact('serviceCategories'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $serviceSubCategories = new ServiceSubCategory();
        $serviceSubCategories->name = $request->name;
        $serviceSubCategories->slug =  Str::slug($request->name);
        $serviceSubCategories->service_category_id = $request->service_category_id;
        //$serviceSubCategories->route = $request->route;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for service category and upload
            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service-sub-category/'. $image_name, $proImage);

        }
        else {
            $image_name ='default.jpg';
        }
        $serviceSubCategories->image = $image_name;
//dd($serviceSubCategories);
        $serviceSubCategories->save();
        Toastr::success('Service Sub Category Created Successfully','Success');
        return  redirect()->route("admin.serviceSubCategory.index");
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $serviceCategories = ServiceCategory::all();
        $serviceSubCategories = ServiceSubCategory::find($id);
        return view('backend.admin.service.ServiceSubCategory.edit',compact('serviceCategories','serviceSubCategories'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $serviceSubCategories = ServiceSubCategory::find($id);
        $serviceSubCategories->name = $request->name;
        $serviceSubCategories->slug =  Str::slug($request->name);
        $serviceSubCategories->service_category_id = $request->service_category_id;
        //$serviceSubCategories->route = $request->route;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //delete old image.....
            if(Storage::disk('public')->exists('uploads/service-sub-category/'.$serviceSubCategories->image))
            {
                Storage::disk('public')->delete('uploads/service-sub-category/'.$serviceSubCategories->image);

            }
//            resize image for service category and upload
            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service-sub-category/' . $image_name, $proImage);

        }
        else {
            $image_name = $serviceSubCategories->image;
        }
        $serviceSubCategories->image = $image_name;

//dd($serviceSubCategories);
        $serviceSubCategories->save();
        Toastr::success('Service Sub Category Edited Successfully','Success');
        return  redirect()->route("admin.serviceSubCategory.index");
    }


    public function destroy($id)
    {
        $serviceSubCategories = ServiceSubCategory::find($id);
        if(Storage::disk('public')->exists('uploads/service-sub-category/'.$serviceSubCategories->image))
        {
            Storage::disk('public')->delete('uploads/service-sub-category/'.$serviceSubCategories->image);

        }
        $serviceSubCategories->delete();
        Toastr::success('Service Sub Category Deleted Successfully', 'Success');
        return redirect()->back();
    }
}
