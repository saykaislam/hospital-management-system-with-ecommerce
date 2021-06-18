<?php



Route::group(['as'=>'seller.','prefix' =>'seller', 'middleware' => ['auth', 'seller']], function(){
    //this route only for with out resource controller
    Route::get('/dashboard', 'Seller\DashboardController@index')->name('dashboard');
    Route::get('profile','Seller\ProfileController@profile')->name('profile.show');
    Route::get('shop/manage','Seller\ShopController@shopUpdate')->name('shop.manage');
    Route::get('products/slug/{name}','Seller\ProductController@ajaxSlugMake')->name('products.slug');
    Route::post('payment/cash_on_delivery_status', 'Seller\ProfileController@cashOnDelivery')->name('payment.cash_on_delivery_status');
    Route::post('payment/bank_payment_status', 'Seller\ProfileController@bankPayment')->name('payment.bank_payment_status');
    Route::put('profile/update/{id}','Seller\ProfileController@profile_update')->name('profile.update');
    Route::post('password/update','Seller\ProfileController@password_update')->name('password.update');
    Route::post('payment/update','Seller\ProfileController@payment_update')->name('payment.update');

    Route::post('products/update2/{id}','Seller\ProductController@update2')->name('products.update2');
    Route::get('products/slug/{name}','Seller\ProductController@ajaxSlugMake')->name('products.slug');
    Route::post('products/get-subcategories-by-category','Seller\ProductController@ajaxSubCat')->name('products.get_subcategories_by_category');
    Route::post('products/get-subsubcategories-by-subcategory','Seller\ProductController@ajaxSubSubCat')->name('products.get_subsubcategories_by_subcategory');
    Route::post('products/sku_combination','Seller\ProductController@sku_combination')->name('products.sku_combination');
    Route::post('products/sku_combination_edit','Seller\ProductController@sku_combination_edit')->name('products.sku_combination_edit');
    Route::post('products/todays_deal', 'Seller\ProductController@updateTodaysDeal')->name('products.todays_deal');
    Route::post('products/published/update', 'Seller\ProductController@updatePublished')->name('products.published');
    Route::post('products/featured/update', 'Seller\ProductController@updateFeatured')->name('products.featured');
//    Route::get('/shop/{slug}', 'Frontend\VendorController@singleshop')->name('shop.details');
    Route::get('get/admin/products', 'Seller\ProductController@getAdminProduct')->name('get.admin.products');
    Route::get('get/admin/products/ajax', 'Seller\ProductController@getAdminProductAjax')->name('get.admin.products.ajax');
    Route::post('admin/products/store', 'Seller\ProductController@getAdminProductStore')->name('admin.products.store');


    Route::resource('products','Seller\ProductController');
    Route::resource('shop','Seller\ShopController');
    Route::resource('seller-info','Seller\SellerInfoController');

    Route::resource('flash_deals','Seller\FlashDealController');
    Route::post('/flash_deals/update_status', 'Seller\FlashDealController@update_status')->name('flash_deals.update_status');
    Route::post('/flash_deals/update_featured', 'Seller\FlashDealController@update_featured')->name('flash_deals.update_featured');
    Route::post('/flash_deals/product_discount', 'Seller\FlashDealController@product_discount')->name('flash_deals.product_discount');
    Route::post('/flash_deals/product_discount_edit', 'Seller\FlashDealController@product_discount_edit')->name('flash_deals.product_discount_edit');


    //Seller Order Management
    Route::get('order/pending','Seller\OrderManagementController@pendingOrder')->name('order.pending');
    Route::get('order/on-reviewed','Seller\OrderManagementController@onReviewedOrder')->name('order.on-reviewed');
    Route::get('order/on-delivered','Seller\OrderManagementController@onDeliveredOrder')->name('order.on-delivered');
    Route::get('order/delivered','Seller\OrderManagementController@deliveredOrder')->name('order.delivered');
    Route::get('order/completed','Seller\OrderManagementController@completedOrder')->name('order.completed');
    Route::get('order/canceled','Seller\OrderManagementController@canceledOrder')->name('order.canceled');
    Route::get('order-product/status-change/{id}','Seller\OrderManagementController@OrderProductChangeStatus')->name('order-product.status');
    Route::get('order-details/{id}','Seller\OrderManagementController@orderDetails')->name('order-details');
    Route::get('order-details/invoice/print/{id}','Seller\OrderManagementController@printInvoice')->name('invoice.print');


    //Customer Details
    Route::get('customer/list','Seller\CustomerController@index')->name('customer.list');
    Route::get('customer/review','Seller\CustomerController@customerReview')->name('customer.review');

    Route::get('payment/history','Seller\PaymentController@index')->name('payment.history');
    Route::get('money/withdraw','Seller\PaymentController@money')->name('money.withdraw');
    Route::post('money/withdraw/store','Seller\PaymentController@store')->name('withdraw-request.store');
    Route::get('payment-report','Seller\PaymentController@paymentReport')->name('payment.report');

});



