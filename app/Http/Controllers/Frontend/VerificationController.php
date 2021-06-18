<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\UserInfo;
use App\User;
use App\VerificationCode;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VerificationController extends Controller
{
    public function getVerificationCode($id)
    {
        $user = User::find($id);

        $verification = VerificationCode::where('phone',$user->phone)->first();
        if (!empty($verification)){
            $verification->delete();
        }
        $verCode = new VerificationCode();
        $verCode->phone = $user->phone;
        $verCode->code = mt_rand(1111,9999);
        $verCode->status = 0;
        $verCode->save();
        $text = "Dear ".$user->name.", Your Prevent Care OTP is ".$verCode->code;
//        echo $text;exit();
        UserInfo::smsAPI("88".$verCode->phone,$text);
        Toastr::success('Thank you for your registration. We send a verification code in your mobile number. please verify your phone number.' ,'Success');
        //$verCode = $verCode->phone;
        //dd($text);
        return view('frontend.pages.verification',compact('verCode'));
    }

    public function verification(Request $request){
        if ($request->isMethod('post')){
            $check = VerificationCode::where('code',$request->code)->where('phone',$request->phone)->where('status',0)->first();
            if (!empty($check)) {
                $check->status = 1;
                $check->update();
                $user = User::where('phone',$request->phone)->first();
                $user->status = 1;
                $user->banned = 0;
                $user->save();
                Toastr::success('Your phone number successfully verified.' ,'Success');
                /*return redirect('login');*/
                $credentials = [
                    'phone' => Session::get('phone'),
                    'password' => Session::get('password'),
                    'role_id' => Session::get('role_id'),
                ];

                if (Auth::attempt($credentials)) {
                    Session::forget('phone');
                    Session::forget('password');
                    if (Session::get('role_id') == 2)
                    {
                        return redirect()->route('doctor.dashboard');
                    }
                    elseif (Session::get('role_id') == 3)
                    {
                        return redirect()->route('clinic.dashboard');
                    }
                    elseif (Session::get('role_id') == 4)
                    {
                        return redirect()->route('service_provider.dashboard');
                    }
                    elseif (Session::get('role_id') == 5)
                    {
                        return redirect()->route('user.dashboard');
                    }
                    elseif (Session::get('role_id') == 6)
                    {
                        return redirect()->route('seller.dashboard');
                    }
                }else{
                    die('no auth');
                }
            }else{
                //$verCode = $request->phone;
                $verCode = VerificationCode::where('phone',$request->phone)->where('status',0)->first();
                Toastr::error('Invalid Code' ,'Error');
                return view('frontend.pages.verification',compact('verCode'));
            }
        }
    }

    public function CheckVerificationCode(Request $request){
        //echo 'okk';
        //echo Session::get('phone');
        $check = VerificationCode::where('code', $request->code)->where('phone', Session::get('phone'))->where('status', 0)->first();
        //dd($check);
        //$users = User::where('bp_code',$request->bp_code)->pluck('id')->first();
        if(!empty($check)){
            echo 'found';
        }else{
            echo 'not found';
        }
    }
}
