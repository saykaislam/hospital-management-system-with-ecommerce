<?php
/**
 * Created by PhpStorm.
 * User: ashiq
 * Date: 11/11/2019
 * Time: 3:08 PM
 */


use App\ProductReview;
use App\Product;
use App\ProductStock;
use App\Seller;
use App\Shop;
use App\ShopCategory;
use App\User;
use App\FlashDeal;
use App\FlashDealProduct;
use App\Advertisement;
use App\Slider;
use Illuminate\Support\Facades\DB;


//function homeDiscountedPrice($id)
//{
//    $product = Product::findOrFail($id);
//    $lowest_price = $product->unit_price;
//    $highest_price = $product->unit_price;
//
//    if ($product->variant_product) {
//        foreach ($product->stocks as $key => $stock) {
//            if($lowest_price > $stock->price){
//                $lowest_price = $stock->price;
//            }
//            if($highest_price < $stock->price){
//                $highest_price = $stock->price;
//            }
//        }
//    }
//
//    $flash_deals = FlashDeal::where('status', 1)->get();
//    $inFlashDeal = false;
//    foreach ($flash_deals as $flash_deal) {
//        if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first() != null) {
//            $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first();
//            if($flash_deal_product->discount_type == 'percent'){
//                $lowest_price -= ($lowest_price*$flash_deal_product->discount)/100;
//                $highest_price -= ($highest_price*$flash_deal_product->discount)/100;
//            }
//            elseif($flash_deal_product->discount_type == 'amount'){
//                $lowest_price -= $flash_deal_product->discount;
//                $highest_price -= $flash_deal_product->discount;
//            }
//            $inFlashDeal = true;
//            break;
//        }
//    }
//
//    if (!$inFlashDeal) {
//        if($product->discount_type == 'percent'){
//            $lowest_price -= ($lowest_price*$product->discount)/100;
//            $highest_price -= ($highest_price*$product->discount)/100;
//        }
//        elseif($product->discount_type == 'amount'){
//            $lowest_price -= $product->discount;
//            $highest_price -= $product->discount;
//        }
//    }
//
//    return $lowest_price.' - '.$highest_price;
//}

//function home_base_price($id)
//{
//    $product = Product::findOrFail($id);
//    return $product->unit_price;
//}

//function home_discounted_base_price($id)
//{
//
//    $product = Product::findOrFail($id);
//    $price = $product->unit_price;
//
//    $flash_deals = FlashDeal::where('status', 1)->get();
//    $inFlashDeal = false;
//    foreach ($flash_deals as $flash_deal) {
//        if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first() != null) {
//            $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $id)->first();
//            if($flash_deal_product->discount_type == 'Percent'){
//                $price -= ($price*$flash_deal_product->discount)/100;
//            }
//            elseif($flash_deal_product->discount_type == 'Flat'){
//                $price -= $flash_deal_product->discount;
//            }
//            $inFlashDeal = true;
//            break;
//        }
//    }
//
//    if (!$inFlashDeal) {
//        if($product->discount_type == 'Percent'){
//            $price -= ($price*$product->discount)/100;
//        }
//        elseif($product->discount_type == 'Flat'){
//            $price -= $product->discount;
//        }
//    }
//    //dd($price);
//    return $price;
//
//}

//function variantProductPrice($variant_id)
//{
//    $variant=ProductStock::find($variant_id);
//    $product = Product::findOrFail($variant->product_id);
//    $price =$variant->price;
//    if($product->discount_type == 'percent'){
//
//        $price -= ($variant->price*$product->discount)/100;
//    }
//    elseif($product->discount_type == 'amount'){
//        $price -= $product->discount;
//    }
//    return $price;
//}


// home category
if (!function_exists('homeCategories')) {
    function homeCategories()
    {
        return $categories = DB::table('categories')->where('is_home',1)->orderBy('id','desc')->get();
    }
}

// home shops
if (!function_exists('homeShops')) {
    function homeShops()
    {
        return DB::table('shops')->get();
    }
}

// home brands
if (!function_exists('homeBrands')) {
    function homeBrands()
    {
        return DB::table('brands')->get();
    }
}

