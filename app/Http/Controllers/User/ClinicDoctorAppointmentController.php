<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClinicDoctorAppointmentController extends Controller
{
    public function appointmentList(){
        //dd('okk');

        $user_appointment_infos = DB::table('users')
            ->join('doctor_clinic_schedule_time_slots','users.id','=','doctor_clinic_schedule_time_slots.user_id')
            ->leftJoin('follow_up_e_prescriptions','follow_up_e_prescriptions.slot_id','=','doctor_clinic_schedule_time_slots.id')
            ->where('doctor_clinic_schedule_time_slots.user_id', Auth::user()->id)
            ->select('doctor_clinic_schedule_time_slots.*','follow_up_e_prescriptions.e_prescription_id')
            ->get();

        //dd($user_appointment_infos);
        return view('backend.user.appointment.clinic_doctor_appointment_list', compact('user_appointment_infos'));
    }

    public function prescriptionView($id){
        $infos = DB::table('follow_up_e_prescriptions')
            ->join('users','follow_up_e_prescriptions.doctor_user_id','=','users.id')
            ->join('doctors','doctors.user_id','=','users.id')
            ->join('e_prescriptions','follow_up_e_prescriptions.e_prescription_id','=','e_prescriptions.id')
            ->leftJoin('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
            ->leftJoin('follow_ups','follow_ups.d_c_s_t_slot_id','=','follow_up_e_prescriptions.slot_id')
            ->leftJoin('doctor_clinic_schedule_time_slots','doctor_clinic_schedule_time_slots.id','=','follow_up_e_prescriptions.slot_id')
            ->leftJoin('orders','doctor_clinic_schedule_time_slots.order_id','=','orders.id')
            ->where('follow_up_e_prescriptions.slot_id',$id)
            ->select('follow_up_e_prescriptions.user_id','follow_up_e_prescriptions.invoice','follow_up_e_prescriptions.date','e_prescriptions.prescription_info','follow_ups.follow_up_date','users.name','doctor_specialities.name as doctor_speciality_name','orders.grand_total')
            ->first();
        //dd($infos);

        return view('backend.user.appointment.prescription_view', compact('infos'));
    }

    public function prescriptionInvoicePrint($id){

        $infos = DB::table('follow_up_e_prescriptions')
            ->join('users','follow_up_e_prescriptions.doctor_user_id','=','users.id')
            ->join('doctors','doctors.user_id','=','users.id')
            ->join('e_prescriptions','follow_up_e_prescriptions.e_prescription_id','=','e_prescriptions.id')
            ->leftJoin('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
            ->leftJoin('follow_ups','follow_ups.d_c_s_t_slot_id','=','follow_up_e_prescriptions.slot_id')
            ->leftJoin('doctor_clinic_schedule_time_slots','doctor_clinic_schedule_time_slots.id','=','follow_up_e_prescriptions.slot_id')
            ->leftJoin('orders','doctor_clinic_schedule_time_slots.order_id','=','orders.id')
            ->where('follow_up_e_prescriptions.slot_id',$id)
            ->select('follow_up_e_prescriptions.user_id','follow_up_e_prescriptions.invoice','follow_up_e_prescriptions.date','e_prescriptions.prescription_info','follow_ups.follow_up_date','users.name','users.phone','users.email','doctor_specialities.name as doctor_speciality_name','orders.grand_total')
            ->first();
//        dd($infos);

        return view('backend.user.appointment.prescription_invoice_print', compact('infos'));
    }
}
