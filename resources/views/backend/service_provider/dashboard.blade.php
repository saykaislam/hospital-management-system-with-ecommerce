@extends('backend.layouts.service_provider.master')
@section('title', 'Dashboard')
@push('css')
    {{--custom css--}}
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">--}}

@endpush
@section('content')
    @if(empty($serviceProviderDetails) && empty($service_provider_contact))
    <div class="row">
        <div class="col-md-12">
            <div class="card dash-card">
                <div class="card-body">
                    <div class="row">
                        <h1>
                            Profile update not completed! Please fill up your profile step by step, to show your services to users.
                            <a href="{{route('service_provider.profile')}}" class="btn btn-info btn-block" role="button">Update Profile settings</a>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="container">--}}
{{--        <h2>Colored Progress Bars</h2>--}}
{{--        <p>The contextual classes color the progress bars:</p>--}}
{{--        <div class="progress">--}}
{{--            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">--}}
{{--                40% Complete (success)--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="progress">--}}
{{--            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">--}}
{{--                50% Complete (info)--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="progress">--}}
{{--            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">--}}
{{--                60% Complete (warning)--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="progress">--}}
{{--            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">--}}
{{--                70% Complete (danger)--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card dash-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <a href="{{route('service_provider.order')}}">
                                <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar1">
                                        <div class="circle-graph1" data-percent="75">
                                            <img src="{{asset('backend/user/img/icon-01.png')}}" class="img-fluid" alt="patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Order</h6>
                                        <h3>{{count($all_orders)}}</h3>
                                        <p class="text-muted">{{date('Y-m-d')}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <a href="{{route('service_provider.order.today')}}">
                                <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar2">
                                        <div class="circle-graph2" data-percent="65">
                                            <img src="{{asset('backend/user/img/icon-02.png')}}" class="img-fluid" alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Today Order</h6>
                                        <h3>{{count($today_orders)}}</h3>
                                        <p class="text-muted">{{date('Y-m-d')}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <a href="{{route('service_provider.order.booking')}}">
                                <div class="dash-widget">
                                    <div class="circle-bar circle-bar3">
                                        <div class="circle-graph3" data-percent="50">
                                            <img src="{{asset('backend/user/img/icon-03.png')}}" class="img-fluid" alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Bookings</h6>
                                        <h3>{{count($booking_orders)}}</h3>
                                        <p class="text-muted">{{date('Y-m-d')}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@push('js')

@endpush
