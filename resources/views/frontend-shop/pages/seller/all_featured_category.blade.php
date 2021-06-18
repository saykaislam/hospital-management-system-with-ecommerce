@extends('frontend-shop.layouts.master')
@section('title','Featured Categories')
@push('css')

    <link rel="stylesheet" href="{{asset('frontend-shop/assets/css/style.css')}}">
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
  $shop_id = $shop->id;
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
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Featured Categories</li>
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
                    @php
                        $shopCats = shopCategory($shop_id)
                    @endphp
                    <div class="woocommerce columns-4">
                        <ul class="product-loop-categories">
                            @foreach($shopCats as $shopCat)
                                <li class="product-category product">
                                    <a href="{{url('/shop/'.$shop->slug.'/'.$cat->category->slug)}}">
                                        <img src="{{asset('uploads/categories/'.$shopCat->category->icon)}}" class="img-responsive" alt="">
                                        <h3>{{$shopCat->category->name}}</h3>
                                    </a>

                                </li><!-- /.item -->
                            @endforeach
                        </ul>
                    </div>


                </div>

            </div>

        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection
@push('js')
    <script>

    </script>
@endpush
