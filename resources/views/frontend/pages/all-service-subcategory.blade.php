@extends('frontend.layouts.master')
@section('title', 'Home')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Service</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Service</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                    <!-- Profile Sidebar -->
                    <div class="profile-sidebar">
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">

                                <div class="profile-det-info">
                                    <h3>All Sub Category Services</h3>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-widget">
                            <nav class="dashboard-menu">
                                <ul>
                                    @if(count($serviceSubCategories) > 0)
                                        @foreach($serviceSubCategories as $serviceSubCategory)
                                            <li>
                                                <a href="{{url('service-sub-category/'.$serviceSubCategory->slug)}}">
                                                    <i class="fas fa-columns"></i>
                                                    <span>{{$serviceSubCategory->name}}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- /Profile Sidebar -->

                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="doc-review review-listing">
                        <!-- Blog -->
                        <div class="row blog-grid-row">

                            @if(count($services) > 0)
                                @foreach($services as $service)
                                    <div class="col-md-6 col-xl-4 col-sm-12">

                                        <!-- Blog Post -->
                                        <div class="blog grid-blog">
                                            <div class="blog-image">
                                                <a href="{{url('service-sub-category/'.$service->slug)}}">
                                                    @if(!empty($service->image))
                                                        <img class="img-fluid" src="{{asset('uploads/services/'.$service->image)}}" alt="Post Image">
                                                    @else
                                                        <img class="img-fluid" src="{{asset('uploads/services/default.jpg')}}" alt="Post Image">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="blog-content">
                                                <h3 class="blog-title mb-1"><a href="{{url('service-sub-category/'.$service->slug)}}">{{$service->name}}</a></h3>
                                                <span class="text-center">Tk.{{$service->price}}</span>
                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#exampleModalLong{{$service->id}}">
                                                    Details
                                                </button>
                                                {{--                                                <div class="col"><a href="#" class="btn-success text-center" style="padding: 10px 30px;margin-left: 100px" > Add +</a></div>--}}
                                                <div class="modal fade" id="exampleModalLong{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Service Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{$service->description}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $cart=Cart::content() ;
                                                    $ser_id=$service->id;
                                                    $item=$cart->search(function ($cartItem, $rowId) use ($ser_id) {
                                                        return $cartItem->id === $ser_id;
                                                    });
                                                @endphp
                                                @if(Cart::count()==0)
                                                    <div class="cartbtn_{{$service->id}} ">
                                                        {{--                                                <button id="" class=" ttm-textcolor-white " style="padding: 6px 14px; background-color: #fff;border: 2px solid #0d71d5;border-radius: 10px;color: #1b1e21" title="Select Service Provider First" onclick="geoLocationInit({{$service->id}})">Add +</button>--}}
                                                        <button id="{{$service->id}}" class=" ttm-textcolor-white cart_button" style="padding: 6px 14px; background-color: #fff;border: 2px solid #0d71d5;border-radius: 10px;color: #1b1e21" title="CLick To Add Cart">Add +</button>
                                                    </div>
                                                @elseif($item==false)
                                                    <div class="cartbtn_{{$service->id}}">
                                                        <button id="{{$service->id}}" class=" ttm-textcolor-white cart_button" style="padding: 6px 14px; background-color: #fff;border: 2px solid #0d71d5;border-radius: 10px;color: #1b1e21" title="CLick To Add Cart">Add +</button>
                                                    </div>
                                                @else
                                                    <h6 class="">Added</h6>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- /Blog Post -->

                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12 col-xl-12 col-sm-12">
                                    <div class="blog grid-blog">
                                        <h3>No Data Found!</h3>
                                    </div>
                                </div>
                            @endif


                        </div>

                        <!-- Blog Pagination -->
                    {{--                        <div class="row">--}}
                    {{--                            <div class="col-md-12">--}}
                    {{--                                <div class="blog-pagination">--}}
                    {{--                                    <nav>--}}
                    {{--                                        <ul class="pagination justify-content-center">--}}
                    {{--                                            <li class="page-item disabled">--}}
                    {{--                                                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-double-left"></i></a>--}}
                    {{--                                            </li>--}}
                    {{--                                            <li class="page-item">--}}
                    {{--                                                <a class="page-link" href="#">1</a>--}}
                    {{--                                            </li>--}}
                    {{--                                            <li class="page-item active">--}}
                    {{--                                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>--}}
                    {{--                                            </li>--}}
                    {{--                                            <li class="page-item">--}}
                    {{--                                                <a class="page-link" href="#">3</a>--}}
                    {{--                                            </li>--}}
                    {{--                                            <li class="page-item">--}}
                    {{--                                                <a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>--}}
                    {{--                                            </li>--}}
                    {{--                                        </ul>--}}
                    {{--                                    </nav>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    <!-- /Blog Pagination -->
                        <!-- /Blog -->

                    </div>

                    <div class="col-md-12 col-xl-12 col-sm-12">
                        <div class="blog grid-blog">
                            <h3 class="text-center">My Cart</h3>
                            <div class="card card-table">
                                <div class="card-body">
                                    @if(count(Cart::content())>0)
                                        <div class="table-responsive">
                                            <table class="table table-hover table-center mb-0">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center">Approx.Proce</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(Cart::content() as $service)
                                                    <tr>
                                                        <td>
                                                            <p>{{$service->name}}</p>
                                                        </td>
                                                        <td>
                                                            Tk.{{$service->price}}
                                                        </td>
                                                        <td>
                                                            <form method="post" action="{{route('qty.update')}}">
                                                                @csrf
                                                                <input type="number" name="quantity" class="input-text" value="{{$service->qty}}" min="0" title="Qty" size="4" onchange="this.form.submit()">
                                                                <input type = "hidden" name="rid" value="{{$service->rowId}}">
                                                            </form>
                                                        </td>
                                                        <td class="text-center">
                                                            Tk.{{$service->price*$service->qty}}
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="table-action">
                                                                <a href="{{route('cart.remove',$service->rowId)}}" class="btn btn-sm bg-danger-light">
                                                                    <i class="fas fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="6" class="text-right">
                                                        {{--                                                        <div class="coupon">--}}
                                                        {{--                                                            <input type="text" name="coupon_code" class="input-text" value="" placeholder="Coupon code">--}}
                                                        {{--                                                            <button type="submit" class="button" name="apply_coupon" value="Apply coupon">Apply coupon</button>--}}
                                                        {{--                                                        </div>--}}
                                                        <a href="{{route('cart.remove.all')}}" class="button text-danger" name="update_cart">Clear Cart</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="service-empty-cart">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="clinic-booking pt-4">
                                                        <a href="/checkout" class="checkout-button button">Proceed to checkout</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="service-empty-cart">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <p class="font-weight-light" style="font-size:40px;color:#d7d5d5">Empty Cart</p>
                                                </div>
                                                <div class="col-md-12 text-center">
                                                    <p class="font-weight-light p-5">Get your service done just with few clicks! so what are you waiting for?</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop
@push('js')
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
                        }else {
                            toastr.success('Service added in your cart <span style="font-size: 15px;">&#10084;&#65039;</span>');
                            $('#number-cart').html(data.response['countCart']);
                            $('.cartbtn_' + data.response['id']).html('<h6>Added</h6>');
                            $('.service-details-cart').append(`<tr class="cart_item border-0">
                                                        <td class="product-name py-2 border-0">
                                                            <p style="font-size: 15px;color: #0c0c0c" class="mb-1">` + data.response['options'].service_sub_category_name + `</p>
                                                            ` + data.response['name'] + `
                                                            <strong class="product-quantity">× ` + data.response['qty'] + `</strong>
                                                        </td>
                                                        <td class="product-total border-0">
                                                                    <span class="Price-amount">
                                                                        <span class="Price-currencySymbol">৳</span>` + data.response['price'] + `
                                                                    </span>
                                                        </td>
                                                    </tr>`);
                            $('.service-empty-cart').empty();
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
@endpush
