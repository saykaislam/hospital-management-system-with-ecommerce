@extends('frontend.layouts.master')
@section('title', 'Home')
@push('css')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Satisfy&display=swap');
        .homeService{
            -webkit-box-shadow: 0px 0px 6px 0px rgba(130,130,130,1);
            -moz-box-shadow: 0px 0px 6px 0px rgba(130,130,130,1);
            box-shadow: 0px 0px 6px 0px rgba(130,130,130,0.20);border-radius: 10px;
            background: lavender;
        }
        .homeService:hover {
            background-color: #F1F1FC;
            transform:scale(1.03,1.03);
            transition: all 1000ms cubic-bezier(.19,1,.22,1) 0ms;
            /*transform: rotate(2deg);*/
        }
        .fa_color{
            color: #ed4095;
        }
        .short_title{
            color: #ed4095;
        }
        .add-section{
            display: none;
        }
        @media only screen and (max-width:479px) {
            .add-section {
                display: block;
            }
            .footer-hide {
                display: none;
            }
        }
        #multiple-datasets .league-name {
            margin: 0 20px 5px 20px;
            padding: 3px 0;
            border-bottom: 1px solid #ccc;
        }
        input[type="search"]::placeholder {
            /* Firefox, Chrome, Opera */
            /*text-align: center;*/
        }
        .custom-list-group-item {
            position: relative;
            display: block;
            padding: 4px;
            background-color: #fff;
            border: 0px solid rgba(0,0,0,.125);
            border-bottom: 1px solid rgba(0,0,0,.125);
            /*border-radius: 30px;*/
        }
        .custom-header {
            background-color: #fff;
            color:#ed4095;
            padding: 6px;
            font-weight: bold;
            border: 1px solid #ed4095;
            /*border-radius: 30px;*/
        }
        .search-results-dropdown{
            width: 340px;
        }
    </style>
