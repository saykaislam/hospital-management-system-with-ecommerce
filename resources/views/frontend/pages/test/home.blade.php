@extends('frontend.layouts.master')
@section('title', 'Lab-Test')
@push('css')
    <style>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    </style>
@endpush
@section('content')
    <div class="content pt-0">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('frontend/img/slider/labslide1.jpg')}}" alt="First slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="row align-items-center pb-3">
                        <div class="col-md-4 col-12 d-md-block d-none custom-short-by">
                            <h3 class="title pharmacy-title">Lab Test</h3>
                            {{--                            <p class="doc-location mb-2 text-ellipse pharmacy-location"><i class="fas fa-map-marker-alt mr-1"></i> 96 Red Hawk Road Cyrus, MN 56323 </p>--}}
                            {{--                            <span class="sort-title">Showing 6 of 98 products</span>--}}
                        </div>
                        {{--                        <div class="col-md-8 col-12 d-md-block d-none custom-short-by">--}}
                        {{--                            <div class="sort-by pb-3">--}}
                        {{--                                <span class="sort-title">Sort by</span>--}}
                        {{--                                <span class="sortby-fliter">--}}
                        {{--											<select class="select">--}}
                        {{--												<option>Select</option>--}}
                        {{--												<option class="sorting">Rating</option>--}}
                        {{--												<option class="sorting">Popular</option>--}}
                        {{--												<option class="sorting">Latest</option>--}}
                        {{--												<option class="sorting">Free</option>--}}
                        {{--											</select>--}}
                        {{--										</span>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>

                    <div class="row">
{{--                        <div class="form-group">--}}
{{--                            <select class="form-control js-example-responsive test_class" style="width: 100%" id="exampleFormControlSelect1" placeholder="Type test names" name="test_name" required>--}}
{{--                            <option value="">Select test name from option to search </option>--}}
{{--                            <option class="" value="q">ksd askl akl lkas</option>--}}
{{--                        </select>--}}
{{--                        </div>--}}

                        @foreach($tests as $product )
                            <div class="col-6 col-md-2 col-lg-2 col-xl-2 product-custom">
                                <div class="profile-widget">
                                    <div class="doc-img">
                                        <a href="{{route('test.lab',$product->slug)}}" tabindex="-1">
                                            @if(!empty($product->image))
                                                <img class="img-fluid" alt="test image1" src="{{asset('uploads/test/'.$product->image)}}">
                                            @else
                                                <img class="img-fluid" alt="test image" src="https://images.medicinenet.com/images/article/main_image/sedimentation-rate.jpg">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="pro-content">
                                        <h3 class="title pb-4">
                                            <a href="{{route('test.lab',$product->slug)}}" tabindex="-1">{{$product->name}}</a>
                                        </h3>
                                        <div class="row align-items-center">
                                            <div class="col-lg-12">
                                                <span class="price">TK{{$product->price}}</span>
                                                <span class="price-strike">TK{{$product->regular_price}}</span>
                                            </div>
                                            {{--                                            <div class="col-lg-6 text-right">--}}
                                            {{--                                                <a href="#" class="cart-icon addToCart" id="{{$product->id}}"><i class="fas fa-shopping-cart"></i></a>--}}
                                            {{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{$tests->links()}}

                        {{--                    <div class="col-md-12 text-center">--}}
                        {{--                        <a href="#" class="btn book-btn1 mb-4">Load More</a>--}}
                        {{--                    </div>--}}
                    </div>
                </div>
            </div>
        </div>
        @stop
        @push('js')
            <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('.js-example-responsive').select2({
                        width: 'resolve' // need to override the changed default
                    });
                });
                {{--$(".addToCart").click(function (e) {--}}
                {{--    e.preventDefault();--}}
                {{--    $.ajaxSetup({--}}
                {{--        headers: {--}}
                {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                {{--        }--}}
                {{--    });--}}
                {{--    $.ajax({--}}
                {{--        url: "{{route('product.cart.add')}}",--}}
                {{--        method: "post",--}}
                {{--        data:{--}}
                {{--            productId:this.id,--}}
                {{--        },--}}
                {{--        success: function(data){--}}
                {{--            console.log(data.response['countCart'])--}}
                {{--            toastr.success('Product added in your cart <span style="font-size: 25px;">&#10084;&#65039;</span>');--}}
                {{--            //$('#number-cart').html('<div>'+data.response['countCart']+'</div>');--}}
                {{--            $('#number-cart').html(data.response['countCart']);--}}
                {{--            // $('.addToCart').prop("disabled",true);--}}
                {{--        }--}}
                {{--    });--}}
                {{--})--}}
            </script>
    @endpush
