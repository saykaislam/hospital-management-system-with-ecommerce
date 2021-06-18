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
    @if(count(Cart::content())>0)
        <!-- Breadcrumb -->
        <div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->


        {{--    modal vendor--}}
        <div class="modal fade" id="vendorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h6 class="modal-title" id="exampleModalLongTitle">Click Vendor <img src = "http://icons.iconarchive.com/icons/graphicloads/polygon/16/shopping-cart-icon.png" alt = ""> Icon From Map To Add Service</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times-circle text-danger" aria-hidden="true"></i></span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="container p-0">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-7">
                                    <!--The div element for the map -->
                                    <div id="map"></div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-5">
                                    <div class="near_venodr_list check mt-2">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- Contact  Person Modal-->
        <div class="modal fade bd-example-modal-lg" id="conPerson" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content px-5 p-3">
                    <div class="modal-header justify-content-center p-1">
                        <h5 class="modal-title" id="">Order For</h5>
                    </div>
                    <div class="row px-1 px-md-5 pb-5 pt-3">
                        <div class="col-md-12 text-center text-dark">
                            <p style="font-size: 17px;">Whose this service ordered for?</p>
                        </div>
                        <div class="col-md-12">
                            <form id="contact_form">
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Name</label>
                                    <input class="form-control" id="modalName" name="modalName" type="text" placeholder="name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Phone</label>
                                    <input class="form-control" id="modalPhone" name="modalPhone" type="text" placeholder="01XXXXXXXXX">
                                    <small id="emailHelp" class="form-text text-danger"></small>
                                </div>
                                {{--                                    <div class="form-row place-order">--}}
                                {{--                                        <button style="width: 100%;" type="" class="button"  id="submit_contact">Place Order</button>--}}
                                {{--                                    </div>--}}
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer" style="justify-content:  center;padding: 0rem;border-top: 0px solid #dee2e6;">
                        <button type="button" class="btn btn-sm btn-primary"  data-dismiss="modal">Done</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Date Time Modal-->
        <div class="modal fade bd-example-modal-lg" id="dateTimeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content p-3">
                    <div class="modal-header justify-content-center p-1">
                        <h5 class="modal-title" id="">Schedule Time</h5>
                    </div>
                    <div class="row pb-5 pt-3">
                        <div class="col-md-12 text-center text-dark">
                            <p style="font-size: 15px;">When would you like Ohmistiry to serve you?</p>
                        </div>
                        <div class="col-md-12">
                            <div class="text-slider owl-carousel owl-theme">
                                @foreach($dates as $date)
                                    @php
                                        $day=date('d', strtotime($date ));
                                        $weak=date('D', strtotime($date ));
                                    @endphp
                                    <div style="background: linear-gradient(90deg, #00d2ff 0%, #1945d5 100%);color: #000000;cursor: pointer;border-radius: 10px;" class=" text-center pt-3 pb-2 date-block" id="{{$date}}"  >
                                        <p style="font-size: 40px">{{$day}}</p>
                                        <p style="font-size: 15px;color: #404040;" class="m-0">{{$weak}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12 text-center text-dark mt-2">
                            <p style="font-size: 15px;">Select your prefer time </p>
                        </div>
                        <div class="col-md-12">
                            <div class="row px-2" style="justify-content: center;">
                                @foreach($times as $time)
                                    <div style="background: #1945d5 ;color: #FFFFFF;cursor: pointer;border-radius: 10px;" class="col-4 col-md-2  mb-2 mr-1 m-md-2 p-2 text-center time-block" id="{{$time}}"  data-name="{{$time}}">
                                        <p style="font-size: 15px" class="m-0">{{$time}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="justify-content:  center;padding: 0rem;border-top: 0px solid #dee2e6;">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <form  action="{{route('order.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- row -->
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="additional-fields-provider text-center py-4" onclick="geoLocationInit()">
                                <h3 class="m-0" style="color: white;">Click For Service Provider</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 col-lg-8">
                            <div class="card">
                                <div class="card-body">

                                        <!-- Personal Information -->
                                        <div class="info-widget">
                                            <h4 class="card-title">Personal Information</h4>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group card-label">
                                                        <input type="hidden" class="input-text service_date" name="service_date" placeholder="service date" value="{{$given_date}}" required>
                                                        <input type="hidden" class="input-text service_time" name="service_time" placeholder="service time" value="{{$given_time}}" required>
                                                        <div class="row px-3">
                                                            <div class="col-1 p-0">
                                                                <img class="img-fluid float-right" src = "{{asset('frontend/img/checkout/calender.png')}}" alt = "">
                                                            </div>
                                                            <div class="col-11">
                                                                <h4 class="m-0">Schedule</h4>
                                                                <p class="m-0">Expert will arrive at your given address.</p>
                                                                <div class="d-inline mt-2">
                                                                    <p class="float-left  mx-0  font-weight-light px-3 py-1 my-2 ser_time" style="font-size: 29px; color: #0c0c0c;border-right: 2px solid #1945d5;">{{$given_time}}</p>
                                                                    <p class="float-left  mx-0  font-weight-light px-3 py-1 my-2 ser_date" style="font-size: 29px; color: #0c0c0c;border-right: 2px solid #1945d5;">{{$given_date}}</p>
                                                                    <a href = "" class="float-left  mx-0  font-weight-light px-3 py-1 my-2" data-toggle="modal" data-target="#dateTimeModal">Change</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group card-label">
                                                        <input type="hidden" class="input-tex" id="billing_name" name="billing_name" placeholder="{{Auth::user()->name}}" value="{{Auth::user()->name}}" required>
                                                        <input type="hidden" class="input-text " id="billing_phone" name="billing_phone" placeholder="{{Auth::user()->phone}}" value="{{Auth::user()->phone}}" required>
                                                        <div class="row px-3">
                                                            <div class="col-1 p-0">
                                                                <img class="img-fluid float-right" src = "{{asset('frontend/img/checkout/person.png')}}"  alt = "">
                                                            </div>
                                                            <div class="col-11">
                                                                <h4 class="m-0">Contact Person</h4>
                                                                <p class="m-0">Expert will contact with the following person.</p>
                                                                <div class="d-inline mt-2">
                                                                    <p class="float-left  mx-0  font-weight-light px-2 py-1 my-2 bill_name" style="font-size: 21px; color: #0c0c0c;border-right: 2px solid #1945d5;">{{Auth::user()->name}}</p>
                                                                    <p class="float-left  mx-0  font-weight-light px-2 py-1 my-2 bill_phone" style="font-size: 19px; color: #0c0c0c;border-right: 2px solid #1945d5;">+88{{Auth::user()->phone}}</p>
                                                                    <a href = "" class="float-left  mx-0  font-weight-light px-2 py-1 my-2"  data-toggle="modal" data-target="#conPerson">Change</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group card-label">
                                                        <div class="row px-3">
                                                            <div class="col-1 p-0">
                                                                <img class="img-fluid float-right" src = "{{asset('frontend/img/checkout/address.png')}}" alt = "">
                                                            </div>
                                                            <div class="col-11">
                                                                <h4 class="m-0">Address</h4>
                                                                <p class="m-0 mb-2">Expert will arrive at the address given below .</p>
                                                                <div class="d-inline mt-2">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="email" style="color: #0c0c0c;">House No<span class="text-danger font-weight-bold">*</span></label>
                                                                                <input type="text" name="house" class="form-control" placeholder="House No" id="house" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="email" style="color: #0c0c0c;">Road No. / Name<span class="text-danger font-weight-bold">*</span></label>
                                                                                <input type="text" name="road" class="form-control" placeholder="Road No. / Name" id="road" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="email" style="color: #0c0c0c;">Block No</label>
                                                                                <input type="text" name="block" class="form-control" placeholder="Block No" id="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="email" style="color: #0c0c0c;">Sector No</label>
                                                                                <input type="text" name="sector" class="form-control" placeholder="Sector No" id="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="email" style="color: #0c0c0c;">Area<span class="text-danger font-weight-bold">*</span></label>
                                                                                <input type="text" name="area" class="form-control" placeholder="ex. bonani/ghulshan" id="email" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group card-label">
                                                        <input type = "hidden" name="vendor_id" id="vendor_id" required>
                                                        <div id="payment" class="checkout-payment">
                                                            <ul class="payment_methods">
                                                                <li class="payment_method_ppec_paypal">
                                                                    <h4 class="m-0">Payment Method</h4>
                                                                    <div class="payment_box">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label>
                                                                                    <input type="radio" name="payment_type" value="cod" checked>
                                                                                    <img class="img-fluid" style="width: 280px;" src="{{asset('frontend/img/payment/cod.png')}}">
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label>
                                                                                    <input type="radio" name="payment_type" value="ssl">
                                                                                    <img src="{{asset('https://i0.wp.com/aquarium.com.bd/wp-content/uploads/2019/04/SSL-Commerz-Pay-With-logo-All-Size-2-05.png?fit=300%2C208&ssl=1')}}" class="img-fluid" style="width: 200px;" >
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            <div class="row ml-4 mt-3">
                                                                <div class="form-group">
                                                                    <h4 class="m-0 mb-2">Any Comment</h4>
                                                                    <textarea class="form-control" name="order_comments" id="exampleFormControlTextarea1" rows="2"></textarea>
                                                                </div>
                                                            </div>

                                                            <!-- Submit Section -->
                                                            <div class="submit-section mt-4 place-order d-none" id="orderBtn">
                                                                <button type="submit" class="btn btn-primary submit-btn" id="place_order">Confirm and Pay</button>
                                                            </div>
                                                            <!-- /Submit Section -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Personal Information -->
                                    <!-- /Checkout Form -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 col-lg-4 theiaStickySidebar">

                            <!-- Booking Summary -->
                            <div class="card booking-card">
                                <div class="card-header">
                                    <h4 class="card-title">Booking Summary</h4>
                                </div>
                                <div class="card-body">

                                    <!-- Booking Doctor Info -->
                                {{--                            <div class="booking-doc-info">--}}
                                {{--                                <a href="doctor-profile.html" class="booking-doc-img">--}}
                                {{--                                    <img src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image">--}}
                                {{--                                </a>--}}
                                {{--                                <div class="booking-info">--}}
                                {{--                                    <h4><a href="doctor-profile.html">Dr. Darren Elder</a></h4>--}}
                                {{--                                    <div class="rating">--}}
                                {{--                                        <i class="fas fa-star filled"></i>--}}
                                {{--                                        <i class="fas fa-star filled"></i>--}}
                                {{--                                        <i class="fas fa-star filled"></i>--}}
                                {{--                                        <i class="fas fa-star filled"></i>--}}
                                {{--                                        <i class="fas fa-star"></i>--}}
                                {{--                                        <span class="d-inline-block average-rating">35</span>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="clinic-details">--}}
                                {{--                                        <p class="doc-location"><i class="fas fa-map-marker-alt"></i> Newyork, USA</p>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
                                <!-- Booking Doctor Info -->

                                    <div class="booking-summary">
                                        <div class="booking-item-wrap">
                                            <ul class="booking-fee">
                                                @foreach(Cart::content() as $service)
                                                    <li>Name <span>{{$service->name}}</span></li>
                                                    <li>Qty <span>{{$service->qty}}</span></li>
                                                    <li>Subtotal <span>৳{{Cart::subtotal()}}</span></li>
                                                @endforeach
                                            </ul>
                                            <div class="booking-total">
                                                <ul class="booking-total-list">
                                                    <li>
                                                        <span>Total</span>
                                                        <span class="total-cost">৳{{Cart::subtotal()}}</span>
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
                </form>

                <div class="row mb-3">

                        @if (! session()->has('coupon'))
                            <a href="#" class="have-code">Have a Code?</a>
                            <div class="have-code-container text-center">
                                <form action="{{ route('checkout.coupon.store') }}" method="POST">
                                    @csrf
                                    <input class="mb-3" type="text" name="coupon_code" id="coupon_code" placeholder="apply coupon code here">
                                    <button style="background: linear-gradient(90deg, #00d2ff 0%, #1945d5 100%);color: #FFFFFF" type="submit" class="button button-plain">Apply</button>
                                </form>
                            </div> <!-- end have-code-container -->
                        @else
                            <form action="{{ route('checkout.coupon.destroy') }}" method="POST" style="display:block">
                                @csrf
                                <button style="background: linear-gradient(90deg, #00d2ff 0%, #1945d5 100%);color: #FFFFFF;width: 100%" type="submit" style="font-size:14px;">Remove Coupon</button>
                            </form>
                        @endif

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
