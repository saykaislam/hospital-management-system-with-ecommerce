@extends('backend.layouts.admin.master')
@section('title', 'Service Provider Category edit')
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
                            <h3 class="page-title">Banner</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('admin.banner.index')}}">Banner</a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Banner edit</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.banner.update',$banner->id)}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Image 1</label>
                                        <div class="col-md-10">
                                            <img src="{{asset('uploads/banner/'.$banner->image_1)}}" alt="" width="300px;">
                                            <input type="file" name="image_1" class="form-control-file">
                                            <span>Width: 300px and Height: 168px (jpg)</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Image 2</label>
                                        <div class="col-md-10">
                                            <img src="{{asset('uploads/banner/'.$banner->image_2)}}" alt="" width="300px;">
                                            <input type="file" name="image_2" class="form-control-file">
                                            <span>Width: 300px and Height: 168px (jpg)</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Image 3</label>
                                        <div class="col-md-10">
                                            <img src="{{asset('uploads/banner/'.$banner->image_3)}}" alt="" width="300px;">
                                            <input type="file" name="image_3" class="form-control-file">
                                            <span>Width: 300px and Height: 168px (jpg)</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Title<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="title" class="form-control" value="{{$banner->title}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Sub Title<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="sub_title" class="form-control" value="{{$banner->sub_title}}">
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
