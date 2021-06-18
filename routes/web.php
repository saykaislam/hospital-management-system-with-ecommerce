<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'cache clear';
});
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'config:cache';
});
Route::get('/view-cache', function() {
    $exitCode = Artisan::call('view:cache');
    return 'view:cache';
});
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return 'view:clear';
});


// SSLCOMMERZ Start
Route::get('/pay', 'PublicSslCommerzPaymentController@index')->name('pay');
Route::POST('/success', 'PublicSslCommerzPaymentController@success');
Route::POST('/fail', 'PublicSslCommerzPaymentController@fail');
Route::POST('/cancel', 'PublicSslCommerzPaymentController@cancel');
Route::POST('/ipn', 'PublicSslCommerzPaymentController@ipn');
//SSLCOMMERZ END


Route::get('privacy-policy', 'Frontend\FrontendController@privacy_policy')->name('privacy-policy');
Route::get('terms-and-conditions', 'Frontend\FrontendController@terms_and_conditions')->name('terms-and-conditions');


// shop pages
Route::get('privacy-and-policy', 'Frontend\Shop\ShopPageController@privacy_and_policy')->name('privacy-and-policy');
Route::get('terms-and-conditions', 'Frontend\Shop\ShopPageController@terms_and_conditions')->name('terms-conditions');
Route::get('faq', 'Frontend\Shop\ShopPageController@faq')->name('faq');
Route::get('about-us', 'Frontend\Shop\ShopPageController@about_us')->name('about-us');
Route::get('contact-us', 'Frontend\Shop\ShopPageController@contact_us')->name('contact-us');


Route::get('/', 'Frontend\FrontendController@index')->name('index');

//Search
Route::get('/search/doctor', 'Frontend\FrontendController@search_doctor');
Route::get('/search/hospital', 'Frontend\FrontendController@search_hospital');
//Route::get('/search/product', 'Frontend\FrontendController@search_product');
Route::get('/search/service', 'Frontend\FrontendController@search_service');
Route::get('/search/test', 'Frontend\FrontendController@search_test');


//Route::get('/search/product', 'Frontend\VendorController@search_product');
//Route::get('/search/category/product', 'Frontend\VendorController@search_category_product');
//Route::get('/search/subcategory/product', 'Frontend\VendorController@search_subcategory_product');
Route::get('/product/filter/{data}/shopId/{shopId}', 'Frontend\SellerController@productFilter');
//Route::get('/featured-product/subcategories/filter/{data}/sellerId/{id}/sub/{subId}', 'Frontend\VendorController@FeaturedSubFilter');
//Route::get('/todays-deal/product/filter/{data}/shopId/{shopId}', 'Frontend\VendorController@todaysDealFilter');
//Route::get('/todays-deal/subcategories/filter/{data}/sellerId/{id}/sub/{subId}', 'Frontend\VendorController@todaysDealSubFilter');
Route::get('/best-selling/product/filter/{data}/shopId/{shopId}', 'Frontend\SellerController@bestSellingFilter');
//Route::get('/best-selling/subcategories/filter/{data}/sellerId/{id}/sub/{subId}', 'Frontend\VendorController@bestSellingSubFilter');
//Route::get('/brand/product/filter/{data}/shopId/{id}/brand/{brndId}', 'Frontend\VendorController@brandFilter');

//Health Tips
Route::get('health-tips/{slug}','Frontend\HealthDetailsController@index')->name('health_tips.details');
Route::get('health-tips/post/list','Frontend\HealthDetailsController@allTips')->name('health.tips.list');
Route::get('/health-tips/category/{slug}','Frontend\HealthDetailsController@postByCategory')->name('health.category.posts');


Route::get('clinic', 'Frontend\ClinicController@clinicList')->name('clinic');
Route::get('clinic-doctor/{slug}', 'Frontend\ClinicController@clinicDoctorList')->name('clinic.doctor');
Route::get('clinic-details/{slug}', 'Frontend\ClinicController@clinicDetails')->name('clinic.details');
Route::get('doctor', 'Frontend\DoctorController@doctorList')->name('doctor');
Route::get('doctor-details/{slug}', 'Frontend\DoctorController@doctorDetails')->name('doctor.details');
Route::get('doctor/booking/{slug}', 'Frontend\DoctorController@doctorBooking')->name('doctor.booking');
Route::post('doctor/booking/find/slot', 'Frontend\DoctorController@doctorBookingFindSlot')->name('doctor.booking.find.slot');

Route::get('doctor-booking-checkout/{slug}/{schedule_id}', 'Frontend\DoctorController@doctorBookingCheckout')->name('doctor.booking.checkout')->middleware('auth', 'user');
Route::get('doctor-booking-success/{slug}', 'Frontend\DoctorController@doctorBookingSuccess')->name('doctor.booking.success')->middleware('auth', 'user');
Route::post('doctor-booking-checkout-store/{slot_id}','Frontend\DoctorController@doctorBookingStore')->name('doctor.booking.checkout.store')->middleware('auth', 'user');
Route::get('doctor-booking-success-message/{slot_id}', 'Frontend\DoctorController@doctorBookingSuccessMessage')->name('doctor.booking.success.message')->middleware('auth', 'user');
Route::get('doctor-booking-invoice-view', 'Frontend\DoctorController@doctorBookingInvoiceView')->name('doctor.booking.invoice.view');
Route::get('question-form', 'Frontend\FrontendController@questionForm')->name('question.form');
Route::post('doctor', 'Frontend\DoctorController@doctorfilter')->name('doctor.filter');

Route::get('service-provider-category', 'Frontend\ServiceController@serviceProviderCategory')->name('service.provider.category');
Route::get('service-provider/{slug}', 'Frontend\ServiceController@serviceProviderService')->name('service.provider.service');
Route::get('service-category/{slug}', 'Frontend\ServiceController@serviceCategory')->name('service.category');
Route::get('service-sub-category/{slug}', 'Frontend\ServiceController@serviceSubCategory')->name('service.sub.category');
Route::get('cart/', 'Frontend\FrontendController@cart')->name('cart');
Route::post('/service/service_provider/near/list', 'Frontend\FrontendController@service_provider' )->name('service.service_provider.near.list');
Route::post('/doctor/near/list', 'Frontend\FrontendController@doctor_near_list' )->name('doctor.near.list');

