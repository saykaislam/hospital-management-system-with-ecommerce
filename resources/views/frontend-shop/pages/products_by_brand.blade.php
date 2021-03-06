@extends('frontend-shop.layouts.master')
@section('title', $brand->name)
@push('css')
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/css/style.css')}}">
@endpush
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
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('shop')}}">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Brand</li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{$brand->name}}</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="mb-8">
                <!-- Shop-control-bar Title -->
                <div class="flex-center-between mb-3">
                    <h3 class="font-size-25 mb-0">Products</h3>
                </div>
                <!-- End shop-control-bar Title -->

                <!-- Tab Content -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                        <ul class="row list-unstyled products-group no-gutters">
                            @foreach($products as $product)
                                @php
                                $shop = \App\Shop::where('user_id',$product->user_id)->first();
                                @endphp
                            <li class="col-6 col-md-3 col-xl-2 product-item">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner px-xl-4 p-3">
                                        <div class="product-item__body pb-xl-2">
                                            <div class="mb-2"><a href="{{route('shop.details',$shop->slug)}}" class="font-size-12 text-gray-5">{{$shop->name}}</a></div>
                                            <h5 class="mb-1 product-item__title"><a href="{{route('product-details',$product->slug)}}" class="text-blue font-weight-bold">{{$product->name}}</a></h5>
                                            <div class="mb-2">
                                                <a href="{{route('product-details',$product->slug)}}" class="d-block text-center"><img class="img-fluid" src="{{url($product->thumbnail_img)}}" alt=""></a>
                                            </div>
                                            @php
                                                $productPrice = productPrice($product->id);
                                            @endphp
                                            <div class="flex-center-between mb-1">
                                                <div class="prodcut-price">
                                                    <div class="text-gray-100">???{{$productPrice['discount_price'] ? $productPrice['discount_price'] : $productPrice['unit_price']}}</div>
                                                    @if($productPrice['discount_price'])
                                                        <del><span class="amount">???{{$productPrice['unit_price']}}</span></del>
                                                    @endif
                                                </div>
                                                <div class="d-none d-xl-block prodcut-add-cart">
                                                    <a href="{{route('product-details',$product->slug)}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="{{route('add.wishlist',$product->id)}}" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                <!-- End Tab Content -->
                <!-- End Shop Body -->
                <!-- Shop Pagination -->
{{--                <nav class="d-md-flex justify-content-between align-items-center border-top pt-3" aria-label="Page navigation example">--}}
{{--                    <div class="text-center text-md-left mb-3 mb-md-0">Showing 1???25 of 56 results</div>--}}
{{--                    <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">--}}
{{--                        <li class="page-item"><a class="page-link current" href="#">1</a></li>--}}
{{--                        <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                        <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                    </ul>--}}
{{--                </nav>--}}
                <!-- End Shop Pagination -->
            </div>

        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection
