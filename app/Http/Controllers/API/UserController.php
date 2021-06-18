<?php

namespace App\Http\Controllers\API;

use App\Clinic;
use App\ClinicCategory;
use App\ClinicDoctor;
use App\ClinicOpenClose;
use App\Doctor;
use App\DoctorAward;
use App\DoctorClinicSchedule;
use App\DoctorClinicScheduleTimeSlot;
use App\DoctorContact;
use App\DoctorEducation;
use App\DoctorExperience;
use App\DoctorReview;
use App\DoctorSpeciality;
use App\DoctorSpecialityDoctor;
use App\HealthTips;
use App\HealthTipsCategory;
use App\LabTest;
use App\Order;
use App\OrderLabDetails;
use App\OrderServiceDetail;
use App\Product;
use App\Question;
use App\Services;
use App\ServiceSubCategory;
use App\Test;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\VerificationCode;
use App\Helpers\UserInfo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;
    public $validationStatus = 404;


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this-> validationStatus);
        }

        $phn1 = (int)$request->phone;
        $check = User::where('phone',$phn1)->first();
        if (!empty($check)){
            $response = [
                'success' => false,
                'data' => 'Check Exists OR Not.',
                'message' => 'phone number already exist'
            ];
            return response()->json($response, $this-> validationStatus);
        }

        if($request->countyCodePrefix == +880){
            $phn = (int)$request->phone;
        }else{
            $phn = $request->phone;
        }
        $slug = Str::slug($request->name,'-');
        $drSlugCheck = User::where('slug', $slug)->first();
        if(!empty($drSlugCheck)) {
            $slug = $slug.'-'.Str::random(6);
        }

        // user data
        $user = new User();
        $user->name = $request->name;
        $user->slug = $slug;
        $user->country_code = $request->countyCodePrefix;
        $user->phone = $phn;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->sign_up_type = 2; // 1=web, 2=phone
        $user->status = 0;
        $user->save();
        $user_id = $user->id;
        if($user_id){
            // create token
            $success['token'] = $user->createToken('PreventCare')->accessToken;
            $success['user'] =  $user;


            // same api
            // verification table
            $verification = VerificationCode::where('phone',$user->phone)->first();
            if (!empty($verification)){
                $verification->delete();
            }
            $verCode = new VerificationCode();
            $verCode->phone = $user->phone;
            $verCode->code = mt_rand(1111,9999);
            $verCode->status = 0;
            $verCode->save();
            $insert_id = $verCode->id;
            if($insert_id){
                $text = "Dear ".$user->name.", Your Prevent Care OTP is ".$verCode->code;
                UserInfo::smsAPI("88".$verCode->phone,$text);

                $success['code'] = $verCode->code;

                return response()->json(['success' => $success], $this-> successStatus);
            }else{
                return response()->json(['error' => 'Unauthorised'], $this-> failStatus);
            }



            //return response()->json(['success' => $success], $this-> successStatus);
        }else{
            return response()->json(['error' => 'Unauthorised'], $this-> failStatus);
        }
    }

    // another api
    public function getVerificationCode(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this-> validationStatus);
        }

        $user = User::find($request->user_id);

        // verification table
        $verification = VerificationCode::where('phone',$user->phone)->first();
        if (!empty($verification)){
            $verification->delete();
        }
        $verCode = new VerificationCode();
        $verCode->phone = $user->phone;
        $verCode->code = mt_rand(1111,9999);
        $verCode->status = 0;
        $verCode->save();
        $insert_id = $verCode->id;
        if($insert_id){
            $text = "Dear ".$user->name.", Your Prevent Care OTP is ".$verCode->code;
            UserInfo::smsAPI("88".$verCode->phone,$text);

            $success['code'] = $verCode->code;
            $success['user'] = $user;

            return response()->json(['success' => $success], $this-> successStatus);
        }else{
            return response()->json(['error' => 'Unauthorised'], $this-> failStatus);
        }
    }

    public function verification(Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];

            return response()->json($response, $this-> validationStatus);
        }

        $check = VerificationCode::where('code',$request->code)->where('phone',$request->phone)->where('status',0)->first();
        if (!empty($check)) {
            // verification update
            $check->status = 1;
            $check->update();

            // user update
            $user = User::where('phone',$request->phone)->first();
            $user->status = 1;
            $user->save();

            // get token
            $token = DB::table('oauth_access_tokens')
                ->where('user_id',$user->id)
                ->latest()
                ->pluck('id')
                ->first();

            $success['token'] = $token;
            $success['user'] = $user;

            return response()->json(['success' => $success], $this-> successStatus);
        }else{
            return response()->json(['error' => 'Unauthorised'], $this-> failStatus);
        }

    }

    public function sendVerificationCode(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this-> validationStatus);
        }

        $user = User::where('phone',$request->phone)->first();
        if($user){
            // verification table
            $verification = VerificationCode::where('phone',$user->phone)->first();
            if (!empty($verification)){
                $verification->delete();
            }
            $verCode = new VerificationCode();
            $verCode->phone = $user->phone;
            $verCode->code = mt_rand(1111,9999);
            $verCode->status = 0;
            $verCode->save();
            $insert_id = $verCode->id;
            if($insert_id){
                $text = "Dear ".$user->name.", Your Prevent Care OTP is ".$verCode->code;
                UserInfo::smsAPI("88".$verCode->phone,$text);

                $success['code'] = $verCode->code;
                $success['user'] = $user;

                return response()->json(['success' => $success], $this-> successStatus);
            }else{
                return response()->json(['error' => 'Unauthorised'], $this-> failStatus);
            }
        }else{
            return response()->json(['error' => 'No User Found Using This Phone!'], $this-> failStatus);
        }
    }

    public function sendVerification(Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];

            return response()->json($response, $this-> validationStatus);
        }

        $check = VerificationCode::where('code',$request->code)->where('phone',$request->phone)->where('status',0)->first();
        if (!empty($check)) {
            // verification update
            $check->status = 1;
            $check->update();



            $digits    = array_flip(range('0', '9'));
            $lowercase = array_flip(range('a', 'z'));
            $uppercase = array_flip(range('A', 'Z'));
            $special   = array_flip(str_split('!@#$%^&*()_+=-}{[}]\|;:<>?/'));
            $combined  = array_merge($digits, $lowercase, $uppercase, $special);

            $password  = str_shuffle(array_rand($digits) .
                array_rand($lowercase) .
                array_rand($uppercase) .
                array_rand($special) .
                implode(array_rand($combined, rand(4, 8))));


            // user update
            $user = User::where('phone',$request->phone)->first();
            $user->status = 1;
            $user->password = Hash::make($password);
            $user->save();

            $text = "Dear ".$user->name.", Your Prevent Care New Password is ".$password;
            UserInfo::smsAPI("88".$request->phone,$text);

            // get token
            $token = DB::table('oauth_access_tokens')
                ->where('user_id',$user->id)
                ->latest()
                ->pluck('id')
                ->first();

            $success['token'] = $token;
            $success['user'] = $user;

            return response()->json(['success' => $success], $this-> successStatus);
        }else{
            return response()->json(['error' => 'Unauthorised'], $this-> failStatus);
        }

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];

            return response()->json($response, $this-> validationStatus);
        }

        //if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
        if (Auth::attempt(['phone' => request('phone'), 'password' => request('password')])) {
            $user = Auth::user();

            $success['success'] = true;

            // one way
//            $user['token'] = $user->createToken('BoiBichitra')->accessToken;
//            $success['user'] = $user;



            // two way
            $userData = DB::table('users')->where('id',$user->id)
                ->select('id','role_id','name','phone','email','slug','gender','blood_group','image')
                ->first();

            // create token
            $userData->token = $user->createToken('PreventCare')->accessToken;

            $success['user'] = $userData;

            return response()->json(['success' => $success], $this-> successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], $this-> failStatus);
        }
    }

    public function userProfileUpdate(Request $request){
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


        $user_id = Auth::user()->id;
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

    public function userProfileImageUpdate(Request $request){

        $user_id = $request->user_id;
        $user = \App\User::find($user_id);

        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //delete old image.....
            if(Storage::disk('public')->exists('uploads/profile_pic/user/'.$user->image))
            {
                Storage::disk('public')->delete('uploads/profile_pic/user/'.$user->image);
            }

//            resize image for hospital and upload
            $proImage = Image::make($image)->resize(100, 100)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/profile_pic/user/'. $imagename, $proImage);

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

    public function hospitalList()
    {
        //$clinicUserLists = User::where('role_id',3)->get();
        $hospitalLists = DB::table('users')
            ->leftJoin('clinics','users.id','=','clinics.user_id')
            ->leftJoin('clinic_contacts','clinics.id','=','clinic_contacts.clinic_id')
            ->leftJoin('clinic_categories','clinics.clinic_category_id','=','clinic_categories.id')
            ->where('users.role_id',3)
            ->select('users.id as user_id','users.name','users.slug','users.image','clinics.id as clinic_user_id','clinics.rating','clinics.emergency_phone','clinics.description','clinics.opens_time','clinic_contacts.address','clinic_contacts.lat','clinic_contacts.lng','clinic_categories.name as clinic_category_name')
            ->get();

        if($hospitalLists)
        {
            $success['hospitalLists'] =  $hospitalLists;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Hospital List Found!'], $this->failStatus);
        }
    }

    public function hospitalDoctorList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hospital_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        $hospitalDoctorUserLists = DB::table('users')
            ->join('clinics','clinics.user_id','=','users.id')
            ->join('clinic_doctors','clinic_doctors.clinic_id','=','clinics.id')
            ->join('doctors','doctors.id','=','clinic_doctors.doctor_id')
            ->join('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
            ->select('doctors.*','doctor_specialities.name as spe_name')
            //->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name')
            ->where('users.id',$request->hospital_id)
            ->get();

        if($hospitalDoctorUserLists)
        {

            $data = [];
            foreach ($hospitalDoctorUserLists as $hospitalDoctorUserList){
                $doctor_user = DB::table('users')
                    ->join('doctors','doctors.user_id','=','users.id')
                    ->select('users.name as doctor_name','users.image')
                    ->where('doctors.id',$hospitalDoctorUserList->id)
                    ->first();

                $nested_data['id']=$hospitalDoctorUserList->id;
                $nested_data['user_id']=$hospitalDoctorUserList->user_id;
                $nested_data['doctor_speciality_id']=$hospitalDoctorUserList->doctor_speciality_id;
                $nested_data['title']=$hospitalDoctorUserList->title;
                $nested_data['slug']=$hospitalDoctorUserList->slug;
                $nested_data['is_active']=$hospitalDoctorUserList->is_active;
                $nested_data['is_online']=$hospitalDoctorUserList->is_online;
                $nested_data['has_permission']=$hospitalDoctorUserList->has_permission;
                $nested_data['has_clinic']=$hospitalDoctorUserList->has_clinic;
                $nested_data['has_home_service']=$hospitalDoctorUserList->has_home_service;
                $nested_data['is_on_demand']=$hospitalDoctorUserList->is_on_demand;
                $nested_data['home_cost']=$hospitalDoctorUserList->home_cost;
                $nested_data['Bmdc_number']=$hospitalDoctorUserList->Bmdc_number;
                $nested_data['personal_statement']=$hospitalDoctorUserList->personal_statement;
                $nested_data['language']=$hospitalDoctorUserList->language;
                $nested_data['spe_name']=$hospitalDoctorUserList->spe_name;

                $nested_data['doctor_name']=$doctor_user->doctor_name;
                $nested_data['image']=$doctor_user->image;

                array_push($data, $nested_data);
            }

            //$success['hospitalDoctorUserLists'] =  $hospitalDoctorUserLists;
            $success['hospitalDoctorUserLists'] =  $data;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Hospital Doctor User List Found!'], $this->failStatus);
        }
    }

    public function hospitalOpenCloseList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hospital_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        $clinicOpenClose = ClinicOpenClose::where('clinic_id',$request->hospital_id)->get();

        if($clinicOpenClose)
        {
            $success['clinicOpenClose'] =  $clinicOpenClose;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Hospital Open Close List Found!'], $this->failStatus);
        }
    }

    public function doctorList()
    {
        $doctorUserLists = DB::table('users')
            ->join('doctors','doctors.user_id','=','users.id')
            ->join('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
            ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name')
            ->where('users.role_id',2)
            ->where('users.active_inactive_status',1)
            ->get();

        if($doctorUserLists)
        {
            $success['doctorUserLists'] =  $doctorUserLists;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Doctor List Found!'], $this->failStatus);
        }
    }

    public function doctorDetails(Request $request){
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        $doctorUserDetails = DB::table('users')
            ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.doctor_speciality_id','doctors.home_cost')
            ->join('doctors','doctors.user_id','=','users.id')
            ->LeftJoin('doctor_reviews','doctor_reviews.doctor_user_id','=','users.id')
            ->where('users.id',$request->doctor_id)
            ->first();

        if($doctorUserDetails)
        {
            $success['doctorUserLists'] =  $doctorUserDetails;


            $doctor_speciality_name = DoctorSpeciality::where('id',$doctorUserDetails->doctor_speciality_id)->pluck('name')->first();
            $doctor_contacts = DoctorContact::where('doctor_id',$doctorUserDetails->doctor_id)->first();
            $doctorEducations = DoctorEducation::where('doctor_id',$doctorUserDetails->doctor_id)->get();
            $doctorExperiences = DoctorExperience::where('doctor_id',$doctorUserDetails->doctor_id)->get();
            $doctorAwards = DoctorAward::where('doctor_id',$doctorUserDetails->doctor_id)->get();
            $doctorSpecialityDoctors = DoctorSpecialityDoctor::where('doctor_id',$doctorUserDetails->doctor_id)->get();
            $clinicDoctors = ClinicDoctor::where('doctor_id',$doctorUserDetails->doctor_id)->get();
            $doctorReviews=DoctorReview::where('doctor_user_id',$doctorUserDetails->id)->get();


            $success['doctor_speciality_name'] =  $doctor_speciality_name;
            $success['doctor_contacts'] =  $doctor_contacts;
            $success['doctorEducations'] =  $doctorEducations;
            $success['doctorExperiences'] =  $doctorExperiences;
            $success['doctorAwards'] =  $doctorAwards;
            $success['doctorSpecialityDoctors'] =  $doctorSpecialityDoctors;
            $success['clinicDoctors'] =  $clinicDoctors;
            $success['doctorReviews'] =  $doctorReviews;



            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Doctor List Found!'], $this->failStatus);
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
        $validator = Validator::make($request->all(), [
            'service_provider_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        $service_provider_category_id = $request->service_provider_category_id ? $request->service_provider_category_id : NULL;

        if($service_provider_category_id){
            $service_categories = DB::table('service_categories')->where('service_provider_category_id',$service_provider_category_id)->get();
        }else{
            $service_categories = DB::table('service_categories')->get();
        }

        if($service_categories)
        {
            $success['service_categories'] =  $service_categories;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Service Category List Found!'], $this->failStatus);
        }
    }

    public function serviceSubCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

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

    public function serviceList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_sub_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        $service_category_id = ServiceSubCategory::where('id',$request->service_sub_category_id)->pluck('service_category_id')->first();
        if($service_category_id){
            $services = Services::where('service_category_id',$service_category_id)->where('service_sub_category_id',$request->service_sub_category_id)->get();
            if($services)
            {
                $success['services'] =  $services;
                return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Service List Found!'], $this->failStatus);
            }
        }else{
            return response()->json(['success'=>false,'response'=>'No Service Sub Category Found!'], $this->failStatus);
        }
    }

    public function serviceRecommendedList()
    {

        $all_services = Services::where('service_type','Hot Service')->latest()->limit(10)->get();

        if($all_services)
        {
            $success['all_recommended_services'] =  $all_services;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Service List Found!'], $this->failStatus);
        }
    }

    public function questionStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_speciality_id' => 'required',
            'search_title' => 'required',
            'question' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this-> validationStatus);
        }

        $question = new Question();
        $question->doctor_speciality_id = $request->doctor_speciality_id;
        $question->search_title = $request->search_title;
        $question->question = $request->question;
        $question->question_user_id = Auth::user()->id;
        $question->save();
        $insert_id = $question->id;

        if($insert_id)
        {
            $success['question'] =  $question;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Inserted Successfully!'], $this->failStatus);
        }
    }

    public function questionList(){
        $questions = DB::table('questions')
            ->leftJoin('question_answers','questions.id','=','question_answers.question_id')
            ->leftJoin('users','users.id','=','question_answers.answer_doctor_user_id')
            ->where('question_user_id',Auth::user()->id)
            ->select('questions.*','question_answers.answer_doctor_user_id','question_answers.answer','question_answers.date','question_answers.answer_by','users.name')
            ->orderBy('questions.id','desc')
            ->get();

        if($questions){
            return response()->json(['success'=>true,'response' => $questions], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Question Found!'], $this->failStatus);
        }
    }
    public function dashboardCount(){

        $service_order_info = Order::where('order_type','service')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $appointment_clinic_doctor_order_info = DB::table('users')
            ->join('doctor_clinic_schedule_time_slots','users.id','=','doctor_clinic_schedule_time_slots.user_id')
            ->leftJoin('follow_up_e_prescriptions','follow_up_e_prescriptions.slot_id','=','doctor_clinic_schedule_time_slots.id')
            ->where('doctor_clinic_schedule_time_slots.user_id', Auth::user()->id)
            ->orderBy('doctor_clinic_schedule_time_slots.id','desc')
            ->select('doctor_clinic_schedule_time_slots.*','follow_up_e_prescriptions.e_prescription_id')
            ->get();

        $product_order_info = Order::where('order_type','product')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $labtest_order_info = Order::where('order_type','lab')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

        $count_service_order = $service_order_info->count();
        $count_appointment_clinic_doctor = $appointment_clinic_doctor_order_info->count();
        $count_product_order = $product_order_info->count();
        $count_labtest_order_info = $labtest_order_info->count();

        if($service_order_info)
        {
            $success['count_service_order'] =  $count_service_order;
            $success['count_appointment_clinic_doctor'] =  $count_appointment_clinic_doctor;
            $success['count_product_order'] =  $count_product_order;
            $success['count_labtest_order_info'] =  $count_labtest_order_info;

            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Question Found!'], $this->failStatus);
        }
    }
    public function serviceOrderList()
    {
        $service_order_info = Order::where('order_type','service')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

        if($service_order_info){
            return response()->json(['success'=>true,'response' => $service_order_info], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Service Order List Found!'], $this->failStatus);
        }
    }

    public function serviceOrderCancelList()
    {
        $service_order_cancel_info = Order::where('order_type','service')->where('delivery_status','Canceled')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

        if($service_order_cancel_info){
            return response()->json(['success'=>true,'response' => $service_order_cancel_info], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Service Cancel Order List Found!'], $this->failStatus);
        }
    }

    public function serviceOrderDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_order_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        $service_order_detail_info = DB::table('order_service_details')
            ->where('order_id',$request->service_order_id)
            ->select('service_name','service_price','service_quantity','service_sub_total')
            ->get();

        if(count($service_order_detail_info) > 0){
            return response()->json(['success'=>true,'response' => $service_order_detail_info], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Service Order Detail Found!'], $this->failStatus);
        }
    }

    public function doctorAppoinmentOrder()
    {
        $user_appointment_infos = DB::table('users')
            ->join('doctor_clinic_schedule_time_slots','users.id','=','doctor_clinic_schedule_time_slots.user_id')
            ->leftJoin('follow_up_e_prescriptions','follow_up_e_prescriptions.slot_id','=','doctor_clinic_schedule_time_slots.id')
            ->where('doctor_clinic_schedule_time_slots.user_id', Auth::user()->id)
            //->select('doctor_clinic_schedule_time_slots.*','follow_up_e_prescriptions.e_prescription_id')
            ->select('doctor_clinic_schedule_time_slots.*','follow_up_e_prescriptions.e_prescription_id')
            ->get();

        $user_appointment_details = [];
        foreach($user_appointment_infos as $data){
            $doctor_user_info = DB::table('users')->where('id',$data->doctor_user_id)->first();
            $clinic_user_info = DB::table('users')->where('id',$data->clinic_user_id)->first();
            $clinic_address = DB::table('clinic_contacts')
                ->join('clinics', 'clinic_contacts.clinic_id','=','clinics.id')
                ->where('clinics.user_id',$data->clinic_user_id)
                ->pluck('clinic_contacts.address')
                ->first();

            $follow_up_e_prescriptions_infos = DB::table('follow_up_e_prescriptions')
                ->join('users','follow_up_e_prescriptions.doctor_user_id','=','users.id')
                ->join('doctors','doctors.user_id','=','users.id')
                ->join('e_prescriptions','follow_up_e_prescriptions.e_prescription_id','=','e_prescriptions.id')
                ->leftJoin('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
                ->leftJoin('follow_ups','follow_ups.d_c_s_t_slot_id','=','follow_up_e_prescriptions.slot_id')
                ->leftJoin('doctor_clinic_schedule_time_slots','doctor_clinic_schedule_time_slots.id','=','follow_up_e_prescriptions.slot_id')
                ->leftJoin('orders','doctor_clinic_schedule_time_slots.order_id','=','orders.id')
                ->where('follow_up_e_prescriptions.slot_id',$data->id)
                ->select('follow_up_e_prescriptions.user_id','follow_up_e_prescriptions.invoice','follow_up_e_prescriptions.date','e_prescriptions.prescription_info','follow_ups.follow_up_date','users.name','doctor_specialities.name as doctor_speciality_name','orders.grand_total')
                ->first();

            $follow_up_e_prescriptions = [];
            if($follow_up_e_prescriptions_infos){
                $follow_up_e_prescriptions['invoice'] = $follow_up_e_prescriptions_infos->invoice;
                $follow_up_e_prescriptions['user_id'] = $follow_up_e_prescriptions_infos->user_id;
                $follow_up_e_prescriptions['user_name'] = $follow_up_e_prescriptions_infos->name;
                $follow_up_e_prescriptions['date'] = $follow_up_e_prescriptions_infos->date;
                $follow_up_e_prescriptions['prescription_info'] = $follow_up_e_prescriptions_infos->prescription_info;
                $follow_up_e_prescriptions['follow_up_date'] = $follow_up_e_prescriptions_infos->follow_up_date;
                $follow_up_e_prescriptions['doctor_speciality_name'] = $follow_up_e_prescriptions_infos->doctor_speciality_name;
                $follow_up_e_prescriptions['grand_total'] = $follow_up_e_prescriptions_infos->grand_total;
            }else{
                $follow_up_e_prescriptions = (object)[];
            }

            $nested_data['doctor_clinic_schedule_time_slot_id'] = $data->id;
            $nested_data['doctor_user_id'] = $doctor_user_info->id;
            $nested_data['doctor_name'] = $doctor_user_info->name;
            $nested_data['clinic_user_id'] = $clinic_user_info->id;
            $nested_data['clinic_name'] = $clinic_user_info->name;
            $nested_data['clinic_address'] = $clinic_address ? $clinic_address : NULL;
            $nested_data['date'] = $data->date;
            $nested_data['time'] = $data->time;
            $nested_data['follow_up_e_prescriptions'] = $follow_up_e_prescriptions;

            array_push($user_appointment_details,$nested_data);

        }

        if($user_appointment_details){
            return response()->json(['success'=>true,'response' => $user_appointment_details], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Doctor Appointment Found!'], $this->failStatus);
        }
    }

    public function productOrderList()
    {
        $product_order_info = Order::where('order_type','product')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

        if($product_order_info){
            return response()->json(['success'=>true,'response' => $product_order_info], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Question Found!'], $this->failStatus);
        }
    }

    public function productOrderCancelList()
    {
        $product_order_info = Order::where('order_type','product')->where('delivery_status','Canceled')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

        if($product_order_info){
            return response()->json(['success'=>true,'response' => $product_order_info], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Question Found!'], $this->failStatus);
        }
    }

    public function productOrderDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_order_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        $product_order_detail_info = DB::table('order_details')
            ->where('order_id',$request->product_order_id)
            ->select('product_name','product_price','product_quantity')
            ->get();

        if(count($product_order_detail_info) > 0){
            return response()->json(['success'=>true,'response' => $product_order_detail_info], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Product Order Detail Found!'], $this->failStatus);
        }
    }
    public function labtestOrder()
    {
        $labtest_order_info = Order::where('order_type','lab')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

        if($labtest_order_info){
            return response()->json(['success'=>true,'response' => $labtest_order_info], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Question Found!'], $this->failStatus);
        }
    }

    public function labtestCancelOrder()
    {
        $labtest_order_info = Order::where('order_type','lab')->where('delivery_status','Canceled')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

        if($labtest_order_info){
            return response()->json(['success'=>true,'response' => $labtest_order_info], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Question Found!'], $this->failStatus);
        }
    }

    public function cancelOrder(Request $request)
    {
        $order = Order::find($request->order_id);
        if ($order->delivery_status=="Pending"){
            $order->delivery_status="Canceled";
            $order->update();
            $affectedRows = $order->id;
            if($affectedRows){
                return response()->json(['success'=>true,'response' => $order], $this-> successStatus);
            }
        }

        return response()->json(['success'=>false,'response'=>'Something Went Wrong'], $this->failStatus);
    }

    public function labtestOrderDetails(Request $request)
    {
        $labtest_order_detail_info = DB::table('order_lab_details')
            ->join('users','order_lab_details.lab_id','=','users.id')
            ->where('order_lab_details.order_id',$request->labtest_order_id)
            ->select('order_lab_details.test_name','order_lab_details.test_price','order_lab_details.test_quantity','order_lab_details.delivery_type','users.name as lab_name')
            ->get();

        if(count($labtest_order_detail_info) > 0){
            return response()->json(['success'=>true,'response' => $labtest_order_detail_info], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Lab Test Detail Found!'], $this->failStatus);
        }
    }
    public function userClinicDoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        //dd( $request->id);
        $user_appointment_infos = DB::table('users')
            ->join('doctor_clinic_schedule_time_slots','users.id','=','doctor_clinic_schedule_time_slots.user_id')
            ->leftJoin('follow_up_e_prescriptions','follow_up_e_prescriptions.slot_id','=','doctor_clinic_schedule_time_slots.id')
            ->where('doctor_clinic_schedule_time_slots.user_id', $request->id)
            ->select('doctor_clinic_schedule_time_slots.doctor_user_id')
            ->get();

        //dd($user_appointment_infos);

        if($user_appointment_infos){
            return response()->json(['success'=>true,'response' => $user_appointment_infos], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Question Found!'], $this->failStatus);
        }


    }

    public function changedPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword)) {
                $user = \App\User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                return response()->json(['success'=>true,'response' => 'Password Updated Successfully'], $this-> successStatus);
            } else {
                return response()->json(['success'=>false,'response'=>'New password cannot be the same as old password.'], $this->failStatus);
            }
        } else {
            return response()->json(['success'=>false,'response'=>'Current password not match.'], $this->failStatus);
        }

    }

    public function healthTips()
    {
        $healthTipsCategory = HealthTipsCategory::all();

        $healthTipsCategoryarr = [];
        foreach ($healthTipsCategory as $data){
            $health_tips = DB::table('health_tips')
                ->where('health_tips_category_id', $data->id)
                //->select([DB::raw("count(id) as total_row_count")])
                ->get();

            $nestedData['name'] = $data->name;
            $nestedData['count'] = count($health_tips);

            array_push($healthTipsCategoryarr,$nestedData);

        }

        $recentHealthTips = DB::table('health_tips')
            ->join('health_tips_categories','health_tips.health_tips_category_id','=','health_tips_categories.id')
            ->join('doctors','health_tips.doctor_id','=','doctors.id')
            ->join('users','doctors.user_id','=','users.id')
            ->select('health_tips.*','health_tips_categories.name as health_tips_category_name','users.name as doctor_name')
            ->get();

        $allHealthTips = DB::table('health_tips')
            ->join('health_tips_categories','health_tips.health_tips_category_id','=','health_tips_categories.id')
            ->join('doctors','health_tips.doctor_id','=','doctors.id')
            ->join('users','doctors.user_id','=','users.id')
            ->select('health_tips.*','health_tips_categories.name as health_tips_category_name','users.name as doctor_name')
            ->latest()->take(4)->get();
        if($recentHealthTips){
            $success['healthTipsCategory'] = $healthTipsCategoryarr;
            $success['allHealthTips'] = $allHealthTips;
            $success['recentHealthTips'] = $recentHealthTips;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Health Tips Found!'], $this->failStatus);
        }
    }

    public function nearestServiceProviderList(Request $request){
        $validator = Validator::make($request->all(), [
            'service_category_id' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }


        $service_category_id = $request->service_category_id;
        $lat = $request->lat;
        $lng = $request->lng;

        $serviceProviders = DB::table('service_providers')
            ->select('service_providers.id','users.name','users.slug','service_provider_contacts.address','service_provider_contacts.lat','service_provider_contacts.lng','service_provider_reviews.star')
            ->join('users','service_providers.user_id','=','users.id')
            ->leftJoin('service_provider_contacts','service_providers.id','=','service_provider_contacts.service_provider_id')
            ->leftJoin('service_provider_reviews','service_providers.id','=','service_provider_reviews.service_provider_id')
            ->where('service_providers.service_category_id',$service_category_id)
            ->whereBetween('service_provider_contacts.lat',[$lat-0.1,$lat+0.1])
            ->whereBetween('service_provider_contacts.lng',[$lng-0.1,$lng+0.1])
            ->where('users.active_inactive_status',1)
            ->get();

        if(count($serviceProviders) > 0){
            return response()->json(['success'=>true,'response' => $serviceProviders], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Service Provider Found!'], $this->failStatus);
        }
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        $name = $request->name;

        $doctor = DB::table('users')
            ->join('doctors','doctors.user_id','=','users.id')
            ->join('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
            ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name')
            ->where('users.name', 'LIKE', '%'. $name. '%')
            ->where('users.role_id',2)
            ->where('users.active_inactive_status',1)
            ->get();

        if(count($doctor) > 0){
            $success['doctor_data'] = $doctor;
        }else{
            $success['doctor_data'] = [];
        }

        //$hospital = User::where('name', 'LIKE', '%'. $name. '%')->where('role_id',3)->get();

        $hospital = DB::table('users')
            ->leftJoin('clinics','users.id','=','clinics.user_id')
            ->leftJoin('clinic_contacts','clinics.id','=','clinic_contacts.clinic_id')
            ->leftJoin('clinic_categories','clinics.clinic_category_id','=','clinic_categories.id')
            ->where('users.name', 'LIKE', '%'. $name. '%')
            ->select('users.id as user_id','users.name','users.slug','users.image','clinics.id as clinic_user_id','clinics.rating','clinics.emergency_phone','clinic_contacts.address','clinic_contacts.lat','clinic_contacts.lng','clinic_categories.name as clinic_category_name')
            ->get();

        if(count($hospital) > 0){
            $success['hospital_data'] = $hospital;
        }else{
            $success['hospital_data'] = [];
        }

        $product = Product::where('name', 'LIKE', '%'. $name. '%')->get();
        if(count($product) > 0){
            $success['product_data'] = $product;
        }else{
            $success['product_data'] = [];
        }

        $service = DB::table('services')
            ->where('services.name', 'LIKE', '%'. $name. '%')->get();

        if(count($service) > 0){
            $success['service_data'] = $service;
        }else{
            $success['service_data'] = [];
        }

        $test = Test::where('name', 'LIKE', '%'. $name. '%')->limit(5)->get();
        if(count($test) > 0){
            $success['test_data'] = $test;
        }else{
            $success['test_data'] = [];
        }

        return response()->json(['success'=>true,'response' => $success], $this-> successStatus);

    }

    public function serviceOrderPlace(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'billing_name' => 'required',
            'house' => 'required',
            'area' => 'required',
            'billing_phone' => 'required',
            'payment_type' => 'required',
            'service_date' => 'required',
            'service_time' => 'required',
            'vendor_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }
//return $request->cart;
        //return response()->json(['success'=>true,'response' => true, 'cart' => $request->cart], $this-> successStatus);

        $data['name'] = $request->billing_name;
        $data['phone'] = $request->billing_phone;
        $data['house'] = $request->house;
        $data['road'] = $request->road;
        $data['block'] = $request->block;
        $data['sector'] = $request->sector;
        $data['area'] = $request->area;
        $data['details'] = $request->notes;
        $data['service_date'] = $request->service_date;
        $data['service_time'] = $request->service_time;
        $shipping_info = json_encode($data);

//        if (session()->has('coupon')){
//            $discount=session()->get('coupon')['discount'];
//        }else{
//            $discount=0;
//        }
        //dd(Cart::total());

        //dd(Cart::subtotal());
        if($request->payment_type == 'cod'){
            $payment_status = 'Due';
        }
        if($request->payment_type == 'ssl'){
            $payment_status = 'Paid';
        }

        $order = new Order();
        $order->invoice_code = date('Ymd-his');
        $order->service_provider_id = $request->vendor_id;
        $order->service_provider_permission = 0;
        $order->order_type = "service";
        $order->user_id = $request->user_id;
        $order->shipping_address = $shipping_info;
        $order->payment_type = $request->payment_type;
        $order->payment_status = $payment_status;
        $order->discount = $request->discount;
        //$order->grand_total = Cart::total();
        //$order->grand_total = Cart::total()-$discount;
        $order->grand_total = $request->grand_total;
        $order->delivery_cost = 0;
        $order->delivery_status = "Pending";
        $order->view = 0;
        //dd($order);
        //dd($order->grand_total = Cart::total()-$discount);
        $order->save();

//
//        foreach ($request->cart as $content) {
//            //return response()->json(['success'=>true,'response' => true, 'tes' => 'sss'], $this-> successStatus);
//
//            $orderServiceDetails = new OrderServiceDetail();
//            $orderServiceDetails->order_id = $order->id;
//            $orderServiceDetails->service_id = $content['service_id'];
//            $orderServiceDetails->service_name = $content['service_name'];
//            $orderServiceDetails->service_price = $content['service_price'];
//            $orderServiceDetails->service_quantity = $content['service_quantity'];
//            $orderServiceDetails->service_sub_total = $content['service_price']*$content['service_quantity'];
//            $orderServiceDetails->save();
//        }

        $pd = json_decode($request->cart,true);
        foreach ($pd as $key => $content) {
            $orderServiceDetails = new OrderServiceDetail();
            $orderServiceDetails->order_id = $order->id;
            $orderServiceDetails->service_id = $content['service_id'];
            $orderServiceDetails->service_name = $content['service_name'];
            $orderServiceDetails->service_price = $content['service_price'];
            $orderServiceDetails->service_quantity = $content['service_quantity'];
            $orderServiceDetails->service_sub_total = $content['service_price']*$content['service_quantity'];
            $orderServiceDetails->save();
        }

        if ($request->payment_type == 'cod') {
            //Toastr::success('Order Successfully done! ');
            //Cart::destroy();
            //return redirect()->route('index');
            return response()->json(['success'=>true,'response' => true, 'order' => $order], $this->successStatus);
        }else {
            //Session::put('order_id',$order->id);
            //return redirect()->route('pay');
            return response()->json(['success'=>true,'response' => true, 'order_id' => $order->id], $this->successStatus);
        }
    }

    public function testLists()
    {
        $tests= Test::latest('created_at')->get();
        if(count($tests) > 0){
            return response()->json(['success'=>true,'response' => true, 'tests' => $tests], $this->successStatus);
        }else{
            return response()->json(['success'=>true,'response' => 'No Test List Found!'], $this->failStatus);
        }
    }

    public function labTestLists(Request $request)
    {
        $lab_tests=DB::table('lab_tests')
            ->leftJoin('users','lab_tests.clinic_or_lab_user_id','=','users.id')
            ->leftJoin('clinics','clinics.user_id','=','users.id')
            ->leftJoin('clinic_contacts','clinic_contacts.clinic_id','=','clinics.id')
            ->leftJoin('tests','lab_tests.test_id','=','tests.id')
            ->where('test_id',$request->test_id)
            ->select(
                'lab_tests.id',
                'lab_tests.clinic_or_lab_user_id',
                'users.name as lab_name',
                'users.name as lab_name',
                'users.image as lab_image',
                'clinic_contacts.address as lab_address',
                'clinic_contacts.lat as lab_lat',
                'clinic_contacts.lng as lab_lng',
                'lab_tests.test_id',
                'tests.name as test_name',
                'tests.image as test_image',
                'lab_tests.lab_test_regular_price',
                'lab_tests.lab_test_price'
            )
            ->get();
        if(count($lab_tests) > 0){
            return response()->json(['success'=>true,'response' => true, 'tests' => $lab_tests], $this->successStatus);
        }else{
            return response()->json(['success'=>true,'response' => 'No Lab Test List Found!'], $this->failStatus);
        }
    }

    public function doctorBookingStore(Request  $request){

        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'payment_type' => 'required',
        ]);
        if($request->payment_type == 'cod'){
            $payment_status = 'Due';
        }
        if($request->payment_type == 'ssl'){
            $payment_status = 'Paid';
        }

        $check_appointment_exists = DoctorClinicScheduleTimeSlot::where('id',$request->slot_id)->pluck('user_id')->first();
        if (!empty($check_appointment_exists)){
            $response = [
                'success' => false,
                'data' => 'Check Appointment Exists OR Not.',
                'message' => 'This Slot already Appointed'
            ];
            return response()->json($response, $this-> validationStatus);
        }
        $ds_slot= DoctorClinicScheduleTimeSlot::find($request->slot_id);
        if (empty($ds_slot)){
            $response = [
                'success' => false,
                'data' => 'Check Slot Exists OR Not.',
                'message' => 'Slot Not Found, using this Slot ID!'
            ];
            return response()->json($response, $this-> validationStatus);
        }

        $clinic_user=User::find($ds_slot->clinic_user_id);
        $clinic=Clinic::where('user_id',$clinic_user->id)->first();
        $dc_user=User::find($ds_slot->doctor_user_id);
        $dc=Doctor::where('user_id',$dc_user->id)->first();

        $clinicDoctor=ClinicDoctor::where('clinic_id',$clinic->id)->where('doctor_id',$dc->id)->first();
        $visit_cost = 0;
        if($clinicDoctor){
            $visit_cost = $clinicDoctor->visit_cost;
        }

        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $shipping_info = json_encode($data);

        $order = new Order();
        $order->invoice_code = date('Ymd-his');
        $order->order_type = "clinic_schedule";
        $order->user_id = Auth::user()->id;
        $order->shipping_address = $shipping_info;
        $order->payment_type = $request->payment_type;
        $order->payment_status = $payment_status;
        //$order->discount = $discount;
        //$order->grand_total = Cart::total();
        $order->grand_total = $visit_cost;
        $order->delivery_cost = 0;
        $order->delivery_status = "Pending";
        $order->view = 0;
        //dd($order->grand_total = Cart::total()-$discount);
        $order->save();

        $cl_sch=DoctorClinicScheduleTimeSlot::find($request->slot_id);
        $cl_sch->user_id=Auth::id();
        $cl_sch->order_id=$order->id;
        $cl_sch->update();

        //dd($slot_id);



        //return redirect()->route('doctor.booking.success.message',$slot_id);
        if ($request->payment_type == 'cod') {
            //Toastr::success('Order Successfully done! ');
            //Cart::destroy();
            //return redirect()->route('index');
            return response()->json(['success'=>true,'response' => true, 'order' => $order], $this-> successStatus);
        }else {
            //Session::put('order_id',$order->id);
            //return redirect()->route('pay');
            return response()->json(['success'=>true,'response' => true, 'order_id' => $order->id], $this-> successStatus);
        }
    }
    public function test_order(Request $request)
    {
        if($request->pay == 'cod'){
            $payment_status = 'Due';
        }
        if($request->pay == 'ssl'){
            $payment_status = 'Paid';
        }

        $this->validate($request,[
            'first_name' => 'required',
            'address' => 'required',
            'pay' => 'required',
        ]);

        //dd($request->all());
        $data['name'] = $request->first_name.' '.$request->last_name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['details'] = $request->note;
        $shipping_info = json_encode($data);

        $order = new Order();
        $order->invoice_code = date('Ymd-his');
        $order->user_id = Auth::user()->id;
        $order->shipping_address = $shipping_info;
        $order->payment_type = $request->pay;
        $order->payment_status = $payment_status;
        $order->grand_total = $request->total;
        $order->delivery_cost = 0;
        $order->delivery_status = "Pending";
        $order->view = 0;
        $order->order_type = "lab";
        $order->save();

        $pd = json_decode($request->cart,true);
        foreach ($pd as $key => $content) {
            $orderDetails = new OrderLabDetails();
            $orderDetails->order_id = $order->id;
            $orderDetails->test_id = $content['id'];
            $orderDetails->test_name = $content['name'];
            $orderDetails->test_price = $content['price'];
            $orderDetails->test_quantity = $content['qty'];
            $orderDetails->lab_id = $content['lab_id'];
            $orderDetails->delivery_type = $content['delivery_type'];
            $orderDetails->save();
        }

        if ($request->pay == 'cod') {
            //Toastr::success('Order Successfully done! ');
            //Cart::destroy();
            //return redirect()->route('index');
            return response()->json(['success'=>true,'response' => true, 'order' => $order], $this-> successStatus);
        }else {
            //Session::put('order_id',$order->id);
            //return redirect()->route('pay');
            return response()->json(['success'=>true,'response' => true, 'order_id' => $order->id], $this-> successStatus);
        }
//        return view('frontend.pages.checkout');
    }
    public function doctorBookingFindSlot(Request $request){

        //dd($request->all());

        $doctorSchedule=DoctorClinicSchedule::where('doctor_user_id',$request->doctor_user_id)->where('clinic_user_id',$request->clinic_id)->where('date',$request->date)->get();
        //dd($doctorSchedule);
        $slot=[];
        foreach($doctorSchedule as $ds){
            $ds_slot=\App\DoctorClinicScheduleTimeSlot::where('d_c_schedule_id',$ds->id)->get();
            array_push($slot,$ds_slot);
        }
        return response()->json(['success'=>true,'response'=>$slot], $this-> successStatus);

    }

}