Route::get('all-service-by-category', 'Frontend\ServiceController@allserviceCategory')->name('all.service.category');
Route::get('all-service-by-sub-category', 'Frontend\ServiceController@allserviceSubCategory')->name('all.service.sub.category');

// static service provider category route start
Route::get('service-provider/caregivers', 'Frontend\ServiceController@serviceProviderService')->name('service.provider.caregivers');
Route::get('service-provider/house-keeping', 'Frontend\ServiceController@serviceProviderService')->name('service.provider.house-keeping');
Route::get('service-provider/house-keeping', 'Frontend\ServiceController@serviceProviderService')->name('service.provider.house-keeping');
Route::get('service-provider/corporate-service', 'Frontend\ServiceController@serviceProviderService')->name('service.provider.corporate-service');
Route::get('service-provider/corporate-service', 'Frontend\ServiceController@serviceProviderService')->name('service.provider.corporate-service');
Route::get('service-provider/home-aplliance', 'Frontend\ServiceController@serviceProviderService')->name('service.provider.home-aplliance');
Route::get('service-provider/moving-and-shifting', 'Frontend\ServiceController@serviceProviderService')->name('service.provider.moving-and-shifting');
Route::get('service-provider/car-rental', 'Frontend\ServiceController@serviceProviderService')->name('service.provider.car-rental');
Route::get('service-provider/it-service', 'Frontend\ServiceController@serviceProviderService')->name('service.provider.it-service');
Route::get('service-provider/event-management', 'Frontend\ServiceController@serviceProviderService')->name('service.provider.event-management');
// static service provider category route end


// service
Route::post('/addToCart', 'Frontend\CartController@addCart' )->name('service.cart.add');
Route::post('/order/store', 'Frontend\CartController@order')->name('order.store');
Route::post('/quantity_update', 'Frontend\CartController@quantityUpdate')->name('qty.update');
Route::get('/remove/cart/{id}', 'Frontend\CartController@cartRemove')->name('cart.remove');
Route::get('/remove/all/cart', 'Frontend\CartController@clearCart')->name('cart.remove.all');

Auth::routes();
Route::post('/reset-password', '\App\Http\Controllers\Auth\LoginController@reset_pass_check_mobile')->name('reset.pass.mobile');
Route::post('/reset-password/send', '\App\Http\Controllers\Auth\LoginController@reset_pass')->name('reset.pass');

//Route::get('/home', 'HomeController@index')->name('home');admin.Doctor.update

Route::post('/user-registration-store', 'Frontend\UserController@registrationStore')->name('user.registration.store');

Route::get('/get-verification-code/{id}', 'Frontend\VerificationController@getVerificationCode')->name('get-verification-code');
Route::post('/get-verification-code-store', 'Frontend\VerificationController@verification')->name('get-verification-code.store');
Route::get('/check-verification-code', 'Frontend\VerificationController@CheckVerificationCode')->name('check-verification-code');

// Seller Registration
Route::get('be-a-seller', 'Seller\AuthController@ShowRegForm')->name('seller.registration');
Route::post('be-a-seller/store', 'Seller\AuthController@store')->name('seller.registration.store');
Route::get('seller/login', 'Seller\AuthController@sellerLoginForm')->name('seller.login');

//ECOMMERCE
Route::get('/shop', 'Frontend\Shop\IndexController@index')->name('shop');
//Route::get('/shop/cart', 'Frontend\Shop\ShopController@cart')->name('shop.cart.list');
//Route::get('/shop/checkout', 'Frontend\shop\ShopController@checkout')->name('shop.checkout')->middleware('auth', 'user');
//Route::post('/shop/order/submit', 'Frontend\shop\ShopController@order')->name('shop.order.submit')->middleware('auth', 'user');
//Route::get('/product/{slug}', 'Frontend\shop\ShopController@product_details')->name('product.details');
//Route::post('/shop/product/cart/add', 'Frontend\shop\ShopController@cartAddProduct')->name('product.cart.add');
//Route::post('/shop', 'Frontend\shop\ShopController@homecatefilter')->name('shop.filter.cat');


// Ecommerce shop
Route::get('/product/{slug}', 'Frontend\Shop\ProductController@ProductDetails')->name('product-details');
//Route::post('/products/get/variant/price', 'Frontend\Shop\ProductController@ProductVariantPrice')->name('product.variant.price');
//Route::post('/products/get/variant/price', 'Frontend\Shop\ProductController@ProductVariantPrice')->name('product.variant.price');
Route::post('/products/get/variant/price', function () {
    return ProductVariantPrice();
})->name('product.variant.price');
Route::get('/shopping-cart', 'Frontend\Shop\CartController@viewCart')->name('shopping-cart');
Route::get('/shopping-checkout', 'Frontend\Shop\CartController@checkout')->name('shopping-checkout');
Route::post('/shopping-cart/quantity_update', 'Frontend\Shop\CartController@quantityUpdate')->name('shopping.qty.update');


//Shop/Vendor
Route::get('/shop/{slug}', 'Frontend\SellerController@singleshop')->name('shop.details');
Route::get('/search/product', 'Frontend\SellerController@search_product');

Route::get('/all-shop/list','Frontend\SellerController@allShops')->name('all.shops');

Route::get('/shop/{shop}/{cat}', 'Frontend\SellerController@productByCategory');
Route::get('/all-products/{cat}/{sub}', 'Frontend\SellerController@productBySubcategory');


//Shop Featured Pages
Route::get('/flash-deal-products/{slug}','Frontend\SellerController@allFlashDealProducts')->name('all.flash-deal.products');
Route::get('/featured-category/{slug}','Frontend\SellerController@allFeaturedCategory')->name('all.featured.category');
Route::get('/featured-products/{slug}','Frontend\Shop\ProductController@allFeaturedProduct')->name('all.featured.products');
Route::get('/best-sales-products/{slug}','Frontend\Shop\ProductController@allBestSalesProduct')->name('all.best_sales.products');
Route::get('/best-sale/category/products/{id}','Frontend\Shop\ProductController@best_sale_categoryProduct');
Route::get('/featured/category/products/{id}','Frontend\Shop\ProductController@featured_categoryProduct');
Route::get('/featured/brand/products/{id}','Frontend\Shop\ProductController@featured_brandProduct');
Route::get('/best-sale/brand/products/{id}','Frontend\Shop\ProductController@best_sale_brandProduct');

