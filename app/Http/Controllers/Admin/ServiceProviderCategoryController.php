<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ServiceProviderCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ServiceProviderCategoryController extends Controller
{

    public function index()
    {
        $serviceProviderCategories = ServiceProviderCategory::latest()->get();
        return view('backend.admin.service.serviceProviderCategory.index',compact('serviceProviderCategories'));

    }


    public function create()
    {
        return view('backend.admin.service.serviceProviderCategory.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $serviceProviderCategories = new ServiceProviderCategory();
        $serviceProviderCategories->name = $request->name;
        $serviceProviderCategories->slug =  Str::slug($request->name);
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for service category and upload
            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service-provider-category/'. $image_name, $proImage);

        }
        else {
            $image_name ='default.jpg';
        }
        $serviceProviderCategories->image = $image_name;


        $serviceProviderCategories->save();
        Toastr::success('Service Provider Category Created Successfully','Success');
        return  redirect()->route("admin.serviceProviderCategory.index");
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $serviceProviderCategories = ServiceProviderCategory::find($id);
        return view('backend.admin.service.serviceProviderCategory.edit',compact('serviceProviderCategories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $serviceProviderCategories =  ServiceProviderCategory::find($id);
        $serviceProviderCategories->name = $request->name;
        $serviceProviderCategories->slug =  Str::slug($request->name);
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //delete old image.....
            if(Storage::disk('public')->exists('uploads/service-provider-category/'.$serviceProviderCategories->image))
            {
                Storage::disk('public')->delete('uploads/service-provider-category/'.$serviceProviderCategories->image);

            }
//            resize image for service category and upload
            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service-provider-category/' . $image_name, $proImage);

        }
        else {
            $image_name = $serviceProviderCategories->image;
        }
        $serviceProviderCategories->image = $image_name;

        $serviceProviderCategories->save();
        Toastr::success('Service Provider Category Edited Successfully','Success');
        return  redirect()->route("admin.serviceProviderCategory.index");
    }

    public function destroy($id)
    {
        $serviceProviderCategories =   ServiceProviderCategory::find($id);
        if(Storage::disk('public')->exists('uploads/service-provider-category/'.$serviceProviderCategories->image))
        {
            Storage::disk('public')->delete('uploads/service-provider-category/'.$serviceProviderCategories->image);

        }
        $serviceProviderCategories->delete();
        Toastr::success('Service Sub Category Deleted Successfully', 'Success');
        return redirect()->back();
    }
}
