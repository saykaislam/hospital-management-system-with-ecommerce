<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetails;
use App\OrderServiceDetail;
use Brian2694\Toastr\Facades\Toastr;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function serviceOrder(){
        $servicesOrders = Order::where('order_type','service')->orderBy('id','desc')->get();
        //dd($order);
        return view('backend.admin.order.service_order',compact('servicesOrders'));
    }
    public function serviceOrderDetail($id){
        $serviceOrder = Order::find($id);
        return view('backend.admin.order.service_order_show',compact('serviceOrder'));
    }

    public function permissionStatus(Request $request)
    {
        $order= Order::find($request->order_id);
        $order->service_provider_permission=$request->service_provider_permission;
        $order->update();

        Toastr::success('Service Provider Permission Successfully Updated', 'Success');
        return redirect()->back();
    }

    public function productOrder(){
        $productOrders = Order::where('order_type','product')->orderBy('id','desc')->get();
        //dd($order);
        return view('backend.admin.order.product_order',compact('productOrders'));
    }

    public function productOrderDetail($id){
        $productOrder = Order::find($id);
        $productOrderDetails = OrderDetails::where('order_id',$id)->get();
        //dd($productOrderDetails);
        return view('backend.admin.order.product_order_show',compact('productOrder','productOrderDetails'));
    }

    public function productInvoicePrint($id){
        $productOrder = Order::find($id);
        $productOrderDetails = OrderDetails::where('order_id',$id)->get();
        //dd($productOrderDetails);
        return view('backend.admin.order.product_invoice_print',compact('productOrder','productOrderDetails'));
    }

    public function serviceInvoicePrint($id){
        $serviceOrder = Order::find($id);
        $serviceOrderDetails = OrderServiceDetail::where('order_id',$id)->get();

        return view('backend.admin.order.service_invoice_print',compact('serviceOrder','serviceOrderDetails'));
    }

    public function cancel_order($order_id)
    {
        $order = Order::find($order_id);
        if($order->delivery_status=="Canceled"){

        }elseif ($order->delivery_status=="Pending"){
            $order->delivery_status="Canceled";
            $order->update();
        }
        else{

        }
        return back();
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
        return redirect()->route('admin.product.order');
    }
}
