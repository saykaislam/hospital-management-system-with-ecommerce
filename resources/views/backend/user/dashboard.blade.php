@extends('backend.layouts.user.master')
@section('title', 'Dashboard')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card dash-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <a href="{{route('user.service.order')}}">
                                <div class="dash-widget dct-border-rht text-center">
                                    <div class="circle-bar circle-bar1">
                                        <div class="circle-graph1" data-percent="75">
                                            <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/g_collection_png/standard/512x512/shopping_cart.png" class="img-fluid" alt="patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Service Order</h6>
                                        <h3>{{$count_service_order}}</h3>
                                        <p class="text-muted">Till Today</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <a href="{{route('user.clinic.doctor.appointment')}}">
                                <div class="dash-widget dct-border-rht text-center">
                                    <div class="circle-bar circle-bar3">
                                        <div class="circle-graph3" data-percent="50">
                                            <img src="{{asset('backend/user/img/icon-03.png')}}" class="img-fluid" alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Doctor Appointments Order</h6>
                                        <h3>{{$count_appointment_clinic_doctor}}</h3>
                                        <p class="text-muted">Till Today</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <a href="{{route('user.product.order')}}">
                                <div class="dash-widget dct-border-rht text-center">
                                    <div class="circle-bar circle-bar2">
                                        <div class="circle-graph2" data-percent="65">
                                            <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/g_collection_png/standard/512x512/shopping_cart.png" class="img-fluid" alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Product Order</h6>
                                        <h3>{{$count_product_order}}</h3>
                                        <p class="text-muted">Till Today</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card dash-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <a href="{{route('user.lab.test.order')}}">
                                <div class="dash-widget dct-border-rht text-center">
                                    <div class="circle-bar circle-bar3">
                                        <div class="circle-graph3" data-percent="50">
                                            <img src="{{asset('backend/user/img/icon-03.png')}}" class="img-fluid" alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Lab Test Order</h6>
                                        <h3>{{$count_labtest_order_info}}</h3>
                                        <p class="text-muted">Till Today</p>
                                    </div>
                                </div>
                            </a>
                        </div>
{{--                        <div class="col-md-12 col-lg-4">--}}
{{--                            <a href="javascript:void(0)">--}}
{{--                                <div class="dash-widget dct-border-rht text-center">--}}
{{--                                    <div class="circle-bar circle-bar3">--}}
{{--                                        <div class="circle-graph3" data-percent="50">--}}
{{--                                            <img src="{{asset('backend/user/img/icon-03.png')}}" class="img-fluid" alt="Patient">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="dash-widget-info">--}}
{{--                                        <h6>Caregiver Appointments</h6>--}}
{{--                                        <h3>0</h3>--}}
{{--                                        <p class="text-muted">Till Today</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@push('js')

@endpush
