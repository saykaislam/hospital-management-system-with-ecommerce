<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SliderController extends Controller
{

    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('backend.admin.slider.index',compact('sliders'));
    }

    public function create()
    {
        return view('backend.admin.slider.create');
    }

    public function store(Request $request)
    {
        $slider = new Slider();
        $slider->url = $request->url;
        if($request->hasFile('image')){
            $slider->image = $request->image->store('uploads/slider');
        }
        $slider->save();
        Toastr::success('Slider Created Successfully');
        return redirect()->route('admin.sliders.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('backend.admin.slider.edit',compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);
        $slider->url = $request->url;
        if($request->hasFile('image')){
            $slider->image = $request->image->store('uploads/slider');
        }
        $slider->save();
        Toastr::success('Slider Updated Successfully');
        return redirect()->route('admin.sliders.index');
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        if(Slider::destroy($id)){
            if($slider->image != null){
                unlink($slider->image);
            }
            Toastr::success('Slider Deleted Successfully');
            return redirect()->route('admin.sliders.index');
        }
    }
}
