@extends('backend.layouts.admin.master')
@section('title', 'Service')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-7 col-auto">
                            <h3 class="page-title">Service </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Service</li>
                            </ul>
                        </div>
                        <div class="col-sm-5 col">
                            <a href="{{route('admin.services.create')}}" class="btn btn-primary float-right mt-2">Add</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>District</th>
                                            <th>Service Provider Category</th>
                                            <th>Service Category</th>
                                            <th>Service Sub Category</th>
                                            <th>Service</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                            <th>Icon</th>
                                            <th>Service Type</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($services as $key => $service)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$service->divisionDistrict ? $service->divisionDistrict->name : ''}}</td>
                                            <td>{{$service->serviceProviderCategory ? $service->serviceProviderCategory->name : ''}}</td>
                                            <td>{{$service->ServiceCategory ? $service->ServiceCategory->name : ''}}</td>
                                            <td>{{$service->ServiceSubCategory ? $service->ServiceSubCategory->name : ''}}</td>
                                            <td>{{$service->name}}</td>
                                            <td>{{$service->price}}</td>
                                            <td>
                                                @if(!empty($service->image))
                                                    <img src="{{asset('uploads/services/'.$service->image)}}" height="100px" width="100px"/>
                                                @else
                                                    <img src="{{asset('uploads/services/default.jpg')}}" height="100px" width="100px"/>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($service->icon))
                                                    <img src="{{asset('uploads/services/icon/'.$service->icon)}}" height="64px" width="64px"/>
                                                @else
                                                    <img src="{{asset('uploads/services/icon/default.png')}}" height="64px" width="64px"/>
                                                @endif
                                            </td>
                                            <td>{{$service->service_type}}</td>
                                            <td class="text-right">
                                                <div class="actions">
                                                    <a class="btn btn-sm bg-success-light" href="{{route('admin.services.edit',$service->id)}}">
                                                        <i class="fe fe-pencil"></i> Edit
                                                    </a>
{{--                                                    <a class="btn btn-sm bg-danger-light" data-toggle="modal" href="#delete_modal">--}}
{{--                                                        <i class="fe fe-trash"></i> Delete--}}
{{--                                                    </a>--}}
                                                </div>
                                                <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered" role="document" >
                                                        <form method="post" action="{{route('admin.services.destroy',$service->id)}}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <div class="modal-content">
                                                                <!--	<div class="modal-header">
                                                                        <h5 class="modal-title">Delete</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>-->
                                                                <div class="modal-body">
                                                                    <div class="form-content p-2">
                                                                        <h4 class="modal-title">Delete</h4>
                                                                        <p class="mb-4">Are you sure want to delete?</p>
                                                                        <button type="submit" class="btn btn-primary">Save </button>
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Wrapper -->


{{--        <!-- Add Modal -->--}}
{{--        <div class="modal fade" id="Add_Specialities_details" aria-hidden="true" role="dialog">--}}
{{--            <div class="modal-dialog modal-dialog-centered" role="document" >--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title">Add Brands</h5>--}}
{{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <form>--}}
{{--                            <div class="row form-row">--}}
{{--                                <div class="col-12 col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Brand Name</label>--}}
{{--                                        <input type="text" class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Image</label>--}}
{{--                                        <input type="file"  class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /ADD Modal -->--}}

{{--        <!-- Edit Details Modal -->--}}
{{--        <div class="modal fade" id="edit_specialities_details" aria-hidden="true" role="dialog">--}}
{{--            <div class="modal-dialog modal-dialog-centered" role="document" >--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h5 class="modal-title">Edit Specialities</h5>--}}
{{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <form>--}}
{{--                            <div class="row form-row">--}}
{{--                                <div class="col-12 col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Specialities</label>--}}
{{--                                        <input type="text" class="form-control" value="Cardiology">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Image</label>--}}
{{--                                        <input type="file"  class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /Edit Details Modal -->--}}

        <!-- Delete Modal -->
        <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document" >
                <div class="modal-content">
                    <!--	<div class="modal-header">
                            <h5 class="modal-title">Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>-->
                    <div class="modal-body">
                        <div class="form-content p-2">
                            <h4 class="modal-title">Delete</h4>
                            <p class="mb-4">Are you sure want to delete?</p>
                            <button type="button" class="btn btn-primary">Save </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Modal -->
    </div>

@endsection
@push('js')
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
