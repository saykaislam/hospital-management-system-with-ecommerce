@extends('backend.layouts.clinic.master')
@section('title', 'Update Blood Bank')
@section('content')
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Blood Bank Update</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('clinic.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('clinic.blood-bank.index')}}">Blood Bank</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Blood Bank Update</h4>
                            </div>
                            <div class="card-body">
{{--                                <form action="{{route('clinic.blood-bank.update',$blood_edt->id)}}" method="post">--}}
{{--                                    @csrf--}}
{{--                                    @method('PUT')--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-form-label col-md-2">Blood Group<span class="text-danger">*</span></label>--}}
{{--                                        <div class="col-md-10">--}}
{{--                                            <select  name="name" id="name" class="form-control">--}}
{{--                                                <option>{{ $blood_edt->name }}</option>--}}
{{--                                                <option>A+</option>--}}
{{--                                                <option>A-</option>--}}
{{--                                                <option>B+</option>--}}
{{--                                                <option>B-</option>--}}
{{--                                                <option>O+</option>--}}
{{--                                                <option>O-</option>--}}
{{--                                                <option>AB+</option>--}}
{{--                                                <option>AB-</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-form-label col-md-2">Quantity<span class="text-danger">*</span></label>--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <input type="number" name="quantity" value="{{$blood_edt->quantity}}" class="form-control">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-form-label col-md-2"></label>--}}
{{--                                        <div class="col-lg-10">--}}
{{--                                            <button type="submit" class="btn btn-primary">Submit</button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
                                <form action="{{route('clinic.blood-bank.update',$blood_edt->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Quantity<span class="text-danger">*</span></label>
                                        <div class="col-md-4">
                                            <input type="number" name="quantity" class="form-control" value="{{$blood_edt->quantity}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2"></label>
                                        <div class="col-lg-10">
                                            <button type="submit" class="btn btn-primary">Update</button>
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

