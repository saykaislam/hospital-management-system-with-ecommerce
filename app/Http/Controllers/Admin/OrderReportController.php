<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Shop;
use App\User;
use Illuminate\Http\Request;

class OrderReportController extends Controller
{
    public function sellerReport(){
        $sellers = User::where('role_id',6)->latest()->get();
        $orders = null;
        $sellerId = null;
        $deliveryStatus = null;
        return view('backend.admin.seller_order_report.index',compact('sellers','orders','sellerId','deliveryStatus'));
    }
    public function sellerOrderDetails(Request $request) {
        $sellers = User::where('role_id',6)->latest()->get();
        if (!empty($request->seller_id && $request->delivery_status)){
            $sellerId = $request->seller_id;
            $shop = Shop::where('user_id',$sellerId)->first();
            $deliveryStatus = $request->delivery_status;
            $orders = Order::where('shop_id',$shop->id)->where('delivery_status',$deliveryStatus)->latest()->get();
            return view('backend.admin.seller_order_report.index',compact('sellers','orders','sellerId','deliveryStatus'));
        }
        return redirect()->back();
    }
}
