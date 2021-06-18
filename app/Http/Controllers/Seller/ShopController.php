<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Shop;
use App\Seller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public function index()
    {
        //
    }
    public function ajaxSlugMake($name)
    {
        $data = Str::slug($name);
        return response()->json(['success'=> true, 'response'=>$data]);
    }

    public function shopUpdate()
    {
        $shop_set = Shop::where('user_id',Auth::id())->first();
//        dd(Auth::id());
        return view('backend.seller.shop.create',compact('shop_set'));
    }

    public function store(Request $request)
    {
        $new_shop = Shop::where('user_id',Auth::id())->first();
        $seller = Seller::where('user_id',Auth::id())->first();
        if(empty($new_shop)){
            $shop = new Shop;
            $shop->name = $request->name;
            $shop->slug = Str::slug($request->name).'-'.Auth::id();
            $shop->address = $request->address;
            $shop->city = $request->city;
            $shop->area = $request->area;
            $shop->latitude = $request->latitude;
            $shop->longitude = $request->longitude;
            $shop->user_id = Auth::id();
            $shop->seller_id = $seller->id;
            $shop->about = $request->about;
            $shop->facebook = $request->facebook;
            $shop->google = $request->google;
            $shop->twitter = $request->twitter;
            $shop->youtube = $request->youtube;
            $shop->meta_title = $request->meta_title;
            $shop->meta_description = $request->meta_description;
            $shop->logo = $request->previous_thumbnail_img;
            if($request->hasFile('logo')){
                $shop->logo = $request->logo->store('uploads/shop/logo');
                //ImageOptimizer::optimize(base_path('public/').$product->thumbnail_img);
            }
            $shop->save();

            Toastr::success("Shop Inserted Successfully","Success");
            return redirect()->back();
        }else {
            $new_shop->name = $request->name;
            $new_shop->slug = Str::slug($request->name).'-'.Auth::id();
            $new_shop->address = $request->address;
            $new_shop->city = $request->city;
            $new_shop->area = $request->area;
            $new_shop->latitude = $request->latitude;
            $new_shop->longitude = $request->longitude;
            $new_shop->user_id = Auth::id();
            $new_shop->seller_id = $seller->id;
            $new_shop->about = $request->about;
            $new_shop->facebook = $request->facebook;
            $new_shop->google = $request->google;
            $new_shop->twitter = $request->twitter;
            $new_shop->youtube = $request->youtube;
            $new_shop->meta_title = $request->meta_title;
            $new_shop->meta_description = $request->meta_description;
//        $sliders = array();

            if($request->has('previous_sliders')){
                $sliders = $request->previous_sliders;
            }
            else{
                $sliders = array();
            }

            if($request->hasFile('sliders')){
                foreach ($request->sliders as $key => $slider) {
                    array_push($sliders, $slider->store('uploads/shop/sliders'));
                }
            }

            $new_shop->sliders = json_encode($sliders);

            if($request->hasFile('logo')){
                $new_shop->logo = $request->logo->store('uploads/shop/logo');
                //ImageOptimizer::optimize(base_path('public/').$product->thumbnail_img);
            }
            $new_shop->save();

            Toastr::success("Shop Updated Successfully","Success");
            return redirect()->back();
        }

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
