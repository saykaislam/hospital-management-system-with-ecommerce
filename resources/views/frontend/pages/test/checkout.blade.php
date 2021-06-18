@extends('frontend.layouts.master')
@section('title', 'Home')
@push('css')
    {{--custom css--}}
    <style>
        [type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }
        /* IMAGE STYLES */
        [type=radio] + img {
            cursor: pointer;
        }
        /* CHECKED STYLES */
        [type=radio]:checked + img {
            border: 2px solid #0000ff;
            border-radius: 10px;

        }
        #map {
            height: 400px;  /* The height is 400 pixels */
            width: 100%;  /* The width is the width of the web page */
        }
        .modal-content {
            background-color: #edebe8;
        }
        /* Important part */

        .near_venodr_list {
            height: 420px;
            overflow-y: auto;
        }

        .additional-fields {
            background-color: white;
            padding: 15px;
            border-radius: 15px;
        }

        .additional-fields-provider {
            /*background: linear-gradient(90deg, #00d2ff 0%, #1945d5 100%);*/
            background-image: url("frontend/img/checkout/ven_ck.png");
            /*padding: 15px;*/
            border-radius: 15px;
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
    @if(Cart::count()>0)
        <!-- Breadcrumb -->
        <div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Lab Test Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->


        {{--    modal vendor--}}
        <!-- Page Content -->

        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-7">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Billing details</h3>
                            </div>
                            <div class="card-body">
                                <!-- Checkout Form -->
                                <form action="{{route('test.order.submit')}}" method="post">
                                    @csrf
                                    <!-- Personal Information -->
                                    <div class="info-widget">
                                        <h4 class="card-title">Personal Information</h4>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group card-label">
                                                    <label>First Name</label>
                                                    <input class="form-control" name="first_name" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group card-label">
                                                    <label>Last Name</label>
                                                    <input class="form-control" name="last_name" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group card-label">
                                                    <label>Email</label>
                                                    <input class="form-control" name="email" type="email">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group card-label">
                                                    <label>Phone</label>
                                                    <input class="form-control" name="phone" type="text" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Personal Information -->

                                    <!-- Shipping Details -->
                                    <div class="info-widget">
                                        <h4 class="card-title">Shipping Details</h4>
                                        <div class="form-group card-label">
                                            <label class="pl-0 ml-0 mb-2">Delivery Address</label>
                                            <textarea rows="2" class="form-control" name="address" required></textarea>
                                        </div>
                                        <div class="form-group card-label">
                                            <label class="pl-0 ml-0 mb-2">Order notes (Optional)</label>
                                            <textarea rows="5" class="form-control" name="note"></textarea>
                                        </div>
                                    </div>
                                    <!-- /Shipping Details -->

                                    <div class="payment-widget">
                                        <h4 class="card-title">Payment Method</h4>
                                        <!-- Credit Card Payment -->
                                        <div class="payment-list">
                                            <label class="payment-radio credit-card-option">
                                                <input type="radio" name="pay" value="cod" checked>
                                                <span class="checkmark"></span>
                                                Cash On Delivery
                                            </label>
                                        </div>
                                        <!-- /Credit Card Payment -->

                                        <!-- Paypal Payment -->
                                        <div class="payment-list">
                                            <label class="payment-radio paypal-option">
                                                <input type="radio" name="pay" value="ssl">
                                                <span class="checkmark"></span>
                                                SSLCommerz
                                            </label>
                                        </div>
                                        <!-- /Paypal Payment -->

                                        <!-- Terms Accept -->
                                        <div class="terms-accept">
                                            <div class="custom-checkbox">
                                                <input type="checkbox" id="terms_accept1" required>
                                                <label for="terms_accept1">I have read and accept <a href="#">Terms &amp; Conditions</a></label>
                                            </div>
                                        </div>
                                        <!-- /Terms Accept -->

                                        <!-- Submit Section -->
                                        <div class="submit-section mt-4">
                                            <button type="submit" class="btn btn-primary submit-btn">Confirm and Pay</button>
                                        </div>
                                        <!-- /Submit Section -->
                                    </div>
                                </form>
                                <!-- /Checkout Form -->
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 col-lg-5 theiaStickySidebar">
                        <!-- Booking Summary -->
                        <div class="card booking-card">
                            <div class="card-header">
                                <h3 class="card-title">Your Order</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-center mb-0">
                                        <tr>
                                            <th>Lab Test</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                        <tbody>
                                        @foreach(Cart::content() as $product)
                                            <tr>
                                                <td><h5>{{$product->name}}</h5>
                                                    <p>
                                                        @if($product->options->delivery_type=="from_home")
                                                            Collect from Lab
                                                        @else
                                                            Deliver to Home
                                                        @endif
                                                    </p></td>
                                                <td class="text-right">TK.{{$product->price}}<i class="fa fa-times mx-1" aria-hidden="true"></i>{{$product->qty}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="booking-summary pt-5">
                                    <div class="booking-item-wrap">
                                        <ul class="booking-date">
                                            <li>Subtotal <span>TK.{{Cart::subtotal()}}</span></li>
{{--                                            <li>Shipping <span>$25.00</span></li>--}}
                                        </ul>
{{--                                        <ul class="booking-fee">--}}
{{--                                            <li>Tax <span>$0.00</span></li>--}}
{{--                                        </ul>--}}
                                        <div class="booking-total">
                                            <ul class="booking-total-list">
                                                <li>
                                                    <span>Total</span>
                                                    <span class="total-cost">TK.{{Cart::total()}}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Booking Summary -->

                    </div>
                </div>

            </div>

        </div>
        <!-- /Page Content -->
    @endif
@stop
@push('js')
    <script src="{{asset('frontend/js/map/map.js')}}" type="text/javascript"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCE1oI9UN7X2VYS0UFVRKBdWd3TzyxT-tE&callback">
    </script>

    <script !src = "">
        $(document).ready(function(){

            if($("#vendor_id").val().length==0){
                $("#orderBtn").addClass('d-none');
            }else{
                $("#orderBtn").removeClass('d-none');
            }

            // $(".text-slider").owlCarousel({
            //     item:5,
            //     loop:true,
            //     margin:15,
            //     nav: $('.text-slider').data('nav'),
            //     dots: $('.text-slider').data('dots'),
            //     autoplay:false,
            //     responsiveClass:true,
            //     responsive:{
            //         0:{
            //             items:2,
            //             nav:true
            //         },
            //         600:{
            //             items:3,
            //             nav:false
            //         },
            //         1000:{
            //             items:5,
            //             nav:false,
            //             loop:false
            //         }
            //     }
            // });
            $(".date-block").click(function () {
                $(".date-block").css("border","0px solid #000");
                var date=this.id;
                $("#"+date).css("border","2px solid #1945d5");
                $(".service_date").val(date);
                $(".ser_date").html(date);
                // console.log(date);
            });

            $(".time-block").click(function () {
                $(".time-block").css("border","0px solid #000");
                var time=this.id;
                $(replaceColon( time )).css("border","2px solid #1945d5");
                $(".service_time").val(time);
                $(".ser_time").html(time);
            });
            function replaceColon( myid ) {
                return "#" + myid.replace( /(:|\.|\[|\]|,|=|@)/g, "\\$1" );
            }
            $("#modalName").on("change", function() {
                if($(this).val().length>2){
                    $("#billing_name").val($(this).val());
                    $(".bill_name").html($(this).val());
                }
            });
            $("#modalPhone").on("change", function() {
                if($(this).val().length==11 && $.isNumeric($(this).val())){
                    $("#billing_phone").val($(this).val());
                    $(".bill_phone").html("+88"+$(this).val());
                    $("#emailHelp").empty();
                }else{
                    $("#emailHelp").html("Phone number must be 11 digit");
                }
            });


            $("#house").click(function (){
                if($("#vendor_id").val().length==0){
                    alert('At First Click For Service Provider From Top Bar!');
                }
            })
        });
    </script>
@endpush
