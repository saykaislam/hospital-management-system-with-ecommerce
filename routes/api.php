<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// user
Route::post('register', 'API\UserController@register');
Route::post('getVerificationCode', 'API\UserController@getVerificationCode');
Route::post('verification', 'API\UserController@verification');
Route::post('login', 'API\UserController@login');
Route::middleware('auth:api')->post('/changed_password', 'API\UserController@changedPassword');
//forgot password
Route::post('sendVerificationCode', 'API\UserController@sendVerificationCode');
Route::post('sendVerification', 'API\UserController@sendVerification');

Route::get('hospital_list', 'API\UserController@hospitalList');
Route::post('hospital_doctor_list', 'API\UserController@hospitalDoctorList');
Route::post('hospital_open_close_list', 'API\UserController@hospitalOpenCloseList');
Route::get('doctor_list', 'API\UserController@doctorList');
Route::post('doctor_details', 'API\UserController@doctorDetails');
Route::get('frontend_service_provider_category_list', 'API\UserController@serviceProviderCategory');
Route::post('frontend_service_category_list', 'API\UserController@serviceCategory');
Route::post('frontend_service_sub_category_list', 'API\UserController@serviceSubCategory');
Route::post('frontend_service_list', 'API\UserController@serviceList');
Route::get('frontend_service_recommended_list', 'API\UserController@serviceRecommendedList');
Route::get('health_tips', 'API\UserController@healthTips');
Route::post('search', 'API\UserController@search');
Route::get('test_lists', 'API\UserController@testLists');
Route::post('lab_test_lists', 'API\UserController@labTestLists');



// user
Route::middleware('auth:api')->get('/user_question_list', 'API\UserController@questionList');
Route::middleware('auth:api')->post('/user_question_store', 'API\UserController@questionStore');
Route::middleware('auth:api')->post('/user_profile_update', 'API\UserController@userProfileUpdate');
Route::middleware('auth:api')->post('/user_profile_image_update', 'API\UserController@userProfileImageUpdate');
Route::middleware('auth:api')->get('/user_dashboard', 'API\UserController@dashboardCount');
Route::middleware('auth:api')->get('/service_order_list', 'API\UserController@serviceOrderList');
Route::middleware('auth:api')->get('/service_order_cancel_list', 'API\UserController@serviceOrderCancelList');
Route::middleware('auth:api')->post('/service_order_details', 'API\UserController@serviceOrderDetails');
Route::middleware('auth:api')->get('/doctor_appoinment_order_list', 'API\UserController@doctorAppoinmentOrder');
Route::middleware('auth:api')->get('/product_order_list', 'API\UserController@productOrderList');
Route::middleware('auth:api')->get('/product_order_cancel_list', 'API\UserController@productOrderCancelList');
Route::middleware('auth:api')->post('/product_order_details', 'API\UserController@productOrderDetails');
Route::middleware('auth:api')->get('/labtest_order_list', 'API\UserController@labtestOrder');
Route::middleware('auth:api')->get('/labtest_order_cancel_list', 'API\UserController@labtestCancelOrder');
Route::middleware('auth:api')->post('/labtest_order_details', 'API\UserController@labtestOrderDetails');
Route::middleware('auth:api')->post('/user_clinic_doctor', 'API\UserController@userClinicDoctor');
Route::middleware('auth:api')->post('/nearest_service_provider_list', 'API\UserController@nearestServiceProviderList');
Route::middleware('auth:api')->post('/service_order_place', 'API\UserController@serviceOrderPlace');
Route::middleware('auth:api')->post('/doctor-booking/checkout/store','API\UserController@doctorBookingStore');
Route::middleware('auth:api')->post('/test/order/submit', 'API\UserController@test_order');
Route::middleware('auth:api')->post('/doctor/booking/find/slot', 'API\UserController@doctorBookingFindSlot');
Route::middleware('auth:api')->post('/user/cancel/order', 'API\UserController@cancelOrder');




// get
Route::middleware('auth:api')->get('/user/address', 'API\AddressController@index');
Route::middleware('auth:api')->get('/user/wishlist', 'API\CustomerController@wishlist');
Route::middleware('auth:api')->get('/user/orders', 'API\OrderController@order_get');
Route::middleware('auth:api')->get('/user/order/details/{id}', 'API\OrderController@order_details_get');
Route::middleware('auth:api')->get('/user/order/all-reviews', 'API\OrderController@getReview');

