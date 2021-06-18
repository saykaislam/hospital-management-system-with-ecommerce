<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Order;
use App\ServiceProvider;
use App\ServiceProviderContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        //$all_orders = Order::where('order_type','service')->where('service_provider_id',Auth::user()->id)->get();
        $all_orders = DB::table('orders')
            ->join('service_providers','orders.service_provider_id','=','service_providers.id')
            ->where('orders.order_type','service')
            ->where('service_providers.user_id',Auth::user()->id)
            ->where('orders.service_provider_permission',1)
            ->get();

        $today_orders = DB::table('orders')
            ->select('orders.id','orders.order_type','orders.shipping_address','orders.invoice_code','orders.grand_total','orders.payment_status','orders.payment_type','orders.delivery_cost','orders.delivery_status','orders.view','orders.service_provider_permission')
            ->join('service_providers','orders.service_provider_id','=','service_providers.id')
            ->where('orders.order_type','service')
            ->where('service_providers.user_id',Auth::user()->id)
            ->where('orders.service_provider_permission',1)
            ->where('orders.created_at','>=',date('Y-m-d 00:00:00'))
            ->where('orders.created_at','<=',date('Y-m-d 11:59:59'))
            ->orderBy('orders.id','desc')
            ->get();

        $booking_orders = DB::table('orders')
            ->select('orders.id','orders.order_type','orders.shipping_address','orders.invoice_code','orders.grand_total','orders.payment_status','orders.payment_type','orders.delivery_cost','orders.delivery_status','orders.view','orders.service_provider_permission')
            ->join('service_providers','orders.service_provider_id','=','service_providers.id')
            ->where('orders.order_type','service')
            ->where('service_providers.user_id',Auth::user()->id)
            ->where('orders.service_provider_permission',1)
            ->where('orders.delivery_status','Pending')
            ->orderBy('orders.id','desc')
            ->get();


        //echo count($all_orders);
        //dd($all_orders);

        $serviceProviderDetails = ServiceProvider::where('user_id',Auth::user()->id)->first();
        $service_provider_contact = '';
        if($serviceProviderDetails){
            $service_provider_contact = ServiceProviderContact::where('service_provider_id',$serviceProviderDetails->id)->first();
        }

        return view('backend.service_provider.dashboard', compact('all_orders','today_orders','booking_orders','serviceProviderDetails','service_provider_contact'));
    }
}
