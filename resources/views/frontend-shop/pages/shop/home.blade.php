@extends('frontend.layouts.master')
@section('title', 'Shop')
@push('css')

@endpush
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 col-lg-3 col-xl-3 theiaStickySidebar">
                    <!-- Search Filter -->
                    <div class="card search-filter">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Filter</h4>
                        </div>
                        <form action = "{{route('shop.filter.cat')}}" method="post">
                            @csrf
                            <div class="card-body">
                                <!-- <div class="filter-widget">
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" placeholder="Select Date">
                                    </div>
                                </div> -->
                                <div class="filter-widget">
                                    <h4>Categories</h4>
                                    @foreach($category as $cat)
                                        <div>
                                            <label class="custom_check">
                                                <input type="checkbox" name="cate[]" value="{{$cat->id}}" {{in_array($cat->id, $chk_cat) ?"checked":""}}>
                                                <span class="checkmark"></span> {{$cat->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="btn-search">
                                    <button type="submit" class="btn btn-block">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /Search Filter -->
                </div>
                <div class="col-md-7 col-lg-9 col-xl-9">
                    <div class="row align-items-center pb-3">
                        <div class="col-md-12 mb-4">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{asset('frontend/img/slider/eslide2.jpg')}}" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{asset('frontend/img/slider/eslide1.jpg')}}" alt="Second slide">
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
                        </div>
                        <div class="col-md-4 col-12 d-md-block d-none custom-short-by">
                            <h3 class="title pharmacy-title">Our Product</h3>
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
                        @foreach($products as $product )
                            <div class="col-md-12 col-lg-4 col-xl-4 product-custom">
                                <div class="profile-widget">
                                    <div class="doc-img">
                                        <a href="{{route('product.details',$product->slug)}}" tabindex="-1">
                                            @if(!empty($product->image))
                                                <img class="img-fluid" alt="Product image" src="{{asset('uploads/products/'.$product->image)}}">
                                            @else
                                                <img class="img-fluid" alt="Product image" src="{{asset('uploads/products/default.jpg')}}">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="pro-content">
                                        <h3 class="title pb-4">
                                            <a href="{{route('product.details',$product->slug)}}" tabindex="-1">{{$product->name}}</a>
                                        </h3>

                                        <div class="row align-items-center">
                                            <div class="col-lg-6">
                                                <span class="price font-weight-bold">TK{{number_format($product->sale_price)}}</span>
                                                <span class="price-strike">TK{{number_format($product->regular_price)}}</span>
                                            </div>
                                            <div class="col-lg-6 text-right">
                                                @if($product->quantity>0)
                                                    <a href="#" class="cart-icon addToCart" id="{{$product->id}}"><i class="fas fa-shopping-cart"></i></a>
                                                @else
                                                    <span class="badge badge-primary">Out of stock</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{$products->links()}}
                        {{--                    <div class="col-md-12 text-center">--}}
                        {{--                        <a href="#" class="btn book-btn1 mb-4">Load More</a>--}}
                        {{--                    </div>--}}
                    </div>
                </div>
            </div>
        </div>
        @stop
        @push('js')
            <script>
                $(".addToCart").click(function (e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('product.cart.add')}}",
                        method: "post",
                        data:{
                            productId:this.id,
                        },
                        success: function(data){
                            console.log(data.response['countCart'])
                            toastr.success('Product added in your cart <span style="font-size: 25px;">&#10084;&#65039;</span>');
                            //$('#number-cart').html('<div>'+data.response['countCart']+'</div>');
                            $('#number-cart').html(data.response['countCart']);
                            // $('.addToCart').prop("disabled",true);
                        }
                    });
                })
            </script>
    @endpush
