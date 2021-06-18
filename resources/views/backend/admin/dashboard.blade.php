@extends('backend.layouts.admin.master')
@section('title', 'Dashboard')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <div class="page-wrapper">

        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome Admin!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('admin.Doctor.index')}}">
                                <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-primary border-primary">
                                                <i class="fe fe-users"></i>
                                            </span>
                                    <div class="dash-count">
                                        <h3>{{count($total_doctors)}}</h3>
                                    </div>
                                </div>
                                <div class="dash-widget-info">
                                    <h6 class="text-muted">Doctors</h6>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary w-50"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('admin.user-list')}}">
                                <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-success">
                                                <i class="fe fe-credit-card"></i>
                                            </span>
                                    <div class="dash-count">
                                        <h3>{{count($total_users)}}</h3>
                                    </div>
                                </div>
                                <div class="dash-widget-info">

                                    <h6 class="text-muted">Users</h6>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success w-50"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('admin.serviceProvider-list')}}">
                                <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-warning border-warning">
                                                <i class="fe fe-folder"></i>
                                            </span>
                                    <div class="dash-count">
                                        <h3>{{count($total_service_providers)}}</h3>
                                    </div>
                                </div>
                                <div class="dash-widget-info">

                                    <h6 class="text-muted">Service Provider</h6>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning w-50"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('admin.product.order')}}">
                                <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-danger border-danger">
                                                <i class="fe fe-money"></i>
                                            </span>
                                    <div class="dash-count">
                                        <h3>{{count($total_product_orders)}}</h3>
                                    </div>
                                </div>
                                <div class="dash-widget-info">

                                    <h6 class="text-muted">Product Orders</h6>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-danger w-50"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('admin.service.order')}}">
                            <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-primary border-primary">
                                                <i class="fe fe-users"></i>
                                            </span>
                                <div class="dash-count">
                                    <h3>{{count($total_service_orders)}}</h3>
                                </div>
                            </div>
                            <div class="dash-widget-info">
                                <h6 class="text-muted">Service Orders</h6>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-primary w-50"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </div>
    @endsection
@push('js')

@endpush
