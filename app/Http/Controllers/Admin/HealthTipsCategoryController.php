<?php

namespace App\Http\Controllers\Admin;

use App\HealthTipsCategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HealthTipsCategoryController extends Controller
{

    public function index()
    {
        $health_tips_categories = HealthTipsCategory::latest()->get();
        return view('backend.admin.health_tips.health_tips_category.index',compact('health_tips_categories'));
    }

    public function create()
    {
        return view('backend.admin.health_tips.health_tips_category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $health_category = new HealthTipsCategory();
        $health_category->name = $request->name;
        $health_category->slug =  Str::slug($request->name);


        $health_category->save();
        Toastr::success('Health Tips Category Created Successfully','Success');
        return  redirect()->route("admin.health-tips-category.index");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $health_category = HealthTipsCategory::find($id);
        return view('backend.admin.health_tips.health_tips_category.edit',compact('health_category'));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $health_category = HealthTipsCategory::find($id);
        $health_category->name = $request->name;
        $health_category->slug =  Str::slug($request->name);

        //dd($brands);
        $health_category->save();
        Toastr::success('Clinic Updated Successfully','Success');
        return  redirect()->route("admin.health-tips-category.index");
    }

    public function destroy($id)
    {
        HealthTipsCategory::destroy($id);
        Toastr::success('Clinic Deleted Successfully','Success');
        return  redirect()->route("admin.health-tips-category.index");
    }
}
