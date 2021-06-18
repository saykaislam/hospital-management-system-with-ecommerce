<?php

namespace App\Http\Controllers\Admin;

use App\Clinic;
use App\ClinicVerification;
use App\Http\Controllers\Controller;
use App\ServiceProvider;
use App\ServiceProviderContact;
use App\ServiceProviderCost;
use App\ServiceProviderEducation;
use App\ServiceProviderExperience;
use App\ServiceProviderVerification;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserListController extends Controller
{
    public function serviceProviderList(){
        //$users = User::where('role_id' ,4)->get();
        //dd($serviceProviderLists);
        //$serviceProviders =ServiceProvider::all();
        $serviceProviders =ServiceProvider::latest()->get();
        //dd($serviceProviders);
        return view('backend.admin.userList.serviceProviderList',compact('serviceProviders'));

    }

    public function verificationImageList(){

        //$serviceProviderVerifications =ServiceProviderVerification::all();
        $serviceProviderVerifications =ServiceProviderVerification::latest()->get();
        //dd($serviceProviders);
        return view('backend.admin.userList.serviceProviderVerification',compact('serviceProviderVerifications'));

    }
    public function userList(){
        $userLists = User::where('role_id' ,5)->latest()->get();
        return view('backend.admin.userList.userList',compact('userLists'));

    }
    public function profileShow($id){
        $userInfo = User::find(decrypt($id));
//        if($userInfo->view == 0){
//            $userInfo->view = 1;
//            $userInfo->save();
//        }
        return view('backend.admin.userList.profile', compact('userInfo'));
    }

    public function profileUpdate(Request $request, $id){
        $this->validate($request, [
            'name' =>  'required',
            'email' =>  'required|email|unique:users,email,'.$id,
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        Toastr::success('User Profile Updated Successfully','Success');
        return redirect()->back();
    }

    public function passwordUpdate(Request $request, $id){
        $this->validate($request, [
            'password' =>  'required|confirmed|min:6',
        ]);
        if ($request->password == $request->password_confirmation){
            $user =  User::find($id);
            $user->password = Hash::make($request->password);
            $user->save();
            Toastr::success('User password Updated Successfully');
            return redirect()->back();
        }else{
            Toastr::error('Current Password does not match');
            return redirect()->back();
        }
    }
    public function banUser($id) {
        $user = User::findOrFail($id);
        $user->banned = 1;
        $user->save();
        Toastr::success('User Baned ', 'Success');
        return redirect()->back();
    }

    public function serviceProviderDetail($id){

        $serviceProviderDetails = ServiceProvider::find($id);
        $serviceProviderContacts = ServiceProviderContact::find($id);
        $serviceProviderCost = ServiceProviderCost::where('service_provider_id',$id)->first();
        $serviceProviderExperiences = ServiceProviderExperience::where('service_provider_id',$id)->get();
        $serviceProviderEducations = ServiceProviderEducation::where('service_provider_id',$id)->get();
        //dd($serviceProviderCost);
        return view('backend.admin.userList.serviceProviderDetails',compact('serviceProviderDetails','serviceProviderCost','serviceProviderExperiences','serviceProviderContacts','serviceProviderEducations'));
    }

    public function clinicList(){
        //$clinics =Clinic::all();
        $clinics =Clinic::latest()->get();

        return view('backend.admin.userList.clinicList',compact('clinics'));

    }

    public function vendorList(){
        $vendorLists = User::where('role_id' ,6)->latest()->get();
        return view('backend.admin.userList.vendorList',compact('vendorLists'));

    }

    public function clinicVerificationImageList(){

        //$clinicVerifications =ClinicVerification::all();
        $clinicVerifications =ClinicVerification::latest()->get();
        //dd($serviceProviders);

        return view('backend.admin.userList.clinicVerification',compact('clinicVerifications'));

    }

    public function clinicDetail($id){

        $clinicDetails = Clinic::find($id);
        $verification = ClinicVerification::where('id',1)->first();

        return view('backend.admin.userList.clinicDetails',compact('clinicDetails','verification'));
    }

    public function service_provider_active_inactive_status(Request $request)
    {
        $user= User::find($request->user_id);
        $user->active_inactive_status=$request->status;
        $user->update();

        return redirect()->route('admin.serviceProvider-list');
    }

    public function clinic_active_inactive_status(Request $request)
    {
        $user= User::find($request->user_id);
        $user->active_inactive_status=$request->status;
        $user->update();

        return redirect()->route('admin.clinic-list');
    }

    public function doctor_active_inactive_status(Request $request)
    {
        $user= User::find($request->user_id);
        $user->active_inactive_status=$request->status;
        $user->update();

        return redirect()->route('admin.Doctor.index');
    }
    public function topRatedUsers(){
        $customers = DB::table('users')
            ->join('orders','users.id','=','orders.user_id')
            ->select('orders.user_id',DB::raw('COUNT(orders.id) as total_orders'))
            ->groupBy('orders.user_id')
            ->orderBy('total_orders', 'DESC')
            ->get();
//        dd($customers);
        return view('backend.admin.userList.top_rated_users',compact('customers'));
    }
}
