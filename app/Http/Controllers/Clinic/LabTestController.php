<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\LabTest;
use App\Test;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LabTestController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;

        $labTests = LabTest::where('clinic_or_lab_user_id', $user_id)->latest()->get();
        return view('backend.clinic.lab_test.index',compact('labTests'));
    }


    public function create()
    {
        $tests = Test::latest()->get();
        $labTests = LabTest::latest()->get();

        return view('backend.clinic.lab_test.create',compact('tests','labTests'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'test'=>'required',
        ]);

        $user_id = Auth::user()->id;
        $row_count = count($request->test);

        for($i=0; $i < $row_count; $i++){
            $lab_test_id = LabTest::where('clinic_or_lab_user_id', $user_id)->where('test_id', $request->test[$i])->pluck('id')->first();
            if($lab_test_id){
                $labTest = LabTest::find($lab_test_id);
                $labTest->lab_test_regular_price = $request->lab_test_regular_price[$i];
                $labTest->lab_test_price = $request->lab_test_price[$i];
                $labTest->save();
            }else{
                $labTest = new LabTest();
                $labTest->clinic_or_lab_user_id = Auth::user()->id;
                $labTest->test_id = $request->test[$i];
                $labTest->lab_test_regular_price = $request->lab_test_regular_price[$i];
                $labTest->lab_test_price = $request->lab_test_price[$i];
                $labTest->save();
            }
        }

        Toastr::success('Lab Test Created Successfully', 'Success');
        return redirect()->route('clinic.labTest.index');

    }
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $labTest = LabTest::find($id);
        return view('backend.clinic.lab_test.edit',compact('labTest'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);

        $labTest =LabTest::find($id);
        $labTest->name = $request->name;
        $labTest->slug = Str::slug($request->name);
        $labTest->lab_test_regular_price = $request->lab_test_regular_price;
        $labTest->lab_test_price = $request->lab_test_price;
        $labTest->save();
        Toastr::success('Lab Test Edited Successfully', 'Success');
        return redirect()->route('clinic.labTest.index');
    }

    public function destroy($id)
    {
        $labTest = LabTest::find($id);
        $labTest->delete();
        Toastr::success('Test Deleted Successfully', 'Success');
        return redirect()->back();
    }
}
