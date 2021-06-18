<?php

namespace App\Http\Controllers\Frontend\test;

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
use App\LabTest;
use App\Order;
use App\OrderDetails;
use App\OrderLabDetails;
use App\Product;
use App\Test;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    public function home(){

        $tests=\App\Test::latest('created_at')->Paginate(24);
        //dd($products);
        if($tests->count()==0){
            Toastr::warning('Nothing Found');
            return back()->withInput();
        }
        else{
            return view('frontend.pages.test.home',compact('tests'));
        }
    }

    public function test_lab($slug){
        $test=Test::where('slug',$slug)->first();
        $labs=LabTest::where('test_id',$test->id)->get();
        //dd($products);
        if($labs->count()==0){
            Toastr::warning('No Lab Found');
            return back()->withInput();
        }
        else{
            return view('frontend.pages.test.lab',compact('labs','test'));
        }
    }

    public function cartAddTest(Request $request)
    {
            $check_cart_type=0;
            foreach (Cart::content() as $productCart) {
                if($productCart->options->cart_type == "service"){
                    $check_cart_type=1;
                    break;
                }elseif($productCart->options->cart_type == "product"){
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

        $lab_test = LabTest::find($request->lab_test);
        $test = Test::find($lab_test->test_id);
        $lab = User::find($lab_test->clinic_or_lab_user_id);

        $data = array();
        $data['id'] = $test->id;
        $data['name'] = $test->name;
        $data['qty'] = 1;
        $data['options']['image'] = "default.png";
        $data['options']['regular_price'] = $test->price;
        $data['options']['lab_id'] =  $lab_test->clinic_or_lab_user_id;
        $data['options']['lab_name'] =  $lab->name;
        $data['options']['delivery_type'] =  $request->delivery;
        $data['options']['cart_type'] = "lab";
        $data['price'] = $lab_test->lab_test_price;
        Cart::add($data);
        $data['countCart'] = Cart::count();
        return response()->json(['success'=> true, 'response'=>$data]);
    }

    public function cart()
    {
        //dd("S");
        return view('frontend.pages.test.cart');
    }

    public function checkout()
    {
        //dd("S");
        return view('frontend.pages.test.checkout');
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
        $order->delivery_cost = 0;
        $order->delivery_status = "Pending";
        $order->view = 0;
        $order->order_type = "lab";
        $order->save();

        foreach (Cart::content() as $content) {
            $orderDetails = new OrderLabDetails();
            $orderDetails->order_id = $order->id;
            $orderDetails->test_id = $content->id;
            $orderDetails->test_name = $content->name;
            $orderDetails->test_price = $content->price;
            $orderDetails->test_quantity = $content->qty;
            $orderDetails->lab_id = $content->options->lab_id;
            $orderDetails->delivery_type = $content->options->delivery_type;
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
