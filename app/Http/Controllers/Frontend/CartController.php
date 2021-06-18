<?php

namespace App\Http\Controllers\Frontend;

use App\BlogPost;
use App\Coupon;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetails;
use App\OrderProductDetail;
use App\OrderServiceDetail;
use App\Product;
use App\ProductSubCategory;
use App\Service;
use App\ServiceCategory;
use App\Services;
use App\ServiceSubCategory;
use App\SubCategory;
use App\SubChildCategory;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addCart(Request $request)
    {
        $check_service_category_type = true;
        $service_category_id = Services::where('id',$request->id)->pluck('service_category_id')->first();
        //Cart::destroy()
        if(count(Cart::content()) != 0){
            if($request->type=="product"){
//                if(Cart::content()->first()->options['cart_type']=="product"){
//                    $product=Product::find($request->subChildId);
//                    $SubCat=ProductSubCategory::find($product->subcategory_id);
//                    $data = array();
//                    $data['id'] = $product->id;
//                    $data['name'] = $product->name;
//                    $data['qty'] = 1;
//                    $data['price'] = $product->sale_price;
//                    $data['options']['subcategory_name'] = $SubCat->name;
//                    $data['options']['cart_type'] = "product";
//                }else{
//                    Cart::destroy();
//                    $product=Product::find($request->subChildId);
//                    $SubCat=ProductSubCategory::find($product->subcategory_id);
//                    $data = array();
//                    $data['id'] = $product->id;
//                    $data['name'] = $product->name;
//                    $data['qty'] = 1;
//                    $data['price'] = $product->sale_price;
//                    $data['options']['subcategory_name'] = $SubCat->name;
//                    $data['options']['cart_type'] = "product";
//                }

            }else{
                if(Cart::content()->first()->options['cart_type']=="service"){
                    if(Cart::content()->first()->options['service_category_id']==$service_category_id){
                        $service=Services::find($request->service_id);
                        $ServiceCategory=ServiceCategory::find($service->service_category_id);
                        $ServiceSubCategory=ServiceSubCategory::find($service->service_sub_category_id);
                        $data = array();
                        $data['id'] = $service->id;
                        $data['name'] = $service->name;
                        $data['qty'] = 1;
                        $data['price'] = $service->price;
                        $data['options']['service_category_id'] = $service->service_category_id;
                        $data['options']['service_category_name'] = $ServiceCategory->name;
                        $data['options']['service_sub_category_name'] = $ServiceSubCategory->name ? $ServiceSubCategory->name : '';
                        $data['options']['cart_type'] = "service";
                    }else{
                        $check_service_category_type = false;
                    }
                }else{
                    Cart::destroy();
                    $service=Services::find($request->service_id);
                    $ServiceCategory=ServiceCategory::find($service->service_category_id);
                    $ServiceSubCategory=ServiceSubCategory::find($service->service_sub_category_id);
                    $data = array();
                    $data['id'] = $service->id;
                    $data['name'] = $service->name;
                    $data['qty'] = 1;
                    $data['price'] = $service->price;
                    $data['options']['service_category_id'] = $service->service_category_id;
                    $data['options']['service_category_name'] = $ServiceCategory->name;
                    $data['options']['service_sub_category_name'] = $ServiceSubCategory->name ? $ServiceSubCategory->name : '';
                    $data['options']['cart_type'] = "service";
                }
            }
        }
        else{
            //if null cart
            if($request->type=="product"){
//                $product=Product::find($request->subChildId);
//                $SubCat=ProductSubCategory::find($product->subcategory_id);
//                $data = array();
//                $data['id'] = $product->id;
//                $data['name'] = $product->name;
//                $data['qty'] = 1;
//                $data['price'] = $product->sale_price;
////        $data['options']['vendor_id'] = $request->vendor_id;
//                $data['options']['subcategory_name'] = $SubCat->name;
//                $data['options']['cart_type'] = "product";
            }else{
                $service=Services::find($request->service_id);
                $ServiceCategory=ServiceCategory::find($service->service_category_id);
                $ServiceSubCategory=ServiceSubCategory::find($service->service_sub_category_id);
                $data = array();
                $data['id'] = $service->id;
                $data['name'] = $service->name;
                $data['qty'] = 1;
                $data['price'] = $service->price;
//        $data['options']['vendor_id'] = $request->vendor_id;
                $data['options']['service_category_id'] = $service->service_category_id;
                $data['options']['service_category_name'] = $ServiceCategory->name;
                $data['options']['service_sub_category_name'] = $ServiceSubCategory->name ? $ServiceSubCategory->name : '';
                $data['options']['cart_type'] = "service";

                //Session::put('service_category_id',$service->service_category_id);
            }
        }

        if($check_service_category_type == true){
            Cart::add($data);
        }
        $data['countCart'] = Cart::count();
        return response()->json(['success'=> true, 'response'=>$data,'check_service_category_type'=>$check_service_category_type]);
    }
    public function quantityUpdate(Request $request)
    {
        //dd($request->rid);
        $cartData = Cart::get($request->rid);
        $qty = $request->quantity;
        Toastr::success('Quantity Updated Successfully');
        Cart::update($request->rid, $qty);
        return back();
    }
    public function cartRemove($rowId)
    {
        Toastr::error('This service successfully remove from cart ');
        Cart::remove($rowId);
        return back();
    }
    public function clearCart()
    {
        Cart::destroy();
        return back();
    }
    public function checkout()
    {
        $dates=[];
        $times=["10:00:am","11:00:am","12:00:am","01:00:pm","02:00:pm","03:00:pm","04:00:pm","05:00:pm","06:00:pm","07:00:pm"];
        $begain = "01";
        $start = "09";
        $end = "16";
        $now_time = date('H');

        if($now_time < $start && $now_time >= $begain){
            $given_date=date('d-m-Y');
            $currentdate=date('d-m-Y');
            for($i=0;$i<10;$i++){
                $next_date = date('d-m-Y', strtotime($currentdate .' +1 day'));
                $dates[$i]=$next_date;
                $currentdate=$next_date;
            }

            if($now_time <= "05" && $now_time >= "01"){
                $given_time="9:00:am";
            }
            else{
                $given_time="12:00:am";
            }
//            elseif($now_time <= "06" && $now_time >= "08"){
//                $given_time="12:00:am";
//            }
        }
        elseif ($now_time <= $end && $now_time >= $start) {
            $given_date=date('d-m-Y');
            $currentdate=date('d-m-Y');
            for($i=0;$i<10;$i++){
                $next_date = date('d-m-Y', strtotime($currentdate .' +1 day'));
                $dates[$i]=$next_date;
                $currentdate=$next_date;
            }
            $given_time=date('h:i:a', time()+10800);
            //dd($given_time);
            if($given_time>="8:00:pm"){

                $given_date = date('d-m-Y', strtotime(' +1 day'));
                $given_time="9:00:am";
                $currentdate=date('d-m-Y', strtotime(' +1 day'));
                for($i=0;$i<10;$i++){
                    $next_date = date('d-m-Y', strtotime($currentdate .' +1 day'));
                    $dates[$i]=$next_date;
                    $currentdate=$next_date;
                }
            }
        }
        else {
            $given_date = date('d-m-Y', strtotime(' +1 day'));
            $currentdate=date('d-m-Y', strtotime(' +1 day'));
            for($i=0;$i<10;$i++){
                $next_date = date('d-m-Y', strtotime($currentdate .' +1 day'));
                $dates[$i]=$next_date;
                $currentdate=$next_date;
            }
            $given_time="9:00:am";
        }
        //dd($dates);
        return view('frontend.pages.checkout',compact('given_date','given_time','dates','times'));
    }
    public function checkoutProduct()
    {
        return view('frontend.pages.checkout_product');
    }
    public function order(Request $request)
    {
//        dd($request->all());
        $this->validate($request,[
            'billing_name' => 'required',
            'house' => 'required',
            'area' => 'required',
            'billing_phone' => 'required',
            'payment_type' => 'required',
            'service_date' => 'required',
            'service_time' => 'required',
            'vendor_id' => 'required',
        ]);
//dd($request->all());
        $data['name'] = $request->billing_name;
        $data['phone'] = $request->billing_phone;
        $data['house'] = $request->house;
        $data['road'] = $request->road;
        $data['block'] = $request->block;
        $data['sector'] = $request->sector;
        $data['area'] = $request->area;
        $data['details'] = $request->notes;
        $data['service_date'] = $request->service_date;
        $data['service_time'] = $request->service_time;
        $shipping_info = json_encode($data);

        if (session()->has('coupon')){
            $discount=session()->get('coupon')['discount'];
        }else{
            $discount=0;
        }
        //dd(Cart::total());

        //dd(Cart::subtotal());
        if($request->payment_type == 'cod'){
            $payment_status = 'Due';
        }
        if($request->payment_type == 'ssl'){
            $payment_status = 'Paid';
        }

        $order = new Order();
        $order->invoice_code = date('Ymd-his');
        $order->service_provider_id = $request->vendor_id;
        $order->service_provider_permission = 0;
        $order->order_type = "service";
        $order->user_id = Auth::user()->id;
        $order->shipping_address = $shipping_info;
        $order->payment_type = $request->payment_type;
        $order->payment_status = $payment_status;
        $order->discount = $discount;
        //$order->grand_total = Cart::total();
        $order->grand_total = Cart::total()-$discount;
        $order->delivery_cost = 0;
        $order->delivery_status = "Pending";
        $order->view = 0;
        //dd($order);
        //dd($order->grand_total = Cart::total()-$discount);
        $order->save();

        foreach (Cart::content() as $content) {
            $orderServiceDetails = new OrderServiceDetail();
            $orderServiceDetails->order_id = $order->id;
            $orderServiceDetails->service_id = $content->id;
            $orderServiceDetails->service_name = $content->name;
            $orderServiceDetails->service_price = $content->price;
            $orderServiceDetails->service_quantity = $content->qty;
            $orderServiceDetails->service_sub_total = $content->price*$content->qty;
            $orderServiceDetails->save();
        }

        if ($request->payment_type == 'cod') {
//            Toastr::success('Order Successfully done! <span class="display-1">&#10084;&#65039;</span>');
            Toastr::success('Order Successfully done! ');
            Cart::destroy();
            return redirect()->route('index');
        }else {
            Session::put('order_id',$order->id);
            return redirect()->route('pay');
        }

//        return view('frontend.pages.checkout');
    }
    public function orderProduct(Request $request)
    {
        // dd($request->all());

        $this->validate($request,[
            'billing_name' => 'required',
            'house' => 'required',
            'road' => 'required',
            'area' => 'required',
            'billing_phone' => 'required',
            'payment_type' => 'required',
        ]);
//dd($request->all());
        $data['name'] = $request->billing_name;
        $data['phone'] = $request->billing_phone;
        $data['house'] = $request->house;
        $data['road'] = $request->road;
        $data['block'] = $request->block;
        $data['sector'] = $request->sector;
        $data['area'] = $request->area;
        $data['details'] = $request->notes;
        $shipping_info = json_encode($data);

        $order = new Order();
        $order->invoice_code = date('Ymd-his');
        $order->vendor_id = null;
        $order->vendor_permission = null;
        $order->user_id = Auth::user()->id;
        $order->shipping_address = $shipping_info;
        $order->payment_type = $request->payment_type;
        $order->payment_status = 0;
        $order->grand_total = Cart::total();
        $order->delivery_cost = 0;
        $order->delivery_status = "Pending";
        $order->view = 0;
        $order->type = "product";
        $order->save();

        foreach (Cart::content() as $content) {
            $orderDetails = new OrderProductDetail();
            $orderDetails->order_id = $order->id;
            $orderDetails->product_id = $content->id;
            $orderDetails->product_name = $content->name;
            $orderDetails->product_price = $content->price;
            $orderDetails->product_quantity = $content->qty;
            $orderDetails->save();
        }

        if ($request->payment_type == 'cod') {
//            Toastr::success('Order Successfully done! <span class="display-1">&#10084;&#65039;</span>');
            Toastr::success('Order Successfully done! ');
            Cart::destroy();
            return redirect()->route('home');
        }else {
            Session::put('order_id',$order->id);
            return redirect()->route('pay');
        }
//        return view('frontend.pages.checkout');
    }

    public function coupon_store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (empty($coupon)) {
            Toastr::error('Invalid Coupon');
            return redirect()->route('checkout');
        }else{
            session()->put('coupon',[
                'name'=>$coupon->code,
                'discount'=>$coupon->discount(Cart::subtotal()),
            ]);
            //dd(session()->get('coupon'));
            Toastr::success('Coupon has been applied!');
            return redirect()->route('checkout');
        }



    }

    public function coupon_destroy()
    {
        session()->forget('coupon');
        Toastr::success('Coupon has been removed');
        return redirect()->route('checkout');

    }
}
