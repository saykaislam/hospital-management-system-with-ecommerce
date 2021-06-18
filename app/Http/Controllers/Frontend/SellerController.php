<?php

namespace App\Http\Controllers\Frontend;

use App\Brand;
use App\Category;
use App\FavoriteShop;
use App\FlashDeal;
use App\FlashDealProduct;
use App\Product;
use App\Review;
use App\Seller;
use App\Shop;
use App\ShopCategory;
use App\SubCategory;
use App\SubSubCategory;
use App\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function singleshop($slug) {

        return view('frontend-shop.pages.seller.seller_shop', compact('slug'));
    }
    public function allFeaturedCategory($slug){
        return view('frontend-shop.pages.seller.all_featured_category', compact('slug'));
    }
    public function allFlashDealProducts($slug){
        $flashDeal = FlashDeal::where('slug',$slug)->first();
        $flashDealProducts = FlashDealProduct::where('flash_deal_id',$flashDeal->id)->latest()->get();
        $shop = Shop::where('id',$flashDeal->shop_id)->first();
        return view('frontend-shop.pages.seller.product_list.all_flash_deal_products', compact('flashDeal','flashDealProducts','shop'));
    }

    public function search_product(Request $request){
        $storeId =  $request->get('storeId');
        $name = $request->get('q');
        $shops = \App\Shop::find($storeId);
        //dd($shops);
        if($request->get('storeId')){
            $product = \App\Product::where('user_id',$shops->user_id)->where('name', 'LIKE', '%'. $name. '%')->where('published',1)->limit(5)->get();
        }else{
            $product = \App\Product::where('name', 'LIKE', '%'. $name. '%')->where('published',1)->limit(5)->get();
        }
        return $product;
    }

    public function allShops(){
        $shops = Shop::latest()->get();
        return view('frontend-shop.pages.shop.all_shop',compact('shops'));
    }

    public function productFilter($data, $shopId)
    {
        $shop = Shop::find($shopId);
        $data2 = explode(',',$data);
        $data_min = (int) $data2[0];
        $data_max = (int) $data2[1];
        $products = Product::where('user_id',$shop->user_id)->where('unit_price', '>=', $data_min)->where('unit_price', '<=', $data_max)->where('published',1)->where('featured',1)->latest()->take(24)->get();

        return view('frontend-shop.pages.shop.products_filter_dataset', compact('products','shop'));
    }

    public function bestSellingFilter($data,$shopId)
    {
        $shop = Shop::find($shopId);
        $data2 = explode(',', $data);
        $data_min = (int)$data2[0];
        $data_max = (int)$data2[1];
        $products = Product::where('user_id', $shop->user_id)->where('unit_price', '>=', $data_min)->where('unit_price', '<=', $data_max)->where('published', 1)->where('num_of_sale', '>', 0)->orderBy('num_of_sale', 'DESC')->latest()->take(24)->get();
        return view('frontend-shop.pages.shop.products_filter_dataset', compact('products', 'shop'));
    }

    public function productByBrand($slug){
        $brand = Brand::where('slug',$slug)->first();
        $products = Product::where('brand_id',$brand->id)->where('published',1)->latest()->get();
        return view('frontend-shop.pages.products_by_brand',compact('brand','products'));
    }
    public function productByCategory($shop, $cat){
        $shop = Shop::where('slug',$shop)->first();
        $category = Category::where('slug',$cat)->first();
        $products = Product::where('category_id',$category->id)->where('user_id',$shop->user_id)->where('published',1)->latest()->get();
        return view('frontend-shop.pages.seller.products_by_category',compact('category','shop','products'));
    }
    public function productBySubcategory($cat, $sub){
        $category = Category::where('slug',$cat)->first();
        $subCategory = SubCategory::where('slug',$sub)->first();
        $products = Product::where('category_id',$category->id)->where('subcategory_id',$subCategory->id)->where('published',1)->latest()->get();
        return view('frontend-shop.pages.products_by_subcategory',compact('category','subCategory','products'));
    }
}
