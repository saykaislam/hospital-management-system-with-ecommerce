<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\FlashDeal;
use App\FlashDealProduct;
use App\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FlashDealController extends Controller
{
    public function index()
    {
        $fashDeals = FlashDeal::where('role_id',1)->latest()->get();
        return view('backend.admin.flash_deals.index', compact('fashDeals'));
    }

    public function create()
    {
        return  view('backend.admin.flash_deals.create');
    }

    public function productsAdd($flash_id)
    {
        $flashDeal = FlashDeal::find(decrypt($flash_id));
        return view('backend.admin.flash_deals.add_flush_deals_products', compact('flashDeal'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $shop_id = shopId(Auth::id());
        $role_id = roleId(Auth::id());
        $flash_deal = new FlashDeal;
        $flash_deal->title = $request->title;
        $flash_deal->user_id = Auth::id();
        $flash_deal->role_id = $role_id;
        $flash_deal->shop_id = $shop_id;
        $flash_deal->status = 0;
        $flash_deal->start_date_time = strtotime($request->start_date);
        $flash_deal->end_date_time = strtotime($request->end_date);
        $flash_deal->slug =  Str::slug($request->title);
        if($flash_deal->save()){
            Toastr::success('Flash Deal has been created successfully, Please add Products');
            return redirect()->route('admin.flash_deals.products.add',encrypt($flash_deal->id));
        }
        else{
            Toastr::error('Something went wrong');
            return back();
        }
    }

    public function flashDealProductsStore(Request $request)
    {
        //dd($request->all());
        if ($request->shop == 'Please select one shop'){
            Toastr::warning('Please select shop first. After that select at least one product','Attention!!');
            return back();
        }
        foreach ($request->products as $key => $product) {
            $shop_id = shopId(Auth::id());
            $role_id = roleId(Auth::id());
            $flash_deal_product = new FlashDealProduct;
            $flash_deal_product->flash_deal_id = $request->flash_deal_id;
            $flash_deal_product->product_id = $product;
            //$flash_deal_product->user_id = $request->shop;
            $flash_deal_product->user_id = Auth::id();;
            $flash_deal_product->role_id = $role_id;
            $flash_deal_product->shop_id = $shop_id;
            $flash_deal_product->discount = $request['discount_'.$product];
            $flash_deal_product->discount_type = $request['discount_type_'.$product];
            $flash_deal_product->save();
        }
        Toastr::success('Flash Deal products has been inserted successfully');
        return back();
    }

    public function flashDealProductsUpdate(Request $request)
    {
        //dd($request->all());
        if ($request->shop == 'Please select one shop'){
            Toastr::warning('Please select shop first. After that select at least one product','Attention!!');
            return back();
        }
        FlashDealProduct::where('user_id',$request->shop)->delete();
        foreach ($request->products as $key => $product) {
            $shop_id = shopId($request->shop);
            $role_id = roleId($request->shop);
            $flash_deal_product = new FlashDealProduct;
            $flash_deal_product->flash_deal_id = $request->flash_deal_id;
            $flash_deal_product->product_id = $product;
            $flash_deal_product->user_id = $request->shop;
            $flash_deal_product->shop_id = $shop_id;
            $flash_deal_product->role_id = $role_id;
            $flash_deal_product->discount = $request['discount_'.$product];
            $flash_deal_product->discount_type = $request['discount_type_'.$product];
            $flash_deal_product->save();

        }
        Toastr::success('Flash Deal products has been inserted successfully');
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //dd('oops!! oh no!!');
        $flash_deal = FlashDeal::findOrFail(decrypt($id));
        return view('backend.admin.flash_deals.edit', compact('flash_deal'));
    }

    public function productsEdit($flash_id)
    {
        $flashDeal = FlashDeal::find(decrypt($flash_id));
        return view('backend.admin.flash_deals.edit_flush_deals_products', compact('flashDeal'));
    }

    public function update(Request $request, $id)
    {
        //dd($id);
        $flash_deal =  FlashDeal::find($id);
        $flash_deal->title = $request->title;
        $flash_deal->user_id = Auth::id();
        $flash_deal->user_type = 'admin';
        $flash_deal->start_date = strtotime($request->start_date);
        $flash_deal->end_date = strtotime($request->end_date);
        $flash_deal->slug =  Str::slug($request->title);
        if($flash_deal->save()){
            Toastr::success('Flash Deal has been created successfully, Please add Products');
            return back();
        }
        else{
            Toastr::error('Something went wrong');
            return back();
        }
    }

    public function destroy($id)
    {
        //
    }

    public function product_discount(Request $request){
        //return
        $product_ids = $request->product_ids;
        return view('backend.partials.flash_deal_discount', compact('product_ids'));
    }

    public function product_discount_edit(Request $request){
        $product_ids = $request->product_ids;
        $flash_deal_id = $request->flash_deal_id;
        return view('backend.partials.flash_deal_discount_edit', compact('product_ids', 'flash_deal_id'));
    }

    public function shopProducts($id)
    {
        //$products = Product::where('user_id', $id)->where('published',1)->get();
        $products = Product::where('user_id', 1)->where('published',1)->get();
        if (!empty($products)){
            return response()->json(['success'=>true,'response' => $products]);
        }else{
            return response()->json(['success'=>false,'response' => 'no products found!']);
        }
    }

    public function shopProductsEdit($id,$flash_id)
    {
        $products = Product::where('user_id', $id)->where('published',1)->get();
        if (!empty($products)){
            //dd($products);
            return view('backend.admin.flash_deals.selected_option_view',compact('products','flash_id'));
        }else{
            return response()->json(['success'=>false,'response' => 'no products found!']);
        }
    }

    public function update_status(Request $request)
    {
        // previous flash deal disable
        $previous_flash_deal = FlashDeal::where('status',1)->where('user_id',Auth::id())->first();
        $previous_flash_deal->status = 0;
        $previous_flash_deal->save();

        $flash_deal = FlashDeal::findOrFail($request->id);
        $flash_deal->status = $request->status;
        if($flash_deal->save()){
            Toastr::success('Flash deal status updated successfully');
            return 1;
        }
        return 0;
    }

    public function update_featured(Request $request)
    {
        foreach (FlashDeal::where('role_id',1)->get() as $key => $flash_deal) {
            $flash_deal->featured = 0;
            $flash_deal->save();
        }
        $flash_deal = FlashDeal::findOrFail($request->id);
        $flash_deal->featured = $request->featured;
        if($flash_deal->save()){
            Toastr::success('Flash deal status updated successfully');
            return 1;
        }
        return 0;
    }
}
