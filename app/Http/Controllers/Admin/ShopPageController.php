<?php

namespace App\Http\Controllers\Admin;

use App\ShopPage;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShopPageController extends Controller
{

    public function index()
    {
        $shop_pages = ShopPage::latest()->get();
        return view('backend.admin.shop_pages.index',compact('shop_pages'));
    }


    public function create()
    {
        return view('backend.admin.shop_pages.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'description'=> 'required',
        ]);
        $shop_page = new ShopPage();
        $shop_page->name = $request->name;
        $shop_page->slug = Str::slug($request->name);
        $shop_page->description = $request->	description;
        $shop_page->meta_title = strip_tags($request->meta_title);
        $shop_page->meta_title = strip_tags($request->meta_title);
        $shop_page->meta_description = strip_tags($request->meta_description);
        $shop_page->save();
        Toastr::success('Shop Page Created Successfully', 'Success');
        return redirect()->route('admin.shop_pages.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $shop_page = ShopPage::find($id);
        return view('backend.admin.shop_pages.edit',compact('shop_page'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            //'name'=> 'required',
            'description'=> 'required',

        ]);
        $shop_page = ShopPage::find($id);
        $shop_page->description = $request->	description;
        $shop_page->meta_title = strip_tags($request->meta_title);
        $shop_page->meta_title = strip_tags($request->meta_title);
        $shop_page->meta_description = strip_tags($request->meta_description);
        $shop_page->save();
        Toastr::success('Shop Page Updated Successfully', 'Success');
        return redirect()->route('admin.shop_pages.index');
    }

    public function destroy($id)
    {
        ShopPage::destroy($id);
        Toastr::success('Shop Page Deleted Successfully');
        return redirect()->route('admin.shop_pages.index');

    }
}
