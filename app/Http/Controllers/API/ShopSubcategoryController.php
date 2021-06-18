<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsListCollection;
use App\Product;
use App\Shop;
use App\ShopCategory;
use App\ShopSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopSubcategoryController extends Controller
{
    public  function getShopCategories(Request $request) {
        $shopSubcategories = DB::table('shop_sub_categories')
            ->Join('sub_categories','shop_sub_categories.subcategory_id','=','sub_categories.id')
            ->where('shop_sub_categories.shop_id',$request->shop_id)
            ->where('shop_sub_categories.category_id',$request->category_id)
            ->select('shop_sub_categories.subcategory_id as subcategory_id','shop_sub_categories.shop_id','shop_sub_categories.category_id as category_id','sub_categories.name as subcategory_name')
            ->get();
//        $shopSubcategories = ShopSubcategory::where('shop_id',$request->shop_id)->where('category_id',$request->category_id)->latest()->get();
        if (!empty($shopSubcategories))
        {
            return response()->json(['success'=>true,'response'=> $shopSubcategories], 200);
        }
        else{
            return response()->json(['success'=>false,'response'=> 'Something went wrong!'], 404);
        }
    }
    public function getFeaturedProducts(Request $request){
        $shop = Shop::find($request->shop_id);
        $shopCategory = ShopSubCategory::where('subcategory_id',$request->subcategory_id)->where('shop_id',$shop->id)->first();
        return new ProductsListCollection(Product::where('published',1)->where('featured',1)->where('subcategory_id',$shopCategory->subcategory_id)->where('user_id',$shop->user_id)->latest()->get());
    }
    public function getAllProducts(Request $request){
        $shop = Shop::find($request->shop_id);
        $shopCategory = ShopSubCategory::where('subcategory_id',$request->subcategory_id)->where('shop_id',$shop->id)->first();
        return new ProductsListCollection(Product::where('published',1)->where('subcategory_id',$shopCategory->subcategory_id)->where('user_id',$shop->user_id)->latest()->get());
    }

}
