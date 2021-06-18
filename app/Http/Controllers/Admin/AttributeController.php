<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Attribute;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();
        return view('backend.admin.attributes.index', compact('attributes'));
        //return view('backend.admin.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('backend.admin.attributes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required|unique:attributes,name',
        ]);

        $attibute = new Attribute();
        $attibute->name = $request->name;
        $attibute->save();
        Toastr::success('Attribute Added Successfully Done!!');
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $attribute = Attribute::find($id);
        return view('backend.admin.attributes.edit', compact('attribute'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=> 'required|unique:attributes,name,'.$id,
        ]);

        $attibute = Attribute::find($id);
        $attibute->name = $request->name;
        $attibute->save();
        Toastr::success('Attribute Updated Successfully Done!!');
        return back();
    }

    public function destroy($id)
    {
        Attribute::find($id)->delete();
        Toastr::success('Attribute Deleted Successfully Done!!');
        return back();
    }
}