// post
Route::middleware('auth:api')->post('/user/address/add', 'API\AddressController@store');
Route::middleware('auth:api')->post('/user/address/update', 'API\CustomerController@addressUpdate');
Route::middleware('auth:api')->post('/user/address/set-default/{id}', 'API\AddressController@setDefault');
Route::middleware('auth:api')->post('/add/wishlist/{id}', 'API\CustomerController@wishlistAdd');
Route::middleware('auth:api')->post('/user/order/submit', 'API\OrderController@orderSubmit');
Route::middleware('auth:api')->post('/user/order/review/submit', 'API\OrderController@reviewStore');
Route::middleware('auth:api')->post('/add/favorite-shop', 'API\CustomerController@favoriteShopAdd');
Route::middleware('auth:api')->post('/remove/favorite-shop', 'API\CustomerController@favoriteShopRemove');

// delete
Route::middleware('auth:api')->delete('/user/address/delete/{id}', 'API\AddressController@destroy');
Route::middleware('auth:api')->delete('/remove/wishlist/{id}', 'API\CustomerController@wishlistRemove');




// service provider
//Route::get('district_list', 'API\ServiceProviderController@districtList');
Route::middleware('auth:api')->post('/service_order_list', 'API\ServiceProviderController@serviceOrderList');
Route::middleware('auth:api')->post('/review_list', 'API\ServiceProviderController@reviewList');
Route::middleware('auth:api')->get('/district_list', 'API\ServiceProviderController@districtList');
Route::middleware('auth:api')->get('/service_provider_category_list', 'API\ServiceProviderController@serviceProviderCategory');
Route::middleware('auth:api')->post('/service_category_list', 'API\ServiceProviderController@serviceCategory');
Route::middleware('auth:api')->post('/service_sub_category_list', 'API\ServiceProviderController@serviceSubCategory');
Route::middleware('auth:api')->post('/service_provider_profile_info', 'API\ServiceProviderController@serviceProviderProfileInfo');

Route::middleware('auth:api')->post('/service_provider_basic_update', 'API\ServiceProviderController@serviceProviderBasicUpdate');
Route::middleware('auth:api')->post('/service_provider_profile_image_update', 'API\ServiceProviderController@serviceProviderProfileImageUpdate');
Route::middleware('auth:api')->post('/service_provider_details_insert_or_update', 'API\ServiceProviderController@serviceProviderDetailsInsertOrUpdate');
Route::middleware('auth:api')->post('/service_provider_contact_insert_or_update', 'API\ServiceProviderController@serviceProviderContactInsertOrUpdate');
Route::middleware('auth:api')->post('/service_provider_cost_insert_or_update', 'API\ServiceProviderController@serviceProviderCostInsertOrUpdate');
Route::middleware('auth:api')->post('/service_provider_education_insert_or_update', 'API\ServiceProviderController@serviceProviderEducationInsertOrUpdate');
Route::middleware('auth:api')->post('/service_provider_experience_insert_or_update', 'API\ServiceProviderController@serviceProviderExperienceInsertOrUpdate');
Route::middleware('auth:api')->post('/service_provider_experience_insert_or_update', 'API\ServiceProviderController@serviceProviderExperienceInsertOrUpdate');
Route::middleware('auth:api')->post('/service_provider_verification_insert_or_update', 'API\ServiceProviderController@serviceProviderVerificationInsertOrUpdate');
Route::middleware('auth:api')->post('/service_provider_review_store', 'API\ServiceProviderController@serviceProviderReviewStore');


// Doctor
Route::middleware('auth:api')->get('/doctor_speciality_list', 'API\DoctorController@doctorSpecialityList');
Route::middleware('auth:api')->get('/doctor_clinic_list', 'API\DoctorController@doctorClinicList');
Route::post('/doctor_clinic_list_by_doctor', 'API\DoctorController@doctorByClinicList');
Route::middleware('auth:api')->post('/doctor_profile_info', 'API\DoctorController@doctorProfileInfo');
Route::middleware('auth:api')->post('/doctor_patient_info', 'API\DoctorController@doctorPatientInfo');
Route::middleware('auth:api')->post('/doctor_basic_update', 'API\DoctorController@doctorBasicUpdate');
Route::middleware('auth:api')->post('/doctor_profile_image_update', 'API\DoctorController@doctorProfileImageUpdate');
Route::middleware('auth:api')->post('/doctor_details_insert', 'API\DoctorController@doctorDetailsInsert');
Route::middleware('auth:api')->post('/doctor_details_update', 'API\DoctorController@doctorDetailsUpdate');
Route::middleware('auth:api')->post('/doctor_contact_insert', 'API\DoctorController@doctorContactInsert');
Route::middleware('auth:api')->post('/doctor_contact_update', 'API\DoctorController@doctorContactUpdate');
Route::middleware('auth:api')->post('/doctor_clinic_insert', 'API\DoctorController@doctorClinicInsert');
Route::middleware('auth:api')->post('/doctor_clinic_update', 'API\DoctorController@doctorClinicUpdate');
Route::middleware('auth:api')->post('/doctor_education_insert_or_update', 'API\DoctorController@doctorEducationInsertOrUpdate');
//Route::middleware('auth:api')->post('/doctor_experience_insert_or_update', 'API\DoctorController@doctorExperienceInsertOrUpdate');
Route::middleware('auth:api')->post('/doctor_experience_insert_or_update', 'API\DoctorController@doctorExperienceInsertOrUpdate');
Route::middleware('auth:api')->post('/doctor_award_insert_or_update', 'API\DoctorController@doctorAwardInsertOrUpdate');
Route::middleware('auth:api')->post('/doctor_speciality_insert_or_update', 'API\DoctorController@doctorSpecialityInsertOrUpdate');

