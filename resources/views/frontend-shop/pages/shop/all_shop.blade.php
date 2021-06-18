@extends('frontend-shop.layouts.master')
@section('title','Shop Lists')
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
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="https://transvelo.github.io/electro-html/2.0/html/home/index.html">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">All Shop List</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="mb-6">
                <div class="d-flex justify-content-between align-items-center border-bottom border-color-1 flex-lg-nowrap flex-wrap mb-4">
                    <h3 class="section-title section-title__full mb-0 pb-2 font-size-22">Shop List</h3>
                </div>
                <ul class="row list-unstyled products-group no-gutters mb-6">
                    @foreach($shops as $shop)
                    <li class="col-6 col-md-2 product-item">
                        <div class="product-item__outer h-100 w-100">
                            <div class="product-item__inner px-xl-4 p-3">
                                <div class="product-item__body pb-xl-2">
                                    <div class="mb-2">
                                        <a href="{{route('shop.details',$shop->slug)}}" class="d-block text-center"><img class="img-fluid" src="{{url($shop->logo)}}" alt="Image Description"></a>
                                    </div>
                                    <h5 class="text-center mb-1 product-item__title"><a href="{{route('shop.details',$shop->slug)}}" class="font-size-15 text-gray-90">{{$shop->name}}</a></h5>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
        </div>
    </main>
@endsection
@push('js')
    <script>

    </script>
@endpush
