<?php

namespace App\Http\Controllers\API;

use App\DoctorEducation;
use App\DoctorExperience;
use App\Http\Controllers\Controller;
use App\Http\Middleware\User;
use App\ServiceProvider;
use App\ServiceProviderContact;
use App\ServiceProviderCost;
use App\ServiceProviderEducation;
use App\ServiceProviderExperience;
use App\ServiceProviderReview;
use App\ServiceProviderVerification;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Validator;

class ServiceProviderController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;
    public $validationStatus = 404;

    public function serviceOrderList(Request $request)
    {
        $all_orders = DB::table('orders')
            ->select('orders.id','orders.order_type','orders.shipping_address','orders.invoice_code','orders.grand_total','orders.payment_status','orders.payment_type','orders.delivery_cost','orders.delivery_status','orders.view','orders.service_provider_permission','orders.created_at')
            ->join('service_providers','orders.service_provider_id','=','service_providers.id')
            ->where('orders.order_type','service')
            ->where('service_providers.user_id',$request->service_provider_id)
            ->where('orders.service_provider_permission',1)
            ->orderBy('orders.id','desc')
            ->get();

        $today_orders = DB::table('orders')
            ->select('orders.id','orders.order_type','orders.shipping_address','orders.invoice_code','orders.grand_total','orders.payment_status','orders.payment_type','orders.delivery_cost','orders.delivery_status','orders.view','orders.service_provider_permission','orders.created_at')
            ->join('service_providers','orders.service_provider_id','=','service_providers.id')
            ->where('orders.order_type','service')
            ->where('service_providers.user_id',$request->service_provider_id)
            ->where('orders.service_provider_permission',1)
            ->where('orders.created_at','>=',date('Y-m-d 00:00:00'))
            ->where('orders.created_at','<=',date('Y-m-d 11:59:59'))
            ->orderBy('orders.id','desc')
            ->get();

        $booking_orders = DB::table('orders')
            ->select('orders.id','orders.order_type','orders.shipping_address','orders.invoice_code','orders.grand_total','orders.payment_status','orders.payment_type','orders.delivery_cost','orders.delivery_status','orders.view','orders.service_provider_permission','orders.created_at')
            ->join('service_providers','orders.service_provider_id','=','service_providers.id')
            ->where('orders.order_type','service')
            ->where('service_providers.user_id',$request->service_provider_id)
            ->where('orders.service_provider_permission',1)
            ->where('orders.delivery_status','Pending')
            ->orderBy('orders.id','desc')
            ->get();

        if($all_orders)
        {
            $success['all_orders'] =  $all_orders;
            $success['today_orders'] =  $today_orders;
            $success['booking_orders'] =  $booking_orders;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Order List Found!'], $this->failStatus);
        }
    }

    public function reviewList(Request $request)
    {
        $reviews = DB::table('service_provider_reviews')
            ->join('service_providers','service_provider_reviews.service_provider_id','=','service_providers.id')
            ->join('users','service_provider_reviews.user_id','=','users.id')
            ->where('service_providers.user_id', $request->service_provider_id)
            ->select('service_provider_reviews.*','users.name','users.image')
            ->get();

        if($reviews)
        {
            $success['reviews'] =  $reviews;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Order List Found!'], $this->failStatus);
        }
    }

    public function districtList()
    {
        $division_districts = DB::table('division_districts')->select('id','name')->get();

        if($division_districts)
        {
            $success['districts'] =  $division_districts;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No District List Found!'], $this->failStatus);
        }
    }

    public function serviceProviderCategory()
    {
        $service_provider_categories = DB::table('service_provider_categories')->get();

        if($service_provider_categories)
        {
            $success['service_provider_categories'] =  $service_provider_categories;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Service Provider Category List Found!'], $this->failStatus);
        }
    }

    public function serviceCategory(Request $request)
    {
        $service_provider_category_id = $request->service_provider_category_id ? $request->service_provider_category_id : NULL;

        if($service_provider_category_id){
            $service_categories = DB::table('service_categories')->where('service_provider_category_id',$service_provider_category_id)->get();
        }else{
            $service_categories = DB::table('service_categories')->get();
        }

        if($service_categories)
        {
            $success['service_provider_categories'] =  $service_categories;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Service Category List Found!'], $this->failStatus);
        }
    }

    public function serviceSubCategory(Request $request)
    {
        $service_category_id = $request->service_category_id ? $request->service_category_id : NULL;

        if($service_category_id){
            $service_sub_categories = DB::table('service_sub_categories')->where('service_category_id',$service_category_id)->get();
        }else{
            $service_sub_categories = DB::table('service_sub_categories')->get();
        }

        if($service_sub_categories)
        {
            $success['service_sub_categories'] =  $service_sub_categories;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Service Sub Category List Found!'], $this->failStatus);
        }
    }

    public function serviceProviderProfileInfo(Request $request)
    {
        $service_provider_basic = DB::table('users')
            ->where('id',$request->service_provider_user_id)
            ->select('name','phone','email','gender','image')
            ->first();

        $service_provider_details = DB::table('service_providers')
            ->leftJoin('service_provider_categories','service_providers.service_provider_category_id','service_provider_categories.id')
            ->leftJoin('service_categories','service_providers.service_category_id','service_categories.id')
            ->where('service_providers.user_id',$request->service_provider_user_id)
            ->select('service_providers.id as service_provider_id','service_providers.height','service_providers.weight','service_providers.language','service_providers.personal_statement','service_providers.is_active','service_provider_categories.id as service_provider_category_id','service_provider_categories.name as service_provider_category_name','service_categories.id as service_category_id','service_categories.name as service_category_name')
            ->first();

        if($service_provider_basic)
        {
            $success['service_provider_basic'] =  $service_provider_basic;
            $success['service_provider_details'] =  $service_provider_details;

            if($service_provider_details){
                $service_provider_contacts = DB::table('service_provider_contacts')
                    ->leftJoin('division_districts','service_provider_contacts.division_district_id','division_districts.id')
                    ->where('service_provider_contacts.service_provider_id',$service_provider_details->service_provider_id)
                    ->select('service_provider_contacts.id as service_provider_contact_id','service_provider_contacts.address','service_provider_contacts.lat','service_provider_contacts.lng','division_districts.id as division_district_id','division_districts.name as division_district_name')
                    ->first();

                $service_provider_costs = DB::table('service_provider_costs')
                    ->where('service_provider_id',$service_provider_details->service_provider_id)
                    ->select('id as service_provider_cost_id','monthly_cost','fullday_cost','halfday_cost','home_cost')
                    ->first();

                $service_provider_educations = DB::table('service_provider_educations')
                    ->where('service_provider_id',$service_provider_details->service_provider_id)
                    ->select('id as service_provider_education_id','degree','institute','year_of_completion')
                    ->get();

                $service_provider_experiences = DB::table('service_provider_experiences')
                    ->where('service_provider_id',$service_provider_details->service_provider_id)
                    ->select('id as service_provider_experience_id','company_name','from','to','designation')
                    ->get();

                $service_provider_verifications = DB::table('service_provider_verifications')
                    ->where('service_provider_id',$service_provider_details->service_provider_id)
                    ->select('id as service_provider_verification_id','image')
                    ->first();

                $success['service_provider_contacts'] =  $service_provider_contacts;
                $success['service_provider_costs'] =  $service_provider_costs;
                $success['service_provider_educations'] =  $service_provider_educations;
                $success['service_provider_experiences'] =  $service_provider_experiences;
                $success['service_provider_verifications'] =  $service_provider_verifications;
            }

            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Service Provider Found!'], $this->failStatus);
        }
    }

    public function serviceProviderBasicUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this-> validationStatus);
        }


        $user_id = $request->user_id;
        $user = \App\User::find($user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $affectedRow = $user->update();
        if($affectedRow){
            return response()->json(['success'=>true,'response' => $user], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }

    }


    public function serviceProviderProfileImageUpdate(Request $request){
//        $validator = Validator::make($request->all(), [
//            'image1' => 'required',
//        ]);
//
//        if ($validator->fails()) {
//            $response = [
//                'success' => false,
//                'data' => 'Validation Error.',
//                'message' => $validator->errors()
//            ];
//            return response()->json($response, $this-> validationStatus);
//        }


        $user_id = $request->user_id;
        $user = \App\User::find($user_id);

        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //delete old image.....
            if(Storage::disk('public')->exists('uploads/profile_pic/service_provider/'.$user->image))
            {
                Storage::disk('public')->delete('uploads/profile_pic/service_provider/'.$user->image);
            }

//            resize image for hospital and upload
            $proImage = Image::make($image)->resize(100, 100)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/profile_pic/service_provider/'. $imagename, $proImage);

        }else {
            $imagename= $user->image;
        }
        $user->image = $imagename;
        $affectedRow = $user->update();
        if($affectedRow){
            return response()->json(['success'=>true,'response' => $user], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }

    }

    public function serviceProviderDetailsInsertOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'service_provider_category_id' => 'required',
            'service_category_id' => 'required',
            'is_active' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'language' => 'required',
            'personal_statement' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        if($request->service_provider_id){
            $service_provider = ServiceProvider::find($request->service_provider_id);
            $service_provider->user_id = $request->user_id;
            $service_provider->service_provider_category_id = $request->service_provider_category_id;
            $service_provider->service_category_id = $request->service_category_id;
            $service_provider->is_active = $request->is_active;
            $service_provider->height = $request->height;
            $service_provider->weight = $request->weight;
            $service_provider->language = $request->language;
            $service_provider->personal_statement = $request->personal_statement;
            $affectedRow = $service_provider->save();
            if($affectedRow){
                return response()->json(['success'=>true,'response' => $service_provider], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
            }
        }else{
            $service_provider = new ServiceProvider();
            $service_provider->user_id = $request->user_id;
            $service_provider->service_provider_category_id = $request->service_provider_category_id;
            $service_provider->service_category_id = $request->service_category_id;
            $service_provider->is_active = $request->is_active;
            $service_provider->height = $request->height;
            $service_provider->weight = $request->weight;
            $service_provider->language = $request->language;
            $service_provider->personal_statement = $request->personal_statement;
            $insert_id = $service_provider->save();
            if($insert_id){
                return response()->json(['success'=>true,'response' => $service_provider], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Inserted!'], $this->failStatus);
            }
        }
    }

    public function serviceProviderContactInsertOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_provider_id' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        if($request->service_provider_contact_id){
            $service_provider_contact = ServiceProviderContact::find($request->service_provider_contact_id);
            $service_provider_contact->service_provider_id = $request->service_provider_id;
            $service_provider_contact->division_district_id = $request->division_district_id;
            $service_provider_contact->address = $request->address;
            $service_provider_contact->city = $request->city;
            $service_provider_contact->state_or_province = $request->area;
            $service_provider_contact->lat = $request->latitude;
            $service_provider_contact->lng = $request->longitude;
            //$service_provider_contact->country = $request->country;
            $service_provider_contact->postal_code = $request->postcode;
            $affectedRow = $service_provider_contact->save();
            if($affectedRow){
                return response()->json(['success'=>true,'response' => $service_provider_contact], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
            }
        }else{
            $service_provider_contact = new ServiceProviderContact();
            $service_provider_contact->service_provider_id = $request->service_provider_id;
            $service_provider_contact->division_district_id = $request->division_district_id;
            $service_provider_contact->address = $request->address;
            $service_provider_contact->city = $request->city;
            $service_provider_contact->state_or_province = $request->area;
            $service_provider_contact->lat = $request->latitude;
            $service_provider_contact->lng = $request->longitude;
            //$service_provider_contact->country = $request->country;
            $service_provider_contact->postal_code = $request->postcode;
            $insert_id = $service_provider_contact->save();
            if($insert_id){
                return response()->json(['success'=>true,'response' => $service_provider_contact], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Inserted!'], $this->failStatus);
            }
        }
    }

    public function serviceProviderCostInsertOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_provider_id' => 'required',
            'monthly_cost' => 'required',
            'fullday_cost' => 'required',
            'halfday_cost' => 'required',
            'home_cost' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }



        if($request->service_provider_cost_id){
            $service_provider_cost = ServiceProviderCost::find($request->service_provider_cost_id);
            $service_provider_cost->service_provider_id = $request->service_provider_id;
            $service_provider_cost->monthly_cost = $request->monthly_cost;
            $service_provider_cost->fullday_cost = $request->fullday_cost;
            $service_provider_cost->halfday_cost = $request->halfday_cost;
            $service_provider_cost->home_cost = $request->home_cost;
            $affectedRow = $service_provider_cost->save();
            if($affectedRow){
                return response()->json(['success'=>true,'response' => $service_provider_cost], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
            }
        }else{
            $service_provider_cost = new ServiceProviderCost();
            $service_provider_cost->service_provider_id = $request->service_provider_id;
            $service_provider_cost->monthly_cost = $request->monthly_cost;
            $service_provider_cost->fullday_cost = $request->fullday_cost;
            $service_provider_cost->halfday_cost = $request->halfday_cost;
            $service_provider_cost->home_cost = $request->home_cost;
            $insert_id = $service_provider_cost->save();
            if($insert_id){
                return response()->json(['success'=>true,'response' => $service_provider_cost], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Inserted!'], $this->failStatus);
            }
        }
    }

    public function serviceProviderEducationInsertOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'degree' => 'required',
            'institute' => 'required',
            'year_of_completion' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        if($request->service_provider_education_id){
            $service_provider_education = ServiceProviderEducation::find($request->service_provider_education_id);
            $service_provider_education->service_provider_id = $request->service_provider_id;
            $service_provider_education->degree = $request->degree;
            $service_provider_education->institute = $request->institute;
            $service_provider_education->year_of_completion = $request->year_of_completion;
            $affectedRow = $service_provider_education->save();
            if($affectedRow){
                return response()->json(['success'=>true,'response' => $service_provider_education], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
            }
        }else{
            $service_provider_education = new ServiceProviderEducation();
            $service_provider_education->service_provider_id = $request->service_provider_id;
            $service_provider_education->degree = $request->degree;
            $service_provider_education->institute = $request->institute;
            $service_provider_education->year_of_completion = $request->year_of_completion;
            $insert_id = $service_provider_education->save();
            if($insert_id){
                return response()->json(['success'=>true,'response' => $service_provider_education], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Inserted!'], $this->failStatus);
            }
        }
    }


    public function serviceProviderExperienceInsertOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'from' => 'required',
            'to' => 'required',
            'designation' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        if($request->service_provider_experience_id){
            $service_provider_experience = ServiceProviderExperience::find($request->service_provider_experience_id);
            $service_provider_experience->service_provider_id = $request->service_provider_id;
            $service_provider_experience->company_name = $request->company_name;
            $service_provider_experience->from = $request->from;
            $service_provider_experience->to = $request->to;
            $service_provider_experience->designation = $request->designation;
            $affectedRow = $service_provider_experience->save();
            if($affectedRow){
                return response()->json(['success'=>true,'response' => $service_provider_experience], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
            }
        }else{
            $service_provider_experience = new ServiceProviderExperience();
            $service_provider_experience->service_provider_id = $request->service_provider_id;
            $service_provider_experience->company_name = $request->company_name;
            $service_provider_experience->from = $request->from;
            $service_provider_experience->to = $request->to;
            $service_provider_experience->designation = $request->designation;
            $insert_id = $service_provider_experience->save();
            if($insert_id){
                return response()->json(['success'=>true,'response' => $service_provider_experience], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Inserted!'], $this->failStatus);
            }
        }
    }

    public function serviceProviderVerificationInsertOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        //dd($verification);
        if($request->service_provider_verification_id) {
            $verification = ServiceProviderVerification::where('service_provider_id',$request->service_provider_id)->where('id',$request->service_provider_verification_id)->first();
            $image = $request->file('image');
            if (isset($image)) {
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                //delete old image.....
                if(Storage::disk('public')->exists('uploads/profile_pic/service_provider/'.$verification->image))
                {
                    Storage::disk('public')->delete('uploads/profile_pic/service_provider/'.$verification->image);
                }

//            resize image for hospital and upload
                $proImage = Image::make($image)->resize(100, 100)->save($image->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/profile_pic/service_provider/'. $imagename, $proImage);

            }else {
                $imagename= $verification->image;
            }
            $verification->image = $imagename;
            $affectedRow = $verification->save();
            if($affectedRow){
                return response()->json(['success'=>true,'response' => $verification], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
            }

        }else{
            $service_provider_id = ServiceProvider::where('user_id',Auth::id())->pluck('id')->first();

            $ver = new ServiceProviderVerification();
            $ver->service_provider_id = $service_provider_id;
            $image = $request->file('image');
            if (isset($image)) {
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

//            resize image for hospital and upload
                $proImage = Image::make($image)->resize(100, 100)->save($image->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/profile_pic/service_provider/'. $imagename, $proImage);

                $ver->image = $imagename;
                $ver->save();
                $insert_id = $ver->id();
                if($insert_id){
                    return response()->json(['success'=>true,'response' => $ver], $this-> successStatus);
                }
            }
            return response()->json(['success'=>false,'response'=>'No Successfully Inserted!'], $this->failStatus);
        }
    }

    public function serviceProviderReviewStore(Request $request){

        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'user_id' => 'required',
            'service_provider_id' => 'required',
            'star' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        $check_already_review = ServiceProviderReview::where('order_id',$request->order_id)
            ->where('user_id',$request->user_id)
            ->where('service_provider_id',$request->service_provider_id)
            ->first();
        if($check_already_review){
            return response()->json(['success'=>false,'response'=>'You Have already Reviewed!'], $this->successStatus);
        }else{
            $service_provider = ServiceProvider::find($request->service_provider_id);

            $review=new ServiceProviderReview();
            $review->order_id=$request->order_id;
            $review->user_id=$request->user_id;
            $review->service_provider_id=$request->service_provider_id;
            $review->star=$request->star;
            $review->description=$request->description;
            $insert_id = $review->save();

            if($insert_id){
                $count_service_provider_review_rating = count(ServiceProviderReview::where('service_provider_id', $request->service_provider_id)
                    ->where('status', 1)
                    ->get());
                $sum_service_provider_review_rating = ServiceProviderReview::where('service_provider_id', $request->service_provider_id)
                    ->where('status', 1)->sum('star');

                if($count_service_provider_review_rating > 0){
                    $rating = $sum_service_provider_review_rating/$count_service_provider_review_rating;
                    $service_provider->rating = $rating;
                }
                else {
                    $service_provider->rating = 0;
                }
                $service_provider->save();
                return response()->json(['success'=>true,'response' => $review], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Inserted!'], $this->failStatus);
            }
        }
    }
}
