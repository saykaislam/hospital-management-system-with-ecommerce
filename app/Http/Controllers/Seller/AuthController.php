<?php

namespace App\Http\Controllers\Seller;

use App\BusinessSetting;
use App\Http\Controllers\Controller;
use App\Seller;
use App\Shop;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function ShowRegForm(){
        return view('auth.seller.register');
    }
    public function store(Request $request){
        $this->validate($request, [
            'name' =>  'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users',
            'email' =>  'required|email|unique:users,email',
            'password' =>  'required|min:6',
        ]);
//        $user = new User;
//        $user->name = $request->name;
//        $user->email = $request->email;
//        $user->phone = $request->phone;
//        $user->role_id = 6;
//        $user->banned = 1;
//        $user->password = Hash::make($request->password);
//        $user->save();
//        $defaultCommissionPercent = BusinessSetting::where('type', 'seller_commission')->first();
//        $seller = new Seller();
//        $seller->user_id = $user->id;
//        $seller->commission = $defaultCommissionPercent->value;
//        $seller->save();
//
//        Session::put('phone',$user->phone);
//        Session::put('password',$user->password);
//        Session::put('role_id', 6);


        $phn1 = (int)$request->phone;
        $check = User::where('phone',$phn1)->first();
        if (!empty($check)){
            Toastr::error('This phone number already exist');
            return back();
        }

        $slug = Str::slug($request->name,'-');
        $drSlugCheck = User::where('slug', $slug)->first();
        if(!empty($drSlugCheck)) {
            $slug = $slug.'-'.Str::random(6);
        }
        $user = new User();
        $user->name = $request->name;
        $user->slug = $slug;
        $user->email = $request->email;
        $user->country_code = "+880";
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role_id = 6;
        $user->banned = 1;
        $user->status = 0;
        $user->active_inactive_status = 0;
        $user->save();

        $defaultCommissionPercent = BusinessSetting::where('type', 'seller_commission')->first();
        $seller = new Seller;
        $seller->user_id = $user->id;
        $seller->commission = $defaultCommissionPercent->value;
        $seller->save();

        if(Shop::where('user_id', $user->id)->first() == null){
            $shop = new Shop;
            $shop->user_id = $user->id;
            $shop->seller_id = $seller->id;
            $shop->name = $request->shop_name;
            $shop->slug = Str::slug($request->shop_name).'-'.$user->id;
            $shop->save();
        }

        // set value in session
        Session::put('phone',$request->phone);
        Session::put('password',$request->password);
        Session::put('role_id',6);


        Toastr::success('Successfully Registered!');
        return redirect()->route('get-verification-code',$user->id);
    }
    public function sellerLoginForm(){
        return view('auth.seller.login');
    }
}
