@extends('frontend.layouts.master')
@section('title', 'Doctor Details')
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
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Doctor Booking Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-md-7 col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <!-- Checkout Form -->
                            <form action="{{url('doctor-booking-checkout-store',$ds_slot->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <!-- Personal Information -->
                                <div class="info-widget">
                                    <h4 class="card-title">Personal Information</h4>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group card-label">
                                                <label>Patient Name</label>
                                                <input class="form-control" name="name" type="text" value="{{Auth::user()->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group card-label">
                                                <label>Contact No.</label>
                                                <input class="form-control" name="phone" type="text" value="{{Auth::user()->phone}}">
                                            </div>
                                        </div>
{{--                                        <div class="col-md-6 col-sm-12">--}}
{{--                                            <div class="form-group card-label">--}}
{{--                                                <label>Email</label>--}}
{{--                                                <input class="form-control" type="email">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-6 col-sm-12">--}}
{{--                                            <div class="form-group card-label">--}}
{{--                                                <label>Phone</label>--}}
{{--                                                <input class="form-control" type="text">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
{{--                                    <div class="exist-customer">Existing Customer? <a href="#">Click here to login</a></div>--}}
                                </div>
                                <!-- /Personal Information -->

                                <div class="payment-widget">
                                    <h4 class="card-title">Payment Method</h4>

                                    <!-- Credit Card Payment -->
                                    <div class="payment-list">
                                        <label class="payment-radio credit-card-option">
                                            <input type="radio" name="payment_type" value="ssl">
                                            <span class="checkmark"></span>
                                            Pay Now via SSLCOMMEZ
                                        </label>
{{--                                        <div class="row">--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group card-label">--}}
{{--                                                    <label for="card_name">Name on Card</label>--}}
{{--                                                    <input class="form-control" id="card_name" type="text">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <div class="form-group card-label">--}}
{{--                                                    <label for="card_number">Card Number</label>--}}
{{--                                                    <input class="form-control" id="card_number" placeholder="1234  5678  9876  5432" type="text">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4">--}}
{{--                                                <div class="form-group card-label">--}}
{{--                                                    <label for="expiry_month">Expiry Month</label>--}}
{{--                                                    <input class="form-control" id="expiry_month" placeholder="MM" type="text">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4">--}}
{{--                                                <div class="form-group card-label">--}}
{{--                                                    <label for="expiry_year">Expiry Year</label>--}}
{{--                                                    <input class="form-control" id="expiry_year" placeholder="YY" type="text">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4">--}}
{{--                                                <div class="form-group card-label">--}}
{{--                                                    <label for="cvv">CVV</label>--}}
{{--                                                    <input class="form-control" id="cvv" type="text">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <!-- /Credit Card Payment -->

                                    <!-- Paypal Payment -->
                                    <div class="payment-list">
                                        <label class="payment-radio paypal-option">
                                            <input type="radio" name="payment_type" value="cod" checked>
                                            <span class="checkmark"></span>
                                            Pay Later
                                        </label>
                                    </div>
                                    <!-- /Paypal Payment -->

                                    <!-- Terms Accept -->
                                    <div class="terms-accept">
                                        <div class="custom-checkbox">
                                            <input type="checkbox" id="terms_accept">
                                            <label for="terms_accept">I have read and accept <a href="#">Terms &amp; Conditions</a></label>
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

                <div class="col-md-5 col-lg-4 theiaStickySidebar">

                    <!-- Booking Summary -->
                    <div class="card booking-card">
                        <div class="card-header">
                            <h4 class="card-title">Booking Summary</h4>
                        </div>
                        <div class="card-body">

                            <!-- Booking Doctor Info -->
                            <div class="booking-doc-info">
                                <a href="{{route('doctor.details',$slug)}}" class="booking-doc-img">
                                    <img src="{{asset('frontend/img/doctors/doctor-thumb-02.jpg')}}" alt="User Image">
                                </a>
                                <div class="booking-info">
                                    <h4><a href="{{route('doctor.details',$slug)}}">{{$doctorDetails->name}}</a></h4>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">35</span>
                                    </div>
{{--                                    <div class="clinic-details">--}}
{{--                                        <p class="doc-location"><i class="fas fa-map-marker-alt"></i> Newyork, USA</p>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                            <!-- Booking Doctor Info -->

                            <div class="booking-summary mt-4">
                                <div class="booking-item-wrap">
                                    <ul class="booking-date">
                                        <li>Date <span>{{$ds_slot->date}}</span></li>
                                        <li>Time <span>{{$ds_slot->time}}</span></li>
                                    </ul>
                                    <ul class="booking-fee">
                                        <li>Clinic <span>{{$clinic_user->name}}</span></li>
{{--                                        <li>Booking Fee <span>$10</span></li>--}}
{{--                                        <li>Video Call <span>$50</span></li>--}}
                                    </ul>
                                    <div class="booking-total">
                                        <ul class="booking-total-list">
                                            <li>
                                                <span>Total</span>
                                                <span class="total-cost">TK{{$visit_cost->visit_cost}}</span>
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
@stop
@push('js')

@endpush
