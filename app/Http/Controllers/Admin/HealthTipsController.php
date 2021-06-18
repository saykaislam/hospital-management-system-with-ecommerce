<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\User;
use App\HealthTips;
use App\HealthTipsCategory;
use App\Http\Controllers\Controller;
//use App\Http\Middleware\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class HealthTipsController extends Controller
{

    public function index()
    {
        $healthTips = HealthTips::latest()->get();
        return view('backend.admin.health_tips.health_tips_list.index',compact('healthTips'));
    }

    public function create()
    {
        $healthCat = HealthTipsCategory::all();
        $doctor = User::where('role_id',2)->get();
        return view('backend.admin.health_tips.health_tips_list.create',compact('healthCat','doctor'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
        $healthTips = new HealthTips();
        $healthTips->health_tips_category_id = $request->health_tips_category_id;
        $healthTips->doctor_id = $request->doctor_id;
        $healthTips->title = $request->title;
        $healthTips->slug =  Str::slug($request->title);
        $healthTips-> title_bangla = $request->title_bangla;
        $healthTips->contents = $request->contents;
        $healthTips-> content_bangla = $request->content_bangla;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $Mainimg = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for category and upload
            $MainImage = Image::make($image)->resize(258, 172)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/health-tips/' . $Mainimg, $MainImage);
        } else {
            $Mainimg = NULL;
        }
        $healthTips->image = $Mainimg;
        $healthTips->image_alt = $request->image_alt;
        $healthTips->meta_title = $request->meta_title;
        $healthTips->meta_description = $request->meta_description;
        $healthTips->save();
        Toastr::success('Health Tips Created Successfully', 'Success');
        return redirect()->route('admin.health-tips-list.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $healthCat= HealthTipsCategory::all();
        $healthTips= HealthTips::find($id);
        $doctor = User::where('role_id',2)->get();
        return view('backend.admin.health_tips.health_tips_list.edit',compact('healthCat','healthTips','doctor'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);
//        dd($request->title);
        $healthTips = HealthTips::find($id);
        $healthTips->health_tips_category_id = $request->health_tips_category_id;
        $healthTips->doctor_id = $request->doctor_id;
        $healthTips->title = $request->title;
        $healthTips->slug =  Str::slug($request->title);
        $healthTips-> title_bangla = $request->title_bangla;
        $healthTips->contents = $request->contents;
        $healthTips-> content_bangla = $request->content_bangla;
        $image = $request->file('image');

        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $Mainimg = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (Storage::disk('public')->exists('uploads/health-tips/' . $healthTips->image)) {
                Storage::disk('public')->delete('uploads/health-tips/' . $healthTips->image);
            }
//            resize image for category and upload
            $MainImage = Image::make($image)->resize(258, 172)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/health-tips/' . $Mainimg, $MainImage);
        } else {
            $Mainimg = $healthTips->image;
        }
        $healthTips->image = $Mainimg;
        $healthTips->image_alt = $request->image_alt;
        $healthTips->meta_title = $request->meta_title;
        $healthTips->meta_description = $request->meta_description;
        $healthTips->save();
        Toastr::success('Health Tips Edited Successfully', 'Success');
        return redirect()->route('admin.health-tips-list.index');
    }

    public function destroy($id)
    {
        $HealthTips = HealthTips::find($id);
        if (Storage::disk('public')->exists('uploads/health-tips/'.$HealthTips->image)) {
            Storage::disk('public')->delete('uploads/health-tips/'.$HealthTips->image);
        }
        $HealthTips->delete();
        Toastr::success('Service Deleted Successfully Done!');
        return redirect()->route('admin.health-tips-list.index');
    }
}
