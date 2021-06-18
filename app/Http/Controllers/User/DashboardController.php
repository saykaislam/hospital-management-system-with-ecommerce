<?php

namespace App\Http\Controllers\User;

use App\ClinicReview;
use App\DoctorReview;
use App\Order;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $service_order_info = Order::where('order_type','service')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        //$appointment_clinic_doctor_info = Order::where('order_type','clinic_schedule')->where('user_id',Auth::user()->id)->get();
        $appointment_clinic_doctor_order_info = DB::table('users')
            ->join('doctor_clinic_schedule_time_slots','users.id','=','doctor_clinic_schedule_time_slots.user_id')
            ->leftJoin('follow_up_e_prescriptions','follow_up_e_prescriptions.slot_id','=','doctor_clinic_schedule_time_slots.id')
            ->where('doctor_clinic_schedule_time_slots.user_id', Auth::user()->id)
            ->orderBy('doctor_clinic_schedule_time_slots.id','desc')
            ->select('doctor_clinic_schedule_time_slots.*','follow_up_e_prescriptions.e_prescription_id')
            ->get();
//dd($service_order_info);
        $product_order_info = Order::where('order_type','product')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $labtest_order_info = Order::where('order_type','lab')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

        $count_service_order = $service_order_info->count();
        $count_appointment_clinic_doctor = $appointment_clinic_doctor_order_info->count();
        $count_product_order = $product_order_info->count();
        $count_labtest_order_info = $labtest_order_info->count();

        return view('backend.user.dashboard', compact('service_order_info','count_service_order','appointment_clinic_doctor_order_info','count_appointment_clinic_doctor','count_product_order','count_labtest_order_info'));
    }

    public function userClinicReviewStore(Request $request){
        //dd($request->all());
        $check_review_exists_id = ClinicReview::where('user_id',$request->user_id)->where('clinic_user_id',$request->clinic_user_id)->pluck('id')->first();
        if(empty($check_review_exists_id)) {
            $clinic_review = new ClinicReview();
            $clinic_review->user_id = $request->user_id;
            $clinic_review->clinic_user_id = $request->clinic_user_id;
            $clinic_review->rating = $request->rating;
            $clinic_review->title = $request->title;
            $clinic_review->description = $request->description;
            $clinic_review->save();
        }else{
            $clinic_review = ClinicReview::find($check_review_exists_id);
            $clinic_review->user_id = $request->user_id;
            $clinic_review->clinic_user_id = $request->clinic_user_id;
            $clinic_review->rating = $request->rating;
            $clinic_review->title = $request->title;
            $clinic_review->description = $request->description;
            $clinic_review->save();
        }


        Toastr::success('Review Created Successfully', 'Success');
        return redirect()->back();
    }

    public function userDoctorReviewStore(Request $request){
        //dd($request->all());

        $check_review_exists_id = DoctorReview::where('user_id',$request->user_id)->where('doctor_user_id',$request->doctor_user_id)->pluck('id')->first();
        if(empty($check_review_exists_id)){
            $doctor_review = new DoctorReview();
            $doctor_review->user_id = $request->user_id;
            $doctor_review->doctor_user_id = $request->doctor_user_id;
            $doctor_review->rating = $request->rating;
            $doctor_review->title = $request->title;
            $doctor_review->description = $request->description;
            $doctor_review->save();
        }else{
            $doctor_review = DoctorReview::find($check_review_exists_id);
            $doctor_review->user_id = $request->user_id;
            $doctor_review->doctor_user_id = $request->doctor_user_id;
            $doctor_review->rating = $request->rating;
            $doctor_review->title = $request->title;
            $doctor_review->description = $request->description;
            $doctor_review->save();
        }


        Toastr::success('Review Created Successfully', 'Success');
        return redirect()->back();
    }
}
