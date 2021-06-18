<?php

namespace App\Http\Controllers\Frontend;

use App\Banner;
use App\DoctorSpeciality;
use App\HealthTips;
use App\Http\Controllers\Controller;
use App\Product;
use App\ServiceCategory;
use App\ServiceProvider;
use App\Services;
use App\ServiceSubCategory;
use App\Test;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index(){
        //dd(Auth::user());

        /* check cart with raw data */
//        Cart::add([
//            'id' => '293ad',
//            'name' => 'Product 1',
//            'qty' => 1,
//            'price' => 9.99,
//            'options' => [
//                'size' => 'large'
//            ]
//        ]);

//        Cart::add([
//            [
//                'id' => '293ad',
//                'name' => 'Product 1',
//                'qty' => 1,
//                'price' => 10.00
//            ],
//            [
//                'id' => '4832k',
//                'name' => 'Product 2',
//                'qty' => 1,
//                'price' => 10.00,
//                'options' => [
//                    'size' => 'large'
//                ]
//            ]
//        ]);


//        Cart::add([$product1, $product2]);
//        Cart::content();
//        Cart::total();
//        Cart::count();
//        Cart::destroy();
//        dd(Cart::count());
        /* check cart with raw data */

        $all_services = Services::where('service_type','Hot Service')->latest()->limit(10)->get();
        //$hot_services = Services::where('service_type','Hot Service')->get();
        $all_service_categories = ServiceCategory::latest()->limit(10)->get();
        $all_health_tips = HealthTips::latest()->limit(4)->get();
        $all_banners = Banner::latest()->first();

        //$all_product = Product::where('active',1)->where('quantity','>',1)->latest()->limit(10)->get();
        $all_product = Product::where('current_stock','>',0)->latest()->limit(10)->get();

        $review_wise_doctor_user_lists = DB::table('users')
            ->join('doctors','doctors.user_id','=','users.id')
            ->join('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
            ->join('doctor_reviews','users.id','=','doctor_reviews.doctor_user_id')
            ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name','doctor_reviews.rating')
            ->where('users.role_id',2)
            ->where('users.active_inactive_status',1)
            ->latest('doctor_reviews.rating','desc')
            ->limit(10)
            ->get();

        //dd($review_wise_doctor_user_lists);


        return view('frontend.pages.index', compact('all_services','all_service_categories','all_health_tips','all_product','review_wise_doctor_user_lists','all_banners'));

    }

    public function cart()
    {
        $check_cart_type=0;
        foreach (Cart::content() as $productCart) {
            if($productCart->options->cart_type == "service"){
                $check_cart_type="ser";
                break;
            }elseif($productCart->options->cart_type == "lab"){
                $check_cart_type="lab";
                break;
            }
            else{
                $check_cart_type="prod";
                break;
            }
        }

        if($check_cart_type=="ser"){
            return view('frontend.pages.cart');
        }elseif($check_cart_type=="lab"){
            return redirect()->route('test.cart.list');
        }
        else{
            //dd($check_cart_type);
            return redirect()->route('shop.cart.list');
        }

    }

    public function service_provider(Request $request)
    {
        $lat=$request->lat;
        $lng=$request->lng;
        $serId=Cart::content()->first()->id;
        $service=\App\Services::find($serId);

        $serviceProviders = DB::table('service_providers')
            ->select('service_providers.id','users.name','users.slug','service_provider_contacts.address','service_provider_contacts.lat','service_provider_contacts.lng','service_provider_reviews.star')
            ->join('users','service_providers.user_id','=','users.id')
            ->leftJoin('service_provider_contacts','service_providers.id','=','service_provider_contacts.service_provider_id')
            ->leftJoin('service_provider_reviews','service_providers.id','=','service_provider_reviews.service_provider_id')
            ->where('service_providers.service_category_id',$service->service_category_id)
            ->whereBetween('service_provider_contacts.lat',[$lat-0.1,$lat+0.1])
            ->whereBetween('service_provider_contacts.lng',[$lng-0.1,$lng+0.1])
            ->where('users.active_inactive_status',1)
            ->get();
        return response()->json(['success'=> true, 'response'=>$serviceProviders]);
    }

    public function questionForm(){
        $doctorSpecialities = DoctorSpeciality::all();
        return view('frontend.pages.question', compact('doctorSpecialities'));
    }
    public function search_doctor(Request $request){
        $name = $request->get('q');
        $doctor = User::where('name', 'LIKE', '%'. $name. '%')->where('role_id',2)->limit(5)->get();
        return $doctor;
    }

    public function search_hospital(Request $request){
        $name = $request->get('q');
        $hospital = User::where('name', 'LIKE', '%'. $name. '%')->where('role_id',3)->limit(5)->get();
        return $hospital;
    }
    public function search_product(Request $request){
        $name = $request->get('q');
        $product = Product::where('name', 'LIKE', '%'. $name. '%')->limit(5)->get();
        //dd($product);
        return $product;
    }
    public function search_service(Request $request){
        $name = $request->get('q');
        //$service = Services::where('name', 'LIKE', '%'. $name. '%')->limit(5)->get();
        $service = DB::table('services')
            ->leftJoin('service_sub_categories','services.service_sub_category_id','service_sub_categories.id')
            ->where('services.name', 'LIKE', '%'. $name. '%')
            ->select('services.name','service_sub_categories.slug')
            ->limit(5)
            ->get();
        //dd($service);
        return $service;
    }
    public function search_test(Request $request){
        $name = $request->get('q');
        $product = Test::where('name', 'LIKE', '%'. $name. '%')->limit(5)->get();
        //dd($product);
        return $product;
    }

    public function doctor_near_list(Request $request)
    {
        $lat=$request->lat;
        $lng=$request->lng;
//        $serId=Cart::content()->first()->id;
//        $service=\App\Services::find($serId);
//
//        $serviceProviders = DB::table('service_providers')
//            ->select('service_providers.id','users.name','users.slug','service_provider_contacts.address','service_provider_contacts.lat','service_provider_contacts.lng')
//            ->join('users','service_providers.user_id','=','users.id')
//            ->join('service_provider_contacts','service_providers.id','=','service_provider_contacts.service_provider_id')
//            ->where('service_providers.service_category_id',$service->service_category_id)
//            ->whereBetween('service_provider_contacts.lat',[$lat-0.1,$lat+0.1])
//            ->whereBetween('service_provider_contacts.lng',[$lng-0.1,$lng+0.1])
//            ->where('users.active_inactive_status',1)
//            ->get();

//            $doctorUserLists = DB::table('doctors')
//                ->join('users','doctors.user_id','=','users.id')
//                ->join('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
//                ->join('doctor_contacts','doctors.id','=','doctor_contacts.doctor_id')
//                ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name')
//                ->where('users.role_id',2)
//                ->where('users.active_inactive_status',1)
//                ->whereBetween('doctor_contacts.lat',[$lat-0.1,$lat+0.1])
//                ->whereBetween('doctor_contacts.lng',[$lng-0.1,$lng+0.1])
//                ->get();

        $doctorUserLists = DB::table('users')
            ->join('doctors','doctors.user_id','=','users.id')
            ->join('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
            ->join('doctor_contacts','doctors.id','=','doctor_contacts.doctor_id')
            ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name','doctor_contacts.address')
            ->where('users.role_id',2)
            ->where('users.active_inactive_status',1)
            ->whereBetween('doctor_contacts.lat',[$lat-0.1,$lat+0.1])
            ->whereBetween('doctor_contacts.lng',[$lng-0.1,$lng+0.1])
            ->get();
            //dd($doctorUserLists);



        return response()->json(['success'=> true, 'response'=>$doctorUserLists]);
//        $doctorSpecialities = DoctorSpeciality::all();
//        $gen=[];
//        $spe=[];
//        return view('frontend.pages.doctor.doctor_list', compact('doctorUserLists','doctorSpecialities','gen','spe'));
    }


    public function privacy_policy(){
        return view('frontend.pages.privacy_policy');

    }

    public function terms_and_conditions(){
        return view('frontend.pages.terms_and_conditions');

    }
}