//Product by Brand
Route::get('/product/brand/{slug}','Frontend\SellerController@productByBrand')->name('brand.wise.products');

Route::get('/products/{slug}', 'Frontend\ProductController@productList')->name('product.list');
Route::get('/products/{name}/{slug}/{sub}', 'Frontend\ProductController@productSubCategory')->name('product.by.subcategory');
Route::get('/products/{name}/{slug}', 'Frontend\ProductController@productByBrand')->name('product.by.brand');
Route::post('/products/ajax/addtocart', 'Frontend\Shop\CartController@ProductAddCart')->name('product.add.cart');
Route::get('/product/clear/cart', 'Frontend\CartController@clearCart')->name('product.clear.cart');
Route::get('/product/remove/cart/{id}', 'Frontend\Shop\CartController@cartRemove')->name('product.cart.remove');
Route::post('/cart/quantity_update', 'Frontend\Shop\CartController@quantityUpdate')->name('qty.update');
Route::get('/best-sells/products','Frontend\ProductController@bestSellsProducts')->name('best-sells-all-products');

//Blog
Route::get('/blog/list','Frontend\BlogController@blogList')->name('blog.list');
Route::get('/blog/{slug}','Frontend\BlogController@blogDetails')->name('blog.details');


// Wishlist
Route::get('/add/wishlist/{id}', 'User\WishlistController@wishlistAdd' )->name('add.wishlist');


//Test
Route::get('/lab-test', 'Frontend\test\TestController@home')->name('test');
Route::get('/test/lab/{slug}', 'Frontend\test\TestController@test_lab')->name('test.lab');
Route::get('/test/cart', 'Frontend\test\TestController@cart')->name('test.cart.list');
Route::post('/test/lab/cart/add', 'Frontend\test\TestController@cartAddTest')->name('test.cart.add');
Route::get('/test/checkout', 'Frontend\test\TestController@checkout')->name('test.checkout')->middleware('auth', 'user');
Route::post('/test/order/submit', 'Frontend\test\TestController@order')->name('test.order.submit')->middleware('auth', 'user');


