<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\BusinessSetting;
use App\Seller;
use App\Shop;
use App\Question;
use App\QuestionAnswer;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function registrationStore(Request $request){
        //dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|min:8|numeric',
            'password' => 'required|min:6',
            'role_id' => 'required',
        ]);
        $phn1 = (int)$request->phone;
        $check = User::where('phone',$phn1)->first();
        if (!empty($check)){
            Toastr::error('This phone number already exist');
            return back();
        }

        if($request->countyCodePrefix == +880){
            $phn = (int)$request->phone;
        }else{
            $phn = $request->phone;
        }
        $slug = Str::slug($request->name,'-');
        $drSlugCheck = User::where('slug', $slug)->first();
        if(!empty($drSlugCheck)) {
            $slug = $slug.'-'.Str::random(6);
        }
        $user = new User();
        $user->name = $request->name;
        $user->slug = $slug;
        //$user->role_id = 6;
        //$user->email = $request->email;
        $user->country_code = $request->countyCodePrefix;
        $user->phone = $phn;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
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
//            $shop->name = $request->shop_name;
//            $shop->slug = Str::slug($request->shop_name).'-'.$user->id;
//            $shop->address = $request->address;
//            $shop->city = $request->city;
//            $shop->area = $request->area;
//            $shop->latitude = $request->latitude;
//            $shop->longitude = $request->longitude;
//            if($request->hasFile('logo')){
//                $shop->logo = $request->logo->store('uploads/shop/logo');
//            }
            $shop->save();
        }

        // set value in session
        Session::put('phone',$request->phone);
        Session::put('password',$request->password);
        Session::put('role_id',$request->role_id);
        //dd(Session::get('role_id'));

        Toastr::success('Successfully Registered');
        //return redirect()->back();
        return redirect()->route('get-verification-code',$user->id);
    }

    public function questionStore(Request $request){
        $this->validate($request, [
            'doctor_speciality_id' => 'required',
            'search_title' => 'required',
            'question' => 'required',
        ]);

        $question = new Question();
        $question->doctor_speciality_id = $request->doctor_speciality_id;
        $question->search_title = $request->search_title;
        $question->question = $request->question;
        $question->question_user_id = Auth::user()->id;
        $question->save();

        Toastr::success('Successfully Done');
        return redirect()->back();
    }
}
