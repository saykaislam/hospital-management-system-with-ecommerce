<?php

namespace App\Http\Controllers\Admin;

use App\DivisionDistrict;
use App\Http\Controllers\Controller;
use App\ServiceCategory;
use App\ServiceProviderCategory;
use App\Services;
use App\ServiceSubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Services::latest()->get();

        return view('backend.admin.service.Service.index',compact('services'));
    }


    public function create()
    {
        $serviceProviderCategories = ServiceProviderCategory::latest()->get();
        $serviceCategories = ServiceCategory::latest()->get();
        $serviceSubCategories = ServiceSubCategory::latest()->get();
        $divisionDistricts = DivisionDistrict::all();

        return view('backend.admin.service.Service.create',compact('serviceProviderCategories','serviceCategories','serviceSubCategories','divisionDistricts'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $services = new Services();
        $services->name = $request->name;
        $services->slug =  Str::slug($request->name);
        $services->service_provider_category_id = $request->service_provider_category_id;
        $services->service_category_id = $request->service_category_id;
        $services->service_sub_category_id = $request->service_sub_category_id ? $request->service_sub_category_id : NULL;
        $services->price = $request->price;
        $services->service_type = $request->service_type;
        $services->division_district_id = $request->division_district_id;
        $services->description = $request->description;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for service category and upload
            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/services/'. $image_name, $proImage);

        }
        else {
            $image_name ='default.jpg';
        }

        $icon_image = $request->file('icon');
        if (isset($icon_image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $icon_name = $currentDate . '-' . uniqid() . '.' . $icon_image->getClientOriginalExtension();
//            resize image for project and upload
            $Icon_Image = Image::make($icon_image)->resize(64, 64)->save($icon_image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/services/icon/'.$icon_name, $Icon_Image);

        }
        else {
            $icon_name = "default.png";
        }

        $services->image = $image_name;
        $services->icon = $icon_name;
        $services->save();
        Toastr::success('Service Created Successfully', 'Success');
        return redirect()->route('admin.services.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $serviceProviderCategories = ServiceProviderCategory::latest()->get();
        $serviceCategories = ServiceCategory::latest()->get();
        $serviceSubCategories = ServiceSubCategory::latest()->get();
        $services = Services::find($id);
        $divisionDistricts = DivisionDistrict::all();

        return view('backend.admin.service.Service.edit',compact('serviceProviderCategories','serviceCategories','serviceSubCategories','services','divisionDistricts'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $services = Services::find($id);
        $services->name = $request->name;
        $services->slug =  Str::slug($request->name);
        $services->service_provider_category_id = $request->service_provider_category_id;
        $services->service_category_id = $request->service_category_id;
        $services->service_sub_category_id = $request->service_sub_category_id ? $request->service_sub_category_id : NULL;
        $services->price = $request->price;
        $services->service_type = $request->service_type;
        $services->division_district_id = $request->division_district_id;
        $services->description = $request->description;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //delete old image.....
            if(Storage::disk('public')->exists('uploads/services/'.$services->image))
            {
                Storage::disk('public')->delete('uploads/services/'.$services->image);

            }
//            resize image for service category and upload
            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/services/' . $image_name, $proImage);

        }
        else {
            $image_name = $services->image;
        }
        $services->image = $image_name;

        $icon_image = $request->file('icon');
        if (isset($icon_image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $icon_name = $currentDate . '-' . uniqid() . '.' . $icon_image->getClientOriginalExtension();
            //delete old image.....
            if(Storage::disk('public')->exists('uploads/service-category/icon/'.$services->image))
            {
                Storage::disk('public')->delete('uploads/services/icon/'.$services->image);

            }
//            resize image for project and upload
            $Icon_Image = Image::make($icon_image)->resize(64, 64)->save($icon_image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/services/icon/'.$icon_name, $Icon_Image);

        }
        else {
            $icon_name = $services->icon;
        }

        $services->icon = $icon_name;

        $services->save();
        Toastr::success('Service Edited Successfully', 'Success');
        return redirect()->route('admin.services.index');
    }


    public function destroy($id)
    {
        $services = Services::find($id);
        if(Storage::disk('public')->exists('uploads/services/'.$services->image))
        {
            Storage::disk('public')->delete('uploads/services/'.$services->image);

        }
        $services->delete();
        Toastr::success('Service Deleted Successfully', 'Success');
        return redirect()->back();
    }

    public function serviceCategoryList(Request $request){
        $service_provider_category_id = $request->service_provider_category_id;

        $service_categories = ServiceCategory::where('service_provider_category_id',$service_provider_category_id)->get();
        if(count($service_categories) > 0){
            $options = "<option value=''>Select One</option>";
            foreach($service_categories as $service_category){
                $options .= "<option value='$service_category->id'>$service_category->name</option>";
            }
        }else{
            $options = "<option value=''>No Data Found!</option>";
        }

        return response()->json(['success'=>true,'data'=>$options]);
    }

    public function serviceSubCategoryList(Request $request){
        $service_category_id = $request->service_category_id;
        $service_sub_categories = ServiceSubCategory::where('service_category_id',$service_category_id)->get();
        if(count($service_sub_categories) > 0){
            $options = "<option value=''>Select One</option>";
            foreach($service_sub_categories as $service_sub_category){
                $options .= "<option value='$service_sub_category->id'>$service_sub_category->name</option>";
            }
        }else{
            $options = "<option value=''>No Data Found!</option>";
        }

        return response()->json(['success'=>true,'data'=>$options]);
    }
}
