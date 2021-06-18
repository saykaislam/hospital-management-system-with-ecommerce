@extends('backend.layouts.admin.master')
@section('title', 'Service edit')
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
                            <h3 class="page-title">Service edit</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('admin.services.index')}}">Service</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Service edit</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.services.update',$services->id)}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Service Provider Category Name<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select  name="service_provider_category_id" id="service_provider_category_id" class="form-control">
                                                <option>-- Select --</option>
                                                @foreach($serviceProviderCategories as $serviceProviderCategory)
                                                    <option value="{{$serviceProviderCategory->id}}"{{$serviceProviderCategory->id == $services->service_provider_category_id ? 'selected' : ''}}>{{$serviceProviderCategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Service Category Name<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select  name="service_category_id" id="service_category_id" class="form-control ">
                                                <option>-- Select --</option>
                                                @foreach($serviceCategories as $cat)
                                                    <option value="{{$cat->id}}"{{$cat->id == $services->service_category_id ? 'selected' : ''}}>{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Service Sub Category Name</label>
                                        <div class="col-md-10">
                                            <select  name="service_sub_category_id" id="service_sub_category_id" class="form-control ">
                                                <option>-- Select --</option>
                                                @foreach($serviceSubCategories as $cat)
                                                    <option value="{{$cat->id}}"{{$cat->id == $services->service_sub_category_id ? 'selected' : ''}}>{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Service Name <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="name" value="{{$services->name}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Price</label>
                                        <div class="col-md-10">
                                            <input type="text" name="price" value="{{$services->price}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Service Type</label>
                                        <div class="col-md-10">
                                            <select name="service_type" class="form-control" required>
                                                <option value="Hot Service" {{$services->service_type == 'Hot Service' ? 'selected' : ''}}>Hot Service</option>
                                                <option value="Popular Service" {{$services->service_type == 'Popular Service' ? 'selected' : ''}}>Popular Service</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">District</label>
                                        <div class="col-md-10">
                                            <select class="select form-control" name="division_district_id">
                                                <option value="">Select District</option>
                                                @if(!empty($divisionDistricts))
                                                    @foreach($divisionDistricts as $divisionDistrict)
                                                        <option value="{{$divisionDistrict->id}}" {{ $divisionDistrict->id == $services->division_district_id ? 'selected' : '' }}>{{$divisionDistrict->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Image</label>
                                        <div class="col-md-10">
                                            <img src="{{asset('uploads/services/'.$services->image)}}" alt="" width="100px;">
                                            <input type="file" name="image" class="form-control-file">
                                            <span>Width: 300px and Height: 300px (jpg)</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Service Icon</label>
                                        <div class="col-md-10">
                                            <img src="{{asset('uploads/services/icon/'.$services->icon)}}" alt="" width="100px;">
                                            <input type="file" name="icon" class="form-control-file">
                                            <span>Width: 64px and Height: 64px (png)</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Description</label>
                                        <div class="col-lg-10">
                                            <textarea rows="4" id="description" cols="5" class="form-control" name="description" placeholder="Enter message">{!! $services->description !!}</textarea>
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
    <script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    <script>
        $('#service_provider_category_id').change(function(){
            var service_provider_category_id = $(this).val();
            console.log(service_provider_category_id);
            $.ajax({
                url : "{{URL('service-category-list-dropdown')}}",
                method : "get",
                data : {
                    service_provider_category_id : service_provider_category_id
                },
                success : function (res){
                    console.log(res)
                    $('#service_category_id').html(res.data)
                },
                error : function (err){
                    console.log(err)
                }
            })
        })


        $('#service_category_id').change(function(){
            var service_category_id = $(this).val();
            $.ajax({
                url : "{{URL('service-sub-category-list')}}",
                method : "get",
                data : {
                    service_category_id : service_category_id
                },
                success : function (res){
                    console.log(res)
                    $('#service_sub_category_id').html(res.data)
                },
                error : function (err){
                    console.log(err)
                }
            })
        })
    </script>
@endpush