Route::group(['middleware' => ['auth', 'admin']], function () {
    //this route only for with out resource controller
    Route::get('/admin/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    //this route only for resource controller
    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin',], function () {
//        Route::resource('category', 'CategoryController');
//        Route::resource('subCategory', 'SubCategoryController');
//        Route::resource('brand', 'BrandController');
        Route::resource('clinicCategory', 'ClinicCategoryController');
        Route::resource('DoctorSpeciality', 'DoctorSpecialityController');
        Route::resource('Doctor', 'DoctorController');
        Route::resource('serviceCategory', 'ServiceCategoryController');
        Route::resource('serviceSubCategory', 'ServiceSubCategoryController');
        Route::resource('services', 'ServiceController');
        Route::resource('serviceProviderCategory', 'ServiceProviderCategoryController');
        Route::resource('doctor.basic.update', 'ServiceSubChildCategoryController');
        Route::resource('relatedQuestions', 'RelatedQuestionController');
        Route::resource('days', 'DayController');
        Route::resource('tests', 'TestController');
        Route::resource('health-tips-category', 'HealthTipsCategoryController');
        Route::resource('health-tips-list', 'HealthTipsController');
        Route::resource('banner', 'BannerController');

        //Admin Shop
        Route::resource('shop','ShopController');


        //shop
        Route::resource('brands', 'BrandController');
        Route::resource('category', 'CategoryController');
        Route::resource('subcategory', 'SubCategoryController');
        Route::resource('subsubcategory', 'SubSubCategoryController');
        Route::resource('attributes','AttributeController');
        Route::resource('products', 'ProductController');
        Route::resource('advertisements', 'AdvertisementController');
        Route::resource('sliders', 'SliderController');
        Route::resource('blogs', 'BlogController');
        Route::resource('shop_pages', 'ShopPageController');



        //Admin Profile
        Route::get('profile','ProfileController@index')->name('profile.index');
        Route::post('profile/update','ProfileController@updateProfile')->name('profile.update');
        Route::post('password/update','ProfileController@updatePassword')->name('password.update');


        //Seller
        Route::get('sellers','SellerController@index')->name('sellers.index');
        Route::post('sellers/verification','SellerController@verification')->name('seller.verification');
        Route::get('sellers/profile/show/{id}','SellerController@profileShow')->name('seller.profile.show');
        Route::post('sellers/profile/update/{id}','SellerController@profileUpdate')->name('seller.profile.update');
        Route::post('sellers/password/update/{id}','SellerController@passwordUpdate')->name('seller.password.update');
        Route::post('sellers/shop-address/update/{id}','SellerController@shopAddressUpdate')->name('seller.shop-address.update');
        Route::post('sellers/bankinfo/update/{id}','SellerController@bankInfoUpdate')->name('seller.bankinfo.update');
        Route::post('/sellers/payment_modal', 'SellerController@sellerPaymentModal')->name('sellers.payment_modal');
        Route::post('/payment_modal', 'SellerController@admin_payment_modal')->name('payment_modal');
        Route::post('/sellers/pay_to_seller_commission', 'SellerController@pay_to_seller_commission')->name('seller.commissions.pay_to_seller');
        Route::get('sellers/payment/history','SellerController@SellerPaymentHistory')->name('seller.payment.history');
        Route::get('payment/history','SellerController@adminPaymentHistory')->name('payment.history');
        Route::post('/widthdraw-request/store/{id}', 'SellerController@admin_withdraw_store')->name('withdraw-request.store');
        Route::post('/sellers/commission_modal', 'SellerController@commission_modal')->name('sellers.commission_modal');
        Route::put('/sellers/individual/commission/set/{id}', 'SellerController@individulCommissionSet')->name('seller.individual.commission.set');
        Route::get('/sellers/ban/{id}','SellerController@banSeller')->name('sellers.ban');

        //Seller Payment
        Route::get('due-to-seller','PaymentController@dueToSeller')->name('due-to-seller');
        Route::post('due-to-seller-details','PaymentController@dueToSellerDetails')->name('due-to-seller-details');
        Route::get('due-to-admin','PaymentController@dueToAdmin')->name('due-to-admin');
        Route::post('due-to-admin-details','PaymentController@dueToAdminDetails')->name('due-to-admin-details');


        //Business Settings
        Route::get('business/settings','BusinessSettingController@index')->name('business.index');
        Route::post('seller/commission/update','BusinessSettingController@commissionUpdate');
        Route::post('refferal/value/update','BusinessSettingController@refferalValueUpdate');
        Route::post('first_order/value/update','BusinessSettingController@firstOrderValueUpdate');

        //flash sales start
        Route::resource('flash_deals','FlashDealController');
        Route::get('/flash_deals/products/add/{flush_id}', 'FlashDealController@productsAdd')->name('flash_deals.products.add');
        Route::get('/flash_deals/products/edit/{flush_id}', 'FlashDealController@productsEdit')->name('flash_deals.products.edit');
        Route::post('/flash_deals/products/store', 'FlashDealController@flashDealProductsStore')->name('flash_deals.products.store');
        Route::get('/flash_deals/shop/products/{id}', 'FlashDealController@shopProducts')->name('flash_deals.shop.products');
        Route::get('/flash_deals/shop/products/edit/{id}/{flush_id}', 'FlashDealController@shopProductsEdit')->name('flash_deals.shop.products.edit');
        Route::post('/flash_deals/update_status', 'FlashDealController@update_status')->name('flash_deals.update_status');
        Route::post('/flash_deals/update_featured', 'FlashDealController@update_featured')->name('flash_deals.update_featured');
        Route::post('/flash_deals/product_discount', 'FlashDealController@product_discount')->name('flash_deals.product_discount');
        Route::post('/flash_deals/product_discount_edit', 'FlashDealController@product_discount_edit')->name('flash_deals.product_discount_edit');
        Route::post('/flash_deals/shop/wise/update', 'FlashDealController@flashDealProductsUpdate')->name('flash_deals.shop.wise.products.update');

        Route::post('categories/is_home', 'CategoryController@updateIsHome')->name('categories.is_home');


        // Admin Order Management
        Route::get('all-orders','OrderManagementController@index')->name('all.orders');
        Route::get('order/pending','OrderManagementController@pendingOrder')->name('order.pending');
        Route::get('order/on-reviewed','OrderManagementController@onReviewedOrder')->name('order.on-reviewed');
        Route::get('order/on-delivered','OrderManagementController@onDeliveredOrder')->name('order.on-delivered');
        Route::get('order/delivered','OrderManagementController@deliveredOrder')->name('order.delivered');
        Route::get('order/completed','OrderManagementController@completedOrder')->name('order.completed');
        Route::get('order/canceled','OrderManagementController@canceledOrder')->name('order.canceled');
        Route::get('order-product/status-change/{id}','OrderManagementController@OrderProductChangeStatus')->name('order-product.status');
        Route::get('order-details/{id}','OrderManagementController@orderDetails')->name('order-details');
        Route::get('order-details/invoice/print/{id}','OrderManagementController@orderInvoicePrint')->name('invoice.print');
        Route::get('order/daily-orders','OrderManagementController@dailyOrders')->name('daily-orders');
        Route::get('order/search/area', 'OrderManagementController@search_area');
        Route::get('/orders/{area}','OrderManagementController@areaWiseOrder');


        //Admin Excel Export
        Route::get('/seller-product-export','ExportExcelController@exportSellerProducts')->name('seller-product-excel.export');
        Route::get('/all-order-export','ExportExcelController@exportOrders')->name('all-order-excel.export');
        Route::get('/all-seller-export','ExportExcelController@exportSeller')->name('all-seller-excel.export');
        Route::get('/all-customer-export','ExportExcelController@exportCustomer')->name('all-customer-excel.export');


        //Product Review
        Route::get('/product-reviews','ReviewController@index')->name('product-reviews');
        Route::post('product-review/details', 'ReviewController@reviewDetails')->name('review.details');
        Route::post('review/status', 'ReviewController@updateStatus')->name('review.status');
        Route::get('review/view/{id}','ReviewController@view')->name('review.view');
        Route::post('review/update/{id}','ReviewController@reviewUpdate')->name('review.update');

        //Site Optimize
        Route::get('/site-optimize', 'SystemOptimize@Settings')->name('site.optimize');
        Route::get('/config-cache', 'SystemOptimize@ConfigCache')->name('config.cache');
        Route::get('/clear-cache', 'SystemOptimize@CacheClear')->name('cache.clear');
        Route::get('/view-cache', 'SystemOptimize@ViewCache')->name('view.cache');
        Route::get('/view-clear', 'SystemOptimize@ViewClear')->name('view.clear');
        Route::get('/route-cache', 'SystemOptimize@RouteCache')->name('route.cache');
        Route::get('/route-clear', 'SystemOptimize@RouteClear')->name('route.clear');

    });

//    Route::get('/admin/products/ajax/{id}', 'Admin\ProductController@ajaxSubCat')->name('admin.products.get.subcategory');
    Route::post('admin/products/get-subcategories-by-category','Admin\ProductController@ajaxSubCat')->name('admin.products.get_subcategories_by_category');
    Route::post('admin/products/get-subsubcategories-by-subcategory','Admin\ProductController@ajaxSubSubCat')->name('admin.products.get_subsubcategories_by_subcategory');
    Route::post('admin/products/sku_combination','Admin\ProductController@sku_combination')->name('admin.products.sku_combination');
    Route::post('admin/products/update2/{id}', 'Admin\ProductController@update2')->name('admin.products.update2');
    Route::post('admin/products/sku_combination_edit', 'Admin\ProductController@sku_combination_edit')->name('admin.products.sku_combination_edit');
    Route::post('admin/products/todays_deal', 'Admin\ProductController@updateTodaysDeal')->name('admin.products.todays_deal');
    Route::post('admin/products/published/update', 'Admin\ProductController@updatePublished')->name('admin.products.published');
    Route::post('admin/products/featured/update', 'Admin\ProductController@updateFeatured')->name('admin.products.featured');
    Route::get('admin/seller-requested-products', 'Admin\ProductController@sellerReqList')->name('admin.seller-requested.products');

    Route::get('admin/all/seller/products', 'Admin\ProductController@sellerProductList')->name('admin.all.seller.products');
    Route::post('admin/ckeditor/upload', 'Admin\CkeditorController@upload')->name('admin.ckeditor.upload');

    //Route::get('admin/all-sellers-products', 'Admin\ProductController@allSellerProducts')->name('admin.all-sellers.products');


    Route::get('/admin/products/slug/{name}', 'Admin\ProductController@ajaxSlugMake')->name('admin.products.slug-make');
    Route::post('/admin/products/slug-change', 'Admin\ProductController@slugChange')->name('admin.products.slug-change');
    Route::post('/admin/products/flush-sale/{id}', 'Admin\ProductController@flushSaleUpdate')->name('admin.products.flush-sale');
    Route::post('/admin/products/flush-sales/store', 'Admin\ProductController@flushSaleStore')->name('admin.products.flush-sale.store');
    Route::post('/admin/products/hide/{id}', 'Admin\ProductController@hide')->name('admin.products.hide');
    Route::get('/all/seller/products/edit/{id}', 'Admin\ProductController@sellerProductEdit')->name('admin.edit.seller.products');
    Route::post('/all/seller/products/update/{id}', 'Admin\ProductController@sellerProductUpdate')->name('admin.update.seller.products');

    Route::get('/admin/service-order/', 'Admin\OrderController@serviceOrder')->name('admin.service.order');
    Route::get('/admin/service-order-details/{id}', 'Admin\OrderController@serviceOrderDetail')->name('admin.service.order.details');
    Route::get('service-category-list-dropdown','Admin\ServiceController@serviceCategoryList');
    Route::get('service-sub-category-list','Admin\ServiceController@serviceSubCategoryList');

    Route::get('serviceProvider-list','Admin\UserListController@serviceProviderList')->name('admin.serviceProvider-list');
    Route::get('verification-image-list','Admin\UserListController@verificationImageList')->name('admin.serviceProvider.verification.image');
    Route::get('/admin/serviceProvider-details/{id}', 'Admin\UserListController@serviceProviderDetail')->name('admin.serviceProvider.details');
    Route::get('clinic-list','Admin\UserListController@clinicList')->name('admin.clinic-list');
    Route::get('clinic-verification-image','Admin\UserListController@clinicVerificationImageList')->name('admin.clinic.verification.image');
    Route::get('/admin/clinic-details/{id}', 'Admin\UserListController@clinicDetail')->name('admin.clinic.details');
    //User
    Route::get('/admin/user-list','Admin\UserListController@userList')->name('admin.user-list');
    Route::get('admin/user/show/profile/{id}','Admin\UserListController@profileShow')->name('admin.user.profile.show');
    Route::post('admin/user/profile/update/{id}','Admin\UserListController@profileUpdate')->name('admin.user.profile.update');
    Route::post('admin/user/password/update/{id}','Admin\UserListController@passwordUpdate')->name('admin.user.password.update');
    Route::get('admin/user/ban/{id}','Admin\UserListController@banUser')->name('admin.user.ban');


    Route::get('/admin/vendor-list','Admin\UserListController@vendorList')->name('admin.vendor-list');
    Route::post('service/provider/permission/status','Admin\OrderController@permissionStatus')->name('service.provider.permission.status');
    Route::get('clinic-doctor-list','Admin\DoctorController@clinicDoctorList')->name('admin.clinic-doctor-list');
    Route::get('admin-user-question-list','Admin\QuestionController@index')->name('admin.users.question.list');
    Route::post('admin-user-question-status','Admin\QuestionController@questionStatus')->name('user.question.status');
    Route::get('admin-user-question-answer/{id}','Admin\QuestionController@questionAnswerForm')->name('admin.users.question.answer.form');
    Route::post('admin-user-question-answer-store','Admin\QuestionController@questionAnswerStore')->name('admin.question.answer.store');
    Route::get('admin-user-question-answer-update/{id}','Admin\QuestionController@questionAnswerUpdateForm')->name('admin.users.question.answer.update.form');
    Route::post('admin-user-question-answer-update','Admin\QuestionController@questionAnswerUpdate')->name('admin.question.answer.update');
    Route::get('admin-user-question-answer-details/{id}','Admin\QuestionController@questionAnswerDetails')->name('admin.users.question.answer.details');

    Route::get('/admin/product-order/', 'Admin\OrderController@productOrder')->name('admin.product.order');
    Route::get('/admin/product-order-details/{id}', 'Admin\OrderController@productOrderDetail')->name('admin.product.order.details');

    Route::get('admin/cancel/order/{id}','Admin\OrderController@cancel_order')->name('admin.cancel.order');
    Route::post('product/order/delivery/status','Admin\OrderController@delivery_status')->name('product.order.delivery.status');
    Route::post('service_provider.active.inactive.status','Admin\UserListController@service_provider_active_inactive_status')->name('service_provider.active.inactive.status');
    Route::post('clinic.active.inactive.status','Admin\UserListController@clinic_active_inactive_status')->name('clinic.active.inactive.status');
    Route::post('doctor.active.inactive.status','Admin\UserListController@doctor_active_inactive_status')->name('doctor.active.inactive.status');

    Route::get('product-invoice-print/{id}','Admin\OrderController@productInvoicePrint')->name('product.invoice.print');
    Route::get('service-invoice-print/{id}','Admin\OrderController@serviceInvoicePrint')->name('service.invoice.print');



    //Seller Order Report
    Route::get('admin/seller-order-report','Admin\OrderReportController@sellerReport')->name('admin.seller-order-report');
    Route::post('admin/seller-order-details','Admin\OrderReportController@sellerOrderDetails')->name('admin.seller-order-details');
    Route::get('admin/top-rated-shop','Admin\SellerController@topRatedShop')->name('admin.top-rated-shop');
    Route::get('admin/top-users','Admin\UserListController@topRatedUsers')->name('admin.top-users');
});

