<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShopController extends Controller
{

    public function index()
    {
        $shop_set = Shop::where('user_id',Auth::id())->first();
//        dd(Auth::id());
        return view('backend.admin.shop.create',compact('shop_set'));
    }

    public function make_slug($string)
    {
        return preg_replace('/\s+/u', '-', trim($string));
    }

    public function ajaxSlugMake($name)
    {
        $data = Str::slug($name);
        return response()->json(['success'=> true, 'response'=>$data]);
    }

    public function dataUpdate($data)
    {
        $shop_set = Shop::where('user_id',Auth::id())->first();
//        dd(Auth::id());
        return view('backend.admin.shop.create',compact('shop_set'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

        if($request->shop_id == null){
            $shop = new Shop();
            $shop->name = $request->name;
            $shop->user_id = Auth::id();
            $shop->seller_id = Auth::id();
            $shop->slug = $this->make_slug($request->name);
            $shop->about = $request->about;
            $shop->address = $request->address;
            $shop->city = $request->city;
            $shop->area = $request->area;
            $shop->shipping_time = $request->shipping_time;
            $shop->facebook = $request->facebook;
            $shop->google = $request->google;
            $shop->twitter = $request->twitter;
            $shop->youtube = $request->youtube;
            $shop->meta_title = $request->meta_title;
            $shop->meta_description = $request->meta_description;
            if($request->hasFile('logo')){
                $shop->logo = $request->logo->store('uploads/shop/logo');
                //ImageOptimizer::optimize(base_path('public/').$product->thumbnail_img);
            }
            $shop->save();
        }else{
            $shop = Shop::where('user_id',Auth::id())->first();
            $shop->name = $request->name;
            $shop->user_id = Auth::id();
            $shop->seller_id = Auth::id();
            $shop->slug = $this->make_slug($request->name);
            $shop->about = $request->about;
            $shop->address = $request->address;
            $shop->city = $request->city;
            $shop->area = $request->area;
            $shop->shipping_time = $request->shipping_time;
            $shop->facebook = $request->facebook;
            $shop->google = $request->google;
            $shop->twitter = $request->twitter;
            $shop->youtube = $request->youtube;
            $shop->meta_title = $request->meta_title;
            $shop->meta_description = $request->meta_description;
            if($request->hasFile('logo')){
                $shop->logo = $request->logo->store('uploads/shop/logo');
                //ImageOptimizer::optimize(base_path('public/').$product->thumbnail_img);
            }
            $shop->save();
        }


        Toastr::success("Shop Inserted Successfully","Success");
        return redirect()->back();

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
