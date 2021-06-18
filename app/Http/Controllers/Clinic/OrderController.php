<?php

namespace App\Http\Controllers\Clinic;

use App\Order;
use App\OrderLabDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function labTestOrder(){
        $labTestOrders = DB::table('orders')
            ->join('order_lab_details','orders.id','=','order_lab_details.order_id')
            ->where('orders.order_type','lab')
            ->where('order_lab_details.lab_id',Auth::user()->id)
            ->select('orders.*')
            ->orderBy('orders.id','desc')
            ->get();
        //dd($labTestOrders);

        return view('backend.clinic.order.lab_test_order',compact('labTestOrders'));
    }

    public function lab_test_list($order_id)
    {
        $order_lab_details=OrderLabDetails::where('order_id',$order_id)->get();
        //dd($order_lab_details);

        return view('backend.clinic.order.ordered_lab_tests',compact('order_lab_details'));
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
        return redirect()->route('clinic.lab.test.order');
    }

}