Route::group(['middleware' => ['auth', 'clinic']], function () {

    //this route only for with out resource controller
    Route::get('/clinic/dashboard', 'Clinic\DashboardController@index')->name('clinic.dashboard');
    Route::get('/clinic/profile/', 'Clinic\ProfileController@index')->name('clinic.profile');
    Route::get('/clinic/profile-update/{id}', 'Clinic\ProfileController@editProfile')->name('clinic.profile.update');
    Route::get('/clinic/change-password', 'Clinic\ProfileController@changedPassword')->name('clinic.change.password');
    Route::post('/clinic/update-password', 'Clinic\ProfileController@updatePassword')->name('clinic.update.password');
    Route::post('/clinic/basic-update', 'Clinic\ProfileController@clinicBasicUpdate')->name('clinic.basic.update');
    Route::post('/clinic/details-insert', 'Clinic\ProfileController@clinicDetailsInsert')->name('clinic.details.insert');
    Route::post('/clinic/details-update', 'Clinic\ProfileController@clinicDetailsUpdate')->name('clinic.details.update');
    Route::post('/clinic/contact-insert', 'Clinic\ProfileController@clinicContactInsert')->name('clinic.contact.insert');
    Route::post('/clinic/contact-update', 'Clinic\ProfileController@clinicContactUpdate')->name('clinic.contact.update');
    Route::post('/clinic/open-close-insert', 'Clinic\ProfileController@clinicopenCloseInsert')->name('clinic.openClose.insert');
    Route::post('/clinic/open-close-update', 'Clinic\ProfileController@clinicopenCloseUpdate')->name('clinic.openClose.update');
    Route::post('/clinic/verification-insert', 'Clinic\ProfileController@clinicVerificationInsert')->name('clinic.verification.insert');
    Route::post('/clinic/verification-update', 'Clinic\ProfileController@clinicVerificationUpdate')->name('clinic.verification.update');
    Route::get('/clinic/doctor-list', 'Clinic\DashboardController@clinicDoctorList')->name('clinic.doctor.list');
    Route::get('/clinic/doctor/create', 'Clinic\DashboardController@clinicDoctorCreate')->name('clinic.doctor.create');
    Route::post('/clinic/doctor/store', 'Clinic\DashboardController@clinicDoctorStore')->name('clinic.doctor.store');

    Route::get('clinic-lab-test-order', 'Clinic\OrderController@labTestOrder')->name('clinic.lab.test.order');
    Route::get('clinic/order/lab-test/{id}','Clinic\OrderController@lab_test_list')->name('clinic.lab.test.list');

    Route::post('lab/order/delivery/status','Clinic\OrderController@delivery_status')->name('lab.order.delivery.status');

    //this route only for resource controller
    Route::group(['as' => 'clinic.', 'prefix' => 'clinic', 'namespace' => 'Clinic',], function () {
        Route::resource('labTest', 'LabTestController');
        Route::resource('blood-bank','BloodBankController');
        Route::resource('ambulance','AmbulanceController');
    });

});