@endpush
@section('content')

    <!-- Home Banner -->
    <section class="section section-search" style="border-bottom: 15px solid #E83C91">
        <div class="container-fluid">
            @if($all_banners)
            <div class="row mb-3 add-section" style="margin-top: -30px">
                <div class="col-md-12 text-center">
                    <div class="add">
                        <div><img src = "{{asset('uploads/banner/'.$all_banners->image_1)}}" alt = ""></div>
                        <div><img src = "{{asset('uploads/banner/'.$all_banners->image_2)}}" alt = ""></div>
                        <div><img src = "{{asset('uploads/banner/'.$all_banners->image_3)}}" alt = ""></div>
                    </div>
                </div>
            </div>
            @endif
            <div class="banner-wrapper">
                <div class="banner-header text-center">
                    <h1 style="font-size: 35px">@if($all_banners) {{$all_banners->title}} @endif</h1>
                    <p>@if($all_banners) {{$all_banners->sub_title}} @endif</p>
                </div>
                <!-- Search -->
                <div class="search-box">
                    {{--                        <div class="form-group search-location">--}}
                    {{--                            <input type="text" class="form-control" placeholder="Search Location">--}}
                    {{--                            <span class="form-text">Based on your Location</span>--}}
                    {{--                        </div>--}}
                    <div class="form-group search-info text-center">
                        <input id="searchMain" class="form-control" name="serviceName" type="search" placeholder="Search Doctors, Hospital, Product, Test, Services..." autocomplete="off">
                        {{--                            <input type="text" class="form-control" placeholder="Search Doctors, Clinics, Hospitals, Diseases Etc">--}}
                        <span class="form-text">Ex : Dr. Mohammad, Care Hospital Ltd., oxygen, TSH, Dental Repair etc</span>
                    </div>
                    {{--                        <button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i> <span>Search</span></button>--}}
                </div>
                <!-- /Search -->
            </div>
        </div>
    </section>
    <!-- /Home Banner -->

    <section class="section home-tile-section pt-1 pb-5">
        <div class="container-fluid pt-5">
            <div class="row">
                <div class="col-md-12 m-auto">
                    {{--                    <div class="section-header text-center">--}}
                    {{--                        <h2>What are you looking for?</h2>--}}
                    {{--                    </div>--}}
                    <div class="row justify-content-center">

                        <div class="col-6 col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('clinic')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-h-square fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    {{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
                                    <h5 class="card-title mb-0">Visit a Hospital</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('doctor')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-female fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">Find A Doctor</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('shop')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-shopping-bag fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">Shop</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.caregivers')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-user-md fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">Caregiver</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.house-keeping')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-home fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">House Keeping</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.corporate-service')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-building fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    {{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
                                    <h5 class="card-title mb-0">Corporate Service</h5>
                                </div>
                            </a>
                        </div>

                        <div class="col-6 col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.home-aplliance')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-bed fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">Home Aplliance</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.moving-and-shifting')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-truck fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">Moving and Shifting</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.car-rental')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-car fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">Car Rental</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.it-service')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-info fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">IT Service</h5>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.event-management')}}">
                                <div class="py-4 homeService">
                                    <i class="fas fa-calendar-week fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    <h5 class="card-title mb-0">Event Management</h5>
                                </div>
                            </a>
                        </div>
                        <div  class="col-6 col-lg-2 mb-3 text-center" style="">
                            <a href="{{route('service.provider.category')}}">
                                <div class="py-4 homeService">
                                    <i class="fa fa-server fa-4x mb-3 fa_color" aria-hidden="true"></i>
                                    {{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
                                    <h5 class="card-title mb-0">View All</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Clinic and Specialities -->
    <section class="section section-specialities py-2">
        <div class="container-fluid">
            <div class="section-header mb-5" style="display: flex;
justify-content: center;">
                <h2 class="py-1 px-2" style="border: 3px solid #E83C91;color:#E83C91;font-weight: bold;"><a
                        href="{{route('all.service.sub.category')}}" style="color:#E83C91;font-weight: bold;">Recommended</a></h2>
                {{--                <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>--}}
            </div>
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <!-- Slider -->
                    <div class="specialities-slider slider">
                    @if(!empty($all_services))
                        @foreach($all_services as $service)
                            @php
                                $service_sub_category_slug = \App\ServiceSubCategory::where('id',$service->service_sub_category_id)->pluck('slug')->first();
                            @endphp
                            <!-- Slider Item -->
                                <div class="speicality-item text-center">
                                    <a href="{{url('service-sub-category/'.$service_sub_category_slug)}}">
                                        <div class="speicality-img" >
                                            @if(!empty($service->image))
                                                <img src="{{asset('uploads/services/'.$service->image)}}" class="img-fluid" alt="Speciality" style="border-radius: 10px;">
                                            @else
                                                <img src="{{asset('uploads/services/default.jpg')}}" class="img-fluid" alt="Speciality" style="border-radius: 10px;">
                                            @endif
                                            {{--                                            <span><i class="fa fa-circle" aria-hidden="true"></i></span>--}}
                                        </div>
                                        <p>{{$service->name}}</p>
                                    </a>
                                </div>
                                <!-- /Slider Item -->
                            @endforeach
                        @endif
                    </div>
                    <!-- /Slider -->
                </div>
            </div>
        </div>
    </section>
    <!-- Clinic and Specialities -->

    <!-- Popular Section -->
    <section class="section section-doctor py-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-header" style="display: flex">
                        <h2 class="px-2 py-1" style="border: 3px solid #E83C91;color:#E83C91;font-weight: bold;" ><a
                                style="color:#E83C91;font-weight: bold;"  href="{{route('doctor')}}">Find All Doctors</a></h2>
                    </div>
                    <div class="about-content">
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.</p>
                        <p>web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes</p>
                        {{--                        <a href="javascript:;">Read More..</a>--}}
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="doctor-slider slider">
                        <!-- Doctor Widget -->
                        @if(count($review_wise_doctor_user_lists) > 0)
                            @foreach($review_wise_doctor_user_lists as $review_wise_doctor_user_list)
                                <div class="profile-widget">
                                    <div class="doc-img">
                                        <a href="{{route('doctor.details',$review_wise_doctor_user_list->slug)}}">
                                            <img class="img-fluid" alt="User Image" src="{{asset('uploads/profile_pic/doctor/'.$review_wise_doctor_user_list->image)}}">
                                        </a>
                                        <a href="javascript:void(0)" class="fav-btn">
                                            <i class="far fa-bookmark"></i>
                                        </a>
                                    </div>
                                    <div class="pro-content">
                                        <h3 class="title">
                                            <a href="{{route('doctor.details',$review_wise_doctor_user_list->slug)}}">{{$review_wise_doctor_user_list->name}}</a>
                                            <i class="fas fa-check-circle verified"></i>
                                        </h3>
                                        <p class="speciality">{{$review_wise_doctor_user_list->spe_name}}</p>
                                        <div class="rating">
                                            @if($review_wise_doctor_user_list->rating >= 5)
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                            @elseif($review_wise_doctor_user_list->rating < 5 && $review_wise_doctor_user_list->rating >= 4)
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                            @elseif($review_wise_doctor_user_list->rating < 4 && $review_wise_doctor_user_list->rating >= 3)
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            @elseif($review_wise_doctor_user_list->rating < 3 && $review_wise_doctor_user_list->rating >= 2)
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            @endif
                                            <span class="d-inline-block average-rating">({{$review_wise_doctor_user_list->rating}})</span>
                                        </div>
                                        @php
                                            $addr=\App\DoctorContact::where('doctor_id',$review_wise_doctor_user_list->doctor_id)->first();
                                        @endphp
                                        <ul class="available-info">
                                            @if(!empty($addr))
                                                <li>
                                                    <i class="fas fa-map-marker-alt"></i> {{$addr->address}}
                                                </li>
                                            @endif
                                            {{--                                            <li>--}}
                                            {{--                                                <i class="far fa-clock"></i> Available on Fri, 22 Mar--}}
                                            {{--                                            </li>--}}
                                            {{--                                            <li>--}}
                                            {{--                                                <i class="far fa-money-bill-alt"></i> $300 - $1000--}}
                                            {{--                                                <i class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i>--}}
                                            {{--                                            </li>--}}
                                        </ul>
                                        <div class="row row-sm">
                                            <div class="col-6">
                                                <a href="{{route('doctor.details',$review_wise_doctor_user_list->slug)}}" class="btn view-btn">View Profile</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{route('doctor.booking',$review_wise_doctor_user_list->slug)}}" class="btn book-btn">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h1 class="text-center">No Doctor Found With Review!</h1>
                    @endif
                    <!-- /Doctor Widget -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Popular Section -->

    <!-- Availabe Features -->
    <section class="section section-features py-4">
        <div class="container-fluid">
            <div class="row">
                {{--                <div class="col-md-5 features-img">--}}
                {{--                    <img src="{{asset('frontend/img/features/category.jpg')}}" class="img-fluid" alt="Feature">--}}
                {{--                </div>--}}
                <div class="col-md-12">
                    <div class="section-header" style="display: flex">
                        <h2 class="px-2 py-1" style="border: 3px solid #E83C91;color:#E83C91;font-weight: bold;" ><a
                                href="{{route('all.service.category')}}" style="color:#E83C91;font-weight: bold;" >Our Service Category</a></h2>
                    </div>
                    <div class="features-slider slider">
                    @if(!empty($all_service_categories))
                        @foreach($all_service_categories as $all_service_category)
                            <!-- Slider Item -->
                                <div class="feature-item text-center">
                                    <a href="{{url('service-category/'.$all_service_category->slug)}}">
                                        @if($all_service_category->image)
                                            <img src="{{asset('uploads/service-category/'.$all_service_category->image)}}" class="img-fluid" alt="Feature">
                                        @else
                                            <img src="{{asset('uploads/service-category/default.png')}}" class="img-fluid" alt="Feature">
                                        @endif
                                        <p>{{$all_service_category->name}}</p>
                                    </a>
                                </div>
                                <!-- /Slider Item -->
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Availabe Features -->

    <!-- Popular Section -->
    <section class="section section-doctor py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-header" style="display: flex;justify-content: flex-end">
                        <h2 class="px-2 py-1" style="border: 3px solid #E83C91;background-color:#E83C91;color:#f5f5f5;font-weight: bold;" >
                            <a href="{{route('shop')}}" style="color:#f5f5f5;font-weight: bold;" >Get Our Product</a></h2>
                    </div>
                </div>
{{--                <div class="col-lg-12">--}}
{{--                    <div class="doctor-slider slider">--}}
{{--                        @foreach($all_product as $product )--}}
{{--                            <div class="col-md-12 col-lg-4 col-xl-4 product-custom">--}}
{{--                                <div class="profile-widget">--}}
{{--                                    <div class="doc-img">--}}
{{--                                        <a href="{{route('product.details',$product->slug)}}" tabindex="-1">--}}
{{--                                            @if(!empty($product->image))--}}
{{--                                                <img class="img-fluid" alt="Product image" src="{{asset('uploads/products/'.$product->image)}}">--}}
{{--                                            @else--}}
{{--                                                <img class="img-fluid" alt="Product image" src="{{asset('uploads/products/default.jpg')}}">--}}
{{--                                            @endif--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <div class="pro-content">--}}
{{--                                        <h3 class="title pb-4">--}}
{{--                                            <a href="{{route('product.details',$product->slug)}}" tabindex="-1">{{$product->name}}</a>--}}
{{--                                        </h3>--}}
{{--                                        <div class="row align-items-center">--}}
{{--                                            <div class="col-lg-6">--}}
{{--                                                <span class="price">TK{{$product->sale_price}}</span>--}}
{{--                                                <span class="price-strike">TK{{$product->regular_price}}</span>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-lg-6 text-right">--}}
{{--                                                <a href="#" class="cart-icon addToCart" id="{{$product->id}}"><i class="fas fa-shopping-cart"></i></a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
                {{--                    @if(!empty($hot_services))--}}
                {{--                        @foreach($hot_services as $service)--}}
                {{--                            <!-- Doctor Widget -->--}}
                {{--                                <div class="profile-widget mr-1">--}}
                {{--                                    <div class="doc-img">--}}
                {{--                                        <a href="javascript:void(0);">--}}
                {{--                                            @if(!empty($service->image))--}}
                {{--                                                <img class="img-fluid" alt="User Image" src="{{asset('uploads/services/'.$service->image)}}">--}}
                {{--                                            @else--}}
                {{--                                                <img class="img-fluid" alt="User Image" src="{{asset('uploads/services/default.jpg')}}">--}}
                {{--                                            @endif--}}
                {{--                                        </a>--}}
                {{--                                        <a href="javascript:void(0)" class="fav-btn">--}}
                {{--                                            <i class="far fa-bookmark"></i>--}}
                {{--                                        </a>--}}
                {{--                                    </div>--}}
                {{--                                    <div class="pro-content">--}}
                {{--                                        <h3 class="title">--}}
                {{--                                            <a href="javascript:void(0);">{{$service->name}}</a>--}}
                {{--                                            <i class="fas fa-check-circle verified"></i>--}}
                {{--                                        </h3>--}}
                {{--                                        <ul class="available-info">--}}
                {{--                                            <li>--}}
                {{--                                                <i class="far fa-money-bill-alt"></i> Tk. {{$service->price}}--}}
                {{--                                            </li>--}}
                {{--                                        </ul>--}}
                {{--                                        <div class="row row-sm">--}}
                {{--                                            <div class="col-12">--}}
                {{--                                                --}}{{--                                                <a href="bookingjavascript:void(0);" class="btn book-btn">Book Now</a>--}}
                {{--                                                @php--}}
                {{--                                                    $cart=Cart::content() ;--}}
                {{--                                                    $ser_id=$service->id;--}}
                {{--                                                    $item=$cart->search(function ($cartItem, $rowId) use ($ser_id) {--}}
                {{--                                                        return $cartItem->id === $ser_id;--}}
                {{--                                                    });--}}
                {{--                                                @endphp--}}
                {{--                                                @if(Cart::count()==0)--}}
                {{--                                                    <div class="cartbtn_{{$service->id}} float-right">--}}
                {{--                                                        <button id="{{$service->id}}" class="ttm-textcolor-white cart_button float-right" style="padding: 3px 14px; background-color: #fff;border: 2px solid #ED4095;border-radius: 4px;color: #1b1e21" title="CLick To Add Cart">Add +</button>--}}
                {{--                                                    </div>--}}
                {{--                                                @elseif($item==false)--}}
                {{--                                                    <div class="cartbtn_{{$service->id}} float-right">--}}
                {{--                                                        <button id="{{$service->id}}" class=" ttm-textcolor-white cart_button" style="padding: 3px 14px; background-color: #fff;border: 2px solid #dc5194;border-radius: 10px;color: #1b1e21" title="CLick To Add Cart">Add +</button>--}}
                {{--                                                    </div>--}}
                {{--                                                @else--}}
                {{--                                                    <h6 class="">Added</h6>--}}
                {{--                                                @endif--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <!-- /Doctor Widget -->--}}
                {{--                            @endforeach--}}
                {{--                        @endif--}}


            </div>
        </div>
    </section>
    <!-- /Popular Section -->
    <!-- Why Choose Us -->
    {{--    <section class="section section-features">--}}
    {{--        <div class="container-fluid">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-7">--}}
    {{--                    <div class="section-header">--}}
    {{--                        <h4 class="short_title">Why Choose Us</h4>--}}
    {{--                        <h2 class="mt-2">Because we care about your safety.. </h2>--}}
    {{--                    </div>--}}
    {{--                    <div class="row">--}}
    {{--                        <div class="col-lg-4 mb-3 text-center" style="">--}}
    {{--                            <div class="py-4 ">--}}
    {{--                                <i class="fa fa-h-square fa-4x mb-3 fa_color" aria-hidden="true"></i>--}}
    {{--                                --}}{{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
    {{--                                <h5 class="card-title mb-0">Prevent Care Guarantee</h5>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-lg-4 mb-3 text-center" style="">--}}
    {{--                            <div class="py-4 ">--}}
    {{--                                <i class="fas fa-heart fa-4x mb-3 fa_color" aria-hidden="true"></i>--}}
    {{--                                --}}{{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
    {{--                                <h5 class="card-title mb-0">Prevent Care Safe And Secure</h5>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-lg-4 mb-3 text-center" style="">--}}
    {{--                            <div class="py-4 ">--}}
    {{--                                <i class="fas fa-allergies fa-4x mb-3 fa_color" aria-hidden="true"></i>--}}
    {{--                                --}}{{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
    {{--                                <h5 class="card-title mb-0">24/7 Support</h5>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-lg-4 mb-3 text-center" style="">--}}
    {{--                            <div class="py-4 ">--}}
    {{--                                <i class="fab fa-accessible-icon fa-4x mb-3 fa_color" aria-hidden="true"></i>--}}
    {{--                                --}}{{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
    {{--                                <h5 class="card-title mb-0">Secure Payment Gateway</h5>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-lg-4 mb-3 text-center" style="">--}}
    {{--                            <div class="py-4 ">--}}
    {{--                                <i class="fab fa-amazon-pay fa-4x mb-3 fa_color" aria-hidden="true"></i>--}}
    {{--                                --}}{{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
    {{--                                <h5 class="card-title mb-0">Latest Price Guarantee</h5>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-lg-4 mb-3 text-center" style="">--}}
    {{--                            <div class="py-4 ">--}}
    {{--                                <i class="fab fa-android fa-4x mb-3 fa_color" aria-hidden="true"></i>--}}
    {{--                                --}}{{--                            <img src="{{asset('frontend/img/lab-image.jpg')}}" alt="" class="img-fluid">--}}
    {{--                                <h5 class="card-title mb-0">Ensuring Masks, Sanitizing, Hands And Globs</h5>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-5 features-img">--}}
    {{--                    <img src="{{asset('frontend/img/features/safety.jpg')}}" class="img-fluid" alt="Feature">--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    <!-- /Why Choose Us -->

    <!-- How it works -->
    {{--    <section class="section section-doctor">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-12">--}}
    {{--                    <div class="section-header">--}}
    {{--                        <h4 class="short_title">How it works</h4>--}}
    {{--                        <h2 class="mt-2">Easiest way to get a service... </h2>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-6 features-img">--}}
    {{--                    <iframe width="570" height="320" src="https://www.youtube.com/embed/rDYdeq3JW_E" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 10px"></iframe>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-6 px-5">--}}
    {{--                    <div class="row">--}}
    {{--                        <div class="col-lg-12 mb-5" >--}}
    {{--                            <div class="row">--}}
    {{--                                <div class="col-md-1 mt-1">--}}
    {{--                                    <h1 class="font-weight-bold short_title">1.</h1>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-11">--}}
    {{--                                    <h3>Select the Service</h3>--}}
    {{--                                    <h6>Pick the service you are looking for- from the website or the app.</h6>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-lg-12 mb-5" style="">--}}
    {{--                            <div class="row">--}}
    {{--                                <div class="col-md-1 mt-3">--}}
    {{--                                    <h1 class="font-weight-bold short_title">2.</h1>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-11">--}}
    {{--                                    <h3>Pick your schedule</h3>--}}
    {{--                                    <h6>Pick your convenient date and time to avail the service. Pick the service provider based on their rating.</h6>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="col-lg-12 mb-5" style="">--}}
    {{--                            <div class="row">--}}
    {{--                                <div class="col-md-1 mt-3">--}}
    {{--                                    <h1 class="font-weight-bold short_title">3.</h1>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-11">--}}
    {{--                                    <h3>Place Your Order & Relax </h3>--}}
    {{--                                    <h6>Review and place the order. Now just sit back and relax. We’ll assign the expert service provider’s schedule for you. </h6>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    <!-- /How it works -->


    {{--    <!-- Availabe Features -->--}}
    {{--    <section class="section section-features">--}}
    {{--        <div class="container-fluid">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-5 features-img">--}}
    {{--                    <img src="{{asset('frontend/img/features/category.jpg')}}" class="img-fluid" alt="Feature">--}}
    {{--                </div>--}}
    {{--                <div class="col-md-7">--}}
    {{--                    <div class="section-header">--}}
    {{--                        <h4 class="mt-2 short_title">Service Category</h4>--}}
    {{--                        <h2 >Availabe Category in Our Services</h2>--}}
    {{--                    </div>--}}
    {{--                    <div class="features-slider slider">--}}
    {{--                    @if(!empty($all_service_categories))--}}
    {{--                        @foreach($all_service_categories as $all_service_category)--}}
    {{--                            <!-- Slider Item -->--}}
    {{--                                <div class="feature-item text-center">--}}
    {{--                                    <a href="{{url('service-category/'.$all_service_category->slug)}}">--}}
    {{--                                        @if($all_service_category->icon)--}}
    {{--                                            <img src="{{asset('uploads/service-category/icon/'.$all_service_category->icon)}}" class="img-fluid" alt="Feature">--}}
    {{--                                        @else--}}
    {{--                                            <img src="{{asset('uploads/service-category/icon/default.png')}}" class="img-fluid" alt="Feature">--}}
    {{--                                        @endif--}}
    {{--                                        <p>{{$all_service_category->name}}</p>--}}
    {{--                                    </a>--}}
    {{--                                </div>--}}
    {{--                                <!-- /Slider Item -->--}}
    {{--                            @endforeach--}}
    {{--                        @endif--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    {{--    <!-- /Availabe Features -->--}}

    <!-- How it works -->
    {{--    <section class="section section-doctor" style="background: #f8f9fa!important;">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-12">--}}
    {{--                    <div class="section-header">--}}
    {{--                        <h4 class="short_title">SOME HAPPY FACES</h4>--}}
    {{--                        <h2 class="mt-2">Real Happy Customers, Real Stories... </h2>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-md-12">--}}
    {{--                    <div class="review">--}}
    {{--                        <div><div class="row">--}}
    {{--                                <div class="col-md-6">--}}
    {{--                                    <div class="row p-5" >--}}
    {{--                                        <div class="col-md-12">--}}
    {{--                                            <p style="font-size: 25px;font-family: 'Satisfy', cursive;">--}}
    {{--                                                Prevent Care services are very helpful for working women like me. They were on time as per the schedule to provide the service, and I’m very satisfied with their quality of service.--}}
    {{--                                            </p>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="col-md-12">--}}
    {{--                                            <h4 class="float-right">-Ayesha Akhter</h4>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="col-md-12">--}}
    {{--                                            <p class="float-right">IT Head</p>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-6 features-img text-center">--}}
    {{--                                    <iframe width="560" height="310" src="https://www.youtube.com/embed/rDYdeq3JW_E" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 10px"></iframe>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div>--}}
    {{--                            <div class="row">--}}
    {{--                                <div class="col-md-6">--}}
    {{--                                    <div class="row p-5" >--}}
    {{--                                        <div class="col-md-12">--}}
    {{--                                            <p style="font-size: 25px;font-family: 'Satisfy', cursive;">--}}
    {{--                                                Prevent Care services are very helpful for working women like me. They were on time as per the schedule to provide the service, and I’m very satisfied with their quality of service.--}}
    {{--                                            </p>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="col-md-12">--}}
    {{--                                            <h4 class="float-right">-Ayesha Akhter</h4>--}}
    {{--                                        </div>--}}
    {{--                                        <div class="col-md-12">--}}
    {{--                                            <p class="float-right">IT Head</p>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-6 features-img text-center">--}}
    {{--                                    <iframe width="560" height="310" src="https://www.youtube.com/embed/rDYdeq3JW_E" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius: 10px"></iframe>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    <!-- /How it works -->
    <!-- Blog Section -->
    <section class="section section-blogs py-2">
        <div class="container-fluid">
            <!-- Section Header -->
            <div class="section-header" style="display: flex;justify-content: flex-start">
                <h2 class="px-2 py-1" style="border: 3px solid #E83C91;color:#E83C91;font-weight: bold;" ><a
                        href="{{route('health.tips.list')}}" style="color:#E83C91;font-weight: bold;" >Health Tips</a></h2>
            </div>
            <!-- /Section Header -->
            <div class="row blog-grid-row">
                @foreach($all_health_tips as $health)
                    <div class="col-md-3 col-lg-3 col-sm-12">
                        <!-- Blog Post -->
                        <div class="blog grid-blog">
                            <div class="blog-image">
                                <a href="javascript:void(0);"><img class="img-fluid" src="{{asset('uploads/health-tips/'.$health->image)}}" alt="{{$health->image_alt}}"></a>
                            </div>
                            <div class="blog-content">
                                @php
                                    $dc=\App\User::find($health->doctor_id);
                                @endphp
                                <ul class="entry-meta meta-item">
                                    <li>
                                        <div class="post-author">
                                            <a href="{{route('health_tips.details',$health->slug)}}"><img src="{{asset('frontend/img/doctors/doctor-thumb-02.jpg')}}" alt="Post Author"> <span>{{ $dc->name }}</span></a>
                                        </div>
                                    </li>
                                    <li style="flex: 0 0 200px;max-width: 200px;"><i class="far fa-clock"></i> {{date('jS F, Y',strtotime($health->created_at))}}</li>
                                </ul>
                                <h3 class="blog-title"><a href="{{route('health_tips.details',$health->slug)}}">{{ $health->title }}</a></h3>
                                {{--                                <p class="mb-0">{!! Str::limit($health->contents,40) !!}</p>--}}
                            </div>
                        </div>
                        <!-- /Blog Post -->
                    </div>
                @endforeach
            </div>
            <div class="view-all text-center">
                <a href="{{route('health.tips.list')}}" class="btn btn-primary">View All</a>
            </div>
        </div>
    </section>
    <!-- app Download -->
{{--    <section class="section section-features" style="background: #fff!important;">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-5 features-img text-center">--}}
{{--                    <img src="{{asset('frontend/img/app-download.jpg')}}" class="img-fluid" alt="Feature" >--}}
{{--                </div>--}}
{{--                <div class="col-md-7 mt-2">--}}
{{--                    <div class="mb-4">--}}
{{--                        <h4 class="short_title">Download Our App</h4>--}}
{{--                        <h2 class="mt-2">Any Service, Any Time, Anywhere... </h2>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-4">--}}
{{--                            <a href = "https://play.google.com/store/apps"><img src = "{{asset('frontend/img/play-store.png')}}" alt = "" width="200px"></a>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <a href = "https://www.apple.com/app-store/"><img src = "{{asset('frontend/img/app-store.png')}}" alt = "" width="200px"></a>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-12 mt-5" style="">--}}
{{--                            <h2>Like Us on Facebook</h2>--}}
{{--                            <a style="font-size: 18px" href = "#">Prevent Care</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- /app Download -->


    <!-- /Blog Section -->
@stop
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script !src = "">
        jQuery(document).ready(function($) {
            var product = new Bloodhound({
                remote: {
                    url: '/search/product?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('serviceName'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });
            var doctor = new Bloodhound({
                remote: {
                    url: '/search/doctor?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('serviceName'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });
            var hospital = new Bloodhound({
                remote: {
                    url: '/search/hospital?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('serviceName'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });
            var test = new Bloodhound({
                remote: {
                    url: '/search/test?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('serviceName'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });
            var service = new Bloodhound({
                remote: {
                    url: '/search/service?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('serviceName'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });


            $("#searchMain").typeahead({
                hint: true,
                highlight: true,
                minLength: 3
            }, {
                source: doctor.ttAdapter(),
                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'serviceList',
                display: 'name',
                // the key from the array we want to display (name,id,email,etc...)
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Sorry,We could not find any Doctor.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown"> <div class="list-group-item custom-header">Doctor</div>'
                    ],
                    suggestion: function (data) {
                        return '<a href="doctor-details/'+data.slug+'" class="list-group-item custom-list-group-item">'+data.name+'</a>'
                    }
                }
            }, {
                source: hospital.ttAdapter(),
                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'serviceList',
                display: 'name',
                // the key from the array we want to display (name,id,email,etc...)
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Sorry,We could not find any Hospital.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown"> <div class="list-group-item custom-header">Hospital</div>'
                    ],
                    suggestion: function (data) {
                        return '<a href="clinic-details/'+data.slug+'" class="list-group-item custom-list-group-item">'+data.name+'</a>'
                    }
                }
            },{
                source: product.ttAdapter(),
                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'serviceList',
                display: 'name',
                // the key from the array we want to display (name,id,email,etc...)
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Sorry,We could not find any Product.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item custom-header">Product</div>'
                    ],
                    suggestion: function (data) {
                        return '<a href="product/'+data.slug+'" class="list-group-item custom-list-group-item">'+data.name+'</a>'
                    }
                }
            },{
                source: test.ttAdapter(),
                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'serviceList',
                display: 'name',
                // the key from the array we want to display (name,id,email,etc...)
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Sorry,We could not find any Lab Test.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item custom-header">Lab Test</div>'
                    ],
                    suggestion: function (data) {
                        return '<a href="test/lab/'+data.slug+'" class="list-group-item custom-list-group-item">'+data.name+'</a>'
                    }
                }
            },{
                source: service.ttAdapter(),
                // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
                name: 'serviceList',
                display: 'name',
                // the key from the array we want to display (name,id,email,etc...)
                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Sorry,We could not find any Service.</div></div>'
                    ],
                    header: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item custom-header">Service</div>'
                    ],
                    suggestion: function (data) {
                        return '<a href="service-sub-category/'+data.slug+'" class="list-group-item custom-list-group-item">'+data.name+'</a>'
                    }
                }
            });
        });
    </script>
    <script !src = "">
        $(document).ready(function(){
            $(".cart_button").click(function (e) {
                e.preventDefault();
                console.log(this.id);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('service.cart.add')}}',
                    method: 'post',
                    data: {
                        service_id:this.id,
                        type:"service",
                        _token: '{{csrf_token()}}',
                    },
                    success: function(data){
                        console.log(data);
                        if(data.check_service_category_type == false){
                            toastr.warning('Service not added in your cart, you did not added different category in same invoice <span style="font-size: 15px;">&#10084;&#65039;</span>');
                        }else{
                            toastr.success('Service added in your cart <span style="font-size: 15px;">&#10084;&#65039;</span>');
                            $('#number-cart').html(data.response['countCart']);
                            $('.cartbtn_'+data.response['id']).html('<h6>Added</h6>');
                            $('.service-details-cart').append(`<tr class="cart_item border-0">
                                                        <td class="product-name py-2 border-0">
                                                            <p style="font-size: 15px;color: #0c0c0c" class="mb-1">`+data.response['options'].service_sub_category_name+`</p>
                                                            `+data.response['name']+`
                                                            <strong class="product-quantity">× `+data.response['qty']+`</strong>
                                                        </td>
                                                        <td class="product-total border-0">
                                                                    <span class="Price-amount">
                                                                        <span class="Price-currencySymbol">৳</span>`+data.response['price']+`
                                                                    </span>
                                                        </td>
                                                    </tr>`);
                            $('.service-empty-cart').empty();
                        }

                    }
                });
            });

            $('.add').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1
            });
            $('.review').slick();
        });
    </script>
{{--    <script>--}}
{{--        $(".addToCart").click(function (e) {--}}
{{--            e.preventDefault();--}}
{{--            $.ajaxSetup({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                }--}}
{{--            });--}}
{{--            $.ajax({--}}
{{--                url: "{{route('product.cart.add')}}",--}}
{{--                method: "post",--}}
{{--                data:{--}}
{{--                    productId:this.id,--}}
{{--                },--}}
{{--                success: function(data){--}}
{{--                    console.log(data.response['countCart'])--}}
{{--                    toastr.success('Product added in your cart <span style="font-size: 25px;">&#10084;&#65039;</span>');--}}
{{--                    //$('#number-cart').html('<div>'+data.response['countCart']+'</div>');--}}
{{--                    $('#number-cart').html(data.response['countCart']);--}}
{{--                    // $('.addToCart').prop("disabled",true);--}}
{{--                }--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}
@endpush
