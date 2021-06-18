<?php

namespace App\Http\Controllers\Admin;

use App\ClinicCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
class ClinicCategoryController extends Controller
{

    public function index()
    {
        $clinic_categories = ClinicCategory::latest()->get();
        return view('backend.admin.clinic_management.client_category.index',compact('clinic_categories'));
    }

    public function create()
    {
        return view('backend.admin.clinic_management.client_category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $clinic_category = new ClinicCategory();
        $clinic_category->name = $request->name;
        $clinic_category->slug =  Str::slug($request->name);


        $clinic_category->save();
        Toastr::success('Clinic Created Successfully','Success');
        return  redirect()->route("admin.clinicCategory.index");
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $clinic_category = ClinicCategory::find($id);
        return view('backend.admin.clinic_management.client_category.edit',compact('clinic_category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $clinic_category = ClinicCategory::find($id);
        $clinic_category->name = $request->name;
        $clinic_category->slug =  Str::slug($request->name);

        //dd($brands);
        $clinic_category->save();
        Toastr::success('Clinic Created Successfully','Success');
        return  redirect()->route("admin.clinicCategory.index");
    }

    public function destroy($id)
    {
        ClinicCategory::destroy($id);
        Toastr::success('Clinic Deleted Successfully','Success');
        return  redirect()->route("admin.clinicCategory.index");
    }
}