Route::group(['middleware' => ['auth', 'doctor']], function () {
    //this route only for with out resource controller
    Route::get('/doctor/dashboard', 'Doctor\DashboardController@index')->name('doctor.dashboard');
    Route::get('/doctor/profile/', 'Doctor\ProfileController@index')->name('doctor.profile');
    Route::get('/doctor/profile-update/{id}', 'Doctor\ProfileController@editProfile')->name('doctor.profile.update');
    Route::get('/doctor/change-password', 'Doctor\ProfileController@changedPassword')->name('doctor.change.password');
    Route::post('/doctor/update-password', 'Doctor\ProfileController@updatePassword')->name('doctor.update.password');
    Route::post('/doctor/basic-update', 'Doctor\ProfileController@doctorBasicUpdate')->name('doctor.basic.update');
    Route::post('/doctor/details-insert', 'Doctor\ProfileController@doctorDetailsInsert')->name('doctor.details.insert');
    Route::post('/doctor/details-update', 'Doctor\ProfileController@doctorDetailsUpdate')->name('doctor.details.update');
    Route::post('/doctor/contact-insert', 'Doctor\ProfileController@doctorContactInsert')->name('doctor.contact.insert');
    Route::post('/doctor/contact-update', 'Doctor\ProfileController@doctorContactUpdate')->name('doctor.contact.update');
    Route::post('/doctor/clinic-insert', 'Doctor\ProfileController@doctorClinicInsert')->name('doctor.clinic.insert');
    Route::post('/doctor/clinic-update', 'Doctor\ProfileController@doctorClinicUpdate')->name('doctor.clinic.update');
    Route::post('/doctor/education-insert', 'Doctor\ProfileController@doctorEducationInsert')->name('doctor.education.insert');
    Route::post('/doctor/education-update', 'Doctor\ProfileController@doctorEducationUpdate')->name('doctor.education.update');
    Route::post('/doctor/experience-insert', 'Doctor\ProfileController@doctorExperienceInsert')->name('doctor.experience.insert');
    Route::post('/doctor/experience-update', 'Doctor\ProfileController@doctorExperienceUpdate')->name('doctor.experience.update');
    Route::post('/doctor/award-insert', 'Doctor\ProfileController@doctorAwardInsert')->name('doctor.award.insert');
    Route::post('/doctor/award-update', 'Doctor\ProfileController@doctorAwardUpdate')->name('doctor.award.update');
    Route::post('/doctor/speciality-insert', 'Doctor\ProfileController@doctorSpecialityInsert')->name('doctor.speciality.insert');
    Route::post('/doctor/speciality-update', 'Doctor\ProfileController@doctorSpecialityUpdate')->name('doctor.speciality.update');
    Route::get('doctor-user-question-list','Doctor\QuestionController@index')->name('doctor.users.question.list');
    Route::get('doctor-user-question-answer-form/{id}','Doctor\QuestionController@questionAnswerForm')->name('doctor.users.question.answer.form');
    Route::post('doctor-user-question-answer-store','Doctor\QuestionController@questionAnswerStore')->name('doctor.question.answer.store');
    Route::get('doctor-user-question-answer-update/{id}','Doctor\QuestionController@questionAnswerUpdateForm')->name('doctor.users.question.answer.update.form');
    Route::post('doctor-user-question-answer-update','Doctor\QuestionController@questionAnswerUpdate')->name('doctor.question.answer.update');
    Route::get('doctor-user-question-answer-details/{id}','Doctor\QuestionController@questionAnswerDetails')->name('doctor.users.question.answer.details');
    //Route::get('doctor-clinic-schedule-list','Doctor\ClinicScheduleController@index')->name('doctor.clinic.schedule.list');
    Route::post('doctor/clinic/schedule/slot', 'Doctor\ClinicScheduleController@doctorClinicScheduleSlot')->name('doctor.clinic.schedule.slot');
    Route::get('doctor-patient-list','Doctor\ClinicScheduleController@patientList')->name('doctor.patient.list');
    Route::get('doctor-patient-list/today','Doctor\ClinicScheduleController@patientListToday')->name('doctor.patient.list.today');
    Route::get('doctor-patient-appointment-list/{slug}','Doctor\ClinicScheduleController@patientAppointmentList')->name('doctor.patient.appointment.list');
    Route::get('prescription-form/{slug}/{slot_id}','Doctor\ClinicScheduleController@prescriptionForm')->name('prescription.form');
    Route::post('prescription-store/{slug}/{slot_id}','Doctor\ClinicScheduleController@prescriptionStore')->name('prescription.store');
    Route::get('prescription-view/{id}','Doctor\ClinicScheduleController@prescriptionView')->name('prescription.view');
    Route::get('prescription-invoice-print/{id}','Doctor\ClinicScheduleController@prescriptionInvoicePrint')->name('prescription.invoice.print');

    //this route only for resource controller
    Route::group(['as' => 'doctor.', 'prefix' => 'doctor', 'namespace' => 'Doctor',], function () {
        Route::resource('clinicSchedules', 'ClinicScheduleController');
    });

});

