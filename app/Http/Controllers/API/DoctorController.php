<?php

namespace App\Http\Controllers\API;

use App\ClinicDoctor;
use App\Day;
use App\Doctor;
use App\DoctorAward;
use App\DoctorClinicSchedule;
use App\DoctorClinicScheduleTimeSlot;
use App\DoctorContact;
use App\DoctorEducation;
use App\DoctorExperience;
use App\DoctorSpeciality;
use App\DoctorSpecialityDoctor;
use App\Http\Controllers\Controller;
use App\Http\Middleware\User;
use App\QuestionAnswer;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Validator;
use DateTime;

class DoctorController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 401;
    public $validationStatus = 404;


    public function doctorSpecialityList()
    {
        $doctor_specialities = DB::table('doctor_specialities')->get();

        if($doctor_specialities)
        {
            $success['doctor_specialities'] =  $doctor_specialities;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Doctor Speciality List Found!'], $this->failStatus);
        }
    }

    public function doctorClinicList()
    {
        $clinic_doctors = DB::table('clinic_doctors')
            ->join('clinics','clinic_doctors.clinic_id','clinics.id')
            ->join('users','clinics.user_id','users.id')
            ->select('clinic_doctors.*','users.name as clinic_name')
            ->get();

        if($clinic_doctors)
        {
            $success['clinic_doctors'] =  $clinic_doctors;
            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Clinic Doctor List Found!'], $this->failStatus);
        }
    }

    public function doctorByClinicList(Request $request)
    {
        $doctor_info = Doctor::find($request->doctor_user_id);
        if($doctor_info){
            $clinic_doctors = DB::table('clinic_doctors')
                ->join('clinics','clinic_doctors.clinic_id','clinics.id')
                ->join('users','clinics.user_id','users.id')
                ->where('clinic_doctors.doctor_id',$doctor_info->id)
                ->select('clinic_doctors.*','users.id as clinic_user_id','users.name as clinic_name')
                ->get();

            $clinic_doctor_arr = [];
            foreach ($clinic_doctors as $data){
                $nested_data['clinic_user_id'] = $data->clinic_user_id;
                $nested_data['clinic_id'] = $data->clinic_id;
                $nested_data['clinic_name'] = $data->clinic_name;
                //$nested_data['doctor_id'] = $data->doctor_id;
                $nested_data['main_clinic_status'] = $data->main_clinic_status;
                $nested_data['visit_cost'] = $data->visit_cost;

                array_push($clinic_doctor_arr, $nested_data);
            }

            if($clinic_doctor_arr)
            {
                $success['clinic_doctors'] =  $clinic_doctor_arr;
                return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Clinic Doctor List Found!'], $this->failStatus);
            }
        }else{
            return response()->json(['success'=>false,'response'=>'No Doctor Found!'], $this->failStatus);
        }
    }

    public function doctorProfileInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this-> validationStatus);
        }

        $doctor_basic = DB::table('users')
            ->where('id',$request->doctor_user_id)
            ->select('id','name','phone','email','gender','image')
            ->first();

        $doctor_details = DB::table('doctors')
            ->leftJoin('doctor_specialities','doctors.doctor_speciality_id','doctor_specialities.id')
            ->where('doctors.user_id',$request->doctor_user_id)
            ->select('doctors.id as doctor_id','doctors.title','doctors.is_active','doctors.is_online','doctors.has_permission','doctors.has_clinic','doctors.has_home_service','doctors.is_on_demand','doctors.home_cost','doctors.Bmdc_number','doctors.personal_statement','doctors.language','doctor_specialities.id as doctor_speciality_id','doctor_specialities.name as doctor_speciality_name')
            ->first();

        if($doctor_basic)
        {
            $success['doctor_basic'] =  $doctor_basic;
            $success['doctor_details'] =  $doctor_details;

            if($doctor_details){
                $doctor_contacts = DB::table('doctor_contacts')
                    ->leftJoin('division_districts','doctor_contacts.division_district_id','division_districts.id')
                    ->where('doctor_contacts.doctor_id',$doctor_details->doctor_id)
                    ->select('doctor_contacts.id as doctor_contact_id','doctor_contacts.address','doctor_contacts.lat','doctor_contacts.lng','doctor_contacts.city','doctor_contacts.state_or_province','division_districts.id as division_district_id','division_districts.name as division_district_name')
                    ->first();

                $clinic_doctors = DB::table('clinic_doctors')
                    ->leftJoin('clinics','clinic_doctors.clinic_id','clinics.id')
                    ->leftJoin('users','clinics.user_id','users.id')
                    ->where('clinic_doctors.doctor_id',$doctor_details->doctor_id)
                    ->select('clinic_doctors.id as clinic_doctor_id','clinic_doctors.main_clinic_status','clinic_doctors.visit_cost','clinics.id as clinic_id','users.name as clinic_name')
                    ->get();


                $doctor_educations = DB::table('doctor_educations')
                    ->where('doctor_id',$doctor_details->doctor_id)
                    ->select('id as doctor_education_id','degree','institute','year_of_completion')
                    ->get();

                $doctor_experiences = DB::table('doctor_experiences')
                    ->where('doctor_id',$doctor_details->doctor_id)
                    ->select('id as doctor_experience_id','hospital_name','from','to','designation')
                    ->get();

                $doctor_awards = DB::table('doctor_awards')
                    ->where('doctor_id',$doctor_details->doctor_id)
                    ->select('id as doctor_award_id','award','year')
                    ->get();

                $doctor_speciality_doctors = DB::table('doctor_speciality_doctors')
                    ->leftJoin('doctor_specialities','doctor_speciality_doctors.doctor_speciality_id','doctor_specialities.id')
                    ->where('doctor_speciality_doctors.doctor_id',$request->doctor_user_id)
                    ->select('doctor_speciality_doctors.id as doctor_speciality_doctor_id','doctor_speciality_doctors.main_specialist_status','doctor_specialities.id as doctor_speciality_id','doctor_specialities.name as doctor_speciality_name')
                    ->get();

                $success['doctor_contacts'] =  $doctor_contacts;
                $success['clinic_doctors'] =  $clinic_doctors;
                $success['doctor_educations'] =  $doctor_educations;
                $success['doctor_experiences'] =  $doctor_experiences;
                $success['doctor_awards'] =  $doctor_awards;
                $success['doctor_speciality_doctors'] =  $doctor_speciality_doctors;
            }

            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Doctor Found!'], $this->failStatus);
        }
    }

    public function doctorPatientInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this-> validationStatus);
        }

        $total_user_appointment = DB::table('users')
            ->join('doctor_clinic_schedule_time_slots','users.id','=','doctor_clinic_schedule_time_slots.user_id')
            ->where('doctor_clinic_schedule_time_slots.doctor_user_id', $request->doctor_user_id)
            ->select('users.id','users.name','users.slug','users.phone')
            ->groupBy('users.id','users.name','users.slug','users.phone')
            ->get();


        $total_user_appointment_info = [];
        foreach($total_user_appointment as $data){

            $user_info = DB::table('users')->where('id',$data->id)->first();


            $nested_data['id'] = $data->id;
            $nested_data['name'] = $data->name;
            $nested_data['slug'] = $data->slug;
            $nested_data['phone'] = $data->phone;
            $nested_data['gender'] = $user_info->gender;
            $nested_data['blood_group'] = $user_info->blood_group;
            $nested_data['image'] = $user_info->image;

            array_push($total_user_appointment_info,$nested_data);
        }

        $today_user_appointment = DB::table('users')
            ->join('doctor_clinic_schedule_time_slots','users.id','=','doctor_clinic_schedule_time_slots.user_id')
            ->where('doctor_clinic_schedule_time_slots.doctor_user_id', $request->doctor_user_id)
            ->where('doctor_clinic_schedule_time_slots.date', '=', date('d-m-Y'))
            ->select('users.id','users.name','users.slug','users.phone')
            ->groupBy('users.id','users.name','users.slug','users.phone')
            ->get();

        $today_user_appointment_info = [];
        foreach($today_user_appointment as $data){

            $user_info = DB::table('users')->where('id',$data->id)->first();


            $nested_data['id'] = $data->id;
            $nested_data['name'] = $data->name;
            $nested_data['slug'] = $data->slug;
            $nested_data['phone'] = $data->phone;
            $nested_data['gender'] = $user_info->gender;
            $nested_data['blood_group'] = $user_info->blood_group;
            $nested_data['image'] = $user_info->image;

            array_push($today_user_appointment_info,$nested_data);
        }

        if($total_user_appointment){

            $success['total_patients'] =  $total_user_appointment_info;
            $success['today_patients'] =  $today_user_appointment_info;

            return response()->json(['success'=>true,'response' => $success], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Patients Found!'], $this->failStatus);
        }

    }

    public function doctorBasicUpdate(Request $request){
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

    public function doctorProfileImageUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required',
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

        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //delete old image.....
            if(Storage::disk('public')->exists('uploads/profile_pic/doctor/'.$user->image))
            {
                Storage::disk('public')->delete('uploads/profile_pic/doctor/'.$user->image);
            }

//            resize image for hospital and upload
            $proImage = Image::make($image)->resize(100, 100)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/profile_pic/doctor/'. $imagename, $proImage);

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

    public function doctorDetailsInsert(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'doctor_speciality_id' => 'required',
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this-> validationStatus);
        }


        $doctor = new Doctor();
        $doctor->user_id = $request->user_id;
        $doctor->doctor_speciality_id = $request->doctor_speciality_id;
        $doctor->title = $request->title;
        $doctor->slug = Str::slug($request->title);
        $doctor->is_active = $request->is_active;
        $doctor->is_online = $request->is_online;
        $doctor->has_permission = $request->has_permission;
        $doctor->has_clinic = $request->has_clinic;
        $doctor->has_home_service = $request->has_home_service;
        $doctor->is_on_demand = $request->is_on_demand;
        $doctor->home_cost = $request->home_cost;
        $doctor->Bmdc_number = $request->Bmdc_number;
        $doctor->personal_statement = $request->personal_statement;
        $doctor->language = $request->language;
        $doctor->save();
        $insert_id = $doctor->id;
        if($insert_id){
            return response()->json(['success'=>true,'response' => $doctor], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Inserted!'], $this->failStatus);
        }

    }

    public function doctorDetailsUpdate(Request $request){

        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'doctor_speciality_id' => 'required',
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this-> validationStatus);
        }

        $doctor_id = $request->doctor_id;
        $doctor = Doctor::find($doctor_id);
        $doctor->user_id = $request->user_id;
        $doctor->doctor_speciality_id = $request->doctor_speciality_id;
        $doctor->title = $request->title;
        $doctor->slug = Str::slug($request->title);
        $doctor->is_active = $request->is_active;
        $doctor->is_online = $request->is_online;
        $doctor->has_permission = $request->has_permission;
        $doctor->has_clinic = $request->has_clinic;
        $doctor->has_home_service = $request->has_home_service;
        $doctor->is_on_demand = $request->is_on_demand;
        $doctor->home_cost = $request->home_cost;
        $doctor->Bmdc_number = $request->Bmdc_number;
        $doctor->personal_statement = $request->personal_statement;
        $doctor->language = $request->language;
        $affectedRow = $doctor->update();
        if($affectedRow){
            return response()->json(['success'=>true,'response' => $doctor], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }
    }

    public function doctorContactInsert(Request $request){

        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
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
            return response()->json($response, $this-> validationStatus);
        }

        $check_doctor_contact = DoctorContact::where('doctor_id',$request->doctor_id)->first();
        if($check_doctor_contact){
            return response()->json(['success'=>false,'response'=>'Doctor Contact Already Exists!'], $this->failStatus);
        }else{
            $doctor_contact = new DoctorContact();
            $doctor_contact->doctor_id = $request->doctor_id;
            $doctor_contact->division_district_id = $request->division_district_id;
            $doctor_contact->address = $request->address;
            $doctor_contact->city = $request->city;
            $doctor_contact->state_or_province = $request->area;
            $doctor_contact->lat = $request->latitude;
            $doctor_contact->lng = $request->longitude;
            $doctor_contact->postal_code = $request->postcode;
            $doctor_contact->save();
            $insert_id = $doctor_contact->id;

            if($insert_id){
                return response()->json(['success'=>true,'response' => $doctor_contact], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Inserted!'], $this->failStatus);
            }
        }
    }

    public function doctorContactUpdate(Request $request){

        $doctor_contact_id = $request->doctor_contact_id;
        $doctor_contact = DoctorContact::find($doctor_contact_id);

        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
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
            return response()->json($response, $this-> validationStatus);
        }

        $doctor_contact->doctor_id = $request->doctor_id;
        $doctor_contact->division_district_id = $request->division_district_id;
        $doctor_contact->address = $request->address;
        $doctor_contact->city = $request->city;
        $doctor_contact->state_or_province = $request->area;
        $doctor_contact->lat = $request->latitude;
        $doctor_contact->lng = $request->longitude;
        $doctor_contact->postal_code = $request->postcode;
        $affectedRow = $doctor_contact->update();
        if($affectedRow){
            return response()->json(['success'=>true,'response' => $doctor_contact], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }

    }

    public function doctorClinicInsert(Request $request){

        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'clinic_id' => 'required',
            'visit_cost' => 'required',
            'main_clinic_status' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this-> validationStatus);
        }

        $check_doctor_main_clinic = ClinicDoctor::where('doctor_id',$request->doctor_id)->where('main_clinic_status',1)->first();
        $check_clinic_exists = ClinicDoctor::where('doctor_id',$request->doctor_id)->where('clinic_id',$request->clinic_id)->pluck('id')->first();
        if($check_clinic_exists){
            return response()->json(['success'=>false,'response'=>'Doctor Clinic Already Exists!'], $this->failStatus);
        }elseif($check_doctor_main_clinic && $request->main_clinic_status == 1){
            return response()->json(['success'=>false,'response'=>'Doctor Main Clinic Already Exists, Please select other clinic status!'], $this->failStatus);
        }else{
            $doctor_clinic = new ClinicDoctor();
            $doctor_clinic->doctor_id = $request->doctor_id;
            $doctor_clinic->clinic_id = $request->clinic_id;
            $doctor_clinic->visit_cost = $request->visit_cost;
            $doctor_clinic->main_clinic_status = $request->main_clinic_status;
            $doctor_clinic->save();
            $insert_id = $doctor_clinic->id;

            if($insert_id){
                return response()->json(['success'=>true,'response' => $doctor_clinic], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Inserted!'], $this->failStatus);
            }
        }
    }



    public function doctorClinicInsert1(Request $request){

//        $validator = Validator::make($request->all(), [
//            'doctor_id' => 'required',
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
        //return response()->json(['success'=>true,'response'=>$request->doctor_id], $this->successStatus);

        // apps team return the code
        //"cart":"[{\"products_id\":\"87\",\"products_name\":\"Three Pin Round Socket\",\"price\":545,\"final_price\":1090,\"customers_basket_quantity\":2}]"
        //cart:[{"products_id":"220","products_name":"Dry Surma Fish","price":"90.0","final_price":"90.0","customers_basket_quantity":"1"}]
        //clinics:[{"clinic_id":"1","visit_cost":"500","main_clinic_status":"1"},{"clinic_id":"2","visit_cost":"600","main_clinic_status":"0"}]


        // static check
//        $clinics = [
//            0 => [
//                "clinic_id"=>"1",
//                "visit_cost"=>"500",
//                "main_clinic_status"=>"1",
//            ],
//            1 => [
//                "clinic_id"=>"2",
//                "visit_cost"=>"600",
//                "main_clinic_status"=>"0",
//            ]
//        ];


        // check main more than one
//        $initial_count = 0;
//        foreach ($clinics as $clinic) {
//            if($clinic['main_clinic_status'] == 1){
//                $initial_count = $initial_count + 1;
//            }
//        }





        // dynamic check
//        $clinics = '[{"clinic_id":"1","visit_cost":"500","main_clinic_status":"1"},{"clinic_id":"2","visit_cost":"600","main_clinic_status":"0"}]';
        // OR
//        $clinics = $request->clinics;
//        //here is JSON object
//        $filters = json_decode($clinics);
//
//        foreach($filters as $obj){
//            $filter_id[] = $obj->clinic_id;
//        }
//
//        //here is your array from that JSON
//        $filter_id;
//        return response()->json(['success'=>false,'response'=>$filter_id], $this->failStatus);


        //return response()->json(['success'=>true,'response'=>$request->all()], $this->successStatus);
        // check main more than one
        $initial_count = 0;
        foreach ($request->clinics as $clinic) {
            if($clinic['main_clinic_status'] == 1){
                $initial_count = $initial_count + 1;
            }
        }

        if($initial_count > 1){
            return response()->json(['success'=>false,'response'=>'You can not more than one Main Clinic Status.'], $this->failStatus);
        }else{
            $flag = false;
            foreach ($request->clinics as $clinic) {
                $check_clinic_exists = ClinicDoctor::where('doctor_id',$request->doctor_id)->where('clinic_id',$clinic['clinic_id'])->pluck('id')->first();
                if($check_clinic_exists){
                    $flag = true;
                }else{
                    $doctor_clinic = new ClinicDoctor();
                    $doctor_clinic->doctor_id = $request->doctor_id;
                    $doctor_clinic->clinic_id = $clinic['clinic_id'];
                    $doctor_clinic->visit_cost = $clinic['visit_cost'];
                    $doctor_clinic->main_clinic_status = $clinic['main_clinic_status'];
                    $doctor_clinic->save();
                }
            }
            if($flag == true){
                return response()->json(['success'=>false,'response'=>'Clinic Already Exists.'], $this->failStatus);
            }else{
                return response()->json(['success'=>true,'response' => 'Successfully Inserted'], $this-> successStatus);
            }
        }


    }

    public function doctorClinicUpdate(Request $request){

        $validator = Validator::make($request->all(), [
            'doctor_clinic_id' => 'required',
            'doctor_id' => 'required',
            'clinic_id' => 'required',
            'visit_cost' => 'required',
            'main_clinic_status' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this-> validationStatus);
        }

        $doctor_clinic = ClinicDoctor::find($request->doctor_clinic_id);
        $doctor_clinic->doctor_id = $request->doctor_id;
        $doctor_clinic->clinic_id = $request->clinic_id;
        $doctor_clinic->visit_cost = $request->visit_cost;
        $doctor_clinic->main_clinic_status = $request->main_clinic_status;
        $affectedRow=$doctor_clinic->save();

        if($affectedRow){
            return response()->json(['success'=>true,'response' => $doctor_clinic], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }

    }

    public function doctorEducationInsertOrUpdate(Request $request)
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

        if($request->doctor_education_id){
            $doctor_education = DoctorEducation::find($request->doctor_education_id);
            $doctor_education->doctor_id = $request->doctor_id;
            $doctor_education->degree = $request->degree;
            $doctor_education->institute = $request->institute;
            $doctor_education->year_of_completion = $request->year_of_completion;
            $affectedRow = $doctor_education->save();
            if($affectedRow){
                return response()->json(['success'=>true,'response' => $doctor_education], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
            }
        }else{
            $doctor_education = new DoctorEducation();
            $doctor_education->doctor_id = $request->doctor_id;
            $doctor_education->degree = $request->degree;
            $doctor_education->institute = $request->institute;
            $doctor_education->year_of_completion = $request->year_of_completion;
            $insert_id = $doctor_education->save();
            if($insert_id){
                return response()->json(['success'=>true,'response' => $doctor_education], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Inserted!'], $this->failStatus);
            }
        }
    }

    public function doctorExperienceInsertOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hospital_name' => 'required',
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

        if($request->doctor_experience_id){
            $doctor_experience = DoctorExperience::find($request->doctor_experience_id);
            $doctor_experience->doctor_id = $request->doctor_id;
            $doctor_experience->hospital_name = $request->hospital_name;
            $doctor_experience->from = $request->from;
            $doctor_experience->to = $request->to;
            $doctor_experience->to = $request->to;
            $doctor_experience->designation = $request->designation;
            $doctor_experience->save();
            $affectedRow = $doctor_experience->save();
            if($affectedRow){
                return response()->json(['success'=>true,'response' => $doctor_experience], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
            }
        }else{
            $doctor_experience = new DoctorExperience();
            $doctor_experience->doctor_id = $request->doctor_id;
            $doctor_experience->hospital_name = $request->hospital_name;
            $doctor_experience->from = $request->from;
            $doctor_experience->to = $request->to;
            $doctor_experience->to = $request->to;
            $doctor_experience->designation = $request->designation;
            $insert_id = $doctor_experience->save();
            if($insert_id){
                return response()->json(['success'=>true,'response' => $doctor_experience], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Inserted!'], $this->failStatus);
            }
        }
    }

    public function doctorAwardInsertOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'award' => 'required',
            'year' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        if($request->doctor_award_id){
            $doctor_award = DoctorAward::find($request->doctor_award_id);
            $doctor_award->doctor_id = $request->doctor_id;
            $doctor_award->award = $request->award;
            $doctor_award->year = $request->year;
            $doctor_award->save();
            $affectedRow = $doctor_award->save();
            if($affectedRow){
                return response()->json(['success'=>true,'response' => $doctor_award], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
            }
        }else{
            $doctor_award = new DoctorAward();
            $doctor_award->doctor_id = $request->doctor_id;
            $doctor_award->award = $request->award;
            $doctor_award->year = $request->year;
            $insert_id = $doctor_award->save();
            if($insert_id){
                return response()->json(['success'=>true,'response' => $doctor_award], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Inserted!'], $this->failStatus);
            }
        }
    }

    public function doctorSpecialityInsertOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_speciality_id' => 'required',
            'main_specialist_status' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        if($request->doctor_speciality_doctor_id){
            $doctor_speciality = DoctorSpecialityDoctor::find($request->doctor_speciality_doctor_id);
            $doctor_speciality->doctor_id = $request->doctor_id;
            $doctor_speciality->doctor_speciality_id = $request->doctor_speciality_id;
            $doctor_speciality->main_specialist_status = $request->main_specialist_status;
            $affectedRow = $doctor_speciality->save();
            if($affectedRow){
                return response()->json(['success'=>true,'response' => $doctor_speciality], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
            }
        }else{
            $doctor_speciality = new DoctorSpecialityDoctor();
            $doctor_speciality->doctor_id = $request->doctor_id;
            $doctor_speciality->doctor_speciality_id = $request->doctor_speciality_id;
            $doctor_speciality->main_specialist_status = $request->main_specialist_status;
            $insert_id = $doctor_speciality->save();
            if($insert_id){
                return response()->json(['success'=>true,'response' => $doctor_speciality], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Inserted!'], $this->failStatus);
            }
        }
    }


    public function questionList(){
        $questions = DB::table('questions')
            ->join('doctors','questions.doctor_speciality_id','=','doctors.doctor_speciality_id')
            ->join('users','doctors.user_id','=','users.id')
            ->LeftJoin('question_answers','questions.id','=','question_answers.question_id')
            ->where('users.id', Auth::user()->id)
            ->where('questions.status',1)
            //->select('questions.*','question_answers.id as question_answer_id')
            ->select('questions.*','question_answers.answer_doctor_user_id','question_answers.answer','question_answers.date','question_answers.answer_by','users.name')
            ->get();


        if($questions){
            return response()->json(['success'=>true,'response' => $questions], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Question Found!'], $this->failStatus);
        }
    }

    public function questionAnswerStore(Request $request){
        $validator = Validator::make($request->all(), [
            'question_id' => 'required',
            'answer' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this-> validationStatus);
        }

        $check_already_question_ans_or_not = QuestionAnswer::where('question_id',$request->question_id)
            ->where('answer_doctor_user_id',Auth::user()->id)->first();


        if($check_already_question_ans_or_not){
            return response()->json(['success'=>true,'response' => 'Already Answered This Question!'], $this-> successStatus);
        }else{
            $answer_by = Auth::user()->role_id == 1 ? 'Admin' : 'Doctor';

            $question_answer = new QuestionAnswer();
            $question_answer->question_id = $request->question_id;
            $question_answer->answer_doctor_user_id = Auth::user()->id;
            $question_answer->answer = $request->answer;
            $question_answer->date = date('Y-m-d');
            $question_answer->answer_by = $answer_by;
            $question_answer->save();
            $insert_id = $question_answer->id;
            if($insert_id){
                return response()->json(['success'=>true,'response' => $question_answer], $this-> successStatus);
            }else{
                return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
            }
        }
    }

    public function patientList(){
        //dd(Auth::id());
        $user_appointment_info = DB::table('users')
            ->join('doctor_clinic_schedule_time_slots','users.id','=','doctor_clinic_schedule_time_slots.user_id')
            ->where('doctor_clinic_schedule_time_slots.doctor_user_id', Auth::user()->id)
            ->select('users.id','users.name','users.slug','users.phone')
            ->groupBy('users.id','users.name','users.slug','users.phone')
            ->get();
        //dd($user_appointment_info);

        $total_user_appointment_info = [];
        foreach($user_appointment_info as $data){

            $user_info = DB::table('users')->where('id',$data->id)->first();


            $nested_data['id'] = $data->id;
            $nested_data['name'] = $data->name;
            $nested_data['slug'] = $data->slug;
            $nested_data['phone'] = $data->phone;
            $nested_data['gender'] = $user_info->gender;
            $nested_data['blood_group'] = $user_info->blood_group;
            $nested_data['image'] = $user_info->image;

            array_push($total_user_appointment_info,$nested_data);
        }

        if($user_appointment_info){
            return response()->json(['success'=>true,'response' => $total_user_appointment_info], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Successfully Updated!'], $this->failStatus);
        }
    }

    public function dayList(){
        $days = Day::all();
        if($days){
            return response()->json(['success'=>true,'response' => $days], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>'No Day List Found!'], $this->failStatus);
        }

    }

    public function doctorClinicScheduleTimeSlot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_user_id' => 'required',
            'clinic_user_id' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, $this->validationStatus);
        }

        $doctorSchedule=DoctorClinicSchedule::where('doctor_user_id',$request->doctor_user_id)->where('clinic_user_id',$request->clinic_user_id)->where('date',$request->date)->get();
        //dd($doctorSchedule);
        $slot=[];
        foreach($doctorSchedule as $ds){
            $ds_slot['slot']=\App\DoctorClinicScheduleTimeSlot::where('d_c_schedule_id',$ds->id)->get();
            array_push($slot,$ds_slot);
        }

        if($slot){
            return response()->json(['success'=>true,'response' => $slot], $this-> successStatus);
        }else{
            return response()->json(['success'=>false,'response'=>$slot], $this->successStatus);
        }
    }

    function getTimeSlot($interval, $start, $end)
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $start_time = $start->format('H:i'); // Get time Format in Hour and minutes
        $end_time = $end->format('H:i');
        $i=0;
        $time[1]['status'] = "failed";
        while(strtotime($start_time) <= strtotime($end_time)){
            $start = $start_time;
            $end = date('H:i',strtotime('+'.$interval.' minutes',strtotime($start_time)));
            $start_time = date('H:i',strtotime('+'.$interval.' minutes',strtotime($start_time)));
            $i++;
            if(strtotime($start_time) <= strtotime($end_time)){
                $time[$i]['start'] = $start;
                $time[$i]['end'] = $end;
                $time[$i]['status'] = "success";
            }
        }
        return $time;
    }

    public function doctorClinicScheduleTimeSlotStore(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'timing_day_duration' => 'required',
//            'start_time' => 'required',
//            'end_time' => 'required',
//            'clinic_user_id' => 'required',
//            'interval_time' => 'required',
//            'day_id' => 'required',
//        ]);
//
//        if ($validator->fails()) {
//            $response = [
//                'success' => false,
//                'data' => 'Validation Error.',
//                'message' => $validator->errors()
//            ];
//            return response()->json($response, $this->validationStatus);
//        }
//return $request->all();
        if(true){
            $clinic_id=$request->clinic_user_id;
            $day_id=$request->day_id;
            $days=Day::find($day_id);
            $day=$days->slug;
            $type=$request->timing_day_duration;
            $interval=$request->interval_time;
            $date= date("d-m-Y");


            if($type=="this_day"){
//                $pd = json_decode($request->start_time,true);
//                $end_time = json_decode($request->end_time,true);

//                foreach ($request->start_time as $index=>$start){
                    $schedule=new DoctorClinicSchedule();
                    $schedule->day_id=$day_id;
                    $schedule->doctor_user_id=Auth::id();
                    $schedule->clinic_user_id=$clinic_id;
                    $schedule->date=$date;
                    $schedule->start_time=$request->start_time;
                    $schedule->end_time=$request->end_time;
                    $schedule->interval_time=$interval;

                    $start_time=$request->start_time;
                    $end_time=$request->end_time;
                    $slots = $this->getTimeSlot($interval, $start_time, $end_time);
                    if($slots[1]['status']=="failed"){
                        return response()->json(['success'=>false,'response'=>'Give Proper Time!'], $this->failStatus);
                    }else{
                        $schedule->save();
                        foreach ($slots as $slot){
                            $scheduleSlot=new DoctorClinicScheduleTimeSlot();
                            $scheduleSlot->d_c_schedule_id=$schedule->id;
                            $scheduleSlot->doctor_user_id=Auth::id();
                            $scheduleSlot->clinic_user_id=$clinic_id;
                            $scheduleSlot->date=$date;
                            $scheduleSlot->user_id=null;
                            $scheduleSlot->time=$slot['start'];
                            $scheduleSlot->save();
                        }
                    }

                return response()->json(['success'=>true,'response'=>'Successfully Inserted.'], $this->successStatus);
            }else{
                $timestamp = strtotime($date);
                $today=date('l', $timestamp);
                if($today==$days->name){
                    $future_date[0]=$date;
                    $future_date[1]=date("d-m-Y",strtotime('next '.$day));
                    $dt= $future_date[1];
                    for($q=2;$q<5;$q++){
                        $dt=date("d-m-Y",strtotime('next '.$day.' '.$dt));
                        $future_date[$q]=$dt;
                    }
                }else{
                    $future_date[0]=date("d-m-Y",strtotime('next '.$day));
                    $dt= $future_date[0];
                    for($q=1;$q<5;$q++){
                        $dt=date("d-m-Y",strtotime('next '.$day.' '.$dt));
                        $future_date[$q]=$dt;
                    }
                }
                foreach ($future_date as $fdate){

                        $schedule=new DoctorClinicSchedule();
                        $schedule->day_id=$day_id;
                        $schedule->doctor_user_id=Auth::id();
                        $schedule->clinic_user_id=$clinic_id;
                        $schedule->date=$fdate;
                        $schedule->start_time=$request->start_time;
                        $schedule->end_time=$request->end_time;
                        $schedule->interval_time=$interval;

                        $start_time=$request->start_time;;
                        $end_time=$request->end_time;
                        $slots = $this->getTimeSlot($interval, $start_time, $end_time);
                        if($slots[1]['status']=="failed"){
                            return response()->json(['success'=>false,'response'=>'Give Proper Time!'], $this->failStatus);
                        }else{
                            $schedule->save();
                            foreach ($slots as $slot){
                                $scheduleSlot=new DoctorClinicScheduleTimeSlot();
                                $scheduleSlot->d_c_schedule_id=$schedule->id;
                                $scheduleSlot->doctor_user_id=Auth::id();
                                $scheduleSlot->clinic_user_id=$clinic_id;
                                $scheduleSlot->date=$fdate;
                                $scheduleSlot->user_id=null;
                                $scheduleSlot->time=$slot['start'];
                                $scheduleSlot->save();
                            }
                        }

                }
                //dd($future_date);
            }
        }
        else{
            return response()->json(['success'=>false,'response'=>'start end not same'], $this->failStatus);
        }
    }


}
