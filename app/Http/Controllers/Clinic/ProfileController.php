<?php

namespace App\Http\Controllers\Clinic;

use App\Clinic;
use App\ClinicCategory;
use App\ClinicContact;
use App\ClinicOpenClose;
use App\ClinicVerification;
use App\DivisionDistrict;
use App\Doctor;
use App\DoctorContact;
use App\Http\Controllers\Controller;
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
        $clinicCategoryLists = ClinicCategory::all();
        $clinicDetails = Clinic::where('user_id',$user_id)->first();
        $divisionDistricts = DivisionDistrict::all();

        if(empty($clinicDetails)){
            return view('backend.clinic.profile', compact('clinicDetails', 'clinicCategoryLists','divisionDistricts'));
        }else {
            $clinicContact = ClinicContact::where('clinic_id',$clinicDetails->id)->first();
            $clinicOpenClose = ClinicOpenClose::where('clinic_id',$clinicDetails->id)->get();
            //dd($clinicOpenClose);
            //dd($clinicOpenClose[1]->open_close_status);
            $clinicVer = ClinicVerification::where('clinic_id',$clinicDetails->id)->latest()->first();
            return view('backend.clinic.profile', compact('clinicDetails', 'clinicCategoryLists','clinicContact','divisionDistricts','clinicVer','clinicOpenClose'));
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

    public function clinicBasicUpdate(Request $request){
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
            $image = $request->file('image');
            if (isset($image)) {
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                //delete old image.....
                if(Storage::disk('public')->exists('uploads/profile_pic/clinic/'.$user->image))
                {
                    Storage::disk('public')->delete('uploads/profile_pic/clinic/'.$user->image);
                }

//            resize image for hospital and upload
                $proImage = Image::make($image)->resize(100, 100)->save($image->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/profile_pic/clinic/'. $imagename, $proImage);

            }else {
                $imagename= $user->image;
            }
            $user->image = $imagename;
            $user->save();

            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function clinicDetailsInsert(Request $request){
        $this->validate($request, [
            'clinic_category_id' => 'required',
        ]);
        $empty_check = $request->clinic_category_id;
        if(!empty($empty_check)){
            $clinic = new Clinic();
            $clinic->user_id = $request->user_id;
            $clinic->clinic_category_id = $request->clinic_category_id;
            $clinic->rating = $request->rating;
            $clinic->opens_time = $request->opens_time;
            $clinic->emergency_phone = $request->emergency_phone;
            $clinic->description = $request->description;
            $clinic->is_active = $request->is_active;
            $clinic->save();
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function clinicDetailsUpdate(Request $request){

        $this->validate($request, [
            'clinic_category_id' => 'required',
        ]);
        $empty_check = $request->clinic_category_id;
        if(!empty($empty_check)){
            $clinic_id = $request->clinic_id;
            $clinic = Clinic::find($clinic_id);
            $clinic->user_id = $request->user_id;
            $clinic->clinic_category_id = $request->clinic_category_id;
            $clinic->rating = $request->rating;
            $clinic->opens_time = $request->opens_time;
            $clinic->emergency_phone = $request->emergency_phone;
            $clinic->description = $request->description;
            $clinic->is_active = $request->is_active;
            $clinic->save();
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function clinicContactInsert(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $empty_check = $request->address;
        if(!empty($empty_check)){
            $clinic_contact = new ClinicContact();
            $clinic_contact->clinic_id = $request->clinic_id;
            $clinic_contact->division_district_id = $request->division_district_id;
            $clinic_contact->address = $request->address;
            $clinic_contact->city = $request->city;
            $clinic_contact->state_or_province = $request->area;
            $clinic_contact->lat = $request->latitude;
            $clinic_contact->lng = $request->longitude;
            //$clinic_contact->country = $request->country;
            $clinic_contact->postal_code = $request->postcode;
            $clinic_contact->save();
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function clinicContactUpdate(Request $request){
        //dd($request->all());

        $clinic_contact_id = $request->doctor_contact_id;
        $clinic_contact = ClinicContact::find($clinic_contact_id);

        if($request->address != $clinic_contact->address) {
            $this->validate($request, [
                'address' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
            ]);
        }
        $empty_check = $request->address;

        if(!empty($empty_check)){
            $clinic_contact->clinic_id = $request->clinic_id;
            $clinic_contact->division_district_id = $request->division_district_id;
            $clinic_contact->address = $request->address;
            $clinic_contact->city = $request->city;
            $clinic_contact->state_or_province = $request->area;
            $clinic_contact->lat = $request->latitude;
            $clinic_contact->lng = $request->longitude;
            //$clinic_contact->country = $request->country;
            $clinic_contact->postal_code = $request->postcode;
            $clinic_contact->save();

            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function clinicopenCloseInsert(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'day' => 'required',
            'open_close_status' => 'required'
        ]);

        $empty_check = $request->open_close_status;
        if(!empty($empty_check)){
            for($i=0;$i<7;$i++){
                $clinic_open_close = new ClinicOpenClose();
                $clinic_open_close->clinic_id = $request->clinic_id;
                $clinic_open_close->day = $request->day[$i];
                $clinic_open_close->open_close_status = $request->open_close_status[$i];
                $clinic_open_close->open_time = $request->open_time[$i];
                $clinic_open_close->close_time = $request->close_time[$i];
                $clinic_open_close->save();
            }

            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }

    public function clinicopenCloseUpdate(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'day' => 'required',
            'open_close_status' => 'required'
        ]);

        for($i=0;$i<7;$i++){
            $clinic_open_close_id = $request->clinic_open_close_id[$i];
            $clinic_open_close = ClinicOpenClose::find($clinic_open_close_id);
            //$clinic_open_close->clinic_id = $request->clinic_id;
            $clinic_open_close->day = $request->day[$i];
            $clinic_open_close->open_close_status = $request->open_close_status[$i];
            $clinic_open_close->open_time = $request->open_time[$i];
            $clinic_open_close->close_time = $request->close_time[$i];
            $clinic_open_close->save();
        }

        Toastr::success('Updated Updated.', 'Success');
        return redirect()->back();
    }

    public function clinicVerificationInsert(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'image' => 'required',
        ]);

        $clinic_id = Clinic::where('user_id',Auth::id())->pluck('id')->first();

        $ver = new ClinicVerification();
        $ver-> clinic_id = $clinic_id;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

//            resize image for hospital and upload
            $proImage = Image::make($image)->resize(100, 100)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/profile_pic/clinic/'. $imagename, $proImage);

            $ver->image = $imagename;
            $ver->save();

            Toastr::success('Image Verified Successfully','Success');
        }
        return redirect()->back();
    }

    public function clinicVerificationUpdate(Request $request){
        //dd($request->all());

        $this->validate($request, [
            'image' => 'required',
        ]);
        $clinic_id = Clinic::where('user_id',Auth::id())->pluck('id')->first();
        $verification = ClinicVerification::where('clinic_id',$clinic_id)->where('id',$request->clinic_verification_id)->first();
        //dd($verification);
        if($verification) {
            $verification-> clinic_id = Auth::id();
            $image = $request->file('image');
            if (isset($image)) {
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                //delete old image.....
                if(Storage::disk('public')->exists('uploads/profile_pic/clinic/'.$verification->image))
                {
                    Storage::disk('public')->delete('uploads/profile_pic/clinic/'.$verification->image);
                }

//            resize image for hospital and upload
                $proImage = Image::make($image)->resize(100, 100)->save($image->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/profile_pic/clinic/'. $imagename, $proImage);

            }else {
                $imagename= $verification->image;
            }
            $verification->image = $imagename;
            $verification->save();
            Toastr::success('Image Verified Successfully','Success');

        }
        return redirect()->back();
    }
}
