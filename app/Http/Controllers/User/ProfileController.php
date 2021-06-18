<?php

namespace App\Http\Controllers\User;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        return view('backend.user.profile');
    }
    public function editProfile(Request $request ,$id)
    {
        $doctorDetails = Doctor::find($id);
        return view('backend.user.profile',compact('doctorDetails'));
    }
    public function changedPassword(){
        return view('backend.user.updatePassword');
    }
    public function updatePassword(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        // dd($hashedPassword);
        if (Hash::check($request->old_password, $hashedPassword)) {
            //dd('okk');
            if (!Hash::check($request->password, $hashedPassword)) {
                $user = \App\User::find(Auth::id());
                //dd($user);
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Updated Successfully','Success');
                Auth::logout();
                return redirect()->route('login');
            } else {
                Toastr::error('New password cannot be the same as old password.', 'Error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Current password not match.', 'Error');
            return redirect()->back();
        }
    }

    public function userBasicUpdate(Request $request){

        //dd($request->all());
        $this->validate($request, [
            'email' => 'required',
        ]);
        $empty_check = $request->email;

        if(!empty($empty_check)){
            $user_id = $request->user_id;
            $user = User::find($user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $image = $request->file('image');
            if (isset($image)) {
                //make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                //delete old image.....
                if(Storage::disk('public')->exists('uploads/profile_pic/user/'.$user->image))
                {
                    Storage::disk('public')->delete('uploads/profile_pic/user/'.$user->image);
                }

//            resize image for hospital and upload
                $proImage = Image::make($image)->resize(100, 100)->save($image->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/profile_pic/user/'. $imagename, $proImage);

            }else {
                $imagename= $user->image;
            }
            $user->image = $imagename;
            $user->save();
//dd($user_id);
            Toastr::success('Successfully Updated.', 'Success');
        }
        return redirect()->back();
    }
}
