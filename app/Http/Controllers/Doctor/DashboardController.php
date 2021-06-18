<?php

namespace App\Http\Controllers\Doctor;

use App\Doctor;
use App\DoctorClinicScheduleTimeSlot;
use App\DoctorContact;
use App\Http\Middleware\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $doctor = DB::table('users')->where('id',2)->first();

        $patients = DB::table('doctor_clinic_schedule_time_slots')
            ->where('doctor_user_id', Auth::user()->id)
            ->where('user_id', '!=', NULL)
            ->select('user_id')
            ->groupBy('user_id')
            ->get();

        $today_patients = DB::table('doctor_clinic_schedule_time_slots')
            ->where('doctor_user_id', Auth::user()->id)
            ->where('user_id', '!=', NULL)
            ->where('date', '=', date('d-m-Y'))
            ->select('user_id')
            ->groupBy('user_id')
            ->get();

        $appointments = DB::table('doctor_clinic_schedule_time_slots')
            ->where('doctor_user_id', Auth::user()->id)
            ->where('user_id', '!=', NULL)
            ->select('user_id')
            //->groupBy('user_id')
            ->get();

        $patients_count = count($patients);
        $appointments_count = count($appointments);
        $today_patients_count = count($today_patients);
        //dd($patients_count);


        $user_appointment_infos = DB::table('users')
            ->join('doctor_clinic_schedule_time_slots','users.id','=','doctor_clinic_schedule_time_slots.user_id')
            ->leftJoin('orders','doctor_clinic_schedule_time_slots.order_id','=','orders.id')
            ->where('doctor_clinic_schedule_time_slots.doctor_user_id', Auth::user()->id)
            ->select('users.id as user_id','users.name','users.slug','users.phone','users.blood_group','users.image','doctor_clinic_schedule_time_slots.id as slot_id','doctor_clinic_schedule_time_slots.time','doctor_clinic_schedule_time_slots.date','orders.grand_total')
            ->get();

        $user_appointment_prescription_infos = DB::table('follow_up_e_prescriptions')
            ->join('users','users.id','=','follow_up_e_prescriptions.user_id')
            ->join('doctor_clinic_schedule_time_slots','users.id','=','doctor_clinic_schedule_time_slots.user_id')
            ->join('e_prescriptions','follow_up_e_prescriptions.e_prescription_id','=','e_prescriptions.id')
            ->where('doctor_clinic_schedule_time_slots.doctor_user_id', Auth::user()->id)
            ->select('follow_up_e_prescriptions.id','follow_up_e_prescriptions.date','e_prescriptions.prescription_info')
            ->get();
        //dd($user_appointment_infos);

        $doctorDetails = Doctor::where('user_id',Auth::user()->id)->first();
        $doctorContact = DoctorContact::where('doctor_id',$doctorDetails->id)->first();
        $clinicLists = DB::table('clinics')
            ->select('clinics.id','users.name')
            ->join('users','clinics.user_id','=','users.id')
            ->get();

        return view('backend.doctor.dashboard', compact('patients_count','appointments_count','today_patients_count','user_appointment_infos','user_appointment_prescription_infos','doctor','doctorDetails','doctorContact','clinicLists'));
    }
}