// product variant price
if (!function_exists('ProductVariantPrice')) {
    function ProductVariantPrice()
    {
        //dd($_REQUEST);

        $c = count($_REQUEST['variant']);
        $i = 1;
        $var = $_REQUEST['variant'];
        $v = [];
        for ($i = 1; $i < $c - 1; $i++) {
            array_push($v, $var[$i]['value']);
        }
        //dd(implode("-", $v));
        $variant = \App\ProductStock::where('variant', implode("-", $v))->first();
        //dd($variant);
        $product = \App\Product::find($variant->product_id);
        if ($product->discount > 0) {
            $price = $variant->price;
            if ($product->discount_type == 'Percent') {

                $price -= ($variant->price * $product->discount) / 100;
            } elseif ($product->discount_type == 'Flat') {
                $price -= $product->discount;
            }
            $variant['price'] = $price;
        } else {
            $variant = ProductStock::where('variant', implode("-", $v))->first();
        }

        return response()->json(['success' => true, 'response' => $variant]);
    }
}

// product price
if (!function_exists('productPrice')) {
    function productPrice($product_id)
    {
        $priceData = [
            'current_stock' => 0,
            'unit_price' => 0,
            'discount_price' => ''
        ];

        $product = Product::findOrFail($product_id);
        $priceData['current_stock'] = $product->current_stock;
        $priceData['unit_price'] = $product->unit_price;

        // flash sale
        $flash_sale_product = FlashDealProduct::where('product_id',$product_id)->first();
        if (!empty($flash_sale_product)) {
            $discount_type = $flash_sale_product->discount_type;
            $discount = $flash_sale_product->discount;
            if($discount_type == 'Flat'){
                $calculated_price = ($product->unit_price - $discount);
            }else{
                $calculated_price = ($product->unit_price * $discount) / 100;
            }
            $priceData['discount_price'] = $calculated_price;
        }

        // discount
        if ($product->discount > 0) {
            $calculated_price = ($product->unit_price - $product->discount);
            $priceData['discount_price'] = $calculated_price;
        }

        return $priceData;
    }
}

// related products
if (!function_exists('relatedProducts')) {
    function relatedProducts($category_id)
    {
        return $categories = Product::where('category_id', $category_id)->take(8)->where('published', 1)->latest()->get();
    }
}

// product attributes infos
if (!function_exists('productAttributesInfo')) {
    function productAttributesInfo($product_id)
    {
        $productDetails = Product::where('id', $product_id)->first();
        return $attributes = json_decode($productDetails->attributes);
    }
}

// product options info
if (!function_exists('productOptionsInfo')) {
    function productOptionsInfo($product_id)
    {
        $productDetails = Product::where('id', $product_id)->first();
        return $options = json_decode($productDetails->choice_options);
    }
}

// product colors infos
if (!function_exists('productColorsInfo')) {
    function productColorsInfo($product_id)
    {
        $productDetails = Product::where('id', $product_id)->first();
        return $colors = json_decode($productDetails->colors);
    }
}

// product photos infos
if (!function_exists('productPhotosInfo')) {
    function productPhotosInfo($product_id)
    {
        $productDetails = Product::where('id', $product_id)->first();
        return $photos = json_decode($productDetails->photos);
    }
}

// shop name
if (!function_exists('shopName')) {
    function shopName($user_id)
    {
        return $shop_name = Shop::where('user_id', $user_id)->pluck('name')->first();
    }
}

// shop id
if (!function_exists('shopId')) {
    function shopId($user_id)
    {
        return $shop_id = Shop::where('user_id', $user_id)->pluck('id')->first();
    }
}

// role id
if (!function_exists('roleId')) {
    function roleId($user_id)
    {
        return $role_id = User::where('id', $user_id)->pluck('role_id')->first();
    }
}

// role id by shop id
if (!function_exists('userRoleId')) {
    function userRoleId($shop_id)
    {
        return $role_id = DB::table('users')
            ->join('shops','users.id','shops.user_id')
            ->where('shops.id', $shop_id)
            ->pluck('users.role_id')
            ->first();
    }
}

