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
                        <h3 class="page-title">Settings</h3>
{{--                        <ul class="breadcrumb">--}}
{{--                            <li class="breadcrumb-item active">Dashboard</li>--}}
{{--                        </ul>--}}
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="#"  onclick="configCache()">
                                <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-primary border-primary">
                                                <i class="fa fa-rocket"></i>
                                            </span>
                                    <div class="dash-count">
                                        <h4>Site Optimise</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('admin.cache.clear')}}">
                                <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-success">
                                                <i class="fa fa-plane"></i>
                                            </span>
                                    <div class="dash-count">
                                        <h4>Site Cache Clear</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('admin.view.cache')}}">
                                <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-warning border-warning">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                    <div class="dash-count">
                                        <h4>View Cache</h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('admin.view.clear')}}">
                                <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-danger border-danger">
                                                <i class="fa fa-eye"></i>
                                            </span>
                                    <div class="dash-count">
                                        <h4>View Clear</h4>
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
                        <a href="{{route('admin.route.clear')}}">
                            <div class="dash-widget-header">
                                            <span class="dash-widget-icon text-dark border-dark">
                                                <i class="fa fa-road"></i>
                                            </span>
                                <div class="dash-count">
                                    <h4>Route Clear</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">


                </div>
            </div>

        </div>
    </div>
@endsection
@push('js')
    <script>
        function configCache(){
            $.ajax({
                url: "{{url('/admin/config-cache')}}",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    console.log(res);
                    toastr.success('Site Successfully Optimized');
                }
            });
        }

    </script>
@endpush
