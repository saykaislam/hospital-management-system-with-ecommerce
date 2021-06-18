<?php

namespace App\Http\Controllers\Admin;


use App\DoctorSpeciality;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DoctorSpecialityController extends Controller
{

    public function index()
    {
        $doctor_departments = DoctorSpeciality::latest()->get();
        return view('backend.admin.doctor_management.doctor_speciality.index',compact('doctor_departments'));
    }


    public function create()
    {
        return view('backend.admin.doctor_management.doctor_speciality.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $doctor_departments = new DoctorSpeciality();
        $doctor_departments->name = $request->name;
        $doctor_departments->slug =  Str::slug($request->name);

        //dd($brands);
        $doctor_departments->save();
        Toastr::success('Doctor Speciality Created Successfully','Success');
        return  redirect()->route("admin.DoctorSpeciality.index");
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $doctor_departments = DoctorSpeciality::find($id);
        return view('backend.admin.doctor_management.doctor_speciality.edit',compact('doctor_departments'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $doctor_departments =  DoctorSpeciality::find($id);
        $doctor_departments->name = $request->name;
        $doctor_departments->slug =  Str::slug($request->name);

        //dd($brands);
        $doctor_departments->save();
        Toastr::success('Doctor Speciality Created Successfully','Success');
        return  redirect()->route("admin.DoctorSpeciality.index");
    }


    public function destroy($id)
    {
        DoctorSpeciality::destroy($id);
        Toastr::success('Doctor Speciality Deleted Successfully','Success');
        return  redirect()->route("admin.DoctorSpeciality.index");
    }
}
