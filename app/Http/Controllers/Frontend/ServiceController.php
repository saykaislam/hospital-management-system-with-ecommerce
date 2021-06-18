<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\ServiceCategory;
use App\ServiceProvider;
use App\ServiceProviderCategory;
use App\Services;
use App\ServiceSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function serviceProviderCategory(){
        $serviceProviderCategories = ServiceProviderCategory::all();

        return view('frontend.pages.service_provider_category', compact('serviceProviderCategories'));
    }

    public function serviceProviderService(Request $request, $slug){
        $service_provider_category_id = ServiceProviderCategory::where('slug',$slug)->pluck('id')->first();

        $servicesCategories = DB::table('service_categories')
            ->select('service_categories.id','service_categories.name','service_categories.slug','service_categories.image')
            ->leftJoin('service_provider_categories','service_categories.service_provider_category_id','=','service_provider_categories.id')
            ->where('service_provider_categories.id','=',$service_provider_category_id)
            ->get();

        return view('frontend.pages.service_category', compact('service_provider_category_id','servicesCategories'));
    }

    public function serviceCategory(Request $request, $slug){

        $service_category_id = ServiceCategory::where('slug',$slug)->pluck('id')->first();
        $serviceSubCategories = ServiceSubCategory::where('service_category_id',$service_category_id)->get();

        return view('frontend.pages.service_sub_category', compact('service_category_id','serviceSubCategories'));
    }

    public function serviceSubCategory(Request $request, $slug){
        $service_category_id = ServiceSubCategory::where('slug',$slug)->pluck('service_category_id')->first();
        $service_sub_category_id = ServiceSubCategory::where('slug',$slug)->pluck('id')->first();
        $services = [];
        if($service_sub_category_id){
            $services = Services::where('service_category_id',$service_category_id)->where('service_sub_category_id',$service_sub_category_id)->get();
        }
        return view('frontend.pages.service', compact('service_category_id','service_sub_category_id','services'));
    }
    public function allserviceSubCategory(Request $request){
        $serviceSubCategories = ServiceSubCategory::all();
        $services = Services::latest()->paginate(40);
        return view('frontend.pages.all-service-subcategory', compact('serviceSubCategories','services'));
    }
    public function allserviceCategory(Request $request){
        $serviceCategories = ServiceCategory::all();
        //dd($serviceCategories);
        $services = Services::latest()->paginate(40);
        return view('frontend.pages.all-service-category', compact('serviceCategories','services'));
    }

}
