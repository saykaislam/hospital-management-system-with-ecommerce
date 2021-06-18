@extends('backend.layouts.admin.master')
@section('title', 'Service Sub Category edit')
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
                            <h3 class="page-title">Service Sub Category edit</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('admin.clinicCategory.index')}}">Service Sub Category</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Service Sub Category edit</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.serviceSubCategory.update',$serviceSubCategories->id)}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Service Category Name<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select  name="service_category_id" class="form-control">
                                                <option>-- Select --</option>
                                                @foreach($serviceCategories as $cat)
                                                    <option value="{{$cat->id}}" {{$cat->id == $serviceSubCategories->service_category_id ? 'selected' : ''}}>{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Service Sub Category Name<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="name" value="{{$serviceSubCategories->name}}" class="form-control">
                                        </div>
                                    </div>
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-form-label col-md-2">Service Sub Category Route</label>--}}
{{--                                        <div class="col-md-10">--}}
{{--                                            <input type="text" name="route" value="{{$serviceSubCategories->route}}"  class="form-control">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Service Category Image</label>
                                        <div class="col-md-10">
                                            <img src="{{asset('uploads/service-sub-category/'.$serviceSubCategories->image)}}" alt="" width="100px;">
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