// today flash deal products
if (!function_exists('todayFlashDealProducts')) {
    function todayFlashDealProducts()
    {
        $flashDealData = [
            'flashDeal' => NULL,
            'flashDealProducts' => NULL
        ];

        // flash sale
        $flash_deal = FlashDeal::where('status',1)
            ->where('start_date_time','<=',strtotime(date('d-m-Y')))
            ->where('end_date_time','>=',strtotime(date('d-m-Y')))
            ->first();

        if(!empty($flash_deal)){
            $flashDealData['flashDeal']=$flash_deal;

            $flash_sale_products = DB::table('flash_deal_products')
                ->join('products','flash_deal_products.product_id','products.id')
                ->where('flash_deal_id',$flash_deal->id)
                ->select(
                    'flash_deal_products.flash_deal_id',
                    'flash_deal_products.user_id',
                    'flash_deal_products.role_id',
                    'flash_deal_products.shop_id',
                    //'flash_deal_products.discount_type',
                    //'flash_deal_products.discount',
                    'flash_deal_products.product_id',
                    'products.name',
                    'products.slug',
                    'products.thumbnail_img'
                )
                ->get();

            $data = [];
            if(count($flash_sale_products) > 0){
                foreach($flash_sale_products as $flash_sale_product){
                    $nested_data['flash_deal_id']=$flash_sale_product->flash_deal_id;
                    $nested_data['user_id']=$flash_sale_product->user_id;
                    $nested_data['role_id']=$flash_sale_product->role_id;
                    $nested_data['shop_id']=$flash_sale_product->shop_id;
                    $nested_data['product_id']=$flash_sale_product->product_id;
                    $nested_data['name']=$flash_sale_product->name;
                    $nested_data['slug']=$flash_sale_product->slug;
                    $nested_data['thumbnail_img']=$flash_sale_product->thumbnail_img;

                    array_push($data, $nested_data);
                }

            }
            $flashDealData['flashDealProducts']=$data;
        }


        return $flashDealData;
    }
}

// shop flash deal products
if (!function_exists('shopFlashDealProducts')) {
    function shopFlashDealProducts($shop_id)
    {
        $flashDealData = [
            'flashDeal' => NULL,
            'flashDealProducts' => NULL
        ];

        // flash sale
        $flash_deal = FlashDeal::where('status',1)
            ->where('start_date_time','<=',strtotime(date('d-m-Y')))
            ->where('end_date_time','>=',strtotime(date('d-m-Y')))
            ->where('shop_id',$shop_id)
            ->first();

        if(!empty($flash_deal)){
            $flashDealData['flashDeal']=$flash_deal;

            $flash_sale_products = DB::table('flash_deal_products')
                ->join('products','flash_deal_products.product_id','products.id')
                ->where('flash_deal_id',$flash_deal->id)
                ->where('shop_id',$shop_id)
                ->select(
                    'flash_deal_products.flash_deal_id',
                    'flash_deal_products.user_id',
                    'flash_deal_products.role_id',
                    'flash_deal_products.shop_id',
                    //'flash_deal_products.discount_type',
                    //'flash_deal_products.discount',
                    'flash_deal_products.product_id',
                    'products.name',
                    'products.slug',
                    'products.thumbnail_img'
                )
                ->get();

            $data = [];
            if(count($flash_sale_products) > 0){
                foreach($flash_sale_products as $flash_sale_product){
                    $nested_data['flash_deal_id']=$flash_sale_product->flash_deal_id;
                    $nested_data['user_id']=$flash_sale_product->user_id;
                    $nested_data['role_id']=$flash_sale_product->role_id;
                    $nested_data['shop_id']=$flash_sale_product->shop_id;
                    $nested_data['product_id']=$flash_sale_product->product_id;
                    $nested_data['name']=$flash_sale_product->name;
                    $nested_data['slug']=$flash_sale_product->slug;
                    $nested_data['thumbnail_img']=$flash_sale_product->thumbnail_img;

                    array_push($data, $nested_data);
                }

            }
            $flashDealData['flashDealProducts']=$data;
        }


        return $flashDealData;
    }
}

// featured products
if (!function_exists('featuredProducts')) {
    function featuredProducts($user_id)
    {
        return Product::where('user_id',$user_id)->where('published',1)->where('featured',1)->latest()->take(8)->get();
    }
}

// best sales products
if (!function_exists('bestSalesProducts')) {
    function bestSalesProducts($user_id)
    {
        return Product::where('user_id',$user_id)->where('published',1)->where('num_of_sale', '>',0)->orderBy('num_of_sale', 'DESC')->limit(8)->get();
    }
}

// shop info
if (!function_exists('shopInfo')) {
    function shopInfo($slug)
    {
        return $shop = Shop::where('slug',$slug)->first();
    }
}

// seller info
if (!function_exists('sellerInfo')) {
    function sellerInfo($user_id)
    {
        return $seller = Seller::where('user_id',$user_id)->first();
    }
}

// shop seller info
if (!function_exists('shopSellerInfo')) {
    function shopSellerInfo($user_id)
    {
        return $user = User::where('id',$user_id)->first();
    }
}

// shop category
if (!function_exists('shopCategory')) {
    function shopCategory($shop_id)
    {
        return $shopCat = ShopCategory::where('shop_id',$shop_id)->latest()->get();
    }
}

