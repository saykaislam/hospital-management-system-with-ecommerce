<?php

namespace App\Http\Controllers\Frontend\shop;

use App\Category;
use App\Clinic;
use App\ClinicDoctor;
use App\ClinicReview;
use App\Doctor;
use App\DoctorAward;
use App\DoctorClinicSchedule;
use App\DoctorClinicScheduleTimeSlot;
use App\DoctorContact;
use App\DoctorEducation;
use App\DoctorExperience;
use App\DoctorReview;
use App\DoctorSpeciality;
use App\DoctorSpecialityDoctor;
use App\FlashSaleSet;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetails;
use App\Product;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function home(){
        $chk_cat=[];
        $products=\App\Product::where('active',1)->latest('created_at')->Paginate(24);
        $category=Category::all();
        //dd($category);
        if($products->count()==0){
            Toastr::warning('Nothing Found');
            return back()->withInput();
        }
        else{
            return view('frontend.pages.shop.home',compact('products','category','chk_cat'));
        }
    }
    public function homecatefilter(Request $request){

        //dd($chk_cat);
        if($request->cate==null){
            $chk_cat=[];
            $products=\App\Product::where('active',1)->latest('created_at')->Paginate(24);
        }else{
            $chk_cat=$request->cate;
            $products=\App\Product::where('active',1)->whereIn('category_id', $request->cate)->latest('created_at')->Paginate(24);
        }
        $category=Category::all();
        if($products->count()==0){
            Toastr::warning('Nothing Found');
            return back()->withInput();
        }
        else{
            return view('frontend.pages.shop.home',compact('products','category','chk_cat'));
        }
    }

    public function product_details($slug){
        //dd($slug);
        $product=\App\Product::where('slug',$slug)->where('active',1)->first();

        //dd($reviews);
        if(empty($product)){
            Toastr::warning('No Product');
            return back()->withInput();
        }
        else{
            //$reviews=ProductReview::where('product_id',$product->id)->latest('created_at')->get();
            $relatedproduct=\App\Product::where('subcategory_id',$product->subcategory_id)->take(5)->get();
            //dd($relatedproduct);
            return view('frontend.pages.shop.product_details',compact('product','relatedproduct'));
        }

    }

    public function cartAddProduct(Request $request)
    {
        //dd("ss");
        //1 service 0 shop
        $check_cart_type=0;
        foreach (Cart::content() as $productCart) {
            if($productCart->options->cart_type == "service"){
                $check_cart_type=1;
                break;
            }
            else{
                $check_cart_type=0;
            }
        }

        if ($check_cart_type==1){
            Cart::destroy();
        }

        $currentDate = date("Y-m-d");
        $currentTime = $date = date('H:i', time());
        $currDateTime = strtotime($currentDate. ' '.$currentTime);
        $flashSale = FlashSaleSet::where('status', 1)->first();
        $flDateTime = strtotime($flashSale->end_date.' '.$flashSale->end_time);
        $product = Product::find($request->productId);
        $data = array();
        $data['id'] = $product->id;
        $data['name'] = $product->name;
        $data['qty'] = 1;
        $data['options']['image'] = $product->image;
        $data['options']['regular_price'] = $product->regular_price;
        $data['options']['shipping_cost'] = $product->shipping_cost;
        $data['options']['cart_type'] = "product";
        if (!empty($flashSale) && $product->flash_sale == 1 && $flDateTime >= $currDateTime){
            $data['price'] = $product->flash_sale_price;
        }else {
            $data['price'] = $product->sale_price;
        }
        Cart::add($data);
        $data['countCart'] = Cart::count();
        return response()->json(['success'=> true, 'response'=>$data]);
    }

    public function cart()
    {
        //dd("S");
         return view('frontend.pages.shop.cart');
    }

    public function checkout()
    {
        //dd("S");
         return view('frontend.pages.shop.checkout');
    }

     public function order(Request $request)
    {

        if($request->pay == 'cod'){
            $payment_status = 'Due';
        }
        if($request->pay == 'ssl'){
            $payment_status = 'Paid';
        }

        $this->validate($request,[
            'first_name' => 'required',
            'address' => 'required',
            'pay' => 'required',
        ]);

//dd($request->all());
        $data['name'] = $request->first_name.' '.$request->last_name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['details'] = $request->note;
        $shipping_info = json_encode($data);

        $order = new Order();
        $order->invoice_code = date('Ymd-his');
        $order->user_id = Auth::user()->id;
        $order->shipping_address = $shipping_info;
        $order->payment_type = $request->pay;
        $order->payment_status = $payment_status;
        $order->grand_total = Cart::total();
        //$order->delivery_cost = 0;
        $order->delivery_cost = 70;
        $order->delivery_status = "Pending";
        $order->view = 0;
        $order->order_type = "product";
        $order->save();

        foreach (Cart::content() as $content) {
            $orderDetails = new OrderDetails();
            $orderDetails->order_id = $order->id;
            $orderDetails->product_id = $content->id;
            $orderDetails->product_name = $content->name;
            $orderDetails->product_price = $content->price;
            $orderDetails->product_quantity = $content->qty;
            $orderDetails->save();
        }

        if ($request->pay == 'cod') {
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

}
