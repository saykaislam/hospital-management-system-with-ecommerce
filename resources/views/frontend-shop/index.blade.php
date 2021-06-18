@extends('frontend-shop.layouts.master')
@section('title','Shop Home')
@section('content')
    <main id="content" role="main">
        <!-- Slider -->
        @php
            $sliders = sliders();
        @endphp
        @if(count($sliders) > 0)
        <div class="col-xl pr-xl-2 mb-4 mb-xl-0">
            <div class="bg-img-hero mr-xl-1 height-410-xl overflow-hidden">
                <div class="js-slick-carousel u-slick"
                     data-autoplay="true"
                     data-speed="7000"
                     data-pagi-classes="text-center position-absolute right-0 bottom-0 left-0 u-slick__pagination u-slick__pagination--long justify-content-start ml-9 mb-3 mb-md-5">
                    @foreach($sliders as $slider)
                        <div class="js-slide bg-img-hero-center">
                            <div class="row height-415-xl py-3 py-md-0 mx-0">

                                <div class="col-xl-12 col-12 d-flex align-items-center ml-auto ml-md-0"
                                     data-scs-animation-in="zoomIn"
                                     data-scs-animation-delay="500">
                                    <img class="img-fluid" src="{{$slider->image}}" alt="Image Description">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <!-- End Slider -->

        <div class="container">
            <!-- Banner -->
            <div class="mb-5">
                <div class="row">
                    @php
                        $advertisements = advertisements();
                    @endphp
                    @if(count($advertisements) > 0)
                        @foreach($advertisements as $advertisement)
                            <div class="col-md-6 mb-4 mb-xl-0 col-xl-4">
                                <a href="{{$advertisement->link ? $advertisement->link : '#'}}" class="d-black text-gray-90">
                                    <div class="min-height-132 py-1 d-flex bg-gray-1 align-items-center">
                                        <div class="col-6 col-xl-5 col-wd-6 pr-0">
                                            @if($advertisement->image)
                                                <img class="img-fluid" src="{{url($advertisement->image)}}" alt="Image Description">
                                            @else
                                                <img class="img-fluid" src="{{asset('frontend-shop/assets/img/190X150/img1.png')}}" alt="Image Description">
                                            @endif
                                        </div>
                                        <div class="col-6 col-xl-7 col-wd-6">
                                            <div class="mb-2 pb-1 font-size-18 font-weight-light text-ls-n1 text-lh-23">
                                                {{$advertisement->title}}
                                            </div>
                                            <div class="link text-gray-90 font-weight-bold font-size-15" href="#">
                                                Shop now
                                                <span class="link__icon ml-1">
                                                        <span class="link__icon-inner"><i class="ec ec-arrow-right-categproes"></i></span>
                                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- End Banner -->
        </div>
        <!-- Products-4-1-4 -->

            <!-- Features Section -->
            <div class="container space-2 d-none">
                <!-- Nav Classic -->
                <div class="position-relative text-center z-index-2 mb-3">
                    <ul class="nav nav-classic nav-tab nav-tab-sm px-md-3 justify-content-start justify-content-lg-center flex-nowrap flex-lg-wrap overflow-auto overflow-lg-visble border-md-down-bottom-0 pb-1 pb-lg-0 mb-n1 mb-lg-0" id="pills-tab-2" role="tablist">
                        <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                            <a class="nav-link active " id="Gpills-one-example1-tab" data-toggle="pill" href="#Gpills-one-example1" role="tab" aria-controls="Gpills-one-example1" aria-selected="true">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    Best Deals
                                </div>
                            </a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                            <a class="nav-link " id="Gpills-two-example1-tab" data-toggle="pill" href="#Gpills-two-example1" role="tab" aria-controls="Gpills-two-example1" aria-selected="false">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    TV & Video
                                </div>
                            </a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                            <a class="nav-link " id="Gpills-three-example1-tab" data-toggle="pill" href="#Gpills-three-example1" role="tab" aria-controls="Gpills-three-example1" aria-selected="false">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    Cameras
                                </div>
                            </a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                            <a class="nav-link " id="Gpills-four-example1-tab" data-toggle="pill" href="#Gpills-four-example1" role="tab" aria-controls="Gpills-four-example1" aria-selected="false">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    Audio
                                </div>
                            </a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                            <a class="nav-link " id="Gpills-five-example1-tab" data-toggle="pill" href="#Gpills-five-example1" role="tab" aria-controls="Gpills-five-example1" aria-selected="false">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    Smartphones
                                </div>
                            </a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                            <a class="nav-link " id="Gpills-six-example1-tab" data-toggle="pill" href="#Gpills-six-example1" role="tab" aria-controls="Gpills-six-example1" aria-selected="false">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    GPS & Navi
                                </div>
                            </a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                            <a class="nav-link " id="Gpills-seven-example1-tab" data-toggle="pill" href="#Gpills-seven-example1" role="tab" aria-controls="Gpills-seven-example1" aria-selected="false">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    Computers
                                </div>
                            </a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                            <a class="nav-link " id="Gpills-eight-example1-tab" data-toggle="pill" href="#Gpills-eight-example1" role="tab" aria-controls="Gpills-eight-example1" aria-selected="false">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    Portable Audio
                                </div>
                            </a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-lg-shrink-1">
                            <a class="nav-link " id="Gpills-nine-example1-tab" data-toggle="pill" href="#Gpills-nine-example1" role="tab" aria-controls="Gpills-nine-example1" aria-selected="false">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    Accessories
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Nav Classic -->

                <!-- Tab Content -->
                <div class="tab-content" id="Gpills-tabContent">
                    <div class="tab-pane fade pt-2 show active" id="Gpills-one-example1" role="tabpanel" aria-labelledby="Gpills-one-example1-tab">
                        <div class="row no-gutters">
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-wd-4 products-group-1">
                                <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                    <li class="col product-item remove-divider">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="d-flex flex-column">
                                                    <div class="mb-1">
                                                        <div class="mb-2">
                                                            <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                            <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-450"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <!-- Gallery -->
                                                        <div class="row mx-gutters-2">
                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>
                                                            <div class="col"></div>
                                                        </div>
                                                        <!-- End Gallery -->
                                                    </div>
                                                    <div class="flex-center-between">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                        <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade pt-2" id="Gpills-two-example1" role="tabpanel" aria-labelledby="Gpills-two-example1-tab">
                        <div class="row no-gutters">
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-wd-4 products-group-1">
                                <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                    <li class="col product-item remove-divider">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="d-flex flex-column">
                                                    <div class="mb-1">
                                                        <div class="mb-2">
                                                            <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                            <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-450"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <!-- Gallery -->
                                                        <div class="row mx-gutters-2">
                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>
                                                            <div class="col"></div>
                                                        </div>
                                                        <!-- End Gallery -->
                                                    </div>
                                                    <div class="flex-center-between">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                        <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade pt-2" id="Gpills-three-example1" role="tabpanel" aria-labelledby="Gpills-three-example1-tab">
                        <div class="row no-gutters">
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-wd-4 products-group-1">
                                <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                    <li class="col product-item remove-divider">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="d-flex flex-column">
                                                    <div class="mb-1">
                                                        <div class="mb-2">
                                                            <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                            <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-450"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <!-- Gallery -->
                                                        <div class="row mx-gutters-2">
                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>
                                                            <div class="col"></div>
                                                        </div>
                                                        <!-- End Gallery -->
                                                    </div>
                                                    <div class="flex-center-between">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                        <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade pt-2" id="Gpills-four-example1" role="tabpanel" aria-labelledby="Gpills-four-example1-tab">
                        <div class="row no-gutters">
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-wd-4 products-group-1">
                                <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                    <li class="col product-item remove-divider">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="d-flex flex-column">
                                                    <div class="mb-1">
                                                        <div class="mb-2">
                                                            <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                            <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-450"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <!-- Gallery -->
                                                        <div class="row mx-gutters-2">
                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>
                                                            <div class="col"></div>
                                                        </div>
                                                        <!-- End Gallery -->
                                                    </div>
                                                    <div class="flex-center-between">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                        <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade pt-2" id="Gpills-five-example1" role="tabpanel" aria-labelledby="Gpills-five-example1-tab">
                        <div class="row no-gutters">
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-wd-4 products-group-1">
                                <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                    <li class="col product-item remove-divider">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="d-flex flex-column">
                                                    <div class="mb-1">
                                                        <div class="mb-2">
                                                            <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                            <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-450"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <!-- Gallery -->
                                                        <div class="row mx-gutters-2">
                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>
                                                            <div class="col"></div>
                                                        </div>
                                                        <!-- End Gallery -->
                                                    </div>
                                                    <div class="flex-center-between">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                        <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade pt-2" id="Gpills-six-example1" role="tabpanel" aria-labelledby="Gpills-six-example1-tab">
                        <div class="row no-gutters">
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-wd-4 products-group-1">
                                <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                    <li class="col product-item remove-divider">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="d-flex flex-column">
                                                    <div class="mb-1">
                                                        <div class="mb-2">
                                                            <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                            <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-450"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <!-- Gallery -->
                                                        <div class="row mx-gutters-2">
                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>
                                                            <div class="col"></div>
                                                        </div>
                                                        <!-- End Gallery -->
                                                    </div>
                                                    <div class="flex-center-between">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                        <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade pt-2" id="Gpills-seven-example1" role="tabpanel" aria-labelledby="Gpills-seven-example1-tab">
                        <div class="row no-gutters">
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-wd-4 products-group-1">
                                <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                    <li class="col product-item remove-divider">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="d-flex flex-column">
                                                    <div class="mb-1">
                                                        <div class="mb-2">
                                                            <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                            <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-450"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <!-- Gallery -->
                                                        <div class="row mx-gutters-2">
                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>
                                                            <div class="col"></div>
                                                        </div>
                                                        <!-- End Gallery -->
                                                    </div>
                                                    <div class="flex-center-between">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                        <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade pt-2" id="Gpills-eight-example1" role="tabpanel" aria-labelledby="Gpills-eight-example1-tab">
                        <div class="row no-gutters">
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-wd-4 products-group-1">
                                <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                    <li class="col product-item remove-divider">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="d-flex flex-column">
                                                    <div class="mb-1">
                                                        <div class="mb-2">
                                                            <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                            <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-450"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <!-- Gallery -->
                                                        <div class="row mx-gutters-2">
                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>
                                                            <div class="col"></div>
                                                        </div>
                                                        <!-- End Gallery -->
                                                    </div>
                                                    <div class="flex-center-between">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                        <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade pt-2" id="Gpills-nine-example1" role="tabpanel" aria-labelledby="Gpills-nine-example1-tab">
                        <div class="row no-gutters">
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-wd-4 products-group-1">
                                <ul class="row list-unstyled products-group no-gutters bg-white h-100 mb-0">
                                    <li class="col product-item remove-divider">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="d-flex flex-column">
                                                    <div class="mb-1">
                                                        <div class="mb-2">
                                                            <div class="bg-gray-1 bg-animation rounded height-10 w-40"></div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="bg-gray-1 bg-animation rounded height-12 mb-1 w-90"></div>
                                                            <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-450"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <!-- Gallery -->
                                                        <div class="row mx-gutters-2">
                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="bg-gray-1 width-60 height-60"></div>
                                                            </div>
                                                            <div class="col"></div>
                                                        </div>
                                                        <!-- End Gallery -->
                                                    </div>
                                                    <div class="flex-center-between">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-40"></div>
                                                        <div class="bg-gray-1 height-35 width-134 rounded-pill"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-wd-4 d-md-flex d-wd-block">
                                <ul class="row list-unstyled products-group no-gutters mb-0 w-100">
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xl-12 col-wd-6 d-md-none d-wd-block">
                                        <div class="h-100 w-100 prodcut-box-shadow">
                                            <div class="bg-white p-3">
                                                <div class="pb-xl-2">
                                                    <div class="mb-2">
                                                        <div class="bg-gray-1 bg-animation rounded height-10 w-60"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="bg-gray-1 bg-animation rounded height-12 mb-1"></div>
                                                        <div class="bg-gray-1 bg-animation rounded height-12 w-80"></div>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="bg-gray-1 height-190"></div>
                                                    </div>
                                                    <div class="flex-center-between mb-1">
                                                        <div class="bg-gray-1 bg-animation rounded height-20 w-60"></div>
                                                        <div class="bg-gray-1 height-35 width-35 rounded-circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Tab Content -->
            </div>
            <!-- End Features Section -->



        </div>


        <!-- End Products-4-1-4 -->
        <div class="container">


            <!-- Full banner -->
{{--            <div class="mb-8">--}}
{{--                <a href="http://localhost/electro_download_file/electro-main/2.0/html/shop/shop.html" class="d-block text-gray-90">--}}
{{--                    <div class="bg-img-hero pt-3" style="background-image: url(../../frontend-shop/assets/img/1100X200/img1.gif);">--}}
{{--                        <div class="space-top-2-md p-4 pt-4 pt-md-5 pt-lg-6 pt-xl-5 pb-lg-4 px-xl-14 px-lg-6">--}}
{{--                            <div class="flex-horizontal-center overflow-auto overflow-md-visble">--}}
{{--                                <h1 class="text-lh-38 font-size-30 font-weight-light mb-0 flex-shrink-0 flex-md-shrink-1">&nbsp</h1>--}}
{{--                                <div class="flex-content-center ml-4 flex-shrink-0">--}}
                                    {{--                                <div class="bg-primary rounded-lg px-6 py-2">--}}
                                    {{--                                    <em class="font-size-14 font-weight-light">STARTING AT</em>--}}
                                    {{--                                    <div class="font-size-30 font-weight-bold text-lh-1">--}}
                                    {{--                                        <sup class="">$</sup>79<sup class="">99</sup>--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
            <!-- End Full banner -->



            <!-- Brand -->
            <div class="mb-6 bg-gray-7 py-6">
                <div class="container">
                    <div class=" d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-5">
                        <h3 class="section-title mb-0 pb-2 font-size-22">Brand</h3>
                    </div>
                    <div class="row flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">

                        @if(count(homeBrands()) > 0)
                            @foreach(homeBrands() as $brand)
                            <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                                <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                                    <a href="#" class="d-block pr-2 pr-wd-6">
                                        <div class="media align-items-center">
                                            <div class="pt-2">
                                                @if($brand->logo)
                                                    <img class="img-fluid" src="{{url($brand->logo)}}" alt="Image Brand">
                                                @else
                                                    <img class="img-fluid" src="{{asset('frontend-shop/assets/img/190X150/img1.png')}}" alt="Image Brand">
                                                @endif
                                            </div>
                                            <div class="ml-3 media-body">
                                                <h6 class="mb-0 text-gray-90"><a href="{{route('brand.wise.products',$brand->slug)}}">{{$brand->name}}</a></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <!-- End Brand -->

            <!-- Top Categories this Week -->
            <div class="mb-6 bg-gray-7 py-6">
                <div class="container">
                    <div class=" d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-5">
                        <h3 class="section-title mb-0 pb-2 font-size-22">Shop</h3>
                    </div>
                    <div class="row flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">

                        @if(count(homeShops()) > 0)
                            @foreach(homeShops() as $shop)
                                <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                                    <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                                        <a href="{{route('shop.details',$shop->slug)}}" class="d-block pr-2 pr-wd-6">
                                            <div class="media align-items-center">
                                                <div class="pt-2">
                                                    @if($shop->logo)
                                                        <img class="img-fluid" src="{{url($shop->logo)}}" alt="Image Description">
                                                    @else
                                                        <img class="img-fluid" src="{{asset('frontend-shop/assets/img/190X150/img1.png')}}" alt="Image Description">
                                                    @endif
                                                </div>
                                                <div class="ml-3 media-body">
                                                    <h6 class="mb-0 text-gray-90">{{$shop->name}}</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <!-- End Top Categories this Week -->

            <!-- Deals of The Day -->
{{--            @php--}}
{{--                $todayFlashDealProducts = todayFlashDealProducts();--}}
{{--                $todayFlashDeal = $todayFlashDealProducts['flashDeal'];--}}
{{--                //dd($todayFlashDeal);--}}
{{--            @endphp--}}

{{--            @if(!empty($todayFlashDeal))--}}
{{--            <div class="mb-3">--}}
{{--                <div class="d-flex border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-sm-bottom-0 mb-2 mb-md-0">--}}
{{--                    <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">{{$todayFlashDeal['title']}}</h3>--}}
{{--                    <div class="js-countdown ml-md-5 mt-md-n1 border-top border-color-1 border-md-top-0 w-100 w-md-auto pt-2 pt-md-0 mb-2 mb-md-0"--}}
{{--                         data-end-date="{{date('Y/m/d', $todayFlashDeal['end_date_time'])}}"--}}
{{--                         data-hours-format="%H"--}}
{{--                         data-minutes-format="%M"--}}
{{--                         data-seconds-format="%S">--}}
{{--                        <div class="flex-horizontal-center d-inline-flex bg-primary py-2 align-self-start height-33 px-5 rounded-pill text-gray-2 font-size-15 font-weight-bold text-lh-1">--}}
{{--                            <h5 class="font-size-15 mb-0 font-weight-bold text-lh-1 mr-1">Ends in:</h5>--}}
{{--                            <div class="px-1">--}}
{{--                                <span class="js-cd-hours"></span>--}}
{{--                            </div>--}}
{{--                            <div class="">:</div>--}}
{{--                            <div class="px-1">--}}
{{--                                <span class="js-cd-minutes"></span>--}}
{{--                            </div>--}}
{{--                            <div class="">:</div>--}}
{{--                            <div class="px-1">--}}
{{--                                <span class="js-cd-seconds"></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <a class="ml-md-auto d-block text-gray-16 align-self-center" href="http://localhost/electro_download_file/electro-main/2.0/html/shop/product-categories-7-column-full-width.html">Go to Daily Deals Section <i class="ec ec-arrow-right-categproes"></i></a>--}}
{{--                </div>--}}
{{--                <div class="js-slick-carousel u-slick overflow-hidden u-slick-overflow-visble pt-3 pb-6 px-1"--}}
{{--                     data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4"--}}
{{--                     data-slides-show="7"--}}
{{--                     data-slides-scroll="1"--}}
{{--                     data-responsive='[{--}}
{{--                          "breakpoint": 1400,--}}
{{--                          "settings": {--}}
{{--                            "slidesToShow": 5--}}
{{--                          }--}}
{{--                        }, {--}}
{{--                            "breakpoint": 1200,--}}
{{--                            "settings": {--}}
{{--                              "slidesToShow": 4--}}
{{--                            }--}}
{{--                        }, {--}}
{{--                          "breakpoint": 992,--}}
{{--                          "settings": {--}}
{{--                            "slidesToShow": 4--}}
{{--                          }--}}
{{--                        }, {--}}
{{--                          "breakpoint": 768,--}}
{{--                          "settings": {--}}
{{--                            "slidesToShow": 3--}}
{{--                          }--}}
{{--                        }, {--}}
{{--                          "breakpoint": 554,--}}
{{--                          "settings": {--}}
{{--                            "slidesToShow": 2--}}
{{--                          }--}}
{{--                        }]'>--}}

{{--                    @php--}}
{{--                        $todayFlashDealProducts = $todayFlashDealProducts['flashDealProducts'];--}}
{{--                        //dd($todayFlashDeal);--}}
{{--                    @endphp--}}

{{--                    @if($todayFlashDealProducts != NULL)--}}
{{--                        @foreach($todayFlashDealProducts as $todayFlashDealProduct)--}}
{{--                            <div class="js-slide products-group">--}}
{{--                                <div class="product-item">--}}
{{--                                    <div class="product-item__outer h-100">--}}
{{--                                        <div class="product-item__inner px-wd-4 p-2 p-md-3">--}}
{{--                                            <div class="product-item__body pb-xl-2">--}}
{{--        --}}{{--                                        <div class="mb-2"><a href="http://localhost/electro_download_file/electro-main/2.0/html/shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>--}}
{{--                                                <h5 class="mb-1 product-item__title"><a href="{{route('product-details',$todayFlashDealProduct['slug'])}}" class="text-blue font-weight-bold">{{$todayFlashDealProduct['name']}}</a></h5>--}}
{{--                                                <div class="mb-2">--}}
{{--                                                    <a href="{{route('product-details',$todayFlashDealProduct['slug'])}}" class="d-block text-center">--}}
{{--                                                        <img class="img-fluid" src="{{url($todayFlashDealProduct['thumbnail_img'])}}" alt="Image Description">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="flex-center-between mb-1">--}}
{{--                                                    <div class="prodcut-price">--}}
{{--                                                        @php--}}
{{--                                                            $product_id = $todayFlashDealProduct['product_id'];--}}
{{--                                                            $productPrice = productPrice($product_id);--}}
{{--                                                        @endphp--}}
{{--                                                        <div class="text-gray-100">--}}
{{--                                                            ৳{{$productPrice['discount_price'] ? $productPrice['discount_price'] : $productPrice['unit_price']}}--}}
{{--                                                        </div>--}}
{{--                                                        @if($productPrice['discount_price'])--}}
{{--                                                            <del class="font-size-20 ml-2 text-gray-6">৳{{$productPrice['unit_price']}}</del>--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                    <div class="d-none d-xl-block prodcut-add-cart">--}}
{{--                                                        <a href="{{route('product-details',$todayFlashDealProduct['slug'])}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="product-item__footer">--}}
{{--                                                <div class="border-top pt-2 flex-center-between flex-wrap">--}}
{{--                                                    <a href="http://localhost/electro_download_file/electro-main/2.0/html/shop/compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
{{--                                                    <a href="{{route('add.wishlist',$product_id)}}" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}

{{--                </div>--}}
{{--            </div>--}}
{{--            @endif--}}
            <!-- End Deals of The Day -->

            <!-- Recently viewed -->

                @if(count(homeCategories()) > 0)
                    @foreach(homeCategories() as $category)
                        @php
                        $products = \Illuminate\Support\Facades\DB::table('products')
                                        ->where('category_id',$category->id)
                                        ->get();
                        @endphp
                        <div class="mb-6">
                            <div class="position-relative">
                                <div class="border-bottom border-color-1 mb-2">
                                    <h3 class="section-title mb-0 pb-2 font-size-22">{{$category->name}}</h3>
                                </div>
                                <div class="js-slick-carousel u-slick position-static overflow-hidden u-slick-overflow-visble pb-7 pt-2 px-1"
                                     data-pagi-classes="text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-3 mt-md-0"
                                     data-slides-show="7"
                                     data-slides-scroll="1"
                                     data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                                     data-arrow-left-classes="fa fa-angle-left right-1"
                                     data-arrow-right-classes="fa fa-angle-right right-0"
                                     data-responsive='[{
                                          "breakpoint": 1400,
                                          "settings": {
                                            "slidesToShow": 6
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


                                        @if(count($products) > 0)
                                            @foreach($products as $product)

                                                <div class="js-slide products-group">
                                                    <div class="product-item">
                                                        <div class="product-item__outer h-100">
                                                            <div class="product-item__inner px-wd-4 p-2 p-md-3">
                                                                <div class="product-item__body pb-xl-2">
            {{--                                                        <div class="mb-2"><a href="http://localhost/electro_download_file/electro-main/2.0/html/shop/product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>--}}
                                                                    <h5 class="mb-1 product-item__title"><a href="{{route('product-details',$product->slug)}}" class="text-blue font-weight-bold">{{$product->name}}</a></h5>
                                                                    <div class="mb-2">
                                                                        <a href="{{route('product-details',$product->slug)}}" class="d-block text-center">
                                                                            <img class="img-fluid" src="{{url($product->thumbnail_img)}}" alt="Image Description">
                                                                        </a>
                                                                    </div>
                                                                    @php
                                                                        $productPrice = productPrice($product->id);
                                                                    @endphp
                                                                    <div class="flex-center-between mb-1">
                                                                        <div class="prodcut-price">
                                                                            <div class="text-gray-100">
                                                                                ৳{{$productPrice['discount_price'] ? $productPrice['discount_price'] : $productPrice['unit_price']}}
                                                                            </div>
                                                                            @if($productPrice['discount_price'])
                                                                                <del class="font-size-20 ml-2 text-gray-6">৳{{$productPrice['unit_price']}}</del>
                                                                            @endif
                                                                        </div>
                                                                        <div class="d-none d-xl-block prodcut-add-cart">
                                                                            <a href="{{route('product-details',$product->slug)}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="product-item__footer">
                                                                    <div class="border-top pt-2 flex-center-between flex-wrap">
{{--                                                                        <a href="#" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
                                                                        <span>Review ({{productReviewCount($product->id)}})</span>
                                                                        <a href="{{route('add.wishlist',$product->id)}}" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
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
                        </div>
                        @endforeach
                @endif
            <!-- End Recently viewed -->

        </div>
    </main>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script !src = "">
        jQuery(document).ready(function($) {
            var product = new Bloodhound({
                remote: {
                    url: '/search/product?q=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('searchName'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $("#searchproduct-item").typeahead({
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
