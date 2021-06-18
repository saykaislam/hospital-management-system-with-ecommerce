@extends('backend.layouts.admin.master')
@section('title', 'Service Category create')
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
                            <h3 class="page-title">Service Category Create</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('admin.serviceCategory.index')}}">Service Category</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Service Category Create</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.serviceCategory.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Service Provider Category<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select  name="service_provider_category_id" class="form-control" required>
                                                <option>--Select--</option>
                                                @foreach($serviceProviderCategories as $serviceProviderCategory)
                                                    <option value="{{$serviceProviderCategory->id}}">{{$serviceProviderCategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Service Category Name<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Service Category Image</label>
                                        <div class="col-md-10">
                                            <input type="file" name="image" class="form-control-file">
                                            <span>Width: 300px and Height: 300px (jpg)</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Service Category Icon</label>
                                        <div class="col-md-10">
                                            <input type="file" name="icon" class="form-control-file">
                                            <span>Width: 64px and Height: 64px (png)</span>
                                        </div>
                                    </div>
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-form-label col-md-2">Service Category Route</label>--}}
{{--                                        <div class="col-md-10">--}}
{{--                                            <input type="text" name="route" class="form-control">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
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

@endpush
