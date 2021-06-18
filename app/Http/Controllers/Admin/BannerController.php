<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Controllers\Controller;
use App\ServiceProviderCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function index()
    {
        //$banners = Banner::all();
        $banners = Banner::latest()->get();
        //dd($banners);

        return view('backend.admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('backend.admin.banner.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required'
        ]);

        $banner = new Banner();
        // image 1
        $image_1 = $request->file('image_1');
        if (isset($image_1)) {
            //make unique name for image
            $currentDate_1 = Carbon::now()->toDateString();
            $image_name_1 = $currentDate_1 . '-' . uniqid() . '.' . $image_1->getClientOriginalExtension();
//            resize image for service category and upload
            $proImage_1 = Image::make($image_1)->resize(300, 168)->save($image_1->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/banner/'. $image_name_1, $proImage_1);

        }
        else {
            $image_name_1 ='default.jpg';
        }

        // image 2
        $image_2 = $request->file('image_2');
        if (isset($image_2)) {
            //make unique name for image
            $currentDate_2 = Carbon::now()->toDateString();
            $image_name_2 = $currentDate_2 . '-' . uniqid() . '.' . $image_2->getClientOriginalExtension();
//            resize image for service category and upload
            $proImage_2 = Image::make($image_2)->resize(300, 168)->save($image_2->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/banner/'. $image_name_2, $proImage_2);

        }
        else {
            $image_name_2 ='default.jpg';
        }

        // image 3
        $image_3 = $request->file('image_3');
        if (isset($image_3)) {
            //make unique name for image
            $currentDate_3 = Carbon::now()->toDateString();
            $image_name_3 = $currentDate_3 . '-' . uniqid() . '.' . $image_3->getClientOriginalExtension();
//            resize image for service category and upload
            $proImage_3 = Image::make($image_3)->resize(300, 168)->save($image_3->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/banner/'. $image_name_3, $proImage_3);

        }
        else {
            $image_name_3 ='default.jpg';
        }

        $banner->image_1 = $image_name_1;
        $banner->image_2 = $image_name_2;
        $banner->image_3 = $image_name_3;
        $banner->title = $request->title;
        $banner->sub_title = $request->sub_title;
        $banner->save();

        Toastr::success('Banner Created Successfully','Success');
        return  redirect()->route("admin.banner.index");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $banner = Banner::find($id);

        return view('backend.admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
//        $this->validate($request, [
//            'image' => 'required'
//        ]);

        $banner = Banner::find($id);

        // image 1
        $image_1 = $request->file('image_1');
        if (isset($image_1)) {
            //make unique name for image
            $currentDate_1 = Carbon::now()->toDateString();
            $image_name_1 = $currentDate_1 . '-' . uniqid() . '.' . $image_1->getClientOriginalExtension();
//            resize image for service category and upload
            $proImage_1 = Image::make($image_1)->resize(300, 168)->save($image_1->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/banner/'. $image_name_1, $proImage_1);

        }
        else {
            $image_name_1 =$banner->image_1;
        }
        $banner->image_1 = $image_name_1;

        // image 2
        $image_2 = $request->file('image_2');
        if (isset($image_2)) {
            //make unique name for image
            $currentDate_2 = Carbon::now()->toDateString();
            $image_name_2 = $currentDate_2 . '-' . uniqid() . '.' . $image_2->getClientOriginalExtension();
//            resize image for service category and upload
            $proImage_2 = Image::make($image_2)->resize(300, 168)->save($image_2->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/banner/'. $image_name_2, $proImage_2);

        }
        else {
            $image_name_2 =$banner->image_2;
        }
        $banner->image_2 = $image_name_2;

        // image 3
        $image_3 = $request->file('image_3');
        if (isset($image_3)) {
            //make unique name for image
            $currentDate_3 = Carbon::now()->toDateString();
            $image_name_3 = $currentDate_3 . '-' . uniqid() . '.' . $image_3->getClientOriginalExtension();
//            resize image for service category and upload
            $proImage_3 = Image::make($image_3)->resize(300, 168)->save($image_3->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/banner/'. $image_name_3, $proImage_3);

        }
        else {
            $image_name_3 =$banner->image_3;
        }
        $banner->image_3 = $image_name_3;

        $banner->title = $request->title;
        $banner->sub_title = $request->sub_title;
        $banner->update();

        Toastr::success('Banner Updated Successfully','Success');
        return  redirect()->route("admin.banner.index");
    }

    public function destroy($id)
    {
        $banner =   Banner::find($id);
        if(Storage::disk('public')->exists('uploads/banner/'.$banner->image))
        {
            Storage::disk('public')->delete('uploads/banner/'.$banner->image);

        }
        $banner->delete();

        Toastr::success('Banner Deleted Successfully', 'Success');
        return redirect()->back();
    }
}
