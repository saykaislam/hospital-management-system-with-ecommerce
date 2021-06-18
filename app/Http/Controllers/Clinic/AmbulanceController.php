<?php

namespace App\Http\Controllers\Clinic;

use App\Ambulance;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmbulanceController extends Controller
{
    public function index()
    {
        $ambulance = Ambulance::where('clinic_id',Auth::user()->id)->latest()->get();
        return view('backend.clinic.ambulance.index',compact('ambulance'));
    }

    public function create()
    {
        return view('backend.clinic.ambulance.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'number' => 'required',
        ]);
        $ambulance = Ambulance::where('clinic_id',Auth::user()->id)->where('number',$request->number)->first();
        if(empty($ambulance)) {
            $amb_new = new Ambulance();
            $amb_new->number = $request->number;
            $amb_new->clinic_id = Auth::user()->id;
            $amb_new->details = $request->details;
            $amb_new->save();
            Toastr::success('Ambulance Created Successfully', 'Success');
            return redirect()->route("clinic.ambulance.index");
        }else {
            $ambulance->number = $request->number;
            $ambulance->details = $request->details;
            $ambulance->update();
            Toastr::success('Ambulance Updated Successfully', 'Success');
            return redirect()->route("clinic.ambulance.index");
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $amb_edt = Ambulance::find($id);
        return view('backend.clinic.ambulance.edit',compact('amb_edt'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'number' => 'required'
        ]);
        $amb_up = Ambulance::find($id);
        $amb_up->number = $request->number;
        $amb_up->details = $request->details;
        $amb_up->save();
        Toastr::success('Ambulance Updated Successfully','Success');
        return  redirect()->route("clinic.ambulance.index");
    }

    public function destroy($id)
    {
        Ambulance::destroy($id);
        Toastr::success('Ambulance Deleted Successfully','Success');
        return  redirect()->route("clinic.ambulance.index");
    }
}
