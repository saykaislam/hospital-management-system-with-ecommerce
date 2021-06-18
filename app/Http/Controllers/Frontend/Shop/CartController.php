<?php

namespace App\Http\Controllers\Frontend\Shop;

use App\Address;
use App\BusinessSetting;
use App\Http\Controllers\Controller;
use App\FlashDealProduct;
//use App\Model\BusinessSetting;
use App\Order;
use App\OrderDetails;
//use App\Model\OrderTempCommission;
use App\OrderTempCommission;
use App\Seller;
use App\Shop;
use App\Product;
use App\ProductStock;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function viewCart() {
        return view('frontend-shop.pages.shop.cart');
    }

    public function checkout() {
        $addresses = Address::where('user_id',Auth::id())->get();
        if(Cart::count()==0){
            Toastr::error('Nothing fount in cart');
            return back();
        }
        //$addresses = Address::where('user_id', Auth::id())->get();
//        dd($address);
        //return view('frontend-shop.pages.shop.checkout',compact('addresses'));
        return view('frontend-shop.pages.shop.checkout', compact('addresses'));
    }

    public function ProductAddCart(Request  $request) {
        //dd('add to cart');
        //dd($request->all());

        $var=$request->variant;
        //dd($var);

        $product=Product::find($request->product_id);
        if(Cart::count() != 0){
            foreach (Cart::content() as $item){
                if($product->user_id != $item->options->shop_userid){
                    Cart::destroy();
                    break;
                }
            }
        }
        //dd($product);

        //$productPrice = productPrice($product->id);
        //$productPrice['discount_price'] ? $productPrice['discount_price'] : $productPrice['unit_price'];


        $qty=$var[count($var)-1]['value'];
//        $shop=\App\Shop::where('user_id',$product->user_id)->first();
//        if($shop != NULL){
//            $shop_name = $shop->name;
//        }else{
//            $shop_name = 'In House';
//        }

        $data = array();
        $data['id'] = $product->id;
        $data['name'] = $product->name;
        $data['qty'] = $qty;
        $data['price'] = $request->product_price;
        $data['options']['image'] = $product->thumbnail_img;
        $data['options']['shipping_cost'] = 60;
        $data['options']['variant_id'] = null;
        $data['options']['variant'] = null;
        //$data['options']['shop_name'] =  $shop_name;
        $data['options']['shop_name'] =  shopName($product->user_id);
        //$data['options']['shop_id'] =  $shop->id;
        $data['options']['shop_id'] =  shopId($product->user_id);
        $data['options']['shop_userid'] =  $product->user_id;
        $data['options']['cart_type'] = "product";
        $data['options']['labour_cost'] = $product->labour_cost;
        //$Price = home_discounted_base_price($product->id);
        $vPrice = 0;
        if ($product->vat_type == 'Percent') {
            $data['options']['vat_type'] = 'Percent';
            //$vPrice += ($Price * $product->vat) / 100;
        } elseif ($product->vat_type == 'Flat') {
            $data['options']['vat_type'] = 'Flat';
            //$vPrice += $product->vat;
        }
        $data['options']['vat'] = $vPrice;
        Cart::add($data);
        $data['countCart'] = Cart::count();
        $data['subtotal'] = Cart::subtotal();
        //dd(Cart::content());
        return response()->json(['success'=> true, 'response'=>$data]);

    }
    public function cartRemove($rowId)
    {
        Toastr::error('This Product removed from cart ');
        Cart::remove($rowId);
        return back();
    }

    public function quantityUpdate(Request $request)
    {
        //dd($request->rid);
        $cartData = Cart::get($request->rid);
        $qty = $request->quantity;
        Toastr::success('Quantity Updated');
        Cart::update($request->rid, $qty);
        return back();
    }


    public function orderSubmit(Request $request) {
        if ($request->address_id == null) {
            Toastr::error('Please select an address.','Please Select');
            return back();
        }
        //dd($request->all());
        $this->validate($request,[
//            'name' => 'required',
//            'address' => 'required',
//            'phone' => 'required',
            'pay' => 'required',
        ]);
        if($request->pay == 'cod'){
            $payment_status = 'Due';
        }
        if($request->pay == 'ssl'){
            $payment_status = 'Paid';
        }
        $address = Address::where('user_id',Auth::id())->where('id',$request->address_id)->first();
        $data['name'] = Auth::User()->name;
        $data['email'] = Auth::User()->email;
        $data['address'] = $address->address;
        $data['country'] = $address->country;
        $data['city'] = $address->city;
        $data['postal_code'] = $address->postal_code;
        $data['phone'] = $address->phone;
        $shipping_info = json_encode($data);
        //dd($data);

        foreach (Cart::content() as $content) {
            $shop_id = $content->options->shop_id;
            break;
        }
        //dd($shop_id);

        $check = Order::where('user_id',Auth::id())->first();
        $discount = BusinessSetting::where('type','first_order_discount')->first();
        //dd($check);

        $order = new Order();
        $order->invoice_code = date('Ymd-his');
        $order->user_id = Auth::user()->id;
        $order->shop_id = $shop_id;
        $order->area = $address->area;
        $order->latitude = $address->latitude;
        $order->longitude = $address->longitude;
        $order->shipping_address = $shipping_info;
        $order->payment_type = $request->pay;
        $order->payment_status = $payment_status;
        $order->grand_total = Cart::total();
        if (empty($check)) {
            $order->discount = $discount->value;
            $order->grand_total = Cart::total() - $order->discount;
        }
        $order->delivery_cost = 0;
        $order->delivery_status = "Pending";
        $order->view = 0;
        $order->order_type = "product";
        $order->save();
        //dd('ok');

        $profit = 0;
        $totalVat = 0;
        $totalLabourCost = 0;
        foreach (Cart::content() as $content) {
            //dd($content->options->labour_cost);
            $product = Product::find($content->id);

            $orderDetails = new OrderDetails();
            $orderDetails->order_id = $order->id;
            $orderDetails->variation_id = $content->options->variant_id;
            $orderDetails->product_id = $content->id;
            $orderDetails->product_name = $content->name;
            $orderDetails->product_price = $content->price;
            $orderDetails->product_quantity = $content->qty;
            $vPrice = 0;
            if ($product->vat_type == 'Percent') {
                $vPrice += ($content->price * $product->vat) / 100;
            } elseif ($product->vat_type == 'Flat') {
                $vPrice += $product->vat;
            }

            $labour_cost = $content->options->labour_cost ? $content->options->labour_cost : 0;
            $orderDetails->vat = $vPrice;
            $orderDetails->labour_cost = $labour_cost;
            $totalVat += $vPrice*$content->qty;
            $totalLabourCost += ($labour_cost)*$content->qty;
            $orderDetails->save();

            $product->num_of_sale++;
            $product->save();
            $profitData = ($content->price - $product->purchase_price) * $content->qty;
            $profit += $profitData;
        }

        $orderUpdate = Order::find($order->id);
        $orderUpdate->profit = $profit;
        $orderUpdate->total_vat = $totalVat;
        $orderUpdate->total_labour_cost = $totalLabourCost;
        $orderUpdate->grand_total += $totalVat +$totalLabourCost;
        $orderUpdate->save();

        if ($request->pay == 'cod') {
            $getShop = Shop::find($shop_id);
            //dd($getShop);
            if(!empty($shop_id)){
                $role_id = userRoleId($shop_id);
                //dd($role_id);
                if($role_id != 1){
                    $getSellerData = Seller::where('user_id',$getShop->user_id)->first();
                    //dd($getSellerData);
                    $grandTotal = Cart::total();
                    //dd($grandTotal);
                    if(!empty($getSellerData)){
                        $adminCommission = new OrderTempCommission();
                        $adminCommission->order_id = $order->id;
                        $adminCommission->shop_id = $shop_id;
                        $adminCommission->temp_commission_to_seller = 0;
                        $adminCommission->temp_commission_to_admin = $grandTotal*$getSellerData->commission / 100;
                        $adminCommission->save();
                    }
                }
            }

            Toastr::success('Order Successfully done! ');
            Cart::destroy();
            return redirect()->route('shop');
        }else {
            Session::put('order_id',$order->id);
            return redirect()->route('pay');
//            Toastr::success('Order Successfully done! ');
//            Cart::destroy();
            //Toastr::warning('Online Payment Method not yet done. Please try on COD');
//            return redirect()->back();
        }
        return view('frontend.pages.shop.checkout');
    }
}
