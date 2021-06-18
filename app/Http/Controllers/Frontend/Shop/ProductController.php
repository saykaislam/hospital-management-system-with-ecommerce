<?php

namespace App\Http\Controllers\Frontend\Shop;

use App\Brand;
use App\Category;
use App\FlashDealProduct;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductStock;
use App\ShopBrand;
use App\ShopCategory;
use App\SubCategory;
use App\SubSubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function ProductDetails($slug) {
        $productDetails = Product::where('slug',$slug)->first();
        $productCategory = Category::where('id',$productDetails->category_id)->pluck('name')->first();
        $productSubCategory = SubCategory::where('id',$productDetails->subcategory_id)->pluck('name')->first();
        $productSubSubCategory = SubSubCategory::where('id',$productDetails->subsubcategory_id)->pluck('name')->first();
        $productBrand = Brand::where('id',$productDetails->brand_id)->pluck('name')->first();
        $categories = Product::where('category_id',$productDetails->category_id)->take(3)->where('published',1)->latest()->get();

        return view('frontend-shop.pages.shop.product_details',
            compact(
                'productDetails',
                'categories',
                'productCategory',
                'productSubCategory',
                'productSubSubCategory',
                'productBrand'
            )
        );
    }

    // this function call from helper function
//    public function ProductVariantPrice(Request  $request) {
//        //dd($request->all());
//
//
//        $c=count($request->variant);
//        $i=1;
//        $var=$request->variant;
//        $v=[];
//        for($i=1;$i<$c-1;$i++){
//            array_push($v,$var[$i]['value']);
//        }
//        //dd(implode("-", $v));
//        $variant= \App\ProductStock::where('variant',implode("-", $v))->first();
//        //dd($variant);
//        $product = \App\Product::find($variant->product_id);
//        if ($product->discount > 0){
//            $price = $variant->price;
//            if($product->discount_type == 'Percent'){
//
//                $price -= ($variant->price*$product->discount)/100;
//            }
//            elseif($product->discount_type == 'Flat'){
//                $price -= $product->discount;
//            }
//            $variant['price'] = $price;
//        }else{
//            $variant=ProductStock::where('variant',implode("-", $v))->first();
//        }
//
//        return response()->json(['success'=> true, 'response'=>$variant]);
//    }

    public function allFeaturedProduct($slug) {
        return view('frontend-shop.pages.seller.product_list.all_featured_products',compact('slug'));
    }
    public function allBestSalesProduct($slug){
        return view('frontend-shop.pages.seller.product_list.all_best_sale_products',compact('slug'));
    }
    public function best_sale_categoryProduct($id){
        $shopCategory = ShopCategory::find($id);
        $products = Product::where('category_id',$shopCategory->category_id)->where('user_id',$shopCategory->shop->user_id)->where('num_of_sale','>',0)->where('published',1)->orderBy('num_of_sale', 'DESC')->get();
//        return $products;
        return view('frontend-shop.pages.seller.product_list.product_filter',compact('products'));
    }
    public function featured_categoryProduct($id){
        $shopCategory = ShopCategory::find($id);
        $products = Product::where('category_id',$shopCategory->category_id)->where('user_id',$shopCategory->shop->user_id)->where('featured',1)->where('published',1)->latest()->get();
//        return $products;
        return view('frontend-shop.pages.seller.product_list.product_filter',compact('products'));
    }
    public function featured_brandProduct($id){
        $shopBrand = ShopBrand::find($id);
        $products = Product::where('brand_id',$shopBrand->brand_id)->where('user_id',$shopBrand->shop->user_id)->where('featured',1)->where('published',1)->latest()->get();
//        return $products;
        return view('frontend-shop.pages.seller.product_list.product_filter',compact('products'));
    }
    public function best_sale_brandProduct($id){
        $shopBrand = ShopBrand::find($id);
        $products = Product::where('brand_id',$shopBrand->brand_id)->where('user_id',$shopBrand->shop->user_id)->where('num_of_sale','>',0)->where('published',1)->latest()->get();
//        return $products;
        return view('frontend-shop.pages.seller.product_list.product_filter',compact('products'));
    }

}
