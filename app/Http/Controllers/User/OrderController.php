<?php

namespace App\Http\Controllers\User;

use App\Clinic;
use App\ClinicReview;
use App\Doctor;
use App\DoctorReview;
use App\ServiceProvider;
use App\Product;
use App\ProductReview;
use App\Shop;
use App\Order;
use App\OrderDetails;
use App\OrderLabDetails;
use App\OrderServiceDetail;
use App\ServiceProviderReview;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function serviceOrder(){
        $serviceOrders = Order::where('order_type','service')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('backend.user.order.service_order',compact('serviceOrders'));
    }
    public function serviceOrderDetail($id){
        $serviceOrder = Order::find($id);
        return view('backend.user.order.service_order_show',compact('serviceOrder'));
    }

    public function order()
    {
        $orders = Order::where('order_type','service')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('backend.user.order.order',compact('orders'));
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

    public function service_list($order_id)
    {
        $order_service_details=OrderServiceDetail::where('order_id',$order_id)->get();
        return view('backend.user.order.ordered_services',compact('order_service_details'));
    }
    public function order_history()
    {
        $orders = Order::where('type','service')->where('user_id',Auth::user()->id)->where('delivery_status','=','Canceled')->orwhere('delivery_status','=','Delivered')->orderBy('id','desc')->get();
        return view('backend.user.order_history',compact('orders'));
    }

    public function productOrder(){
        $productOrders = Order::where('order_type','product')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('backend.user.order.product_order',compact('productOrders'));
    }

    public function product_list($order_id)
    {
        $order=Order::find($order_id);
        $order_product_details=OrderDetails::where('order_id',$order_id)->get();
        return view('backend.user.order.ordered_products',compact('order_product_details','order'));
    }

    public function labTestOrder(){
        $labTestOrders = Order::where('order_type','lab')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('backend.user.order.lab_test_order',compact('labTestOrders'));
    }

    public function lab_test_list($order_id)
    {
        $order_lab_details=OrderLabDetails::where('order_id',$order_id)->get();

        return view('backend.user.order.ordered_lab_tests',compact('order_lab_details'));
    }

    public function ser_review(Request $request)
    {
        $this->validate($request,[
            'category_id' => 'required',
            'star' => 'required',
            'description' => 'required',
        ]);
        $review=new ServiceReview();
        $review->user_id=Auth::id();
        $review->service_category_id=$request->category_id;
        $review->star=$request->star;
        $review->description=$request->description;
        $review->save();

        Toastr::success('Thanks for reviewing us','Success');
       return redirect()->back();

    }
    public function service_provider_review(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'order_id' => 'required',
            'service_provider_id' => 'required',
            'star' => 'required',
            'description' => 'required',
        ]);
        $check_already_review = ServiceProviderReview::where('order_id',$request->order_id)
            ->where('user_id',Auth::id())
            ->where('service_provider_id',$request->service_provider_id)
            ->first();
        if($check_already_review){
            Toastr::success('You have already reviewed.','Success');
        }else {
            $service_provider = ServiceProvider::find($request->service_provider_id);

            $review = new ServiceProviderReview();
            $review->user_id = Auth::id();
            $review->order_id = $request->order_id;
            $review->service_provider_id = $request->service_provider_id;
            $review->star = $request->star;
            $review->description = $request->description;
            if($review->save()){

                $count_service_provider_review_rating = count(ServiceProviderReview::where('service_provider_id', $request->service_provider_id)
                    ->where('status', 1)
                    ->get());
                $sum_service_provider_review_rating = ServiceProviderReview::where('service_provider_id', $request->service_provider_id)
                    ->where('status', 1)->sum('star');

                if($count_service_provider_review_rating > 0){
                    $rating = $sum_service_provider_review_rating/$count_service_provider_review_rating;
                    $service_provider->rating = $rating;
                }
                else {
                    $service_provider->rating = 0;
                }
                $service_provider->save();
                Toastr::success('Review has been submitted successfully');
                return back();
            }
            Toastr::error('Something went wrong!');
            return back();
        }

        return redirect()->back();

    }

    public function clinic_doctor_review(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'order_id' => 'required',
            'clinic_user_id' => 'required',
            'doctor_user_id' => 'required',
            'star' => 'required',
            'description' => 'required',
        ]);
        $check_already_clinic_review = ClinicReview::where('order_id',$request->order_id)
            ->where('user_id',Auth::id())
            ->where('clinic_user_id',$request->clinic_user_id)
            ->first();

        $check_already_doctor_review = DoctorReview::where('order_id',$request->order_id)
            ->where('user_id',Auth::id())
            ->where('doctor_user_id',$request->doctor_user_id)
            ->first();

        if($check_already_clinic_review || $check_already_doctor_review){
            Toastr::success('You have already reviewed.','Success');
        }else {
            // clinic review
            $clinic = Clinic::where('user_id',$request->clinic_user_id)->first();

            $review = new ClinicReview();
            $review->user_id = Auth::id();
            $review->order_id = $request->order_id;
            $review->clinic_user_id = $request->clinic_user_id;
            $review->rating = $request->star;
            $review->description = $request->description;
            //dd($review);
            if($review->save()){

                $count_clinic_review_rating = count(ClinicReview::where('clinic_user_id', $request->clinic_user_id)
                    ->where('status', 1)
                    ->get());
                $sum_clinic_review_rating = ClinicReview::where('clinic_user_id', $request->clinic_user_id)
                    ->where('status', 1)->sum('rating');

                if($count_clinic_review_rating > 0){
                    $rating = $sum_clinic_review_rating/$count_clinic_review_rating;
                    $clinic->rating = $rating;
                }
                else {
                    $clinic->rating = 0;
                }
                $clinic->save();
                //Toastr::success('Review has been submitted successfully');
                //return back();
            }

            // doctor review
            $doctor = Doctor::where('user_id',$request->doctor_user_id)->first();

            $doctor_review = new DoctorReview();
            $doctor_review->user_id = Auth::id();
            $doctor_review->order_id = $request->order_id;
            $doctor_review->doctor_user_id = $request->doctor_user_id;
            $doctor_review->rating = $request->star;
            $doctor_review->description = $request->description;
            if($doctor_review->save()){

                $count_doctor_review_rating = count(DoctorReview::where('doctor_user_id', $request->doctor_user_id)
                    ->where('status', 1)
                    ->get());
                $sum_doctor_review_rating = DoctorReview::where('doctor_user_id', $request->doctor_user_id)
                    ->where('status', 1)->sum('rating');

                if($count_doctor_review_rating > 0){
                    $rating = $sum_doctor_review_rating/$count_doctor_review_rating;
                    $doctor->rating = $rating;
                }
                else {
                    $doctor->rating = 0;
                }
                $doctor->save();
                Toastr::success('Review has been submitted successfully');
                return back();
            }

            Toastr::error('Something went wrong!');
            return back();
        }

        return redirect()->back();

    }

    public function product_review(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'order_id' => 'required',
            'product_id' => 'required',
            'rating' => 'required',
            'comment' => 'required',
        ]);
