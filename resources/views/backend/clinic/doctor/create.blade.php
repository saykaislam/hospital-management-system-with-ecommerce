@extends('backend.layouts.clinic.master')
@section('title', 'Doctor')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Doctor Create</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('clinic.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('clinic.doctor.list')}}">Doctor</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Doctor Create</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('clinic.doctor.store')}}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Name<span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input type="name" name="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Phone<span class="text-danger">*</span></label>
                                        <div class="col-md-6">
                                            <input type="number" name="phone" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Password</label>
                                        <div class="col-lg-6">
                                                <input type="password" name="password" id="pwd" class="form-control input-lg" placeholder="Enter Password" required/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-eye-close" style="cursor:pointer;float:left;padding-top:15px;padding-left: 0px;margin-left: -7px;"></span>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2"></label>
                                        <div class="col-lg-10">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $(".glyphicon").bind("click", function() {
                if ($('#pwd').attr('type') =='password'){
                    $('#pwd').attr('type','text');
                    $('.glyphicon').removeClass('glyphicon-eye-open');
                    $('.glyphicon').addClass('glyphicon-eye-close');
                }else if($('#pwd').attr('type') =='text'){
                    $('#pwd').attr('type','password');
                    $('.glyphicon').removeClass('glyphicon-eye-close');
                    $('.glyphicon').addClass('glyphicon-eye-open');
                }
            })
        });
    </script>
@endpush
