@extends('frontend-shop.layouts.master')
@section('title','Shop Details')
@push('css')
    <style>
        .shop_div {
            background-color: #f1f1f1;
            padding: 20px;
        }
    </style>
@endpush
@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    @php
        $shop = shopInfo($slug);
        $user_id = $shop->user_id;
        $seller = sellerInfo($user_id);
        $user = shopSellerInfo($user_id);
    @endphp
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="https://transvelo.github.io/electro-html/2.0/html/home/index.html">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{$shop->name}}</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="row mb-8">

                <!-- Header Start -->
                @include('frontend-shop.pages.seller.includes.seller_shop_sidebar')
                <!--Header End-->

                <div class="col-xl-9 col-wd-9gdot5">
                    <div class="mb-3">
                        <div class="ps-block__right">
                            <form class="ps-form--search text-right" action="" method="get">
                                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                                <input  class="form-control" id="searchMain" name="searchName" type="search" placeholder="Search in this shop" autocomplete="off">
                            </form>
                        </div>
                    </div>

                    <!-- Deals of The Day -->
                    @php
                        $shop_id = $shop->id;
                        $shopFlashDealProducts = shopFlashDealProducts($shop_id);
                        $shopFlashDeal = $shopFlashDealProducts['flashDeal'];
                        //dd($shopFlashDeal);
                    @endphp

                    @if(!empty($shopFlashDeal))
                        <div class="mb-3">
                            <div class="d-flex border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-sm-bottom-0 mb-2 mb-md-0">
                                <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">{{$shopFlashDeal['title']}}</h3>
                                <div class="js-countdown ml-md-5 mt-md-n1 border-top border-color-1 border-md-top-0 w-100 w-md-auto pt-2 pt-md-0 mb-2 mb-md-0"
                                     data-end-date="{{date('Y/m/d', $shopFlashDeal['end_date_time'])}}"
                                     data-hours-format="%H"
                                     data-minutes-format="%M"
                                     data-seconds-format="%S">
                                    <div class="flex-horizontal-center d-inline-flex bg-primary py-2 align-self-start height-33 px-5 rounded-pill text-gray-2 font-size-15 font-weight-bold text-lh-1">
                                        <h5 class="font-size-15 mb-0 font-weight-bold text-lh-1 mr-1">Ends in:</h5>
                                        <div class="px-1">
                                            <span class="js-cd-hours"></span>
                                        </div>
                                        <div class="">:</div>
                                        <div class="px-1">
                                            <span class="js-cd-minutes"></span>
                                        </div>
                                        <div class="">:</div>
                                        <div class="px-1">
                                            <span class="js-cd-seconds"></span>
                                        </div>
                                    </div>
                                </div>
{{--                                <ul class="nav nav-pills mb-2 pt-3 pt-md-0 mb-0 border-top border-color-1 border-md-top-0 align-items-center font-size-15 font-size-15-md flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">--}}
{{--                                    <li class="nav-item flex-shrink-0 flex-md-shrink-1">--}}
{{--                                        <a class="nav-link text-gray-8" href="{{route('all.featured.category',$shop->slug)}}"> View All</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
                                <a class="ml-md-auto d-block text-gray-16 align-self-center" href="{{route('all.flash-deal.products',$shopFlashDeal['slug'])}}">View All <i class="ec ec-arrow-right-categproes"></i></a>
                            </div>
                            <div class="js-slick-carousel u-slick overflow-hidden u-slick-overflow-visble pt-3 pb-6 px-1"
                                 data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4"
                                 data-slides-show="7"
                                 data-slides-scroll="1"
                                 data-responsive='[{
                          "breakpoint": 1400,
                          "settings": {
                            "slidesToShow": 5
                          }
                        }, {
                            "breakpoint": 1200,
                            "settings": {
                              "slidesToShow": 4
                            }
                        }, {
                          "breakpoint": 992,
                          "settings": {
                            "slidesToShow": 4
                          }
                        }, {
                          "breakpoint": 768,
                          "settings": {
                            "slidesToShow": 3
                          }
                        }, {
                          "breakpoint": 554,
                          "settings": {
                            "slidesToShow": 2
                          }
                        }]'>

                                @php
                                    $shopFlashDealProducts = $shopFlashDealProducts['flashDealProducts'];
                                    //dd($todayFlashDeal);
                                @endphp

                                @if($shopFlashDealProducts != NULL)
                                    @foreach($shopFlashDealProducts as $shopFlashDealProduct)
                                        <div class="js-slide products-group">
                                            <div class="product-item">
                                                <div class="product-item__outer h-100">
                                                    <div class="product-item__inner px-wd-4 p-2 p-md-3">
                                                        <div class="product-item__body pb-xl-2">
                                                            {{--                                        <div class="mb-2"><a href="http://localhost/electro_download_file/electro-main/2.0/html/shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>--}}
                                                            <h5 class="mb-1 product-item__title"><a href="{{route('product-details',$shopFlashDealProduct['slug'])}}" class="text-blue font-weight-bold">{{$shopFlashDealProduct['name']}}</a></h5>
                                                            <div class="mb-2">
                                                                <a href="{{route('product-details',$shopFlashDealProduct['slug'])}}" class="d-block text-center"><img class="img-fluid" src="{{url($shopFlashDealProduct['thumbnail_img'])}}" alt="Image Description"></a>
                                                            </div>
                                                            <div class="flex-center-between mb-1">
                                                                <div class="prodcut-price">
                                                                    @php
                                                                        $product_id = $shopFlashDealProduct['product_id'];
                                                                        $productPrice = productPrice($product_id);
                                                                    @endphp
                                                                    <div class="text-gray-100">
                                                                        ৳{{$productPrice['discount_price'] ? $productPrice['discount_price'] : $productPrice['unit_price']}}
                                                                    </div>
                                                                    @if($productPrice['discount_price'])
                                                                        <del class="font-size-20 ml-2 text-gray-6">৳{{$productPrice['unit_price']}}</del>
                                                                    @endif
                                                                </div>
                                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                                    <a href="{{route('product-details',$shopFlashDealProduct['slug'])}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="product-item__footer">
                                                            <div class="border-top pt-2 flex-center-between flex-wrap">
{{--                                                                <a href="http://localhost/electro_download_file/electro-main/2.0/html/shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
                                                                <span>Review ({{productReviewCount($product_id)}})</span>
                                                                <a href="{{route('add.wishlist',$product_id)}}" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                @endif
                <!-- End Deals of The Day -->


                    <!-- Start Featured Category -->
{{--                    @if($shopCat->count() > 0)--}}
{{--                    <div class="mb-3">--}}
{{--                        <h4>Featured Category</h4>--}}
{{--                        <div class="py-2 border-top border-bottom">--}}
{{--                            <div class="js-slick-carousel u-slick my-1"--}}
{{--                                 data-slides-show="5"--}}
{{--                                 data-slides-scroll="1"--}}
{{--                                 data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-normal u-slick__arrow-centered--y"--}}
{{--                                 data-arrow-left-classes="fa fa-angle-left u-slick__arrow-classic-inner--left z-index-9"--}}
{{--                                 data-arrow-right-classes="fa fa-angle-right u-slick__arrow-classic-inner--right"--}}
{{--                                 data-responsive='[{--}}
{{--                                    "breakpoint": 992,--}}
{{--                                    "settings": {--}}
{{--                                        "slidesToShow": 2--}}
{{--                                    }--}}
{{--                                }, {--}}
{{--                                    "breakpoint": 768,--}}
{{--                                    "settings": {--}}
{{--                                        "slidesToShow": 1--}}
{{--                                    }--}}
{{--                                }, {--}}
{{--                                    "breakpoint": 554,--}}
{{--                                    "settings": {--}}
{{--                                        "slidesToShow": 1--}}
{{--                                    }--}}
{{--                                }]'>--}}
{{--                                @foreach($shopCat as $cat)--}}
{{--                                <div class="js-slide">--}}
{{--                                    <a href="{{url('/shop/'.$shop->slug.'/'.$cat->category->slug)}}" class="link-hover__brand">--}}
{{--                                        <img class="img-fluid m-auto max-height-50" src="{{asset('uploads/categories/'.$cat->category->icon)}}" alt="Image Description">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endif--}}
                    <!-- End Featured Category -->

                    <!-- Recommended Products -->
                    @php
                        $shopCat = shopCategory($shop_id)
                    @endphp

                    @if($shopCat->count() > 0)
                    <div class="mb-6 d-none d-xl-block">
                        <div class="position-relative">
                            <div class=" d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
                                <h3 class="section-title mb-0 pb-2 font-size-22">Featured Category</h3>
                                <ul class="nav nav-pills mb-2 pt-3 pt-md-0 mb-0 border-top border-color-1 border-md-top-0 align-items-center font-size-15 font-size-15-md flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">
                                    <li class="nav-item flex-shrink-0 flex-md-shrink-1">
                                        <a class="nav-link text-gray-8" href="{{route('all.featured.category',$shop->slug)}}"> View All</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-7 pt-2 px-1"
                                 data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0"
                                 data-slides-show="5"
                                 data-slides-scroll="1"
                                 data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                                 data-arrow-left-classes="fa fa-angle-left right-1"
                                 data-arrow-right-classes="fa fa-angle-right right-0"
                                 data-responsive='[{
                                      "breakpoint": 1400,
                                      "settings": {
                                        "slidesToShow": 4
                                      }
                                    }, {
                                        "breakpoint": 1200,
                                        "settings": {
                                          "slidesToShow": 4
                                        }
                                    }, {
                                      "breakpoint": 992,
                                      "settings": {
                                        "slidesToShow": 3
                                      }
                                    }, {
                                      "breakpoint": 768,
                                      "settings": {
                                        "slidesToShow": 2
                                      }
                                    }, {
                                      "breakpoint": 554,
                                      "settings": {
                                        "slidesToShow": 2
                                      }
                                    }]'>
                                @foreach($shopCat as $cat)
                                <div class="js-slide products-group">
                                    <div class="product-item">
                                        <div class="product-item__outer h-100">
                                            <div class="product-item__inner px-wd-4 p-2 p-md-3">
                                                <div class="product-item__body pb-xl-2">
                                                    <h5 class="mb-1 product-item__title">
                                                        <a href="{{url('/shop/'.$shop->slug.'/'.$cat->category->slug)}}" class="text-blue font-weight-bold">{{$cat->category->name}}</a>
                                                    </h5>
                                                    <div class="mb-2">
                                                        <a href="{{url('/shop/'.$shop->slug.'/'.$cat->category->slug)}}" class="d-block text-center"><img class="img-fluid" src="{{asset('uploads/categories/'.$cat->category->icon)}}" alt="Image Description"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- End Recommended Products -->



                    <!--Start Featured Product-cards-carousel -->
                    @php
                        $featured_products = featuredProducts($shop->user_id)
                    @endphp
                    @if(count($featured_products) >= 0)
                        <div class="space-top-2">
                            <div class=" d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
                                <h3 class="section-title mb-0 pb-2 font-size-22">Featured Products</h3>
                                <ul class="nav nav-pills mb-2 pt-3 pt-md-0 mb-0 border-top border-color-1 border-md-top-0 align-items-center font-size-15 font-size-15-md flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">
                                    <li class="nav-item flex-shrink-0 flex-md-shrink-1">
                                        <a class="nav-link text-gray-8" href="{{route('all.featured.products',$shop->slug)}}"> View All</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="js-slick-carousel u-slick u-slick--gutters-2 overflow-hidden u-slick-overflow-visble pt-3 pb-6"
                                 data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">
                                <div class="js-slide">
                                    <ul class="row list-unstyled products-group no-gutters mb-0 overflow-visible">
                                        @foreach($featured_products as $key => $featured_product)
                                        <li class="col-wd-3 col-md-3 product-item product-item__card pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                            <div class="product-item__outer h-100">
                                                <div class="product-item__inner p-md-3 row no-gutters">
                                                    <div class="col col-lg-auto product-media-left">
                                                        <a href="{{route('product-details',$featured_product->slug)}}" class="max-width-150 d-block">
                                                            <img class="img-fluid" src="{{url($featured_product->thumbnail_img)}}" alt="Image Description">
                                                        </a>
                                                    </div>
                                                    <div class="col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1">
                                                        <div class="mb-4">
    {{--                                                        <div class="mb-2">--}}
    {{--                                                            <a href="" class="font-size-12 text-gray-5">Laptops & Computers</a>--}}
    {{--                                                        </div>--}}
                                                            <h5 class="product-item__title">
                                                                <a href="{{route('product-details',$featured_product->slug)}}" class="text-blue font-weight-bold">{{$featured_product->name}}</a>
                                                            </h5>
                                                        </div>
                                                        @php
                                                            $productPrice = productPrice($featured_product->id);
                                                        @endphp
                                                        <div class="flex-center-between mb-3">
                                                            <div class="prodcut-price">
                                                                <div class="text-gray-100">
                                                                    ৳{{$productPrice['discount_price'] ? $productPrice['discount_price'] : $productPrice['unit_price']}}
                                                                </div>
                                                                @if($productPrice['discount_price'])
                                                                    <del class="font-size-20 ml-2 text-gray-6">৳{{$productPrice['unit_price']}}</del>
                                                                @endif
                                                            </div>
                                                            <div class="d-none d-xl-block prodcut-add-cart">
                                                                <a href="{{route('product-details',$featured_product->slug)}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-item__footer">
                                                            <div class="border-top pt-2 flex-center-between flex-wrap">
    {{--                                                            <a href="http://localhost/electro_download_file/electro-main/2.0/html/shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
                                                                <span>Review ({{productReviewCount($featured_product->id)}})</span>
                                                                <a href="{{route('add.wishlist',$featured_product->id)}}" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!--End Featured Product-cards-carousel -->

                    <!--Start Best Product-cards-carousel -->
                    @php
                        $best_sales_products = bestSalesProducts($shop->user_id)
                    @endphp
                    @if(count($best_sales_products) >= 0)
                        <div class="space-top-2">
                            <dv class=" d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
                                <h3 class="section-title mb-0 pb-2 font-size-22">Best sell Products</h3>
                                <ul class="nav nav-pills mb-2 pt-3 pt-md-0 mb-0 border-top border-color-1 border-md-top-0 align-items-center font-size-15 font-size-15-md flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">
                                    <li class="nav-item flex-shrink-0 flex-md-shrink-1">
                                        <a class="nav-link text-gray-8" href="{{route('all.best_sales.products',$shop->slug)}}"> View All</a>
                                    </li>
                                </ul>
                            </dv>
                            <div class="js-slick-carousel u-slick u-slick--gutters-2 overflow-hidden u-slick-overflow-visble pt-3 pb-6"
                                 data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4">
                                @if(count($best_sales_products) >= 1 && count($best_sales_products) <= 4)
                                    <div class="js-slide">
                                        <ul class="row list-unstyled products-group no-gutters mb-0 overflow-visible">
                                            @foreach($best_sales_products as $key => $best_sales_product)
                                                <li class="col-wd-3 col-md-3 product-item product-item__card pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                                    <div class="product-item__outer h-100">
                                                        <div class="product-item__inner p-md-3 row no-gutters">
                                                            <div class="col col-lg-auto product-media-left">
                                                                <a href="{{route('product-details',$best_sales_product->slug)}}" class="max-width-150 d-block">
                                                                    <img class="img-fluid" src="{{url($best_sales_product->thumbnail_img)}}" alt="Image Description">
                                                                </a>
                                                            </div>
                                                            <div class="col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1">
                                                                <div class="mb-4">
                                                                    {{--                                                        <div class="mb-2">--}}
                                                                    {{--                                                            <a href="" class="font-size-12 text-gray-5">Laptops & Computers</a>--}}
                                                                    {{--                                                        </div>--}}
                                                                    <h5 class="product-item__title">
                                                                        <a href="{{route('product-details',$best_sales_product->slug)}}" class="text-blue font-weight-bold">{{$best_sales_product->name}}</a>
                                                                    </h5>
                                                                </div>
                                                                @php
                                                                    $productPrice = productPrice($best_sales_product->id);
                                                                @endphp
                                                                <div class="flex-center-between mb-3">
                                                                    <div class="prodcut-price">
                                                                        <div class="text-gray-100">
                                                                            ৳{{$productPrice['discount_price'] ? $productPrice['discount_price'] : $productPrice['unit_price']}}
                                                                        </div>
                                                                        @if($productPrice['discount_price'])
                                                                            <del class="font-size-20 ml-2 text-gray-6">৳{{$productPrice['unit_price']}}</del>
                                                                        @endif
                                                                    </div>
                                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                                        <a href="{{route('product-details',$best_sales_product->slug)}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="product-item__footer">
                                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                                        {{--                                                            <a href="http://localhost/electro_download_file/electro-main/2.0/html/shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
                                                                        <span>Review ({{productReviewCount($best_sales_product->id)}})</span>
                                                                        <a href="{{route('add.wishlist',$best_sales_product->id)}}" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(count($best_sales_products) >= 5 && count($best_sales_products) <= 8)
                                    <div class="js-slide">
                                        <ul class="row list-unstyled products-group no-gutters mb-0 overflow-visible">
                                            @foreach($best_sales_products as $key => $best_sales_product)
                                                <li class="col-wd-3 col-md-3 product-item product-item__card pb-2 mb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">
                                                    <div class="product-item__outer h-100">
                                                        <div class="product-item__inner p-md-3 row no-gutters">
                                                            <div class="col col-lg-auto product-media-left">
                                                                <a href="{{route('product-details',$best_sales_product->slug)}}" class="max-width-150 d-block">
                                                                    <img class="img-fluid" src="{{url($best_sales_product->thumbnail_img)}}" alt="Image Description">
                                                                </a>
                                                            </div>
                                                            <div class="col product-item__body pl-2 pl-lg-3 mr-xl-2 mr-wd-1">
                                                                <div class="mb-4">
                                                                    {{--                                                        <div class="mb-2">--}}
                                                                    {{--                                                            <a href="" class="font-size-12 text-gray-5">Laptops & Computers</a>--}}
                                                                    {{--                                                        </div>--}}
                                                                    <h5 class="product-item__title">
                                                                        <a href="{{route('product-details',$best_sales_product->slug)}}" class="text-blue font-weight-bold">{{$best_sales_product->name}}</a>
                                                                    </h5>
                                                                </div>
                                                                @php
                                                                    $productPrice = productPrice($best_sales_product->id);
                                                                @endphp
                                                                <div class="flex-center-between mb-3">
                                                                    <div class="prodcut-price">
                                                                        <div class="text-gray-100">
                                                                            ৳{{$productPrice['discount_price'] ? $productPrice['discount_price'] : $productPrice['unit_price']}}
                                                                        </div>
                                                                        @if($productPrice['discount_price'])
                                                                            <del class="font-size-20 ml-2 text-gray-6">৳{{$productPrice['unit_price']}}</del>
                                                                        @endif
                                                                    </div>
                                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                                        <a href="{{route('product-details',$best_sales_product->slug)}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                    </div>
                                                                </div>
                                                                <div class="product-item__footer">
                                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                                                        {{--                                                            <a href="http://localhost/electro_download_file/electro-main/2.0/html/shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
                                                                        <span>Review ({{productReviewCount($best_sales_product->id)}})</span>
                                                                        <a href="{{route('add.wishlist',$best_sales_product->id)}}" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                    <!--End Best Product-cards-carousel -->

                </div>
            </div>

        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script !src = "">
        jQuery(document).ready(function($) {
            var product = new Bloodhound({
                remote: {
                    url: '/search/product?q=%QUERY%&storeId={{$shop->id}}',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('searchName'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $("#searchMain").typeahead({
                    hint: true,
                    highlight: true,
                    minLength: 3
                }, {
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
                            // '<div class="list-group search-results-dropdown"><div class="list-group-item custom-header">Product</div>'
                        ],
                        suggestion: function (data) {
                            return '<a href="/product/'+data.slug+'" class="list-group-item custom-list-group-item">'+data.name+'</a>'
                        }
                    }
                },
            );
        });
    </script>
@endpush
