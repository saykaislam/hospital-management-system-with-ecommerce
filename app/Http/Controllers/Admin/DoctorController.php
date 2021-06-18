<?php

namespace App\Http\Controllers\Admin;

use App\Clinic;
use App\ClinicDoctor;
use App\Doctor;
use App\DoctorSpeciality;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DoctorController extends Controller
{

    public function index()
    {

        //$doctors = Doctor::where('user_id',2)->get();
        //$doctors = Doctor::all();
        //$doctors = Doctor::latest()->get();
        //dd($doctors);

        $doctors = DB::table('users')
            ->leftJoin('doctors','doctors.user_id','=','users.id')
            ->leftJoin('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
            ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name')
            ->where('users.role_id',2)
            //->where('users.active_inactive_status',1)
            ->get();

        return view('backend.admin.doctor_management.doctor.index',compact('doctors'));

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $users = User::all();
        $doctor_departments =DoctorSpeciality::all();
        $doctor = Doctor::find($id);
        return view('backend.admin.doctor_management.doctor.edit',compact('doctor','doctor_departments','users'));
    }


    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
            'title' => 'required',

        ]);
        $doctor =  Doctor::find($id);
        $doctor->doctor_specialities_id = $request->doctor_specialities_id;
        $doctor->user_id = $request->user_id;
        $doctor->title = $request->title;
        $doctor->slug =  Str::slug($request->title);
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

        //echo gettype($doctor).'<br>';

//        var_dump($doctor);
//        die();
        //dd($doctor->is_active);
        $doctor->save();
        return redirect()->route('admin.Doctor.index');
    }


    public function destroy($id)
    {

    }

    public function clinicDoctorList(){
        //$clinicDoctors =ClinicDoctor::all();
        $clinicDoctors =ClinicDoctor::latest()->get();

        return view('backend.admin.doctor_management.clinic_doctor.clinicDoctorList',compact('clinicDoctors'));

    }
}
