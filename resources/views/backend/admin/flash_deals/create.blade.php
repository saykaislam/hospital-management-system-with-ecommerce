@extends('backend.layouts.admin.master')
@section('title','Brand Create')
@push('css')
    <link rel="stylesheet" href="{{asset('backend/seller/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/seller/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('backend/seller/plugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('backend/seller/dist/css/spectrum.css')}}">
    <style>
        .input-group-addon {
            padding: 6px 2px;
            font-size: 20px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
        }
        .input-daterange .input-group-addon {
            width: auto;
            min-width: 21px;
            padding: 4px 19px;
            line-height: 1.42857143;
            border-width: 1px 0;
            margin-left: -5px;
            margin-right: -5px;
        }
    </style>
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-title">Add Flash Deal</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Flash Deal</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <a href="{{route('admin.flash_deals.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body custom-edit-service">
                            <!-- Add Medicine -->
                            <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.flash_deals.store')}}" enctype="multipart/form-data">
                                @csrf
                                <section class="content">
                                    <div class="row m-2">
                                        <div class="col-md-6 offset-md-3">
                                            <!-- general form elements -->
                                            <div class="card card-info card-outline">
                                                <p class="pl-2 pb-0 mb-0 bg-info">Flash Deals Info</p>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="name">Title</label>
                                                            <input type="text" class="form-control " name="title" id="name" placeholder="Enter Flash sales title"
                                                                   required>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <div id="demo-dp-range">
                                                                <label for="name">Select Date Range</label>
                                                                <div class="input-daterange input-group" id="datepicker">
                                                                    <input type="text" class="form-control" name="start_date" autocomplete="off" required>
                                                                    <span class="input-group-addon">To</span>
                                                                    <input type="text" class="form-control" name="end_date" autocomplete="off" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-success float-right">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </form>
                            <!-- /Add Medicine -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

@endsection
@push('js')
    <script src="{{asset('backend/seller/dist/js/spartan-multi-image-picker-min.js')}}"></script>
    <script src="{{asset('backend/seller/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/seller/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('backend/seller/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="{{asset('backend/seller/plugins/ckeditor/ckeditor.js')}}"></script>
{{--    <script src="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.js?key:MTg3NzpCRE5DQ01JSkgw"></script>--}}
    <script>
        $('.demo-select2').select2();
        $("#demo-dp-range .input-daterange").datepicker({
            startDate: "-0d",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
        });
    </script>
@endpush
