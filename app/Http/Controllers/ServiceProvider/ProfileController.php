<?php

namespace App\Http\Controllers\ServiceProvider;

use App\ClinicVerification;
use App\DivisionDistrict;
use App\Doctor;
use App\DoctorAward;
use App\DoctorContact;
use App\DoctorEducation;
use App\DoctorExperience;
use App\DoctorSpeciality;
use App\DoctorSpecialityDoctor;
use App\Http\Controllers\Controller;
use App\ServiceCategory;
use App\ServiceProvider;
use App\ServiceProviderCategory;
use App\ServiceProviderContact;
use App\ServiceProviderCost;
use App\ServiceProviderEducation;
use App\ServiceProviderExperience;
use App\ServiceProviderVerification;
use App\ServiceSubCategory;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $serviceProviderCategories = ServiceProviderCategory::all();
        $serviceCategories = ServiceCategory::all();
        $serviceProviderDetails = ServiceProvider::where('user_id',$user_id)->first();
        //dd($doctorDetails);
        $divisionDistricts = DivisionDistrict::all();
        if(empty($serviceProviderDetails)){
            return view('backend.service_provider.profile', compact('serviceProviderDetails','serviceProviderCategories','serviceCategories','divisionDistricts'));
        }else{
            $service_provider_contact = ServiceProviderContact::where('service_provider_id',$serviceProviderDetails->id)->first();
            $serviceProviderCost = ServiceProviderCost::where('service_provider_id',$serviceProviderDetails->id)->first();
            $serviceProviderEducations = ServiceProviderEducation::where('service_provider_id',$serviceProviderDetails->id)->get();
            $serviceProviderExperiences = ServiceProviderExperience::where('service_provider_id',$serviceProviderDetails->id)->get();
            $serviceProviderVer = ServiceProviderVerification::where('service_provider_id',$serviceProviderDetails->id)->latest()->first();
            //dd($serviceProviderExperiences);
            return view('backend.service_provider.profile', compact('serviceProviderDetails','serviceProviderCategories','serviceCategories','service_provider_contact','serviceProviderCost','serviceProviderEducations','serviceProviderExperiences','divisionDistricts','serviceProviderVer'));
        }
    }
    public function editProfile(Request $request ,$id)
    {
        $serviceProviderDetails = ServiceProvider::find($id);
        return view('backend.service_provider.profile',compact('serviceProviderDetails'));
    }
    public function changedPassword(){
        return view('backend.service_provider.updatePassword');
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

    public function serviceProviderBasicUpdate(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'email' => 'required',
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
            //dd($imagename);
            $user->save();
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function serviceProviderDetailsInsert(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'service_provider_category_id' => 'required',
            'service_category_id' => 'required',
        ]);
        $empty_check = $request->service_category_id;
        if(!empty($empty_check)){
            $service_provider = new ServiceProvider();
            $service_provider->user_id = $request->user_id;
            $service_provider->service_provider_category_id = $request->service_provider_category_id;
            $service_provider->service_category_id = $request->service_category_id;
            $service_provider->is_active = $request->is_active;
            $service_provider->height = $request->height;
            $service_provider->weight = $request->weight;
            $service_provider->language = $request->language;
            $service_provider->personal_statement = $request->personal_statement;
            $service_provider->save();
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function serviceProviderDetailsUpdate(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'service_provider_category_id' => 'required',
            'service_category_id' => 'required',
        ]);
        $empty_check = $request->service_provider_category_id;
        if(!empty($empty_check)){
            $service_provider_id = $request->service_provider_id;
            $service_provider = ServiceProvider::find($service_provider_id);
            $service_provider->user_id = $request->user_id;
            $service_provider->service_provider_category_id = $request->service_provider_category_id;
            $service_provider->service_category_id = $request->service_category_id;
            $service_provider->is_active = $request->is_active;
            $service_provider->height = $request->height;
            $service_provider->weight = $request->weight;
            $service_provider->language = $request->language;
            $service_provider->personal_statement = $request->personal_statement;
            $service_provider->save();
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }
    public function serviceProviderContactInsert(Request $request){

        $this->validate($request, [
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $empty_check = $request->address;
        if(!empty($empty_check)){
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
            $service_provider_contact->save();
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }
    public function  serviceProviderContactUpdate(Request $request){

        $service_provider_contact_id = $request->service_provider_contact_id;
        $service_provider_contact = ServiceProviderContact::find($service_provider_contact_id);

        if($request->address != $service_provider_contact->address) {
            $this->validate($request, [
                'address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);
        }
        $empty_check = $request->address;

        if(!empty($empty_check)){
            $service_provider_contact->division_district_id = $request->division_district_id;
            $service_provider_contact->address = $request->address;
            $service_provider_contact->city = $request->city;
            $service_provider_contact->state_or_province = $request->area;
            $service_provider_contact->lat = $request->latitude;
            $service_provider_contact->lng = $request->longitude;
            //$service_provider_contact->country = $request->country;
            $service_provider_contact->postal_code = $request->postcode;
            $service_provider_contact->save();

            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }
    public function serviceProviderCostInsert(Request $request){
        //dd('ss');
        $this->validate($request, [
            'monthly_cost' => 'required',
        ]);
        $empty_check = $request->monthly_cost;
        if(!empty($empty_check)){
            $service_provider_cost = new ServiceProviderCost();
            $service_provider_cost->service_provider_id = $request->service_provider_id;
            $service_provider_cost->monthly_cost = $request->monthly_cost;
            $service_provider_cost->fullday_cost = $request->fullday_cost;
            $service_provider_cost->halfday_cost = $request->halfday_cost;
            $service_provider_cost->home_cost = $request->home_cost;
            $service_provider_cost->save();
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();

    }
    public function serviceProviderCostUpdate(Request $request){

        $this->validate($request, [
            'monthly_cost' => 'required',
        ]);
        $empty_check = $request->monthly_cost;

        if(!empty($empty_check)){

            $service_provider_cost_id = $request->service_provider_cost_id;
            $service_provider_cost =  ServiceProviderCost::find($service_provider_cost_id);
            //dd($service_provider_cost_id);
            $service_provider_cost->service_provider_id = $request->service_provider_id;
            $service_provider_cost->monthly_cost = $request->monthly_cost;
            $service_provider_cost->fullday_cost = $request->fullday_cost;
            $service_provider_cost->halfday_cost = $request->halfday_cost;
            $service_provider_cost->home_cost = $request->home_cost;
           // dd($service_provider_cost);
            $service_provider_cost->save();
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();

    }
    public function serviceProviderEducationInsert(Request $request){
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
                $service_provider_education = new ServiceProviderEducation();
                $service_provider_education->service_provider_id = $request->service_provider_id;
                $service_provider_education->degree = $request->degree[$i];
                $service_provider_education->institute = $request->institute[$i];
                $service_provider_education->year_of_completion = $request->year_of_completion[$i];
                $service_provider_education->save();
            }
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function serviceProviderEducationUpdate(Request $request){
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
                $service_provider_education_id = $request->service_provider_education_id[$i] ? $request->service_provider_education_id[$i] : '';
                //dd($request->service_provider_education_id[$i] );
                //dd($request->all());
                if($service_provider_education_id != ''){
                    $service_provider_education = ServiceProviderEducation::find($service_provider_education_id);
                    $service_provider_education->service_provider_id = $request->service_provider_id;
                    $service_provider_education->degree = $request->degree[$i];
                    $service_provider_education->institute = $request->institute[$i];
                    $service_provider_education->year_of_completion = $request->year_of_completion[$i];
                   //dd($service_provider_education->service_provider_id);
                    //dd($request->all());
                    $service_provider_education->save();
                }
                else
                {
                    $service_provider_education = new ServiceProviderEducation();
                    $service_provider_education->service_provider_id = $request->service_provider_id;
                    $service_provider_education->degree = $request->degree[$i];
                    $service_provider_education->institute = $request->institute[$i];
                    $service_provider_education->year_of_completion = $request->year_of_completion[$i];
                    //dd($request->all());
                    $service_provider_education->save();
                }
            }
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }
    public function serviceProviderExperienceInsert(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'company_name' => 'required',
            'from' => 'required',
            'to' => 'required',
            'designation' => 'required',
        ]);
        $empty_check = $request->company_name[0];
        $row_count = count($request->company_name);
        if(!empty($empty_check)){
            for($i=0; $i<$row_count; $i++){
                $service_provider_experience = new ServiceProviderExperience();
                $service_provider_experience->service_provider_id = $request->service_provider_id;
                $service_provider_experience->company_name = $request->company_name[$i];
                $service_provider_experience->from = $request->from[$i];
                $service_provider_experience->to = $request->to[$i];
                $service_provider_experience->designation = $request->designation[$i];
                $service_provider_experience->save();
            }
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function serviceProviderExperienceUpdate(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'company_name' => 'required',
            'from' => 'required',
            'to' => 'required',
            'designation' => 'required',
        ]);
        $empty_check = $request->company_name[0];
        $row_count = count($request->company_name);
        if(!empty($empty_check)){
            for($i=0; $i<$row_count; $i++){
                $service_provider_experience_id = $request->service_provider_experience_id[$i] ? $request->service_provider_experience_id[$i] : '';
                if($service_provider_experience_id != ''){
                    $service_provider_experience = ServiceProviderExperience::find($service_provider_experience_id);
                    $service_provider_experience->service_provider_id = $request->service_provider_id;
                    $service_provider_experience->company_name = $request->company_name[$i];
                    $service_provider_experience->from = $request->from[$i];
                    $service_provider_experience->to = $request->to[$i];
                    $service_provider_experience->designation = $request->designation[$i];
                    //dd($service_provider_experience->all());
                    $service_provider_experience->save();
                }else{
                    $service_provider_experience = new ServiceProviderExperience();
                    $service_provider_experience->service_provider_id = $request->service_provider_id;
                    $service_provider_experience->company_name = $request->company_name[$i];
                    $service_provider_experience->from = $request->from[$i];
                    $service_provider_experience->to = $request->to[$i];
                    $service_provider_experience->designation = $request->designation[$i];
                    //dd($service_provider_experience->all());
                    $service_provider_experience->save();
                }
            }
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function serviceProviderVerificationInsert(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'image' => 'required',
        ]);

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

            Toastr::success('Image Verified Successfully','Success');
        }
        return redirect()->back();
    }

    public function serviceProviderVerificationUpdate(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'image' => 'required',
        ]);
        $service_provider_id = ServiceProvider::where('user_id',Auth::id())->pluck('id')->first();
        $verification = ServiceProviderVerification::where('service_provider_id',$service_provider_id)->where('id',$request->clinic_verification_id)->first();
        //dd($verification);
        if($verification) {
            //$verification->service_provider_id = Auth::id();
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
            $verification->save();
            Toastr::success('Image Verified Successfully','Success');

        }
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

}
