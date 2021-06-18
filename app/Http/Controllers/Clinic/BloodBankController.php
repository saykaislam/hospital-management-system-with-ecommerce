<?php

namespace App\Http\Controllers\Clinic;

use App\Blood;
use App\BloodBank;
use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BloodBankController extends Controller
{
    public function index()
    {
//        dd('abc');
        $bloods = BloodBank::where('clinic_id',Auth::id())->latest()->get();
        return view('backend.clinic.blood_bank.index',compact('bloods'));
    }

    public function create()
    {
        return view('backend.clinic.blood_bank.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'quantity' => 'required'
        ]);

        $blood = BloodBank::where('clinic_id',Auth::id())->where('name',$request->name)->first();
        if(empty($blood)){
            $blood_new = new BloodBank();
            $blood_new-> name = $request->name;
            $blood_new-> clinic_id = Auth::id();
            $blood_new-> quantity = $request->quantity;
            $blood_new->save();
            Toastr::success('Blood Bank Created Successfully','Success');
            return  redirect()->route("clinic.blood-bank.index");
        }else{
            $blood->quantity = $request->quantity;
            $blood->update();
            Toastr::success('Blood Bank Updated Successfully','Success');
            return  redirect()->route("clinic.blood-bank.index");
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $blood_edt = BloodBank::find($id);
        return view('backend.clinic.blood_bank.edit',compact('blood_edt'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'quantity' => 'required'
        ]);
        $blood_up = BloodBank::find($id);
        $blood_up->quantity = $request->quantity;

//        dd($blood_up);
        $blood_up->save();
        Toastr::success('Blood Bank Updated Successfully','Success');
        return  redirect()->route("clinic.blood-bank.index");
    }

    public function destroy($id)
    {
        BloodBank::destroy($id);
        Toastr::success('Blood Bank Deleted Successfully','Success');
        return  redirect()->route("clinic.blood-bank.index");
    }
}