Route::group(['middleware' => ['auth', 'service_provider']], function () {
    //this route only for with out resource controller
    Route::get('/service_provider/dashboard', 'ServiceProvider\DashboardController@index')->name('service_provider.dashboard');
    Route::get('/service_provider/profile/', 'ServiceProvider\ProfileController@index')->name('service_provider.profile');
    Route::get('/service_provider/profile-update/{id}', 'ServiceProvider\ProfileController@editProfile')->name('service_provider.profile.update');
    Route::get('/service_provider/change-password', 'ServiceProvider\ProfileController@changedPassword')->name('service_provider.change.password');
    Route::post('/service_provider/update-password', 'ServiceProvider\ProfileController@updatePassword')->name('service_provider.update.password');
    Route::post('/service_provider/basic-update', 'ServiceProvider\ProfileController@serviceProviderBasicUpdate')->name('service_provider.basic.update');
    Route::post('/service_provider/details-insert', 'ServiceProvider\ProfileController@serviceProviderDetailsInsert')->name('service_provider.details.insert');
    Route::post('/service_provider/details-update', 'ServiceProvider\ProfileController@serviceProviderDetailsUpdate')->name('service_provider.details.update');
    Route::post('/service_provider/contact-insert', 'ServiceProvider\ProfileController@serviceProviderContactInsert')->name('service_provider.contact.insert');
    Route::post('/service_provider/contact-update', 'ServiceProvider\ProfileController@serviceProviderContactUpdate')->name('service_provider.contact.update');
    Route::post('/service_provider/cost-insert', 'ServiceProvider\ProfileController@serviceProviderCostInsert')->name('service_provider.cost.insert');
    Route::post('/service_provider/cost-update', 'ServiceProvider\ProfileController@serviceProviderCostUpdate')->name('service_provider.cost.update');
    Route::post('/service_provider/education-insert', 'ServiceProvider\ProfileController@serviceProviderEducationInsert')->name('service_provider.education.insert');
    Route::post('/service_provider/education-update', 'ServiceProvider\ProfileController@serviceProviderEducationUpdate')->name('service_provider.education.update');
    Route::post('/service_provider/experience-insert', 'ServiceProvider\ProfileController@serviceProviderExperienceInsert')->name('service_provider.experience.insert');
    Route::post('/service_provider/experience-update', 'ServiceProvider\ProfileController@serviceProviderExperienceUpdate')->name('service_provider.experience.update');

    Route::get('/service_provider/order/', 'ServiceProvider\OrderController@index')->name('service_provider.order');
    Route::get('/service_provider/order/today', 'ServiceProvider\OrderController@today_order')->name('service_provider.order.today');
    Route::get('/service_provider/order/booking', 'ServiceProvider\OrderController@booking')->name('service_provider.order.booking');
    Route::get('/service_provider/order-details/{id}', 'ServiceProvider\OrderController@show')->name('service_provider.details');
    Route::get('/service_provider/review', 'ServiceProvider\ReviewController@index')->name('service_provider.review');
    //Route::get('service/provider/invoice/{id}','ServiceProvider\OrderController@invoice')->name('service.provider.invoice');
    Route::post('service/provider/delivery/status','ServiceProvider\OrderController@delivery_status')->name('service.provider.delivery.status');
    Route::get('service/provider/order','ServiceProvider\OrderController@order_list')->name('service.provider.order');
    Route::get('service/provider/invoice/{id}','ServiceProvider\OrderController@invoice')->name('service.provider.invoice');
    Route::get('service/provider/invoice/print/{id}','ServiceProvider\OrderController@invoicePrint')->name('service.provider.invoice.print');

    Route::post('/service_provider/verification-insert', 'ServiceProvider\ProfileController@serviceProviderVerificationInsert')->name('service_provider.verification.insert');
    Route::post('/service_provider/verification-update', 'ServiceProvider\ProfileController@serviceProviderVerificationUpdate')->name('service_provider.verification.update');

    Route::get('service-category-list','ServiceProvider\ProfileController@serviceCategoryList');

    //this route only for resource controller
    Route::group(['as' => 'user.', 'prefix' => 'user', 'namespace' => 'User',], function () {
        //Route::resource('products', 'ProductController');
    });
});

