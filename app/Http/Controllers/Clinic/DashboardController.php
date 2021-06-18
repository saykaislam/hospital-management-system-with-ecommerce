<?php

namespace App\Http\Controllers\Clinic;

use App\Clinic;
use App\ClinicDoctor;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.clinic.dashboard');
    }

    public function clinicDoctorList()
    {
        //dd(Auth::user()->id);
        $clinic_user_id = Clinic::where('user_id',Auth::user()->id)->pluck('id')->first();
        //dd($clinic_user_id);
        $clinicDoctors = DB::table('clinic_doctors')
            ->join('doctors','clinic_doctors.doctor_id','=','doctors.id')
            ->join('users','doctors.user_id','=','users.id')
            ->join('doctor_speciality_doctors','clinic_doctors.doctor_id','=','doctor_speciality_doctors.doctor_id')
            ->join('doctor_specialities','doctor_specialities.id','=','doctor_speciality_doctors.doctor_speciality_id')
            ->where('clinic_doctors.clinic_id',$clinic_user_id)
            ->select('clinic_doctors.visit_cost','users.name as doctor_name','doctor_specialities.name')
            ->get();

        //dd($clinicDoctors);
        return view('backend.clinic.doctor.index', compact('clinicDoctors'));
    }
    public function clinicDoctorCreate(){
        return view('backend.clinic.doctor.create');
    }
    public function clinicDoctorStore(Request $request){
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|min:8|numeric',
            'password' => 'required|min:6',
        ]);
//        $doctor = User::where('clinic_id',Auth::user()->id)->where('number',$request->number)->first();
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role_id = 2;
        $user->status = 1;
        $user->save();
        Toastr::success('Doctor Added Successfully!', 'Success');
//        $credential = [
//            'name' => $request->name,
//            'phone' => $request->phone,
//            'password' => $request->password,
//        ];
//        if (Auth::attempt($credential)) {
//            return redirect()->route('clinic.doctor.list');
//        }

        return redirect()->back();

    }


}
