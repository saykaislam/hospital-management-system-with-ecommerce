<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Test;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::latest()->get();
        return view('backend.admin.test.index',compact('tests'));
    }


    public function create()
    {
        return view('backend.admin.test.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);

        $tests = new Test();
        $tests->name = $request->name;
        $tests->slug = Str::slug($request->name);
        $tests->regular_price = $request->regular_price;
        $tests->price = $request->price;
        $image = $request->file('image');
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/test/'. $image_name, $proImage);
        }
        else {
            $image_name ='default.jpg';
        }
        $tests->image = $image_name;
        $tests->save();
        Toastr::success('Lab Created Successfully', 'Success');
        return redirect()->route('admin.tests.index');

    }
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $test = Test::find($id);
        return view('backend.admin.test.edit',compact('test'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);
        //dd($request);
        $test =Test::find($id);
        $test->name = $request->name;
        $test->slug = Str::slug($request->name);
        $test->regular_price = $request->regular_price;
        $test->price = $request->price;
        $image = $request->file('image');
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $image_name = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if(Storage::disk('public')->exists('uploads/test/'.$test->image))
            {
                Storage::disk('public')->delete('uploads/test/'.$test->image);
            }
            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/test/' . $image_name, $proImage);
        }
        else {
            $image_name = $test->image;
        }
        $test->image = $image_name;
        $test->save();
        Toastr::success('Test Edited Successfully', 'Success');
        return redirect()->route('admin.tests.index');
    }

    public function destroy($id)
    {
        $test = Test::find($id);
        if(Storage::disk('public')->exists('uploads/test/'.$test->image))
        {
            Storage::disk('public')->delete('uploads/test/'.$test->image);
        }
        $test->delete();
        Toastr::success('Test Deleted Successfully', 'Success');
        return redirect()->back();
    }
}
