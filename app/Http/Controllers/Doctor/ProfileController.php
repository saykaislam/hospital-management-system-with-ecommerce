<?php

namespace App\Http\Controllers\Doctor;

use App\Clinic;
use App\ClinicDoctor;
use App\DivisionDistrict;
use App\Doctor;
use App\DoctorAward;
use App\DoctorContact;
use App\DoctorEducation;
use App\DoctorExperience;
use App\DoctorSpeciality;
use App\DoctorSpecialityDoctor;
use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $doctorSpecialityLists = DoctorSpeciality::all();
        $doctorDetails = Doctor::where('user_id',$user_id)->first();
        //dd($doctorSpecialityLists);
        $divisionDistricts = DivisionDistrict::all();

        //$clinicLists = Clinic::all();
        $clinicLists = DB::table('clinics')
            ->select('clinics.id','users.name')
            ->join('users','clinics.user_id','=','users.id')
            ->get();

        if(empty($doctorDetails)){
            return view('backend.doctor.profile', compact('doctorDetails','doctorSpecialityLists','divisionDistricts'));
        }else{
            $doctorAwards = DoctorAward::where('doctor_id',$doctorDetails->id)->get();
            $doctorExperiences = DoctorExperience::where('doctor_id',$doctorDetails->id)->get();
            $doctorEducations = DoctorEducation::where('doctor_id',$doctorDetails->id)->get();
            $doctorContact = DoctorContact::where('doctor_id',$doctorDetails->id)->first();
            $doctorSpecialityDoctors = DoctorSpecialityDoctor::where('doctor_id',$doctorDetails->id)->get();
            $clinicDoctors = ClinicDoctor::where('doctor_id',$doctorDetails->id)->get();
            return view('backend.doctor.profile', compact('doctorDetails','doctorAwards','doctorExperiences','doctorEducations','doctorContact','doctorSpecialityLists','doctorSpecialityDoctors', 'clinicLists','clinicDoctors','divisionDistricts'));
        }
    }

    public function editProfile(Request $request ,$id)
    {
        $doctorDetails = Doctor::find($id);
        return view('backend.doctor.profile',compact('doctorDetails'));
    }
    public function changedPassword(){
        return view('backend.doctor.updatePassword');
    }
    public function updatePassword(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        // dd($hashedPassword);
        if (Hash::check($request->old_password, $hashedPassword)) {
            //dd('okk');
            if (!Hash::check($request->password, $hashedPassword)) {
                $user = \App\User::find(Auth::id());
                //dd($user);
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Updated Successfully','Success');
                Auth::logout();
                return redirect()->route('login');
            } else {
                Toastr::error('New password cannot be the same as old password.', 'Error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Current password not match.', 'Error');
            return redirect()->back();
        }
    }

    public function doctorAwardInsert(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'award' => 'required',
            'year' => 'required',
        ]);
        $empty_check = $request->award[0];
        $row_count = count($request->award);
        if(!empty($empty_check)){
            for($i=0; $i<$row_count; $i++){
                $doctor_award = new DoctorAward();
                $doctor_award->doctor_id = $request->doctor_id;
                $doctor_award->award = $request->award[$i];
                $doctor_award->year = $request->year[$i];
                $doctor_award->save();
            }
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function doctorAwardUpdate(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'award' => 'required',
            'year' => 'required',
        ]);
        $empty_check = $request->award[0];
        $row_count = count($request->award);
        if(!empty($empty_check)){
            for($i=0; $i<$row_count; $i++){

                $doctor_award_id = $request->doctor_award_id[$i] ? $request->doctor_award_id[$i] : '';
                if($doctor_award_id != ''){
                    $doctor_award = DoctorAward::find($doctor_award_id);
                    $doctor_award->doctor_id = $request->doctor_id;
                    $doctor_award->award = $request->award[$i];
                    $doctor_award->year = $request->year[$i];
                    $doctor_award->save();
                }else{
                    $doctor_award = new DoctorAward();
                    $doctor_award->doctor_id = $request->doctor_id;
                    $doctor_award->award = $request->award[$i];
                    $doctor_award->year = $request->year[$i];
                    $doctor_award->save();
                }
            }
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function doctorExperienceInsert(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'hospital_name' => 'required',
            'from' => 'required',
            'to' => 'required',
            'designation' => 'required',
        ]);
        $empty_check = $request->hospital_name[0];
        $row_count = count($request->hospital_name);
        if(!empty($empty_check)){
            for($i=0; $i<$row_count; $i++){
                $doctor_experience = new DoctorExperience();
                $doctor_experience->doctor_id = $request->doctor_id;
                $doctor_experience->hospital_name = $request->hospital_name[$i];
                $doctor_experience->from = $request->from[$i];
                $doctor_experience->to = $request->to[$i];
                $doctor_experience->designation = $request->designation[$i];
                $doctor_experience->save();
            }
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function doctorExperienceUpdate(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'hospital_name' => 'required',
            'from' => 'required',
            'to' => 'required',
            'designation' => 'required',
        ]);
        $empty_check = $request->hospital_name[0];
        $row_count = count($request->hospital_name);
        if(!empty($empty_check)){
            for($i=0; $i<$row_count; $i++){
                $doctor_experience_id = $request->doctor_experience_id[$i] ? $request->doctor_experience_id[$i] : '';
                if($doctor_experience_id != ''){
                    $doctor_experience = DoctorExperience::find($doctor_experience_id);
                    $doctor_experience->doctor_id = $request->doctor_id;
                    $doctor_experience->hospital_name = $request->hospital_name[$i];
                    $doctor_experience->from = $request->from[$i];
                    $doctor_experience->to = $request->to[$i];
                    $doctor_experience->designation = $request->designation[$i];
                    $doctor_experience->save();
                }else{
                    $doctor_experience = new DoctorExperience();
                    $doctor_experience->doctor_id = $request->doctor_id;
                    $doctor_experience->hospital_name = $request->hospital_name[$i];
                    $doctor_experience->from = $request->from[$i];
                    $doctor_experience->to = $request->to[$i];
                    $doctor_experience->designation = $request->designation[$i];
                    $doctor_experience->save();
                }
            }
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function doctorClinicInsert(Request $request){
        $this->validate($request, [
            'clinic_id' => 'required',
        ]);
        $empty_check = $request->clinic_id[0];
        $row_count = count($request->clinic_id);
        if(!empty($empty_check)){
            // check main more than one
            $initial_count = 0;
            for($i=0; $i<$row_count; $i++){
                if($request->main_clinic_status[$i] == 1){
                    $initial_count = $initial_count + 1;
                }
            }
            if($initial_count > 1){
                Toastr::warning('You can not more than one Main Clinic Status.', 'Warning');
            }else{
                $flag = false;
                for($i=0; $i<$row_count; $i++){
                    $check_clinic_exists = ClinicDoctor::where('doctor_id',$request->doctor_id)->where('clinic_id',$request->clinic_id[$i])->pluck('id')->first();
                    if($check_clinic_exists){
                        $flag = true;
                    }else{
                        $doctor_clinic = new ClinicDoctor();
                        $doctor_clinic->doctor_id = $request->doctor_id;
                        $doctor_clinic->clinic_id = $request->clinic_id[$i];
                        $doctor_clinic->visit_cost = $request->visit_cost[$i];
                        $doctor_clinic->main_clinic_status = $request->main_clinic_status[$i];
                        $doctor_clinic->save();
                    }
                }
                if($flag == true){
                    Toastr::warning('Clinic Already Exists.', 'Warning');
                }else{
                    Toastr::success('Successfully Updated.', 'Success');
                }
            }
        }
        return redirect()->back();
    }

    public function doctorClinicUpdate(Request $request){
        $this->validate($request, [
            'clinic_id' => 'required',
        ]);
        //dd($request->all());
        $empty_check = $request->clinic_id[0];
        $row_count = count($request->clinic_id);

        if(!empty($empty_check)){
            // check main more than one
            $initial_count = 0;
            for($i=0; $i<$row_count; $i++){
                if($request->main_clinic_status[$i] == 1){
                    $initial_count = $initial_count + 1;
                }
            }
            if($initial_count > 1){
                Toastr::warning('You can not more than one Main Clinic Status.', 'Warning');
            }else{
                $flag = false;
                for($i=0; $i<$row_count; $i++){
                    $clinic_doctor_id = $request->clinic_doctor_id[$i] ? $request->clinic_doctor_id[$i] : '';
                    if(!empty($clinic_doctor_id)){
                        $doctor_clinic = ClinicDoctor::find($clinic_doctor_id);
                        $doctor_clinic->doctor_id = $request->doctor_id;
                        $doctor_clinic->clinic_id = $request->clinic_id[$i];
                        $doctor_clinic->visit_cost = $request->visit_cost[$i];
                        $doctor_clinic->main_clinic_status = $request->main_clinic_status[$i];
                        $doctor_clinic->save();
                    }else{

                        $check_clinic_exists = ClinicDoctor::where('doctor_id',$request->doctor_id)->where('clinic_id',$request->clinic_id[$i])->pluck('id')->first();
                        if($check_clinic_exists){
                            $flag = true;
                        }else{
                            $doctor_clinic = new ClinicDoctor();
                            $doctor_clinic->doctor_id = $request->doctor_id;
                            $doctor_clinic->clinic_id = $request->clinic_id[$i];
                            $doctor_clinic->visit_cost = $request->visit_cost[$i];
                            $doctor_clinic->main_clinic_status = $request->main_clinic_status[$i];
                            $doctor_clinic->save();
                        }
                    }
                }

                if($flag == true){
                    Toastr::warning('Clinic Already Exists.', 'Warning');
                }else{
                    Toastr::success('Successfully Updated.', 'Success');
                }
            }
        }
        return redirect()->back();
    }

    public function doctorEducationInsert(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'degree' => 'required',
            'institute' => 'required',
            'year_of_completion' => 'required',
        ]);
        $empty_check = $request->degree[0];
        $row_count = count($request->degree);
        if(!empty($empty_check)){
            for($i=0; $i<$row_count; $i++){
                $doctor_education = new DoctorEducation();
                $doctor_education->doctor_id = $request->doctor_id;
                $doctor_education->degree = $request->degree[$i];
                $doctor_education->institute = $request->institute[$i];
                $doctor_education->year_of_completion = $request->year_of_completion[$i];
                $doctor_education->save();
            }
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function doctorEducationUpdate(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'degree' => 'required',
            'institute' => 'required',
            'year_of_completion' => 'required',
        ]);
        $empty_check = $request->degree[0];
        $row_count = count($request->degree);

        if(!empty($empty_check)){
            for($i=0; $i<$row_count; $i++){
                $doctor_education_id = $request->doctor_education_id[$i] ? $request->doctor_education_id[$i] : '';
                if($doctor_education_id != ''){
                    $doctor_education = DoctorEducation::find($doctor_education_id);
                    $doctor_education->doctor_id = $request->doctor_id;
                    $doctor_education->degree = $request->degree[$i];
                    $doctor_education->institute = $request->institute[$i];
                    $doctor_education->year_of_completion = $request->year_of_completion[$i];
                    $doctor_education->save();
                }else{
                    $doctor_education = new DoctorEducation();
                    $doctor_education->doctor_id = $request->doctor_id;
                    $doctor_education->degree = $request->degree[$i];
                    $doctor_education->institute = $request->institute[$i];
                    $doctor_education->year_of_completion = $request->year_of_completion[$i];
                    //dd($doctor_education->all());
                    $doctor_education->save();
                }
            }
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function doctorContactInsert(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $empty_check = $request->address;
        if(!empty($empty_check)){
            $doctor_contact = new DoctorContact();
            $doctor_contact->doctor_id = $request->doctor_id;
            $doctor_contact->division_district_id = $request->division_district_id;
            $doctor_contact->address = $request->address;
            $doctor_contact->city = $request->city;
            $doctor_contact->state_or_province = $request->area;
            $doctor_contact->lat = $request->latitude;
            $doctor_contact->lng = $request->longitude;
            //$doctor_contact->country = $request->country;
            $doctor_contact->postal_code = $request->postcode;
            $doctor_contact->save();
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function doctorContactUpdate(Request $request){
        //dd($request->all());

        $doctor_contact_id = $request->doctor_contact_id;
        $doctor_contact = DoctorContact::find($doctor_contact_id);

        if($request->address != $doctor_contact->address){
            $this->validate($request, [
                'address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);
        }
        $empty_check = $request->address;

        if(!empty($empty_check)){
            $doctor_contact->doctor_id = $request->doctor_id;
            $doctor_contact->division_district_id = $request->division_district_id;
            $doctor_contact->address = $request->address;
            $doctor_contact->city = $request->city;
            $doctor_contact->state_or_province = $request->area;
            $doctor_contact->lat = $request->latitude;
            $doctor_contact->lng = $request->longitude;
            //$doctor_contact->country = $request->country;
            $doctor_contact->postal_code = $request->postcode;
            $doctor_contact->save();

            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function doctorBasicUpdate(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'phone' => 'required',
        ]);
        $empty_check = $request->email;

        if(!empty($empty_check)){
            $user_id = $request->user_id;
            $user = User::find($user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
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
            $user->save();
//dd($user_id);
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function doctorSpecialityInsert(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'doctor_speciality_id' => 'required',
            'main_specialist_status' => 'required',
        ]);
        $empty_check = $request->doctor_speciality_id[0];
        $row_count = count($request->doctor_speciality_id);
        if(!empty($empty_check)){
            // check main more than one
            $initial_count = 0;
            for($i=0; $i<$row_count; $i++){
                if($request->main_specialist_status[$i] == 1){
                    $initial_count = $initial_count + 1;
                }
            }
            if($initial_count > 1){
                Toastr::warning('You can not more than one Main Specialist Status.', 'Warning');
            }else{
                $flag = false;
                for($i=0; $i<$row_count; $i++){
                    $check_clinic_exists = DoctorSpecialityDoctor::where('doctor_id',$request->doctor_id)->where('doctor_speciality_id',$request->doctor_speciality_id[$i])->pluck('id')->first();
                    if($check_clinic_exists){
                        $flag = true;
                    }else{
                        $doctor_speciality_doctor = new DoctorSpecialityDoctor();
                        $doctor_speciality_doctor->doctor_id = $request->doctor_id;
                        $doctor_speciality_doctor->doctor_speciality_id = $request->doctor_speciality_id[$i];
                        $doctor_speciality_doctor->main_specialist_status = $request->main_specialist_status[$i];
                        $doctor_speciality_doctor->save();
                    }
                }
                if($flag == true){
                    Toastr::warning('Clinic Already Exists.', 'Warning');
                }else{
                    Toastr::success('Successfully Inserted.', 'Success');
                }
            }
        }
        return redirect()->back();
    }

    public function doctorSpecialityUpdate(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'doctor_speciality_id' => 'required',
            'main_specialist_status' => 'required',
        ]);
        $empty_check = $request->doctor_speciality_id[0];
        $row_count = count($request->doctor_speciality_id);

        if(!empty($empty_check)){
            // check main more than one
            $initial_count = 0;
            for($i=0; $i<$row_count; $i++){
                if($request->main_specialist_status[$i] == 1){
                    $initial_count = $initial_count + 1;
                }
            }
            if($initial_count > 1){
                Toastr::warning('You can not more than one Main Specialist Status.', 'Warning');
            }else{
                $flag = false;
                for($i=0; $i<$row_count; $i++){
                    $doctor_speciality_doctor_id = $request->doctor_speciality_doctor_id[$i] ? $request->doctor_speciality_doctor_id[$i] : '';
                    if($doctor_speciality_doctor_id != ''){
                        $doctor_speciality_doctor = DoctorSpecialityDoctor::find($doctor_speciality_doctor_id);
                        $doctor_speciality_doctor->doctor_id = $request->doctor_id;
                        $doctor_speciality_doctor->doctor_speciality_id = $request->doctor_speciality_id[$i];
                        $doctor_speciality_doctor->main_specialist_status = $request->main_specialist_status[$i];
                        $doctor_speciality_doctor->save();
                    }else{
                        $check_clinic_exists = DoctorSpecialityDoctor::where('doctor_id',$request->doctor_id)->where('doctor_speciality_id',$request->doctor_speciality_id[$i])->pluck('id')->first();
                        if($check_clinic_exists){
                            $flag = true;
                        }else{
                            $doctor_speciality_doctor = new DoctorSpecialityDoctor();
                            $doctor_speciality_doctor->doctor_id = $request->doctor_id;
                            $doctor_speciality_doctor->doctor_speciality_id = $request->doctor_speciality_id[$i];
                            $doctor_speciality_doctor->main_specialist_status = $request->main_specialist_status[$i];
                            $doctor_speciality_doctor->save();
                        }
                    }
                }
                if($flag == true){
                    Toastr::warning('Specialist Already Exists.', 'Warning');
                }else{
                    Toastr::success('Successfully Updated.', 'Success');
                }
            }
        }
        return redirect()->back();
    }

    public function doctorDetailsInsert(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'title' => 'required',
        ]);
        $empty_check = $request->title;
        if(!empty($empty_check)){
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
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function doctorDetailsUpdate(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'title' => 'required',
        ]);
        $empty_check = $request->title;
        if(!empty($empty_check)){
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
            $doctor->save();
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }
}
