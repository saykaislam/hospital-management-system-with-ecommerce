@extends('frontend-shop.layouts.master')
@section('title','Shop Details')
@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="\shop">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="#">{{$productCategory}}</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="#">{{$productSubCategory}}</a></li>
                            @if($productSubSubCategory != '')
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="#">{{$productSubSubCategory}}</a></li>
                            @endif
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{$productDetails->name}}</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->
        <div class="container">
            <!-- Single Product Body -->
            <div class="mb-xl-14 mb-6">
                <div class="row">
                    @php
                        $photos = productPhotosInfo($productDetails->id);
                    @endphp
                    <div class="col-md-5 mb-4 mb-md-0">
{{--                        <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2"--}}
{{--                             data-infinite="true"--}}
{{--                             data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"--}}
{{--                             data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"--}}
{{--                             data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"--}}
{{--                             data-nav-for="#sliderSyncingThumb">--}}
{{--                            @if(count($photos) > 0)--}}
{{--                                @foreach($photos as $photo)--}}
{{--                                    <div class="js-slide">--}}
{{--                                        <img class="img-fluid" src="{{url($photo)}}" alt="Image Description">--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                        </div>--}}

{{--                        <div id="sliderSyncingThumb" class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"--}}
{{--                             data-infinite="true"--}}
{{--                             data-slides-show="5"--}}
{{--                             data-is-thumbs="true"--}}
{{--                             data-nav-for="#sliderSyncingNav">--}}
{{--                            @if(count($photos) > 0)--}}
{{--                                @foreach($photos as $photo)--}}
{{--                                    <div class="js-slide" style="cursor: pointer;">--}}
{{--                                        <img class="img-fluid" src="{{url($photo)}}" alt="Image Description">--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                        </div>--}}
                        <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2">
                            <div class="js-slide">
                                <img class="img-fluid" src="{{url($productDetails->thumbnail_img)}}" alt="Image Description">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 mb-md-6 mb-lg-0">
                        <div class="mb-2">
                            <div class="border-bottom mb-3 pb-md-1 pb-3">
                                <a href="#" class="font-size-12 text-gray-5 mb-2 d-inline-block">Brand: {{$productBrand}}</a>
                                <h2 class="font-size-25 text-lh-1dot2">{{$productDetails->name}}</h2>
                                <div class="mb-2">
                                    <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">
                                        {!! productRatingStar($productDetails->rating) !!}
                                        <span class="text-secondary font-size-13">({{productReviewCount($productDetails->id)}} customer reviews)</span>
                                    </a>
                                </div>
                                <div class="d-md-flex align-items-center">
{{--                                    <a href="#" class="max-width-150 ml-n2 mb-2 mb-md-0 d-block"><img class="img-fluid" src="{{asset('frontend-shop/assets/img/190X150/img1.png')}}" alt="Image Description"></a>--}}
                                    <div class="ml-md-3 text-gray-9 font-size-14 aval">Availability: <span class="text-green font-weight-bold">{{$productDetails->current_stock}} in stock</span></div>
                                </div>
                            </div>
                            <div class="flex-horizontal-center flex-wrap mb-4">
                                <a href="#" class="text-gray-6 font-size-13 mr-2"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
{{--                                <a href="#" class="text-gray-6 font-size-13 ml-2"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
                            </div>
{{--                            <div class="mb-2">--}}
{{--                                <ul class="font-size-14 pl-3 ml-1 text-gray-110">--}}
{{--                                    <li>4.5 inch HD Touch Screen (1280 x 720)</li>--}}
{{--                                    <li>Android 4.4 KitKat OS</li>--}}
{{--                                    <li>1.4 GHz Quad Core™ Processor</li>--}}
{{--                                    <li>20 MP Electro and 28 megapixel CMOS rear camera</li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>--}}
{{--                            <p><strong>SKU</strong>: FW511948218</p>--}}
                            @php
                                $productPrice = productPrice($productDetails->id);
                            @endphp
                            <h5>Sold By: <a href="#" class="text-gray-6 font-size-13 ml-2">{{$productDetails->user_id == 1 ? 'In House' : shopName($productDetails->user_id)}}</a></h5>
                            <div class="mb-4">
                                <div class="d-flex align-items-baseline">
                                    <ins class="font-size-36 text-decoration-none">
                                        ৳<span class="price">
                                            {{$productPrice['discount_price'] ? $productPrice['discount_price'] : $productPrice['unit_price']}}
                                        </span>
                                    </ins>
                                    @if($productPrice['discount_price'])
                                        <del class="font-size-20 ml-2 text-gray-6">৳{{$productPrice['unit_price']}}</del>
                                    @endif
                                </div>
                                <input type = "hidden" class="base_price" value="{{$productPrice['discount_price'] ? $productPrice['discount_price'] : $productPrice['unit_price']}}" autocomplete="off">
                                <input type = "hidden" class="base_qty" value="{{$productPrice['current_stock']}}" autocomplete="off">
                            </div>
                            @php
                                $colors = productColorsInfo($productDetails->id);
                            @endphp

                            <form id="option-choice-form">
                                @csrf
                                @if(count($colors) > 0)
                                    <div class="border-top border-bottom py-3 mb-4">
                                        <div class="d-flex align-items-center">
                                            <h6 class="font-size-14 mb-0">Color</h6>
                                            <!-- Select -->
                                            <select class="js-select selectpicker dropdown-select ml-3"
                                                    data-style="btn-sm bg-white font-weight-normal py-2 border" name="color">
        {{--                                        <option value="one" selected>White with Gold</option>--}}

                                                    @foreach($colors as $index=>$col)
                                                        <option value="{{$col->name}}" @if($index == 0) checked @endif >{{$col->name}}</option>
                                                    @endforeach
                                            </select>
                                            <!-- End Select -->
                                        </div>
                                    </div>
                                @endif
                                @php
                                    $attributes = productAttributesInfo($productDetails->id);
                                    $options = productOptionsInfo($productDetails->id);
                                @endphp
                                @if(count($attributes) > 0)
                                    @foreach($attributes as $key=>$attr)
                                        @php
                                            $att=\App\Attribute::find($attr);
                                        @endphp
                                        <div class="border-bottom py-2 mb-4">
                                            <div class="d-flex align-items-center">
                                                <h6 class="font-size-14 mb-0">{{$att->name}}</h6>
                                                <!-- Select -->
                                                <select class="js-select selectpicker dropdown-select ml-3"
                                                        data-style="btn-sm bg-white font-weight-normal py-2 border" name="{{$att->name}}" id="">
                                                    {{--                                        <option value="one" selected>White with Gold</option>--}}

                                                    @foreach($options[$key]->values as $index=>$val)
                                                        <option value="{{$val}}" @if($index == 0) checked @endif >{{$val}}</option>
                                                    @endforeach
                                                </select>
                                                <!-- End Select -->
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="d-md-flex align-items-end mb-3">
                                    <div class="max-width-150 mb-4 mb-md-0">
                                        <h6 class="font-size-14">Quantity</h6>
                                        <!-- Quantity -->
                                        <div class="border rounded-pill py-2 px-3 border-color-1">
                                            <div class="js-quantity row align-items-center">
                                                <div class="col">
                                                    <input class="js-result form-control h-auto border-0 rounded p-0 shadow-none qtty" name="quantity" type="text" value="1">
                                                </div>
                                                <div class="col-auto pr-1">
                                                    <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0 down" href="javascript:;">
                                                        <small class="fas fa-minus btn-icon__inner"></small>
                                                    </a>
                                                    <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0 up" href="javascript:;">
                                                        <small class="fas fa-plus btn-icon__inner"></small>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Quantity -->
                                    </div>
                                    <div class="ml-md-3">
                                        @if($productDetails->current_stock > 0)
                                            <a href="#" class="btn px-5 btn-primary-dark transition-3d-hover" id="add_to_cart"><i class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart</a>
                                        @else
                                            <a href="#" class="btn px-5 btn-primary-dark transition-3d-hover" disabled="disabled"><i class="ec ec-add-to-cart mr-2 font-size-20"></i> Stock Out</a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Product Body -->
            <!-- Single Product Tab -->
            <div class="mb-8">
                <div class="position-relative position-md-static px-md-6">
                    <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
{{--                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">--}}
{{--                            <a class="nav-link active" id="Jpills-one-example1-tab" data-toggle="pill" href="#Jpills-one-example1" role="tab" aria-controls="Jpills-one-example1" aria-selected="true">Accessories</a>--}}
{{--                        </li>--}}
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link active" id="Jpills-two-example1-tab" data-toggle="pill" href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1" aria-selected="false">Description</a>
                        </li>
{{--                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">--}}
{{--                            <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill" href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1" aria-selected="false">Specification</a>--}}
{{--                        </li>--}}
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link" id="Jpills-four-example1-tab" data-toggle="pill" href="#Jpills-four-example1" role="tab" aria-controls="Jpills-four-example1" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                </div>
                <!-- Tab Content -->
                <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                    <div class="tab-content" id="Jpills-tabContent">
{{--                        <div class="tab-pane fade active show" id="Jpills-one-example1" role="tabpanel" aria-labelledby="Jpills-one-example1-tab">--}}
{{--                            <div class="row no-gutters">--}}
{{--                                <div class="col mb-6 mb-md-0">--}}
{{--                                    <ul class="row list-unstyled products-group no-gutters border-bottom border-md-bottom-0">--}}
{{--                                        <li class="col-4 col-md-4 col-xl-2gdot5 product-item remove-divider-sm-down border-0">--}}
{{--                                            <div class="product-item__outer h-100">--}}
{{--                                                <div class="remove-prodcut-hover product-item__inner px-xl-4 p-3">--}}
{{--                                                    <div class="product-item__body pb-xl-2">--}}
{{--                                                        <div class="mb-2 d-none d-md-block"><a href="product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>--}}
{{--                                                        <h5 class="mb-1 product-item__title d-none d-md-block"><a href="#" class="text-blue font-weight-bold">Wireless Audio System Multiroom 360 degree Full base audio</a></h5>--}}
{{--                                                        <div class="mb-2">--}}
{{--                                                            <a href="single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{asset('frontend-shop/assets/img/190X150/img1.png')}}" alt="Image Description"></a>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex-center-between mb-1 d-none d-md-block">--}}
{{--                                                            <div class="prodcut-price">--}}
{{--                                                                <div class="text-gray-100">$685,00</div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li class="col-4 col-md-4 col-xl-2gdot5 product-item remove-divider-sm-down">--}}
{{--                                            <div class="product-item__outer h-100">--}}
{{--                                                <div class="remove-prodcut-hover add-accessories product-item__inner px-xl-4 p-3">--}}
{{--                                                    <div class="product-item__body pb-xl-2">--}}
{{--                                                        <div class="mb-2 d-none d-md-block"><a href="product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>--}}
{{--                                                        <h5 class="mb-1 product-item__title d-none d-md-block"><a href="#" class="text-blue font-weight-bold">Tablet White EliteBook Revolve 810 G2</a></h5>--}}
{{--                                                        <div class="mb-2">--}}
{{--                                                            <a href="single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{asset('frontend-shop/assets/img/190X150/img1.png')}}" alt="Image Description"></a>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex-center-between mb-1 d-none d-md-block">--}}
{{--                                                            <div class="prodcut-price d-flex align-items-center position-relative">--}}
{{--                                                                <ins class="font-size-20 text-red text-decoration-none">$1999,00</ins>--}}
{{--                                                                <del class="font-size-12 tex-gray-6 position-absolute bottom-100">$2 299,00</del>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li class="col-4 col-md-4 col-xl-2gdot5 product-item remove-divider-sm-down remove-divider">--}}
{{--                                            <div class="product-item__outer h-100">--}}
{{--                                                <div class="remove-prodcut-hover add-accessories product-item__inner px-xl-4 p-3">--}}
{{--                                                    <div class="product-item__body pb-xl-2">--}}
{{--                                                        <div class="mb-2 d-none d-md-block"><a href="product-categories-7-column-full-width.html" class="font-size-12 text-gray-5">Speakers</a></div>--}}
{{--                                                        <h5 class="mb-1 product-item__title d-none d-md-block"><a href="#" class="text-blue font-weight-bold">Purple Solo 2 Wireless</a></h5>--}}
{{--                                                        <div class="mb-2">--}}
{{--                                                            <a href="single-product-fullwidth.html" class="d-block text-center"><img class="img-fluid" src="{{asset('frontend-shop/assets/img/190X150/img1.png')}}" alt="Image Description"></a>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex-center-between mb-1 d-none d-md-block">--}}
{{--                                                            <div class="prodcut-price">--}}
{{--                                                                <div class="text-gray-100">$685,00</div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                    <div class="form-check pl-4 pl-md-0 ml-md-4 mb-2 pb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">--}}
{{--                                        <input class="form-check-input" type="checkbox" value="" id="inlineCheckbox1" checked disabled>--}}
{{--                                        <label class="form-check-label mb-1" for="inlineCheckbox1">--}}
{{--                                            <strong>This product: </strong> Ultra Wireless S50 Headphones S50 with Bluetooth - <span class="text-red font-size-16">$35.00</span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-check pl-4 pl-md-0 ml-md-4 mb-2 pb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">--}}
{{--                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option1" checked>--}}
{{--                                        <label class="form-check-label mb-1 text-blue" for="inlineCheckbox2">--}}
{{--                                            <span class="text-decoration-on cursor-pointer-on">Universal Headphones Case in Black</span> - <span class="text-red font-size-16">$159.00</span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-check pl-4 pl-md-0 ml-md-4 mb-2 pb-2 pb-md-0 mb-md-0 border-bottom border-md-bottom-0">--}}
{{--                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option2" checked>--}}
{{--                                        <label class="form-check-label mb-1 text-blue" for="inlineCheckbox3">--}}
{{--                                            <span class="text-decoration-on cursor-pointer-on">Headphones USB Wires</span> - <span class="text-red font-size-16">$50.00</span>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-auto">--}}
{{--                                    <div class="mr-xl-15">--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <div class="text-red font-size-26 text-lh-1dot2">$244.00</div>--}}
{{--                                            <div class="text-gray-6">for 3 item(s)</div>--}}
{{--                                        </div>--}}
{{--                                        <a href="#" class="btn btn-sm btn-block btn-primary-dark btn-wide transition-3d-hover">Add all to cart</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="tab-pane fade active show" id="Jpills-two-example1" role="tabpanel" aria-labelledby="Jpills-two-example1-tab">
                            <p>{!! $productDetails->description !!}</p>
                        </div>
{{--                        <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel" aria-labelledby="Jpills-three-example1-tab">--}}
{{--                            <div class="mx-md-5 pt-1">--}}
{{--                                <div class="table-responsive mb-4">--}}
{{--                                    <table class="table table-hover">--}}
{{--                                        <tbody>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5 border-top-0">Weight</th>--}}
{{--                                            <td class="border-top-0">7.25kg</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Dimensions</th>--}}
{{--                                            <td>90 x 60 x 90 cm</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Size</th>--}}
{{--                                            <td>One Size Fits all</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">color</th>--}}
{{--                                            <td>Black with Red, White with Gold</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Guarantee</th>--}}
{{--                                            <td>5 years</td>--}}
{{--                                        </tr>--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                                <h3 class="font-size-18 mb-4">Technical Specifications</h3>--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table table-hover">--}}
{{--                                        <tbody>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5 border-top-0">Brand</th>--}}
{{--                                            <td class="border-top-0">Apple</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Item Height</th>--}}
{{--                                            <td>18 Millimeters</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Item Width</th>--}}
{{--                                            <td>31.4 Centimeters</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Screen Size</th>--}}
{{--                                            <td>13 Inches</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Item Weight</th>--}}
{{--                                            <td>1.6 Kg</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Product Dimensions</th>--}}
{{--                                            <td>21.9 x 31.4 x 1.8 cm</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Item model number</th>--}}
{{--                                            <td>MF841HN/A</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Processor Brand</th>--}}
{{--                                            <td>Intel</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Processor Type</th>--}}
{{--                                            <td>Core i5</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Processor Speed</th>--}}
{{--                                            <td>2.9 GHz</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">RAM Size</th>--}}
{{--                                            <td>8 GB</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Hard Drive Size</th>--}}
{{--                                            <td>512 GB</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Hard Disk Technology</th>--}}
{{--                                            <td>Solid State Drive</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Graphics Coprocessor</th>--}}
{{--                                            <td>Intel Integrated Graphics</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Graphics Card Description</th>--}}
{{--                                            <td>Integrated Graphics Card</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Hardware Platform</th>--}}
{{--                                            <td>Mac</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Operating System</th>--}}
{{--                                            <td>Mac OS</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th class="px-4 px-xl-5">Average Battery Life (in hours)</th>--}}
{{--                                            <td>9</td>--}}
{{--                                        </tr>--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="tab-pane fade" id="Jpills-four-example1" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                            <div class="row mb-8">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h3 class="font-size-18 mb-6">Based on {{productReviewCount($productDetails->id)}} reviews</h3>
                                        <h2 class="font-size-30 font-weight-bold text-lh-1 mb-0">{{number_format((float)productReviewCount($productDetails->id), 1, '.', '')}}</h2>
                                        <div class="text-lh-1">overall</div>
                                    </div>

                                    <!-- Ratings -->
                                    @php
                                        $productReviewAverageCount = productReviewAverageCount($productDetails->id);
                                    @endphp
                                    <ul class="list-unstyled">
                                        <li class="py-1">
                                            <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                <div class="col-auto mb-2 mb-md-0">
                                                    <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                    </div>
                                                </div>
                                                <div class="col-auto mb-2 mb-md-0">
                                                    <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="{{$productReviewAverageCount['fiveStarRev']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-auto text-right">
                                                    <span class="text-gray-90">{{$productReviewAverageCount['fiveStarRev']}}</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-1">
                                            <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                <div class="col-auto mb-2 mb-md-0">
                                                    <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                    </div>
                                                </div>
                                                <div class="col-auto mb-2 mb-md-0">
                                                    <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 53%;" aria-valuenow="{{$productReviewAverageCount['fourStarRev']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-auto text-right">
                                                    <span class="text-gray-90">{{$productReviewAverageCount['fourStarRev']}}</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-1">
                                            <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                <div class="col-auto mb-2 mb-md-0">
                                                    <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                        <small class="fas fa-star"></small>
                                                        <small class="fas fa-star"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                    </div>
                                                </div>
                                                <div class="col-auto mb-2 mb-md-0">
                                                    <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="{{$productReviewAverageCount['threeStarRev']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-auto text-right">
                                                    <span class="text-gray-90">{{$productReviewAverageCount['threeStarRev']}}</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-1">
                                            <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                <div class="col-auto mb-2 mb-md-0">
                                                    <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                        <small class="fas fa-star"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                    </div>
                                                </div>
                                                <div class="col-auto mb-2 mb-md-0">
                                                    <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="{{$productReviewAverageCount['twoStarRev']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-auto text-right">
                                                    <span class="text-muted">{{$productReviewAverageCount['twoStarRev']}}</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-1">
                                            <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                                                <div class="col-auto mb-2 mb-md-0">
                                                    <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                                        <small class="fas fa-star"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                        <small class="far fa-star text-muted"></small>
                                                    </div>
                                                </div>
                                                <div class="col-auto mb-2 mb-md-0">
                                                    <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 1%;" aria-valuenow="{{$productReviewAverageCount['oneStarRev']}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-auto text-right">
                                                    <span class="text-gray-90">{{$productReviewAverageCount['oneStarRev']}}</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- End Ratings -->
                                </div>
                                <div class="col-md-6">
{{--                                    <h3 class="font-size-18 mb-5">Add a review</h3>--}}
                                    <!-- Form -->
{{--                                    <form class="js-validate">--}}
{{--                                        <div class="row align-items-center mb-4">--}}
{{--                                            <div class="col-md-4 col-lg-3">--}}
{{--                                                <label for="rating" class="form-label mb-0">Your Review</label>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-8 col-lg-9">--}}
{{--                                                <a href="#" class="d-block">--}}
{{--                                                    <div class="text-warning text-ls-n2 font-size-16">--}}
{{--                                                        <small class="far fa-star text-muted"></small>--}}
{{--                                                        <small class="far fa-star text-muted"></small>--}}
{{--                                                        <small class="far fa-star text-muted"></small>--}}
{{--                                                        <small class="far fa-star text-muted"></small>--}}
{{--                                                        <small class="far fa-star text-muted"></small>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="js-form-message form-group mb-3 row">--}}
{{--                                            <div class="col-md-4 col-lg-3">--}}
{{--                                                <label for="descriptionTextarea" class="form-label">Your Review</label>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-8 col-lg-9">--}}
{{--                                                    <textarea class="form-control" rows="3" id="descriptionTextarea"--}}
{{--                                                              data-msg="Please enter your message."--}}
{{--                                                              data-error-class="u-has-error"--}}
{{--                                                              data-success-class="u-has-success"></textarea>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="js-form-message form-group mb-3 row">--}}
{{--                                            <div class="col-md-4 col-lg-3">--}}
{{--                                                <label for="inputName" class="form-label">Name <span class="text-danger">*</span></label>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-8 col-lg-9">--}}
{{--                                                <input type="text" class="form-control" name="name" id="inputName" aria-label="Alex Hecker" required--}}
{{--                                                       data-msg="Please enter your name."--}}
{{--                                                       data-error-class="u-has-error"--}}
{{--                                                       data-success-class="u-has-success">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="js-form-message form-group mb-3 row">--}}
{{--                                            <div class="col-md-4 col-lg-3">--}}
{{--                                                <label for="emailAddress" class="form-label">Email <span class="text-danger">*</span></label>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-8 col-lg-9">--}}
{{--                                                <input type="email" class="form-control" name="emailAddress" id="emailAddress" aria-label="alexhecker@pixeel.com" required--}}
{{--                                                       data-msg="Please enter a valid email address."--}}
{{--                                                       data-error-class="u-has-error"--}}
{{--                                                       data-success-class="u-has-success">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="offset-md-4 offset-lg-3 col-auto">--}}
{{--                                                <button type="submit" class="btn btn-primary-dark btn-wide transition-3d-hover">Add Review</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
                                    <!-- End Form -->

                                    <!-- Review -->
                                    @php
                                        $reviewsComments = productReviewComments($productDetails->id);
                                    @endphp
                                    @forelse($reviewsComments as $reviews)
                                        @php
                                            $userData = App\User::find($reviews->user_id);
                                        @endphp
                                        <div class="border-bottom border-color-1 pb-4 mb-4">
                                            <!-- Review Rating -->
                                            <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
{{--                                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">--}}
{{--                                                    <small class="fas fa-star"></small>--}}
{{--                                                    <small class="fas fa-star"></small>--}}
{{--                                                    <small class="fas fa-star"></small>--}}
{{--                                                    <small class="far fa-star text-muted"></small>--}}
{{--                                                    <small class="far fa-star text-muted"></small>--}}
{{--                                                </div>--}}
                                                {!! productRatingStar($reviews->rating) !!}
                                            </div>
                                            <!-- End Review Rating -->

                                            <p class="text-gray-90">{{$reviews->comment}}</p>

                                            <!-- Reviewer -->
                                            <div class="mb-2">
                                                <strong>{{$userData->name}}</strong>
                                                <span class="font-size-13 text-gray-23">- {{$reviews->updated_at->diffForHumans()}}</span>
                                            </div>
                                            <!-- End Reviewer -->
                                        </div>
                                    @empty
                                        <div>
                                            <h3 class="text-info">No review yet!!</h3>
                                        </div>
                                    @endforelse
                                    <!-- End Review -->

                                </div>
                            </div>

                            <!-- Review -->
{{--                            <div class="border-bottom border-color-1 pb-4 mb-4">--}}
{{--                                <!-- Review Rating -->--}}
{{--                                <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">--}}
{{--                                    <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="fas fa-star"></small>--}}
{{--                                        <small class="far fa-star text-muted"></small>--}}
{{--                                        <small class="far fa-star text-muted"></small>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- End Review Rating -->--}}

{{--                                <p class="text-gray-90">Fusce vitae nibh mi. Integer posuere, libero et ullamcorper facilisis, enim eros tincidunt orci, eget vestibulum sapien nisi ut leo. Cras finibus vel est ut mollis. Donec luctus condimentum ante et euismod.</p>--}}

{{--                                <!-- Reviewer -->--}}
{{--                                <div class="mb-2">--}}
{{--                                    <strong>John Doe</strong>--}}
{{--                                    <span class="font-size-13 text-gray-23">- April 3, 2019</span>--}}
{{--                                </div>--}}
{{--                                <!-- End Reviewer -->--}}
{{--                            </div>--}}
                            <!-- End Review -->

                        </div>
                    </div>
                </div>
                <!-- End Tab Content -->
            </div>
            <!-- End Single Product Tab -->
            <!-- Related products -->
            @php
                $relatedProducts = relatedProducts($productDetails->category_id);
//dd($relatedProducts);
            @endphp

            @if(count($relatedProducts) > 0)
            <div class="mb-6">
                <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                    <h3 class="section-title mb-0 pb-2 font-size-22">Related products</h3>
                </div>
                <ul class="row list-unstyled products-group no-gutters">
                    @foreach($relatedProducts as $relatedProduct)
                    <li class="col-6 col-md-3 col-xl-2gdot4-only col-wd-2 product-item">
                        <div class="product-item__outer h-100">
                            <div class="product-item__inner px-xl-4 p-3">
                                <div class="product-item__body pb-xl-2">
                                    <div class="mb-2">Sold By: <a href="#" class="font-size-12 text-gray-5">{{$relatedProduct->user_id == 1 ? 'In House' : shopName($relatedProduct->user_id)}}</a></div>
                                    <h5 class="mb-1 product-item__title"><a href="{{route('product-details',$relatedProduct->slug)}}" class="text-blue font-weight-bold">{{$relatedProduct->name}}</a></h5>
                                    <div class="mb-2">
                                        <a href="{{route('product-details',$relatedProduct->slug)}}" class="d-block text-center"><img class="img-fluid" src="{{url($relatedProduct->thumbnail_img)}}" alt="Image Description"></a>
                                    </div>
                                    @php
                                        $productPrice = productPrice($relatedProduct->id);
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
                                            <a href="{{route('product-details',$relatedProduct->slug)}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-item__footer">
                                    <div class="border-top pt-2 flex-center-between flex-wrap">
{{--                                        <a href="compare.html" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>--}}
                                        <span>Review ({{productReviewCount($relatedProduct->id)}})</span>
                                        <a href="wishlist.html" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>
            @endif
            <!-- End Related products -->
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection
@push('js')
    <script>
        $('.qtty').val(1);
        $('#option-choice-form select').on('change', function(){
            getVariantPrice($('#option-choice-form').serializeArray());
            console.log($('#option-choice-form').serializeArray());
        });
        $('#add_to_cart').on('click', function(e){
            e.preventDefault();
            //getVariantPrice($('#option-choice-form').serializeArray());
            addtocart($('#option-choice-form').serializeArray());
        });

        $('.up').on('click', function(event){
            event.preventDefault();
            var val=$('.qtty').val();
            var price=$('.price').html();
            var base_price=$('.base_price').val();
            var base_qty=$('.base_qty').val();
            // console.log(typeof base_qty);
            // console.log(typeof val);
            console.log(val);
            if(parseInt(val)<parseInt(base_qty)){
                $('.qtty').val(parseInt(val)+1);
                $('.price').html(parseInt(base_price)*(parseInt(val)+1));
            }

        });
        $('.down').on('click', function(event){
            event.preventDefault();
            var val=$('.qtty').val();
            var price=$('.price').html();
            var base_price=$('.base_price').val();
            if(parseInt(val)>1){
                $('.qtty').val(parseInt(val)-1);
                $('.price').html(parseInt(price)-parseInt(base_price));
            }
        });

        function getVariantPrice(array){
            console.log(array);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('product.variant.price')}}",
                method: "post",
                data:{
                    variant:array,
                },
                success: function(data){
                    console.log(data.response.price)
                    $('.price').html(data.response.price);
                    $('.base_price').val(data.response.price);
                    $('.aval').html(data.response.qty+" available");
                    $('.qtty').val(1);
                    $('.base_qty').val(data.response.qty);
                    //toastr.success('Lab Test added in your cart <span style="font-size: 25px;">&#10084;&#65039;</span>');
                }
            });
        }
        function addtocart(array){
            //console.log(array);
            var price = $('.price').text();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('product.add.cart')}}",
                method: "post",
                data:{
                    variant:array,
                    product_id: "{{$productDetails->id}}",
                    product_name:"{{$productDetails->name}}",
                    //product_price:"{{$productDetails->unit_price}}",
                    product_price:price,
                },
                success: function(data){
                    console.log(data.response)
                    $('.cart_count').html(data.response.countCart);
                    $('.cart_item').append(`<li class="border-bottom pb-3 mb-3">
                                                    <div class="">
                                                        <ul class="list-unstyled row mx-n2">
                                                            <li class="px-2 col-auto">
                                                                <img class="img-fluid" src="/${data.response['options'].image}" height="100px" width="100px" alt="Image Description">
                                                            </li>
                                                            <li class="px-2 col">
                                                                <h5 class="text-blue font-size-14 font-weight-bold">${data.response.name}</h5>
                                                                <span class="font-size-14">${data.response.qty} × ৳${data.response.price}</span>
                                                            </li>
                                                            <li class="px-2 col-auto">
                                                                <a href="/${data.response.rowId}" class="text-gray-90"><i class="ec ec-close-remove"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>`);
                    $('.subTotal').html(data.response.subtotal);
                    // $('.base_price').val(data.response.price);
                    // $('.aval').html(data.response.qty+" available");
                    // $('.qtty').val(1);
                    // $('.base_qty').val(data.response.qty);
                    //toastr.success('Lab Test added in your cart <span style="font-size: 25px;">&#10084;&#65039;</span>');
                }
            });
        }

    </script>
@endpush
