@extends('backend.layouts.admin.master')
@section('title', 'Service Category edit')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Test edit</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('admin.tests.index')}}">Test</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Test edit</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.tests.update',$test->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Test Name<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="name" value="{{$test->name}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Previous Price</label>
                                        <div class="col-md-10">
                                            <input type="text" value="{{$test->regular_price}}" name="regular_price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Price</label>
                                        <div class="col-md-10">
                                            <input type="text" name="price" value="{{$test->price}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Image</label>
                                        <div class="col-md-10">
                                            <img src="{{asset('uploads/test/'.$test->image)}}" alt="" width="100px;">
                                            <input type="file" name="image" class="form-control-file">
                                            <span>Width: 300px and Height: 300px (jpg)</span>
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
@push('js')

@endpush
