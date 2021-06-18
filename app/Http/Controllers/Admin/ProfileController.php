<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index(){
        return view('backend.admin.profile.index');
    }
    public function updateProfile(Request $request) {
        $this->validate($request, [
            'name' =>  'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone,'.Auth::id(),
            'email' =>  'required|email|unique:users,email,'.Auth::id(),
        ]);
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for hospital and upload
            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/profile/' . $imagename, $proImage);

        }else {
            $imagename = "default.png";
        }
        $user->image = $imagename;
        $user->save();
        Toastr::success('Admin Profile Updated Successfully','Success');
        return redirect()->back();
    }
    public function updatePassword(Request $request){
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword)) {
                $user = User::find(Auth::id());
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
}