Route::middleware('auth:api')->get('/question_list', 'API\DoctorController@questionList');
Route::middleware('auth:api')->post('/question_answer_store', 'API\DoctorController@questionAnswerStore');
Route::middleware('auth:api')->get('/doctor-patient-list', 'API\DoctorController@patientList');

Route::middleware('auth:api')->get('/day-list', 'API\DoctorController@dayList');

Route::middleware('auth:api')->post('/doctor_clinic_schedule_time_slot', 'API\DoctorController@doctorClinicScheduleTimeSlot');
Route::middleware('auth:api')->post('/doctor_clinic_schedule_time_slot_store', 'API\DoctorController@doctorClinicScheduleTimeSlotStore');



// Ecommerce start
// Frontend start
// get method
Route::get('/sliders','API\SliderController@getSliders');
Route::get('/brands','API\BrandController@getBrands');
Route::get('/shops','API\ShopController@getShop');
Route::get('/categories','API\CategoryController@getCategories');
Route::get('/subcategories','API\SubcategoryController@getSubcategories');
Route::get('/sellers','API\SellerController@getSellers');
Route::get('/shop-categories','API\ShopCategoryController@getShopCategories');
Route::get('/shop-brands','API\ShopBrandController@getShopBrands');
Route::get('/featured-products/{id}','API\ProductController@getFeaturedProducts');
Route::get('/product/details/{id}','API\ProductController@productDetails');
Route::get('/todays-deal-products/{id}','API\ProductController@getTodaysDeal');
Route::get('/best-sales-products/{id}','API\ProductController@getBestSales');
Route::get('/flash-deals-products/{id}','API\ProductController@getFlashDeals');
Route::get('/related-products/{id}','API\ProductController@getRelatedProducts');
// Shop Ratings
Route::get('/shop-total-ratings/{id}','API\ShopController@getShopRatings');
Route::get('/favorite-shops', 'API\CustomerController@getFavoriteShop' );
//Route::get('/product/reviews/{id}','API\ProductController@allReviews');
//Offers
Route::get('/advertisements','API\AdvertisementController@getAdvertisements');

//post method
Route::post('/seller/register','API\AuthController@sellerRegister');

Route::post('/verification-code-store', 'API\AuthController@verificationStore');
Route::post('/resend-otp', 'API\AuthController@resendOtp');
Route::get('/check-verification-code', 'API\AuthController@CheckVerificationCode');
Route::post('/phone/check','API\AuthController@checkPhoneNumber');

Route::post('product/variant/price', 'API\ProductController@variantPrice');
Route::post('/search/product', 'API\ProductController@search_product');
Route::post('/category/featured-products', 'API\CategoryController@featuredProducts');
Route::post('/category/all-products', 'API\CategoryController@categoryAllProducts');
//Route::get('/shop-subcategory', 'API\CategoryController@categoryProducts');
//Shop Subcategory
Route::post('/shop-categories','API\ShopSubcategoryController@getShopCategories');
Route::post('/shop-subcategories/featured-products','API\ShopSubcategoryController@getFeaturedProducts');
Route::post('/shop-subcategories/all-products','API\ShopSubcategoryController@getAllProducts');

// Frontend end


// Seller start
// get
Route::middleware('auth:api')->get('/seller/dashboard', 'API\SellerController@dashboard');
Route::middleware('auth:api')->get('/seller/info', 'API\SellerController@profile');
Route::middleware('auth:api')->get('/seller/shop/info', 'API\SellerController@shopInfo');
Route::middleware('auth:api')->get('/seller/verification-status', 'API\SellerController@verificationStatus');

// post
Route::middleware('auth:api')->get('/seller/profile-update', 'API\SellerController@profileUpdate');
// Seller end
// Ecommerce end


