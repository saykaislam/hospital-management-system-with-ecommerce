<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\UserInfo;
use App\Http\Controllers\Controller;
use App\Password_Reset_Code;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    protected $redirectTo;

    protected function redirectTo() {
        if (Auth::check() && Auth::user()->role_id == 1) {
            //dd('okk');
            Toastr::success('Successfully Logged In',"Success");
            return $this->redirectTo = route('admin.dashboard');
        }
        elseif (Auth::check() && Auth::user()->role_id == 2) {
            Toastr::success('Successfully Logged In',"Success");
            return $this->redirectTo = route('doctor.dashboard');
        }
        elseif (Auth::check() && Auth::user()->role_id == 3) {
            Toastr::success('Successfully Logged In',"Success");
            return $this->redirectTo = route('clinic.dashboard');
        }
        elseif (Auth::check() && Auth::user()->role_id == 4) {
            Toastr::success('Successfully Logged In',"Success");
            return $this->redirectTo = route('service_provider.dashboard');
        }
        elseif (Auth::check() && Auth::user()->role_id == 5) {
            Toastr::success('Successfully Logged In',"Success");
            return $this->redirectTo = route('user.dashboard');
        }
        elseif (Auth::check() && Auth::user()->role_id == 6) {
            Toastr::success('Successfully Logged In',"Success");
            return $this->redirectTo = route('seller.dashboard');
        }
        else {
            //return('/login');
            return('/');
        }
    }

    public function username()
    {
        return 'phone';
    }
    protected function credentials(Request $request)
    {
        //dd($request->all());
        //return $request->only($this->username(), 'password');
        return ['phone' => $request->get('phone'), 'password'=>$request->get('password'),'status'=>1];
    }


    public function reset_pass_check_mobile(Request $request) {
        $user=\App\User::where('phone',$request->phone)->first();
        if(!empty($user)){

            $verification =Password_Reset_Code::where('phone',$user->phone)->first();
            if (!empty($verification)){
                $verification->delete();
            }
            $verCode = new Password_Reset_Code();
            $verCode->phone = $user->phone;
            $verCode->code = mt_rand(1111,9999);
            $verCode->status = 0;
            $verCode->save();
            $text = "Dear ".$user->name.", Your Password Reset Verification Code is ".$verCode->code;
            UserInfo::smsAPI("88".$verCode->phone,$text);
            $type="found";
            return response()->json(['status'=>$user , 'type'=>$type]);
        }else{
            $content="oops!! No User Found With This Phone Number.Please Sign Up First.";
            $type="Not_found";
            return response()->json(['status'=>$content , 'type'=>$type]);
        }
    }

    public function reset_pass(Request $request) {
        $this->validate($request, [
            'newPassword' =>  'required|min:6',
        ]);
        $verification = \App\Password_Reset_Code::where('phone',$request->phone)->where('code',$request->code)->first();
        if (!empty($verification)){
            $user=\App\User::where('phone',$request->phone)->first();
//                $rand_pass= mt_rand(111111,999999);
            $new_pass=Hash::make($request->newPassword);
            $user->password=$new_pass;
            $user->update();
            $verification->status = 1;
            $verification->update();
//                $text = "Dear ".$user->name.", Your New Password is ".$rand_pass.".Please Change Password from Profile Edit";
//                UserInfo::smsAPI("0".$user->phone,$text);

            Toastr::success('Password Changed' ,'Success');
            return redirect()->route('login');
        }else{
            Toastr::success('Wrong Code' ,'error');
            $phone=$request->phone;
            return view('frontend.pages.reset_pass',compact('phone'));
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


}
