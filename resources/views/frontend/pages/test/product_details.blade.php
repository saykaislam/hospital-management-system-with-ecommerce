@extends('frontend.layouts.master')
@section('title', 'Product')
@push('css')

@endpush
@section('content')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7 col-lg-9 col-xl-9">
                    <!-- Doctor Widget -->
                    <div class="card">
                        <div class="card-body product-description">
                            <div class="doctor-widget">
                                <div class="doc-info-left">
                                    <div class="doctor-img1">
                                        <img src="{{asset('uploads/products/'.$product->image)}}" class="img-fluid" alt="User Image">
                                    </div>
                                    <div class="doc-info-cont">
                                        <div class="card search-filter">
                                            <div class="card-body">
                                                <h4 class="doc-name mb-2">{{$product->name}}</h4>
                                                <p><span class="text-muted">Manufactured By </span> {{$product->brand->name}}</p>
                                                <div class="clini-infos mt-0">
                                                    <h2>$19 <b class="text-lg strike">$45</b>  <span class="text-lg text-success"><b>10% off</b></span></h2>
                                                </div>
                                                <span class="badge badge-primary">In stock</span>
                                                {{--                                                <div class="custom-increment pt-4">--}}
                                                {{--                                                    <div class="input-group1">--}}
                                                {{--		                                    <span class="input-group-btn float-left">--}}
                                                {{--		                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">--}}
                                                {{--		                                          <span><i class="fas fa-minus"></i></span>--}}
                                                {{--		                                        </button>--}}
                                                {{--		                                    </span>--}}
                                                {{--                                                        <input type="text" id="quantity" name="quantity" class=" input-number" value="10">--}}
                                                {{--                                                        <span class="input-group-btn float-right">--}}
                                                {{--		                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">--}}
                                                {{--		                                            <span><i class="fas fa-plus"></i></span>--}}
                                                {{--		                                        </button>--}}
                                                {{--		                                    </span>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                                <div class="clinic-details mt-4" style="width: 48%">
                                                    <div class="clinic-booking">
                                                        <a class="apt-btn addToCart" href="#">Add To Cart</a>
                                                    </div>
                                                </div>
                                                {{--                                                <div class="card flex-fill mt-4 mb-0">--}}
                                                {{--                                                    <ul class="list-group list-group-flush">--}}
                                                {{--                                                        <li class="list-group-item">SKU	<span class="float-right">201902-0057</span></li>--}}
                                                {{--                                                        <li class="list-group-item">Pack Size	<span class="float-right">100g</span></li>--}}
                                                {{--                                                        <li class="list-group-item">Unit Count	<span class="float-right">200ml</span></li>--}}
                                                {{--                                                        <li class="list-group-item">Country	<span class="float-right">Japan</span></li>--}}
                                                {{--                                                    </ul>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- /Doctor Widget -->

                    <!-- Doctor Details Tab -->
                    <div class="card">
                        <div class="card-body pt-0">

                            <!-- Tab Menu -->
                            <h3 class="pt-4">Product Details</h3>
                            <hr>
                            <!-- /Tab Menu -->

                            <!-- Tab Content -->
                            <div class="tab-content pt-3">
                                <!-- Overview Content -->
                                <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="widget about-widget">
                                                <h4 class="widget-title">Description</h4>
                                                <p>{!! $product->description !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Overview Content -->
                            </div>
                        </div>
                    </div>
                    <!-- /Doctor Details Tab -->
                </div>

                <div class="col-md-5 col-lg-3 col-xl-3 theiaStickySidebar">

                    <!-- Right Details -->
                    {{--                    <div class="card search-filter">--}}
                    {{--                        <div class="card-body">--}}
                    {{--                            <div class="clini-infos mt-0">--}}
                    {{--                                <h2>$19 <b class="text-lg strike">$45</b>  <span class="text-lg text-success"><b>10% off</b></span></h2>--}}
                    {{--                            </div>--}}
                    {{--                            <span class="badge badge-primary">In stock</span>--}}
                    {{--                            <div class="custom-increment pt-4">--}}
                    {{--                                <div class="input-group1">--}}
                    {{--		                                    <span class="input-group-btn float-left">--}}
                    {{--		                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">--}}
                    {{--		                                          <span><i class="fas fa-minus"></i></span>--}}
                    {{--		                                        </button>--}}
                    {{--		                                    </span>--}}
                    {{--                                    <input type="text" id="quantity" name="quantity" class=" input-number" value="10">--}}
                    {{--                                    <span class="input-group-btn float-right">--}}
                    {{--		                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">--}}
                    {{--		                                            <span><i class="fas fa-plus"></i></span>--}}
                    {{--		                                        </button>--}}
                    {{--		                                    </span>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="clinic-details mt-4">--}}
                    {{--                                <div class="clinic-booking">--}}
                    {{--                                    <a class="apt-btn" href="cart.html">Add To Cart</a>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="card flex-fill mt-4 mb-0">--}}
                    {{--                                <ul class="list-group list-group-flush">--}}
                    {{--                                    <li class="list-group-item">SKU	<span class="float-right">201902-0057</span></li>--}}
                    {{--                                    <li class="list-group-item">Pack Size	<span class="float-right">100g</span></li>--}}
                    {{--                                    <li class="list-group-item">Unit Count	<span class="float-right">200ml</span></li>--}}
                    {{--                                    <li class="list-group-item">Country	<span class="float-right">Japan</span></li>--}}
                    {{--                                </ul>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="card search-filter">
                        <div class="card-body">
                            <div class="card flex-fill mt-0 mb-0">
                                <ul class="list-group list-group-flush benifits-col">
                                    <li class="list-group-item d-flex align-items-center">
                                        <div>
                                            <i class="fas fa-shipping-fast"></i>
                                        </div>
                                        <div>
                                            Fast Shipping<br><span class="text-sm"></span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <div>
                                            <i class="far fa-question-circle"></i>
                                        </div>
                                        <div>
                                            Support 24/7<br><span class="text-sm">Call us anytime</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <div>
                                            <i class="fas fa-hands"></i>
                                        </div>
                                        <div>
                                            100% Safety<br><span class="text-sm">Only secure payments</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <div>
                                            <i class="fas fa-tag"></i>
                                        </div>
                                        <div>
                                            Hot Offers<br><span class="text-sm">Discounts up to 90%</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Right Details -->
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script>
        $(".addToCart").click(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('product.cart.add')}}",
                method: "post",
                data:{
                    productId:{{$product->id}},
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