//        $check_already_review = ServiceProviderReview::where('order_id',$request->order_id)
//            ->where('user_id',Auth::id())
//            ->where('service_provider_id',$request->service_provider_id)
//            ->first();
//        if($check_already_review){
//            Toastr::success('You have already reviewed.','Success');
//        }else {
//            $review = new ServiceProviderReview();
//            $review->user_id = Auth::id();
//            $review->order_id = $request->order_id;
//            $review->service_provider_id = $request->service_provider_id;
//            $review->star = $request->star;
//            $review->description = $request->description;
//            $review->save();
//
//            Toastr::success('Thanks for reviewing us','Success');
//        }

        $product = Product::findOrFail($request->product_id);
        $shop = Shop::where('user_id', $product->user_id)->first();

        $review = new ProductReview;
        $review->order_id = $request->order_id;
        $review->product_id = $request->product_id;
        $review->user_id = Auth::user()->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->shop_id = $shop->id;
        $review->viewed = '0';
        if($review->save()){
            if(count(ProductReview::where('product_id', $product->id)->where('status', 1)->get()) > 0){
                $product->rating = ProductReview::where('product_id', $product->id)
                        ->where('status', 1)->sum('rating')/count(ProductReview::where('product_id', $product->id)->where('status', 1)->get());
            }
            else {
                $product->rating = 0;
            }
            $product->save();
            Toastr::success('Review has been submitted successfully');
            return back();
        }
        Toastr::error('Something went wrong!');
        return back();

    }

}
