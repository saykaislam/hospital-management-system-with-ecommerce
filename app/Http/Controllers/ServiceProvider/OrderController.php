<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderServiceDetail;
use App\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(){
        //$orders = Order::all();
        $orders = DB::table('orders')
            ->select('orders.id','orders.order_type','orders.shipping_address','orders.invoice_code','orders.grand_total','orders.payment_status','orders.payment_type','orders.delivery_cost','orders.delivery_status','orders.view','orders.service_provider_permission')
            ->join('service_providers','orders.service_provider_id','=','service_providers.id')
            ->where('orders.order_type','service')
            ->where('service_providers.user_id',Auth::user()->id)
            ->where('service_provider_permission',1)
            ->orderBy('id','desc')
            ->get();
        //dd($orders);
        return view('backend.service_provider.order',compact('orders'));
    }

    public function today_order(){
        //$orders = Order::all();
        $orders = DB::table('orders')
            ->select('orders.id','orders.order_type','orders.shipping_address','orders.invoice_code','orders.grand_total','orders.payment_status','orders.payment_type','orders.delivery_cost','orders.delivery_status','orders.view','orders.service_provider_permission')
            ->join('service_providers','orders.service_provider_id','=','service_providers.id')
            ->where('orders.order_type','service')
            ->where('service_providers.user_id',Auth::user()->id)
            ->where('orders.service_provider_permission',1)
            ->where('orders.created_at','>=',date('Y-m-d 00:00:00'))
            ->where('orders.created_at','<=',date('Y-m-d 11:59:59'))
            ->orderBy('orders.id','desc')
            ->get();
        //dd($orders);
        return view('backend.service_provider.order',compact('orders'));
    }

    public function booking(){

        $orders = DB::table('orders')
            ->select('orders.id','orders.order_type','orders.shipping_address','orders.invoice_code','orders.grand_total','orders.payment_status','orders.payment_type','orders.delivery_cost','orders.delivery_status','orders.view','orders.service_provider_permission')
            ->join('service_providers','orders.service_provider_id','=','service_providers.id')
            ->where('orders.order_type','service')
            ->where('service_providers.user_id',Auth::user()->id)
            ->where('orders.service_provider_permission',1)
            ->where('orders.delivery_status','Pending')
            ->orderBy('orders.id','desc')
            ->get();
        //dd($orders);
        return view('backend.service_provider.order',compact('orders'));
    }

    public function show($id){
        $orders = Order::find($id);
        //dd($id);


        return view('backend.service_provider.order_show',compact('orders'));
    }

    public function delivery_status(Request $request)
    {
        $order= Order::find($request->order_id);
        if($order->delivery_status=="Canceled"){}
        elseif ($order->delivery_status=="Completed"){}
        else{
            if ($request->status=="Completed"){
                $order->delivery_status=$request->status;
                $order->payment_status='Paid';
                $order->update();
            }else{
                $order->delivery_status=$request->status;
                $order->update();
            }
        }
        return redirect()->route('service.provider.order');
    }

    public function order_list()
    {
        $service_provider = ServiceProvider::where('user_id',Auth::id())->first();
        $orders = Order::where('order_type','service')->where('service_provider_id',$service_provider->id)->where('service_provider_permission',1)->orderBy('id','desc')->get();
        return view('backend.service_provider.order',compact('orders'));
    }

    public function invoice($id)
    {
        // dd($id);
        $order= Order::find($id);
        $order_details=OrderServiceDetail::where('order_id',$order->id)->orderBy('id','desc')->get();
        return view('backend.service_provider.invoice',compact('order','order_details'));
    }

    public function invoicePrint($id)
    {
        // dd($id);
        $order= Order::find($id);
        $order_details=OrderServiceDetail::where('order_id',$order->id)->orderBy('id','desc')->get();
        return view('backend.service_provider.invoice-print',compact('order','order_details'));
    }
}