// shop rating
if (!function_exists('shopRating')) {
    function shopRating($shop_id)
    {

        $fiveStarRev = ProductReview::where('shop_id',$shop_id)->where('rating',5)->where('status',1)->sum('rating');
        $fourStarRev = ProductReview::where('shop_id',$shop_id)->where('rating',4)->where('status',1)->sum('rating');
        $threeStarRev = ProductReview::where('shop_id',$shop_id)->where('rating',3)->where('status',1)->sum('rating');
        $twoStarRev = ProductReview::where('shop_id',$shop_id)->where('rating',2)->where('status',1)->sum('rating');
        $oneStarRev = ProductReview::where('shop_id',$shop_id)->where('rating',1)->where('status',1)->sum('rating');
        $totalRating = ProductReview::where('shop_id',$shop_id)->sum('rating');


        if ($totalRating > 0){
            $rating = (5*$fiveStarRev + 4*$fourStarRev + 3*$threeStarRev + 2*$twoStarRev + 1*$oneStarRev) / ($totalRating);
            $totalRatingCount = number_format((float)$rating, 1, '.', '');
        }else{
            $totalRatingCount =number_format((float)0, 1, '.', '');
        }
        return $totalRatingCount;
    }
}

if (!function_exists('shopRatingStar')) {
    function shopRatingStar($round_shop_rating)
    {
        if($round_shop_rating == 5){
            $star = '<div class="text-warning  font-size-12" style="">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="far fa-star"></small>
                </div>';
        }elseif($round_shop_rating == 4){
            $star = '<div class="text-warning  font-size-12" style="">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }elseif($round_shop_rating == 3){
            $star = '<div class="text-warning  font-size-12" style="">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }elseif($round_shop_rating == 2){
            $star = '<div class="text-warning  font-size-12" style="">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }elseif($round_shop_rating == 1){
            $star = '<div class="text-warning  font-size-12" style="">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }else{
            $star = '<div class="text-warning  font-size-12" style="">
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }

        return $star;
    }
}

if (!function_exists('productRatingStar')) {
    function productRatingStar($rating)
    {
        if($rating == 5){
            $star = '<div class="text-warning">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="far fa-star"></small>
                </div>';
        }elseif($rating == 4){
            $star = '<div class="text-warning">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }elseif($rating == 3){
            $star = '<div class="text-warning">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }elseif($rating == 2){
            $star = '<div class="text-warning">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }elseif($rating == 1){
            $star = '<div class="text-warning">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }else{
            $star = '<div class="text-warning">
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="fas fa-star text-muted"></small>
                    <small class="far fa-star text-muted"></small>
                </div>';
        }

        return $star;
    }
}

// product review count
if (!function_exists('productReviewCount')) {
    function productReviewCount($product_id)
    {
        return $product_reviews = ProductReview::where('product_id',$product_id)->where('status',1)->get()->count();
    }
}

// product review average count
if (!function_exists('productReviewAverageCount')) {
    function productReviewAverageCount($product_id)
    {
        $star_rev_data = [
            'fiveStarRev'=>0,
            'fourStarRev'=>0,
            'threeStarRev'=>0,
            'twoStarRev'=>0,
            'oneStarRev'=>0,
        ];

        $star_rev_data['fiveStarRev'] = ProductReview::where('product_id',$product_id)->where('rating',5)->where('status',1)->get()->count();
        $star_rev_data['fourStarRev'] = ProductReview::where('product_id',$product_id)->where('rating',4)->where('status',1)->get()->count();
        $star_rev_data['threeStarRev'] = ProductReview::where('product_id',$product_id)->where('rating',3)->where('status',1)->get()->count();
        $star_rev_data['twoStarRev'] = ProductReview::where('product_id',$product_id)->where('rating',2)->where('status',1)->get()->count();
        $star_rev_data['oneStarRev'] = ProductReview::where('product_id',$product_id)->where('rating',1)->where('status',1)->get()->count();

        return $star_rev_data;
    }
}

// product review comments
if (!function_exists('productReviewComments')) {
    function productReviewComments($product_id)
    {
        return $reviewsComments = ProductReview::where('product_id',$product_id)->where('status',1)->latest()->paginate(5);
    }
}

// advertisement
if (!function_exists('advertisements')) {
    function advertisements()
    {
        return $advertisements = Advertisement::take(3)->latest()->get();
    }
}

// sliders
if (!function_exists('sliders')) {
    function sliders()
    {
        return $sliders = Slider::all();
    }
}




