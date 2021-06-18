<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ServiceCategory;
use App\ServiceProviderCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ServiceCategoryController extends Controller
{

    public function index()
    {
        $serviceCategories = ServiceCategory::latest()->get();
        return view('backend.admin.service.ServiceCategory.index',compact('serviceCategories'));
    }


    public function create()
    {
        $serviceProviderCategories = ServiceProviderCategory::all();
        return view('backend.admin.service.ServiceCategory.create',compact('serviceProviderCategories'));
    }


    public function store(Request $request)
    {
       $this->validate($request,[
           'name'=>'required',
           //'route'=>'required',
       ]);
       //dd($request);
        $serviceCategories = new ServiceCategory();
        $serviceCategories->service_provider_category_id = $request->service_provider_category_id;
        $serviceCategories->name = $request->name;
        $serviceCategories->slug = Str::slug($request->name);
        //$serviceCategories->route = $request->route;

        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for service category and upload
            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service-category/'. $image_name, $proImage);

        }
        else {
            $image_name ='default.jpg';
        }
        $serviceCategories->image = $image_name;

        $icon_image = $request->file('icon');
        if (isset($icon_image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $icon_name = $currentDate . '-' . uniqid() . '.' . $icon_image->getClientOriginalExtension();
//            resize image for project and upload
            $Icon_Image = Image::make($icon_image)->resize(64, 64)->save($icon_image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service-category/icon/'.$icon_name, $Icon_Image);

        }
        else {
            $icon_name = "default.png";
        }
        $serviceCategories->icon = $icon_name;
//dd($serviceCategories);
        $serviceCategories->save();
        Toastr::success('Service Category Created Successfully', 'Success');
        return redirect()->route('admin.serviceCategory.index');

    }
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $serviceCategories = ServiceCategory::find($id);
        $serviceProviderCategories = ServiceProviderCategory::all();
        return view('backend.admin.service.ServiceCategory.edit',compact('serviceCategories','serviceProviderCategories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            //'route'=>'required',
        ]);
        //dd($request);
        $serviceCategories =ServiceCategory::find($id);
        $serviceCategories->service_provider_category_id = $request->service_provider_category_id;
        $serviceCategories->name = $request->name;
        $serviceCategories->slug = Str::slug($request->name);
        //$serviceCategories->route = $request->route;

        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //delete old image.....
            if(Storage::disk('public')->exists('uploads/service-category/'.$serviceCategories->image))
            {
                Storage::disk('public')->delete('uploads/service-category/'.$serviceCategories->image);

            }
//            resize image for service category and upload
            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service-category/' . $image_name, $proImage);

        }
        else {
            $image_name = $serviceCategories->image;
        }
        $serviceCategories->image = $image_name;

        $icon_image = $request->file('icon');
        if (isset($icon_image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $icon_name = $currentDate . '-' . uniqid() . '.' . $icon_image->getClientOriginalExtension();
            //delete old image.....
            if(Storage::disk('public')->exists('uploads/service-category/icon/'.$serviceCategories->image))
            {
                Storage::disk('public')->delete('uploads/service-category/icon/'.$serviceCategories->image);

            }
//            resize image for project and upload
            $Icon_Image = Image::make($icon_image)->resize(64, 64)->save($icon_image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service-category/icon/'.$icon_name, $Icon_Image);

        }
        else {
            $icon_name = $serviceCategories->icon;
        }
        $serviceCategories->icon = $icon_name;
        //dd($serviceCategories->image );
        $serviceCategories->save();
        Toastr::success('Service Category Edited Successfully', 'Success');
        return redirect()->route('admin.serviceCategory.index');
    }

    public function destroy($id)
    {
        $serviceCategories = ServiceCategory::find($id);
        if(Storage::disk('public')->exists('uploads/service-category/'.$serviceCategories->image))
        {
            Storage::disk('public')->delete('uploads/service-category/'.$serviceCategories->image);

        }

        $serviceCategories->delete();
        Toastr::success('Service Category Deleted Successfully', 'Success');
        return redirect()->back();
    }
}
