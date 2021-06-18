<?php

namespace App\Http\Controllers\Admin;

use App\Day;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DayController extends Controller
{
    public function index()
    {
        $days = Day::latest()->get();
        return view('backend.admin.day.index',compact('days'));
    }


    public function create()
    {
        return view('backend.admin.day.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);

        $days = new Day();
        $days-> name = $request->name;
        $days->slug = Str::slug($request->name);
        $days->save();
        Toastr::success('Day Created Successfully', 'Success');
        return redirect()->route('admin.days.index');

    }
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $day = Day::find($id);
        return view('backend.admin.day.edit',compact('day'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);
        //dd($request);
        $day =Day::find($id);
        $day->name = $request->name;
        $day->slug = Str::slug($request->name);
        $day->save();
        Toastr::success('Day Edited Successfully', 'Success');
        return redirect()->route('admin.days.index');
    }

    public function destroy($id)
    {
        $day = Day::find($id);
        $day->delete();
        Toastr::success('Day Deleted Successfully', 'Success');
        return redirect()->back();
    }
}
