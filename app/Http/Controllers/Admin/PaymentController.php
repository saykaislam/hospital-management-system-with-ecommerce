<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Seller;
use App\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function dueToSeller(){
        $sellers = User::where('role_id',6)->latest()->get();
        $sellerInfo = null;
        $sellerId = null;
        return view('backend.admin.seller.due_to_seller',compact('sellers','sellerInfo','sellerId'));
    }
    public function dueToSellerDetails(Request $request){
        $sellers = User::where('role_id',6)->latest()->get();
        if (!empty($request->seller_id)){
            $sellerId = $request->seller_id;
            $sellerInfo = Seller::where('user_id',$sellerId)->first();
//            $orders = Order::where('shop_id',$shop->id)->where('delivery_status',$deliveryStatus)->latest()->get();
            return view('backend.admin.seller.due_to_seller',compact('sellers','sellerInfo','sellerId'));
        }
        return redirect()->back();
    }
    public function dueToAdmin(){
        $sellers = User::where('role_id',6)->latest()->get();
        $sellerInfo = null;
        $sellerId = null;
        return view('backend.admin.seller.due_to_admin',compact('sellers','sellerInfo','sellerId'));
    }
    public function dueToAdminDetails(Request $request){
        $sellers = User::where('role_id',6)->latest()->get();
        if (!empty($request->seller_id)){
            $sellerId = $request->seller_id;
            $sellerInfo = Seller::where('user_id',$sellerId)->first();
//            $orders = Order::where('shop_id',$shop->id)->where('delivery_status',$deliveryStatus)->latest()->get();
            return view('backend.admin.seller.due_to_admin',compact('sellers','sellerInfo','sellerId'));
        }
        return redirect()->back();
    }
}
