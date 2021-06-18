<?php

namespace App\Http\Controllers\Admin;

use App\AdminPaymentHistory;
use App\Http\Controllers\Controller;
use App\Order;
use App\Payment;
use App\Product;
use App\Seller;
use App\SellerWithdrawRequest;
use App\Shop;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SellerController extends Controller
{
    public function index(){
        $sellerUserInfos = User::where('role_id',6)->latest()->get();
        return view('backend.admin.seller.index',compact('sellerUserInfos'));
    }
    public function profileShow($id){
        $userInfo = User::find(decrypt($id));
        $sellerInfo = Seller::where('user_id',$userInfo->id)->first();
        $shopInfo = Shop::where('user_id',$userInfo->id)->first();
        $totalProducts = Product::where('user_id',$userInfo->id)->count();
        $totalOrders = Order::where('shop_id',$shopInfo->id)->count();
        $totalSoldAmount = Order::where('shop_id',$shopInfo->id)->where('payment_status','paid')->where('delivery_status','Completed')->sum('grand_total');
//        if($userInfo->view == 0){
//            $userInfo->view = 1;
//            $userInfo->save();
//        }
        return view('backend.admin.seller.profile',compact('userInfo','sellerInfo','shopInfo','totalProducts', 'totalOrders','totalSoldAmount'));
    }
    public function profileUpdate(Request $request, $id){
        $this->validate($request, [
            'name' =>  'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone,'.$id,
            'email' =>  'required|email|unique:users,email,'.$id,
        ]);
        $user =  User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        Toastr::success('Seller Profile Updated Successfully','Success');
        return redirect()->back();
    }
    public function passwordUpdate(Request $request, $id){
        $this->validate($request, [
            'password' =>  'required|confirmed|min:6',
        ]);
        if ($request->password == $request->password_confirmation){
            $user =  User::find($id);
            $user->password = Hash::make($request->password);
            $user->save();
            Toastr::success('Seller Password Updated Successfully','Success');
            return redirect()->back();
        }else{
            Toastr::error('Current password not match.', 'Error');
            return redirect()->back();
        }

    }
    public function shopAddressUpdate(Request $request, $id){
        $this->validate($request, [
            'address' =>  'required',
        ]);
        $user =  User::find($id);
        $shop = Shop::where('user_id',$user->id)->first();
        $shop->address = $request->address;
        $shop->city = $request->city;
        $shop->area = $request->area;
        $shop->latitude = $request->latitude;
        $shop->longitude = $request->longitude;
        $shop->save();
        Toastr::success('Shop Address Updated Successfully','Success');
        return redirect()->back();
    }
    public function bankInfoUpdate(Request $request, $id){
        $this->validate($request, [
            'bank_name' =>  'required',
            'bank_acc_name' =>  'required',
            'bank_acc_no' =>  'required',
            'bank_routing_no' =>  'required',
        ]);

        $serller = Seller::find($id);
        $serller->bank_name =  $request->bank_name;
        $serller->bank_acc_name =  $request->bank_acc_name;
        $serller->bank_acc_no =  $request->bank_acc_no;
        $serller->bank_routing_no =  $request->bank_routing_no;
        $serller->save();
        Toastr::success('Seller Bank Info Updated Successfully','Success');
        return redirect()->back();
    }
    public function verification(Request $request){
        $seller = Seller::find($request->id);
        $seller->verification_status = $request->status;
        if($seller->save()){
            return 1;
        }
        return 0;
    }
    public function sellerPaymentModal(Request $request)
    {
        $seller = Seller::find($request->id);
        return view('backend.admin.seller.seller_payment_modal', compact('seller'));
    }
    public function admin_payment_modal(Request $request)
    {
        $seller = Seller::find($request->id);
        return view('backend.admin.seller.admin_payment_modal', compact('seller'));
    }
    public function pay_to_seller_commission(Request $request)
    {
        $data['seller_id'] = $request->seller_id;
        $data['amount'] = $request->amount;
        $data['type'] = $request->type;
        $data['payment_method'] = $request->payment_option;
        //$data['payment_withdraw'] = $request->payment_withdraw;
        if ($data['type'] == 'withdraw'){
            $data['withdraw_request_id'] = $request->withdraw_request_id;
        }
        if ($request->txn_code != null) {
            $data['txn_code'] = $request->txn_code;
        }
        else {
            $data['txn_code'] = null;
        }
        $request->session()->put('payment_type', 'seller_payment');
        $request->session()->put('payment_data', $data);
        if ($request->payment_option == 'cash') {
            return $this->seller_payment_done($request->session()->get('payment_data'), null);
        }
        /*elseif ($request->payment_option == 'sslcommerz') {
            $sslcommerz = new PublicSslCommerzPaymentController;
            return $sslcommerz->index($request);
        }*/

    }
    public function seller_payment_done($payment_data, $payment_details){
        $seller = Seller::findOrFail($payment_data['seller_id']);
        if($payment_data['type'] == 'payment'){
            $seller->admin_to_pay = $seller->admin_to_pay - $payment_data['amount'];
            $seller->save();
        }

        $payment = new Payment();
        $payment->seller_id = $seller->id;
        $payment->amount = $payment_data['amount'];
        $payment->payment_method = $payment_data['payment_method'];
        $payment->txn_code = $payment_data['txn_code'];
        $payment->payment_details = $payment_details;
        $payment->save();

        if ($payment_data['type'] == 'withdraw') {
            $seller_withdraw_request = SellerWithdrawRequest::find($payment_data['withdraw_request_id']);
            $seller_withdraw_request->status = '1';
            $seller_withdraw_request->viewed = '1';
            $seller_withdraw_request->save();
        }

        Session::forget('payment_data');
        Session::forget('payment_type');

        if ($payment_data['type'] == 'payment') {
            Toastr::success('Payment completed', 'Success');
            return redirect()->route('admin.seller.payment.history');
        }else{
            Toastr::success('Payment completed', 'Success');
            return redirect()->route('admin.seller.withdraw.request');
        }

    }
    public function admin_withdraw_store(Request $request, $id) {
        $seller = Seller::find($id);
//       dd($seller);
        if($seller->seller_will_pay_admin >= $request->amount ) {
            $payment = new AdminPaymentHistory();
            $payment->seller_id = $seller->id;
            $payment->amount = $request->amount;
            $payment->payment_method = $request->payment_option;;
            $payment->save();
            $seller->seller_will_pay_admin -= $request->amount;
            $seller->save();
            Toastr::success("Request Inserted Successfully", "Success");
            return redirect()->route('admin.payment.history');
        } else {
            Toastr::error("You do not have enough balance to send withdraw request");
            return redirect()->back();
        }
    }
    public function adminPaymentHistory()
    {
        $paymentHistories = AdminPaymentHistory::latest()->get();
        return view('backend.admin.seller.admin_payment_history',compact('paymentHistories'));
    }
    public function SellerPaymentHistory()
    {
        $paymentHistories = Payment::latest()->get();
        return view('backend.admin.seller.seller_payment_history',compact('paymentHistories'));
    }
    public function commission_modal(Request $request)
    {
        $seller = Seller::find($request->id);
        return view('backend.admin.seller.individual_seller_commission', compact('seller'));
    }
    public function individulCommissionSet(Request $request, $id)
    {
        $this->validate($request,[
            'commission' => 'required',
        ]);
        $data = Seller::find($id);
        $data->commission = $request->commission;
        $data->save();
        Toastr::success($request->commission.' % Seller Commission successfully added for all sellers');
        return redirect()->back();
    }

    public function banSeller($id) {
        //dd($id);
        $user = User::findOrFail($id);
        $seller = Seller::where('user_id',$user->id)->first();
        //dd($seller);
        $seller->verification_status = 0;
        $seller->save();
        $user->banned = 1;
        $user->save();
        Toastr::success('Seller Baned ', 'Success');
        return redirect()->back();
    }
    public function topRatedShop(){
        $reviews = DB::table('product_reviews')
            ->join('shops','shops.id','=','product_reviews.shop_id')
            ->select('product_reviews.shop_id',DB::raw('SUM(product_reviews.rating) as total_rating'))
            ->groupBy('product_reviews.shop_id')
            ->orderBy('total_rating', 'DESC')
            ->get();
        return view('backend.admin.seller.top_rated_shop',compact('reviews'));
    }
}
