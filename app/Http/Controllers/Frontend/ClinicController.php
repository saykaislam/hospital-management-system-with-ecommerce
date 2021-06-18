<?php

namespace App\Http\Controllers\Frontend;

use App\Clinic;
use App\ClinicCategory;
use App\ClinicOpenClose;
use App\ClinicReview;
use App\DoctorSpeciality;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClinicController extends Controller
{
    public function clinicList(){

        $clinicUserLists = User::where('role_id',3)->where('active_inactive_status',1)->get();
        $clinicCategories = ClinicCategory::all();

        return view('frontend.pages.clinic.clinic_list', compact('clinicUserLists','clinicCategories'));
    }

    public function clinicDetails($slug){


        $clinicUserDetails = DB::table('clinics')
                    ->select('users.*','clinics.id as clinic_id','clinics.rating','clinics.emergency_phone','clinics.description','clinics.opens_time','clinic_categories.name as clinic_category_name','clinic_contacts.address')
                    ->join('users','clinics.user_id','=','users.id')
                    ->join('clinic_categories','clinics.clinic_category_id','=','clinic_categories.id')
                    ->leftJoin('clinic_contacts','clinics.id','=','clinic_contacts.clinic_id')
                    ->where('users.slug',$slug)
                    ->first();



        $clinicReviews = ClinicReview::where('clinic_user_id', $clinicUserDetails->id)->get();
        $clinicOpenCloses = ClinicOpenClose::where('clinic_id', $clinicUserDetails->clinic_id)->get();

        return view('frontend.pages.clinic.clinic_details', compact('clinicUserDetails','clinicReviews','clinicOpenCloses'));
    }

    public function clinicDoctorList($slug){

        $doctorUserLists = DB::table('users')
            ->join('clinics','clinics.user_id','=','users.id')
            ->join('clinic_doctors','clinic_doctors.clinic_id','=','clinics.id')
            ->join('doctors','doctors.id','=','clinic_doctors.doctor_id')
            ->join('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
            ->select('doctors.*','doctor_specialities.name as spe_name')
            //->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name')
            ->where('users.slug',$slug)
            ->get();

        //dd($doctorUserLists);

        $doctorSpecialities = DoctorSpeciality::all();
        $gen=[];
        $spe=[];
        return view('frontend.pages.clinic.doctor_list', compact('doctorUserLists','doctorSpecialities','gen','spe'));
    }
}