Route::group(['middleware' => ['auth', 'user']], function () {
    //this route only for with out resource controller
    Route::get('/user/dashboard', 'User\DashboardController@index')->name('user.dashboard');
    Route::get('/user/profile/', 'User\ProfileController@index')->name('user.profile');
    //Route::get('/user/profile-update/{id}', 'User\ProfileController@editProfile')->name('user.profile.update');
    Route::post('/user/basic-update', 'User\ProfileController@userBasicUpdate')->name('user.basic.update');
    Route::get('/user/change-password', 'User\ProfileController@changedPassword')->name('user.change.password');
    Route::post('/user/update-password', 'User\ProfileController@updatePassword')->name('user.update.password');

    //service
    //Route::get('user/order','User\OrderController@order')->name('user.order');
    Route::get('/checkout', 'Frontend\CartController@checkout')->name('checkout');
    Route::post('/checkout/coupon/store', 'Frontend\CartController@coupon_store')->name('checkout.coupon.store');

    //user question answer
    Route::get('user/question','User\QuestionController@question')->name('user.question');

    Route::get('user/order','User\OrderController@order')->name('user.order');
    Route::get('/user/service-order/', 'User\OrderController@serviceOrder')->name('user.service.order');
    Route::get('user/order/services/{id}','User\OrderController@service_list')->name('user.service.list');
    //Route::get('/user/service-order-details/{id}', 'User\OrderController@serviceOrderDetail')->name('user.service.order.details');
    Route::get('user/cancel/order/{id}','User\OrderController@cancel_order')->name('user.cancel.order');
    Route::post('/user/service_provider/review', 'User\OrderController@service_provider_review')->name('user.service_provider.review');
    Route::post('/user/clinic_doctor/review', 'User\OrderController@clinic_doctor_review')->name('user.clinic_doctor.review');

    Route::post('/checkout/coupon/store', 'Frontend\CartController@coupon_store')->name('checkout.coupon.store');
    Route::post('/checkout/coupon/destroy', 'Frontend\CartController@coupon_destroy')->name('checkout.coupon.destroy');

    Route::post('clinic/review/store', 'User\DashboardController@userClinicReviewStore')->name('clinic.review.store');
    Route::post('doctor/review/store', 'User\DashboardController@userDoctorReviewStore')->name('doctor.review.store');
    Route::post('/user-question-store', 'Frontend\UserController@questionStore')->name('user.question.store');

    Route::get('user-clinic-doctor-appointment', 'User\ClinicDoctorAppointmentController@appointmentList')->name('user.clinic.doctor.appointment');
    Route::get('user-prescription-view/{id}','User\ClinicDoctorAppointmentController@prescriptionView')->name('user.prescription.view');
    Route::get('user-prescription-invoice-print/{id}','User\ClinicDoctorAppointmentController@prescriptionInvoicePrint')->name('user.prescription.invoice.print');

    Route::get('user-product-order', 'User\OrderController@productOrder')->name('user.product.order');
    Route::get('user/order/product/{id}','User\OrderController@product_list')->name('user.product.list');

    Route::get('user-lab-test-order', 'User\OrderController@labTestOrder')->name('user.lab.test.order');
    Route::get('user/order/lab-test/{id}','User\OrderController@lab_test_list')->name('user.lab.test.list');

    //Product Wishlist
    Route::get('user/wishlists','User\WishlistController@wishlist')->name('user.product.wishlist');
    Route::get('user/remove/wishlist/{id}', 'User\WishlistController@wishlistRemove' )->name('user.remove.wishlist');


    Route::post('/user/product/review', 'User\OrderController@product_review')->name('user.product.review');


    //this route only for resource controller
    Route::group(['as' => 'user.', 'prefix' => 'user', 'namespace' => 'User',], function () {
        Route::resource('address', 'AddressController');
    });

    Route::post('/user/address-status/update/{id}', 'User\AddressController@updateStatus')->name('user.update.status');
    Route::post('/shopping-checkout/order/submit', 'Frontend\Shop\CartController@orderSubmit')->name('shopping.checkout.order.submit');

    //Favorite Shop
    Route::get('/add/favorite-shop/{id}','User\FavoriteShopController@addFavoriteShop')->name('add.favorite-shop');
    Route::get('/remove/favorite-shop/{id}','User\FavoriteShopController@removeFavoriteShop')->name('remove.favorite-shop');
    Route::get('favorite-shop/list','User\FavoriteShopController@favoriteShopList')->name('user.favorite-shop.list');

});

//Route::group(['middleware' => ['auth', 'vendor']], function () {
//    //this route only for with out resource controller
//    Route::get('/vendor/dashboard', 'Vendor\DashboardController@index')->name('vendor.dashboard');
//    Route::get('/vendor/profile/', 'Vendor\ProfileController@index')->name('vendor.profile');
//    Route::post('/vendor/basic-update', 'Vendor\ProfileController@vendorBasicUpdate')->name('vendor.basic.update');
//    Route::get('/vendor/change-password', 'Vendor\ProfileController@changedPassword')->name('vendor.change.password');
//    Route::post('/vendor/update-password', 'Vendor\ProfileController@updatePassword')->name('vendor.update.password');
//
//    Route::get('/vendor/product-order/', 'Vendor\OrderController@productOrder')->name('vendor.product.order');
//    Route::get('/vendor/product-order-details/{id}', 'Vendor\OrderController@productOrderDetail')->name('vendor.product.order.details');
//
//    Route::get('vendor/cancel/order/{id}','Vendor\OrderController@cancel_order')->name('vendor.cancel.order');
//    Route::post('product/order/delivery/status','Vendor\OrderController@delivery_status')->name('product.order.delivery.status');
//
//    Route::get('product-invoice-print/{id}','Vendor\OrderController@productInvoicePrint')->name('product.invoice.print');
//    Route::get('service-invoice-print/{id}','Vendor\OrderController@serviceInvoicePrint')->name('service.invoice.print');
//
//    Route::get('/vendor/products/ajax/{id}', 'Vendor\ProductController@ajaxSubCat')->name('vendor.products.get.subcategory');
//    Route::get('/vendor/products/slug/{name}', 'Vendor\ProductController@ajaxSlugMake')->name('vendor.products.slug-make');
//    Route::post('/vendor/products/slug-change', 'Vendor\ProductController@slugChange')->name('vendor.products.slug-change');
//    Route::post('/vendor/products/flush-sale/{id}', 'Vendor\ProductController@flushSaleUpdate')->name('vendor.products.flush-sale');
//    Route::post('/vendor/products/flush-sales/store', 'Vendor\ProductController@flushSaleStore')->name('vendor.products.flush-sale.store');
//    Route::post('/vendor/products/hide/{id}', 'Vendor\ProductController@hide')->name('vendor.products.hide');
//
//
//    //this route only for resource controller
//    Route::group(['as' => 'vendor.', 'prefix' => 'vendor', 'namespace' => 'Vendor',], function () {
//        //shop
//        Route::resource('brands', 'BrandController');
//        Route::resource('category', 'CategoryController');
//        Route::resource('subcategory', 'SubCategoryController');
//        Route::resource('products', 'ProductController');
//    });
//});

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
