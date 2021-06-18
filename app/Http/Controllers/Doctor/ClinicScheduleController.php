<?php

namespace App\Http\Controllers\Doctor;

use App\Clinic;
use App\ClinicDoctor;
use App\Day;
use App\Doctor;
use App\DoctorClinicSchedule;
use App\DoctorClinicScheduleTimeSlot;
use App\DoctorSchedule;
use App\DoctorScheduleTimeSlot;
use App\EPrescription;
use App\FollowUp;
use App\FollowUpEPrescription;
use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClinicScheduleController extends Controller
{
    public function index()
    {
        //
    }

    public function thirtyDays(){
        $today= date("d-m-Y");
        $today_day=date("D");
//        dd(date("d-m-Y",strtotime('+'.$i.' day'.$today)));
        $dates=[];
        $dates[0]['day']=$today_day;
        $dates[0]['date']=$today;

        for($q=1;$q<31;$q++){
            $next_date=date("d-m-Y",strtotime('+'.$q.' day'.$today));
            $next_day=date("D",strtotime($next_date));
            $dates[$q]['day']=$next_day;
            $dates[$q]['date']=$next_date;
        }
        return $dates;
    }

    public function doctorClinicScheduleSlot(Request $request){

        //dd($request->all());

        $doctorSchedule=DoctorClinicSchedule::where('doctor_user_id',$request->doctor_user_id)->where('clinic_user_id',$request->clinic_id)->where('date',$request->date)->get();
        //dd($doctorSchedule);
        $slot=[];
        foreach($doctorSchedule as $ds){
            $ds_slot=\App\DoctorClinicScheduleTimeSlot::where('d_c_schedule_id',$ds->id)->get();
            array_push($slot,$ds_slot);
        }
        //dd($slot);
        return response()->json(['response'=>$slot]);

    }

    public function create()
    {
        $doctorDetails = DB::table('doctors')
            ->select('users.slug as user_slug','users.name','doctors.*')
            ->join('users','doctors.user_id','=','users.id')
            ->where('users.id',Auth::user()->id)
            ->first();

        if(empty(ClinicDoctor::where('doctor_id',$doctorDetails->id)->first())){
            Toastr::error('No Clinic Found','Sorry');
            return redirect()->back();
        }

        $doctorClinics = ClinicDoctor::where('doctor_id',$doctorDetails->id)->get();

        $dates=$this->thirtyDays();
        $days = Day::all();

        $cl_user=Clinic::find($doctorClinics[0]->clinic_id);
        $doctorSchedule=DoctorClinicSchedule::where('doctor_user_id',$doctorDetails->user_id)->where('clinic_user_id',$cl_user->user_id)->where('date',date("d-m-Y"))->get();


        return view('backend.doctor.clinic_schedule.schedule', compact('days','dates','doctorDetails','doctorClinics','doctorSchedule'));
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

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'timing_day_duration' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'clinic_user_id' => 'required',
            'interval_time' => 'required',
            'day_id' => 'required',
        ]);




        if(count($request->start_time)==count($request->end_time)){
            $clinic_id=$request->clinic_user_id;
            $day_id=$request->day_id;
            $days=Day::find($day_id);
            $day=$days->slug;
            $type=$request->timing_day_duration;
            $interval=$request->interval_time;
            $date= date("d-m-Y");


            if($type=="this_day"){
                foreach ($request->start_time as $index=>$start){
                    $schedule=new DoctorClinicSchedule();
                    $schedule->day_id=$day_id;
                    $schedule->doctor_user_id=Auth::id();
                    $schedule->clinic_user_id=$clinic_id;
                    $schedule->date=$date;
                    $schedule->start_time=$start;
                    $schedule->end_time=$request->end_time[$index];
                    $schedule->interval_time=$interval;

                    $start_time=$start;
                    $end_time=$request->end_time[$index];
                    $slots = $this->getTimeSlot($interval, $start_time, $end_time);
                    if($slots[1]['status']=="failed"){
                        Toastr::error('Give Proper Time','Failed');
                        return redirect()->back();
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
                }
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
                    foreach ($request->start_time as $index=>$start){
                        $schedule=new DoctorClinicSchedule();
                        $schedule->day_id=$day_id;
                        $schedule->doctor_user_id=Auth::id();
                        $schedule->clinic_user_id=$clinic_id;
                        $schedule->date=$fdate;
                        $schedule->start_time=$start;
                        $schedule->end_time=$request->end_time[$index];
                        $schedule->interval_time=$interval;

                        $start_time=$start;
                        $end_time=$request->end_time[$index];
                        $slots = $this->getTimeSlot($interval, $start_time, $end_time);
                        if($slots[1]['status']=="failed"){
                            Toastr::error('Give Proper Time','Failed');
                            return redirect()->back();
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
                }
                //dd($future_date);
            }
        }

        Toastr::success('Schedule Created Successfully','Success');
        return redirect()->back();
    }

    public function patientList(){
        $user_appointment_info = DB::table('users')
            ->join('doctor_clinic_schedule_time_slots','users.id','=','doctor_clinic_schedule_time_slots.user_id')
            ->where('doctor_clinic_schedule_time_slots.doctor_user_id', Auth::user()->id)
            ->select('users.id','users.name','users.slug','users.phone')
            ->groupBy('users.id','users.name','users.slug','users.phone')
            ->get();
        //dd($user_appointment_info);

        return view('backend.doctor.patient.patient_list', compact('days','dates','doctorDetails','doctorClinics','doctorSchedule','user_appointment_info'));
    }

        public function patientListToday(){
        $user_appointment_info = DB::table('users')
            ->join('doctor_clinic_schedule_time_slots','users.id','=','doctor_clinic_schedule_time_slots.user_id')
            ->where('doctor_clinic_schedule_time_slots.doctor_user_id', Auth::user()->id)
            ->where('doctor_clinic_schedule_time_slots.date', '=', date('d-m-Y'))
            ->select('users.id','users.name','users.slug','users.phone')
            ->groupBy('users.id','users.name','users.slug','users.phone')
            ->get();
        //dd($user_appointment_info);

        return view('backend.doctor.patient.patient_list', compact('days','dates','doctorDetails','doctorClinics','doctorSchedule','user_appointment_info'));
    }

    public function patientAppointmentList($slug){

        $user_appointment_infos = DB::table('users')
            ->join('doctor_clinic_schedule_time_slots','users.id','=','doctor_clinic_schedule_time_slots.user_id')
            ->leftJoin('orders','doctor_clinic_schedule_time_slots.order_id','=','orders.id')
            ->leftJoin('follow_up_e_prescriptions','doctor_clinic_schedule_time_slots.id','=','follow_up_e_prescriptions.slot_id')
            ->where('users.slug', $slug)
            ->select('users.id as user_id','users.name','users.slug','users.phone','users.blood_group','users.image','doctor_clinic_schedule_time_slots.id as slot_id','doctor_clinic_schedule_time_slots.time','doctor_clinic_schedule_time_slots.date','orders.grand_total','follow_up_e_prescriptions.id as follow_up_e_prescription_id')
            ->get();

//        $user_appointment_prescription_infos = DB::table('follow_up_e_prescriptions')
//            ->join('users','users.id','=','follow_up_e_prescriptions.user_id')
//            ->join('doctor_clinic_schedule_time_slots','users.id','=','doctor_clinic_schedule_time_slots.user_id')
//            ->join('e_prescriptions','follow_up_e_prescriptions.e_prescription_id','=','e_prescriptions.id')
//            ->where('users.slug', $slug)
//            ->select('follow_up_e_prescriptions.id','follow_up_e_prescriptions.date','e_prescriptions.prescription_info')
//            ->groupBy('follow_up_e_prescriptions.id','follow_up_e_prescriptions.date','e_prescriptions.prescription_info')
//            ->get();

        $user_appointment_prescription_infos = DB::table('follow_ups')
            ->join('users','users.id','=','follow_ups.user_id')
            ->join('doctor_clinic_schedule_time_slots','doctor_clinic_schedule_time_slots.id','=','follow_ups.d_c_s_t_slot_id')
            ->where('users.slug', $slug)
            ->select('users.name','doctor_clinic_schedule_time_slots.date as previous_date','doctor_clinic_schedule_time_slots.time','follow_ups.follow_up_date')
            ->get();

        //dd($user_appointment_prescription_infos);

        return view('backend.doctor.patient.patient_appointment_list', compact('days','dates','doctorDetails','doctorClinics','doctorSchedule','user_appointment_infos','user_appointment_prescription_infos'));
    }

    public function prescriptionForm($slug,$slot_id){
        //echo $slug;
        //dd($slot_id);

        return view('backend.doctor.patient.prescription_form', compact('slug','slot_id'));
    }

    public function prescriptionStore(Request $request){

        $user_id = User::where('slug',$request->slug)->pluck('id')->first();
        $check_invoice_no = FollowUpEPrescription::latest()->pluck('invoice')->first();

        if($check_invoice_no){
            $invoice_no = $check_invoice_no + 1;
        }else{
            $invoice_no = 1;
        }

        $row_count = count($request->name);

        $prescription_info = [];
        for($i=0; $i<$row_count; $i++){

            if(!empty($request->morning[$i][0]))
            {
                $morning = $request->morning[$i][0];
            }else{
                $morning = '';
            }

            if(!empty($request->afternoon[$i][0]))
            {
                $afternoon = $request->afternoon[$i][0];
            }else{
                $afternoon = '';
            }

            if(!empty($request->evening[$i][0]))
            {
                $evening = $request->evening[$i][0];
            }else{
                $evening = '';
            }

            if(!empty($request->night[$i][0]))
            {
                $night = $request->night[$i][0];
            }else{
                $night = '';
            }


            $data = [
                'name' => $request->name[$i],
//                'age' => $request->age,
                'quantity' => $request->quantity[$i],
                'days' => $request->days[$i],
                'morning' => $morning,
                'afternoon' => $afternoon,
                'evening' => $evening,
                'night' => $night,
            ];



            array_push($prescription_info,$data);
        }

        $e_prescription = new EPrescription();
        $e_prescription->prescription_info = json_encode($prescription_info);
        $e_prescription->save();
        $insert_id = $e_prescription->id;
        if($insert_id){
            $follow_up_e_prescription = new FollowUpEPrescription();
            $follow_up_e_prescription->user_id=$user_id;
            $follow_up_e_prescription->doctor_user_id=Auth::user()->id;
            $follow_up_e_prescription->e_prescription_id=$insert_id;
            $follow_up_e_prescription->slot_id=$request->slot_id;
//            $follow_up_e_prescription->age=$request->age;
            $follow_up_e_prescription->invoice=$invoice_no;
            $follow_up_e_prescription->date=date('Y-m-d');
            //$follow_up_e_prescription->signature=$request->signature;
            $follow_up_e_prescription->save();

            if($request->follow_up_date){
                $follow_up = new FollowUp();
                $follow_up->user_id = $user_id;
                $follow_up->doctor_user_id = Auth::user()->id;
                $follow_up->follow_up_date = $request->follow_up_date;
                $follow_up->d_c_s_t_slot_id = $request->slot_id;
                $follow_up->save();
            }
        }


        Toastr::success('Successfully Inserted','Success');
        //return redirect()->back();
        return redirect()->route('doctor.patient.appointment.list',$request->slug);
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
            ->where('follow_up_e_prescriptions.id',$id)
            ->select('follow_up_e_prescriptions.user_id','follow_up_e_prescriptions.invoice','follow_up_e_prescriptions.date','e_prescriptions.prescription_info','follow_ups.follow_up_date','users.name','doctor_specialities.name as doctor_speciality_name','orders.grand_total')
            ->first();
        //dd($infos);

        return view('backend.doctor.patient.prescription_view', compact('infos'));
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
            ->where('follow_up_e_prescriptions.id',$id)
            ->select('follow_up_e_prescriptions.user_id','follow_up_e_prescriptions.invoice','follow_up_e_prescriptions.date','e_prescriptions.prescription_info','follow_ups.follow_up_date','users.name','doctor_specialities.name as doctor_speciality_name','orders.grand_total')
            ->first();
        //dd($infos);

        return view('backend.doctor.patient.prescription_invoice_print', compact('infos'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
