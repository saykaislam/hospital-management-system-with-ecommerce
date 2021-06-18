<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\ServiceProvider;
use App\User;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        //$total_doctors = Doctor::all();
        $total_doctors = DB::table('users')
            ->leftJoin('doctors','doctors.user_id','=','users.id')
            ->leftJoin('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
            ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name')
            ->where('users.role_id',2)
            //->where('users.active_inactive_status',1)
            ->get();
        $total_service_providers = ServiceProvider::all();
        $total_users = User::where('role_id',5)->get();
        $total_service_orders = Order::where('order_type','service')->get();
        $total_product_orders = Order::where('order_type','product')->get();
        $total_lab_orders = Order::where('order_type','product')->get();
        $total_clinic_schedule_orders = Order::where('order_type','product')->get();
        return view('backend.admin.dashboard', compact('total_doctors','total_service_providers','total_users','total_service_orders','total_product_orders','total_lab_orders','total_clinic_schedule_orders'));
    }
}
