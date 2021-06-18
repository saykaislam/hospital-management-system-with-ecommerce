<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Color;
use App\FlashSaleSet;
use App\Http\Helpers;
use App\Product;
use App\ProductStock;
use App\Shop;
use App\ShopBrand;
use App\ShopCategory;
use App\ShopSubCategory;
use App\SubCategory;
use App\SubSubCategory;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Laravel\Scout\Searchable;

class ProductController extends Controller
{

    public function index()
    {
        //$flashSale = FlashSaleSet::find(1);
        $products = Product::latest()->get();
        return view('backend.admin.product.index', compact('products'));
    }


    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $vendors = User::where('role_id',6)->get();
        $auth_user_id = Auth::user()->id;

        return view('backend.admin.product.create',compact('categories','brands','vendors','auth_user_id'));
    }
//    public function ajaxSubCat ($id)
//    {
//        //dd($id);
//        $Sub_Cate_data = SubCategory::where('category_id',$id)->get();
//        return response()->json(['success'=> true, 'response'=>$Sub_Cate_data]);
//    }
    public function ajaxSlugMake($name)
    {
        $data = Str::slug($name, '-');
        return response()->json(['success'=> true, 'response'=>$data]);
    }
    public function ajaxSubCat (Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->category_id)->get();
        return $subcategories;
    }
    public function ajaxSubSubCat(Request $request)
    {
        $subsubcategories = SubSubCategory::where('sub_category_id', $request->subcategory_id)->get();
        return $subsubcategories;
    }

    public function sku_combination(Request $request)
    {
        //dd('ami ses');
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
            //dd('ami colors');
        }
        else {
            $colors_active = 0;
        }

        $unit_price = $request->unit_price;
        $product_name = $request->name;

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        $combinations = Helpers::combinations($options);
        return view('backend.partials.sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
    }


    public function store(Request $request)
    {
//        dd($request->all());
        $product = new Product();
        $product->name = $request->name;
        $product->role_id = $request->role_id;
        $product->user_id = User::where('role_id', '1')->first()->id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->subsubcategory_id = $request->subsubcategory_id;
        $product->brand_id = $request->brand_id;
//        $product->tags = implode('|',$request->tags);
        if ($request->current_stock == 1){
            $product->current_stock = 100000;
        }else{
            $product->current_stock = 0;
        }
        $photos = array();

        if($request->hasFile('photos')){
            foreach ($request->photos as $key => $photo) {
                $path = $photo->store('uploads/products/photos');
                array_push($photos, $path);
            }
            $product->photos = json_encode($photos);
        }

        if($request->hasFile('thumbnail_img')){
            $product->thumbnail_img = $request->thumbnail_img->store('uploads/products/thumbnail');
            //ImageOptimizer::optimize(base_path('public/').$product->thumbnail_img);
        }

        $product->unit = $request->unit;
        $product->description = $request->description;
        $product->video_link = $request->video_link;
        $product->unit_price = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        $product->discount = $request->discount;
        $product->discount_type = $request->discount_type;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->slug = $request->slug.'-'.Str::random(5);
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){

            $data = Array();
            foreach ($request->colors as $color){
                $colorName = Color::where('code',$color)->first();
                $color_item['name'] = $colorName->name;
                $color_item['code'] = $color;
                array_push($data, $color_item);
                //$data = array_push($colorName,$color);
            }
            //dd($data);
            $product->colors = json_encode($data);
        }
        else {
            $colors = array();
            $product->colors = json_encode($colors);
        }
        //choice option data
        $choice_options = array();
        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_'.$no;

                $item['attribute_id'] = $no;
                $item['values'] = explode(',', implode('|', $request[$str]));

                array_push($choice_options, $item);
            }
        }

        if (!empty($request->choice_no)) {
            $product->attributes = json_encode($request->choice_no);
        }
        else {
            $product->attributes = json_encode(array());
        }
        $product->choice_options = json_encode($choice_options);
        $product->save();

        //combinations start
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('|',$request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        //Generates the combinations of customer choice options
        $combinations = Helpers::combinations($options);
        if(count($combinations[0]) > 0){
            $product->variant_product = 1;
            foreach ($combinations as $key => $combination){
                $str = '';
                foreach ($combination as $key => $item){
                    if($key > 0 ){
                        $str .= '-'.str_replace(' ', '', $item);
                    }
                    else{
                        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                            $color_name = Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        }
                        else{
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }
                // $item = array();
                // $item['price'] = $request['price_'.str_replace('.', '_', $str)];
                // $item['sku'] = $request['sku_'.str_replace('.', '_', $str)];
                // $item['qty'] = $request['qty_'.str_replace('.', '_', $str)];
                // $variations[$str] = $item;

                $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                if($product_stock == null){
                    $product_stock = new ProductStock();
                    $product_stock->product_id = $product->id;
                }

                $product_stock->variant = $str;
                $product_stock->price = $request['price_'.str_replace('.', '_', $str)];
                $product_stock->sku = $request['sku_'.str_replace('.', '_', $str)];
                /*$product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];*/
                if ($request->current_stock == 1){
                    $product_stock->qty = 100000;
                }else{
                    $product_stock->qty = 0;
                }
                $product_stock->save();
            }
            //combinations end
            $product->save();
            Toastr::success("Product Inserted Successfully","Success");
            return redirect()->route('admin.products.index');
        }
        $shopId = Shop::where('user_id',Auth::id())->first();
        $shopCategory = ShopCategory::where('shop_id',$shopId->id)->where('category_id',$request->category_id)->first();
        if(empty($shopCategory)){
            $shopCategoryData = new ShopCategory();
            $shopCategoryData->shop_id = $shopId->id;
            $shopCategoryData->category_id = $request->category_id;
            //Toastr::success("Shop Category Inserted Successfully","Success");
            $shopCategoryData->save();
        }
        $shopSubcategory = ShopSubCategory::where('shop_id',$shopId->id)->where('subcategory_id',$request->subcategory_id)->where('category_id',$request->category_id)->first();
        if(empty($shopSubcategory)){
            $shopSubcategoryData = new ShopSubcategory();
            $shopSubcategoryData->shop_id = $shopId->id;
            $shopSubcategoryData->subcategory_id = $request->subcategory_id;
            $shopSubcategoryData->category_id = $request->category_id;
            $shopSubcategoryData->save();
        }
        $shopBrand = ShopBrand::where('shop_id',$shopId->id)->where('brand_id',$request->brand_id)->first();
        if(empty($shopBrand)){
            $shopBrandData = new ShopBrand();
            $shopBrandData->shop_id = $shopId->id;
            $shopBrandData->brand_id = $request->brand_id;
            $shopBrandData->save();
        }
        $product->save();
        Toastr::success("Product Inserted Successfully","Success");
        return redirect()->route('admin.products.index');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::find(decrypt($id));
        $categories = Category::all();
        $brands = Brand::all();
//        $vendors = User::where('role_id',6)->get();
//        $auth_user_id = Auth::user()->id;

        return view('backend.admin.product.edit',compact('product','categories','brands'));
    }
    public function sku_combination_edit(Request $request)
    {
       //dd('hhhhh');
       //dd($request->all());
        $product = Product::find($request->id);
        $options = array();
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        } else {
            $colors_active = 0;
        }

        $product_name = $request->name;
        $unit_price = $request->unit_price;

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        $combinations = Helpers::combinations($options);
        return view('backend.partials.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
    }
    public function update(Request $request, $id){}
    public function update2(Request $request, $id)
    {
        $product = Product::find(decrypt($id));
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->subsubcategory_id = $request->subsubcategory_id;
        $product->brand_id = $request->brand_id;
//        $product->tags = implode('|',$request->tags);
        if ($request->current_stock == 1){
            $product->current_stock = 100000;
        }else{
            $product->current_stock = 0;
        }

        if($request->has('previous_photos')){
            $photos = $request->previous_photos;
        }
        else{
            $photos = array();
        }

        if($request->hasFile('photos')){
            foreach ($request->photos as $key => $photo) {
                $path = $photo->store('uploads/products/photos');
                array_push($photos, $path);
                //ImageOptimizer::optimize(base_path('public/').$path);
            }
        }
        $product->photos = json_encode($photos);

        $product->thumbnail_img = $request->previous_thumbnail_img;
        if($request->hasFile('thumbnail_img')){
            $product->thumbnail_img = $request->thumbnail_img->store('uploads/products/thumbnail');
            //ImageOptimizer::optimize(base_path('public/').$product->thumbnail_img);
        }
        $product->unit = $request->unit;
        //$product->min_qty = $request->min_qty;
        //$product->tags = implode('|',$request->tags);
        $product->description = $request->description;
        //$product->video_provider = $request->video_provider;
        $product->video_link = $request->video_link;
        $product->unit_price = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        //$product->tax = $request->tax;
        //$product->tax_type = $request->tax_type;
        $product->discount = $request->discount;
        $product->discount_type = $request->discount_type;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->slug = $request->slug.'-'.Str::random(5);
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $data = Array();
            foreach ($request->colors as $color){
                $colorName = Color::where('code',$color)->first();
                $color_item['name'] = $colorName->name;
                $color_item['code'] = $color;
                array_push($data, $color_item);
                //$data = array_push($colorName,$color);
            }
            //dd($data);
            $product->colors = json_encode($data);
        }
        else {
            $colors = array();
            $product->colors = json_encode($colors);
        }
        $choice_options = array();

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_'.$no;

                $item['attribute_id'] = $no;
                $item['values'] = explode(',', implode('|', $request[$str]));

                array_push($choice_options, $item);
            }
        }
        if($product->attributes != json_encode($request->choice_attributes)){
            foreach ($product->stocks as $key => $stock) {
                $stock->delete();
            }
        }

        if (!empty($request->choice_no)) {
            $product->attributes = json_encode($request->choice_no);
        }
        else {
            $product->attributes = json_encode(array());
        }
        $product->choice_options = json_encode($choice_options);

        //combinations start
        $options = array();
        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if($request->has('choice_no')){
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_'.$no;
                $my_str = implode('|',$request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        $combinations = Helpers::combinations($options);
        if(count($combinations[0]) > 0){
            $product->variant_product = 1;
            foreach ($combinations as $key => $combination){
                $str = '';
                foreach ($combination as $key => $item){
                    if($key > 0 ){
                        $str .= '-'.str_replace(' ', '', $item);
                    }
                    else{
                        if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
                            $color_name = Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        }
                        else{
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }

                $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                if($product_stock == null){
                    $product_stock = new ProductStock();
                    $product_stock->product_id = $product->id;
                }

                $product_stock->variant = $str;
                $product_stock->price = $request['price_'.str_replace('.', '_', $str)];
                $product_stock->sku = $request['sku_'.str_replace('.', '_', $str)];
                /*$product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];*/
                if ($request->current_stock == 1){
                    $product_stock->qty = 100000;
                }else{
                    $product_stock->qty = 0;
                }
                $product_stock->save();
            }
        }
        $shopId = Shop::where('user_id',Auth::id())->first();
        $shopCategory = ShopCategory::where('shop_id',$shopId->id)->where('category_id',$request->category_id)->first();
        if(empty($shopCategory)){
            $shopCategoryData = new ShopCategory();
            $shopCategoryData->shop_id = $shopId->id;
            $shopCategoryData->category_id = $request->category_id;
            //Toastr::success("Shop Category Inserted Successfully","Success");
            $shopCategoryData->save();
        }
        $shopSubcategory = ShopSubCategory::where('shop_id',$shopId->id)->where('subcategory_id',$request->subcategory_id)->where('category_id',$request->category_id)->first();
        if(empty($shopSubcategory)){
            $shopSubcategoryData = new ShopSubcategory();
            $shopSubcategoryData->shop_id = $shopId->id;
            $shopSubcategoryData->subcategory_id = $request->subcategory_id;
            $shopSubcategoryData->category_id = $request->category_id;
            $shopSubcategoryData->save();
        }
        $shopBrand = ShopBrand::where('shop_id',$shopId->id)->where('brand_id',$request->brand_id)->first();
        if(empty($shopBrand)){
            $shopBrandData = new ShopBrand();
            $shopBrandData->shop_id = $shopId->id;
            $shopBrandData->brand_id = $request->brand_id;
            $shopBrandData->save();
        }
        $product->save();
        Toastr::success("Product Updated Successfully","Success");
        return redirect()->route('admin.products.index');

    }

    public function destroy($id)
    {

    }
    public function slugChange(Request $request)
    {
        //dd($request->all());
        $product = Product::find($request->product_id);
        $product->slug = $request->slug;
        $product->save();
        Toastr::success('Slug change Successfully Done! (^_^)');
        return redirect()->route('admin.products.index');
    }

    public function hide(Request $request, $id)
    {
        //dd($request->all());
        $product = Product::find($id);
        $product->active = $request->active;
        $product->update();
        Toastr::success('Done');
        return redirect()->route('admin.products.index');
    }

    public function flushSaleUpdate(Request $request, $id)
    {
        //dd($request->all());
        $product = Product::find($id);
        $product->flash_sale = $request->flash_sale;
        $product->save();
        Toastr::success('Flush Sales change Successfully Done! (^_^)');
        return redirect()->route('admin.products.index');
    }
    public function flushSaleStore(Request $request)
    {
       $this->validate($request,[
          'start_date' => 'required',
          'end_date' => 'required',
          'start_time' => 'required',
          'end_time' => 'required',
       ]);
       $flashSale = FlashSaleSet::find(1);
       if (!$flashSale)
       {
           $data = new FlashSaleSet();
           $data->start_date = $request->start_date;
           $data->end_date = $request->end_date;
           $data->start_time = $request->start_time;
           $data->end_time = $request->end_time;
//           $data->status = $request->status;
           $flashSale->status = 1;
           $data->save();
           Toastr::success('Flash Date Time set successfully');
           return back();
       }else {
           $flashSale->start_date = $request->start_date;
           $flashSale->end_date = $request->end_date;
           $flashSale->start_time = $request->start_time;
           $flashSale->end_time = $request->end_time;
//           $flashSale->status = $request->status;
           $flashSale->status = 1;
           $flashSale->save();
           Toastr::success('Flash Date Time set successfully');
           return back();
       }
    }
    //today's deals update
    public function updateTodaysDeal(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->todays_deal = $request->status;
        if($product->save()){
            return 1;
        }
        return 0;
    }
    //product published
    public function updatePublished(Request $request)
    {
        //return 'ok';
        $product = Product::find($request->id);
        $product->published = $request->status;
        if (url('/admin/seller-requested-products')){
            $product->admin_permission = 1;
        }
        if($product->save()){
            return 1;
        }
        return 0;
    }
    //featured product status updated
    public function updateFeatured(Request $request)
    {
        $product = Product::find($request->id);
        $product->featured = $request->status;
        if($product->save()){
            return 1;
        }
        return 0;
    }
    public function sellerReqList()
    {
        $products = Product::where('role_id',6)->where('admin_permission',0)->latest()->get();
        return view('backend.admin.product.seller_request_product_list', compact('products'));
    }


    public function sellerProductList()
    {
        $products = Product::where('role_id',6)->where('admin_permission',1)->latest()->get();
        return view('backend.admin.product.seller_all_products', compact('products'));

    }

    public function sellerProductEdit($id)
    {
        //dd($id);
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::find(decrypt($id));
        //dd($product);
        return view('backend.admin.product.seller_product_edit',compact('brands', 'categories','product'));
    }

    public function sellerProductUpdate(Request $request,$id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->subsubcategory_id = $request->subsubcategory_id;
        $product->brand_id = $request->brand_id;
        $product->tags = implode('|', $request->tags);
        if ($request->current_stock == 1) {
            $product->current_stock = 100000;
        } else {
            $product->current_stock = 0;
        }

        if ($request->has('previous_photos')) {
            $photos = $request->previous_photos;
        } else {
            $photos = array();
        }

        if ($request->hasFile('photos')) {
            foreach ($request->photos as $key => $photo) {
                $path = $photo->store('uploads/products/photos');
                array_push($photos, $path);
                //ImageOptimizer::optimize(base_path('public/').$path);
            }
        }
        $product->photos = json_encode($photos);

        $product->thumbnail_img = $request->previous_thumbnail_img;
        if ($request->hasFile('thumbnail_img')) {
            $product->thumbnail_img = $request->thumbnail_img->store('uploads/products/thumbnail');
            //ImageOptimizer::optimize(base_path('public/').$product->thumbnail_img);
        }
        $product->unit = $request->unit;
        //$product->min_qty = $request->min_qty;
        //$product->tags = implode('|',$request->tags);
        $product->description = $request->description;
        //$product->video_provider = $request->video_provider;
        $product->video_link = $request->video_link;
        $product->unit_price = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        //$product->tax = $request->tax;
        //$product->tax_type = $request->tax_type;
        $product->discount = $request->discount;
        $product->discount_type = $request->discount_type;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->slug = $request->slug . '-' . Str::random(5);
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $data = array();
            foreach ($request->colors as $color) {
                $colorName = Color::where('code', $color)->first();
                $color_item['name'] = $colorName->name;
                $color_item['code'] = $color;
                array_push($data, $color_item);
                //$data = array_push($colorName,$color);
            }
            //dd($data);
            $product->colors = json_encode($data);
        } else {
            $colors = array();
            $product->colors = json_encode($colors);
        }
        $choice_options = array();

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $str = 'choice_options_' . $no;

                $item['attribute_id'] = $no;
                $item['values'] = explode(',', implode('|', $request[$str]));

                array_push($choice_options, $item);
            }
        }
        if ($product->attributes != json_encode($request->choice_attributes)) {
            foreach ($product->stocks as $key => $stock) {
                $stock->delete();
            }
        }

        if (!empty($request->choice_no)) {
            $product->attributes = json_encode($request->choice_no);
        } else {
            $product->attributes = json_encode(array());
        }
        $product->choice_options = json_encode($choice_options);

        //combinations start
        $options = array();
        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
            $colors_active = 1;
            array_push($options, $request->colors);
        }

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $key => $no) {
                $name = 'choice_options_' . $no;
                $my_str = implode('|', $request[$name]);
                array_push($options, explode(',', $my_str));
            }
        }

        $combinations = Helpers::combinations($options);
        if (count($combinations[0]) > 0) {
            $product->variant_product = 1;
            foreach ($combinations as $key => $combination) {
                $str = '';
                foreach ($combination as $key => $item) {
                    if ($key > 0) {
                        $str .= '-' . str_replace(' ', '', $item);
                    } else {
                        if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                            $color_name = Color::where('code', $item)->first()->name;
                            $str .= $color_name;
                        } else {
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                }

                $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
                if ($product_stock == null) {
                    $product_stock = new ProductStock;
                    $product_stock->product_id = $product->id;
                }

                $product_stock->variant = $str;
                $product_stock->price = $request['price_' . str_replace('.', '_', $str)];
                $product_stock->sku = $request['sku_' . str_replace('.', '_', $str)];
                /*$product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];*/
                if ($request->current_stock == 1) {
                    $product_stock->qty = 100000;
                } else {
                    $product_stock->qty = 0;
                }
                $product_stock->save();
            }
        }
        $product->save();
        Toastr::success("Seller Product Updated Successfully", "Success");
        return redirect()->route('admin.all.seller.products');
    }

    public function allSellerProducts(){
        $products = Product::where('role_id',6)->latest()->get();
        return view('backend.admin.product.all_sellers_products',compact('products'));

    }
}
