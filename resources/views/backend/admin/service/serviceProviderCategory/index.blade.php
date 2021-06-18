@extends('backend.layouts.admin.master')
@section('title', 'Service Provider Category')
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
                            <h3 class="page-title">Service Provider Category</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Service Provider Category</li>
                            </ul>
                        </div>
                        <div class="col-sm-5 col">
                            <a href="{{route('admin.serviceProviderCategory.create')}}" class="btn btn-primary float-right mt-2">Add</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="order" class="table" style="width:100%;overflow-x:auto;">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Service Provider Category Name</th>
                                            <th>Image</th>
{{--                                            <th>Doctor Department Slug</th>--}}
                                            <th class="text-right">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($serviceProviderCategories as $key => $serviceProviderCategory)
                                        <tr>
                                            <td>#{{$key + 1}}</td>
                                            <td>{{$serviceProviderCategory->name}}</td>
                                            <td>
                                                @if(!empty($serviceProviderCategory->image))
                                                    <img src="{{asset('uploads/service-provider-category/'.$serviceProviderCategory->image)}}" height="100px" width="100px"/>
                                                @else
                                                    <img src="{{asset('uploads/service-provider-category/default.jpg')}}" height="100px" width="100px"/>
                                                @endif
                                            </td>
{{--                                            <td>{{$doctor_department->slug}}</td>--}}
                                            <td class="text-right">
                                                <div class="actions">
                                                    <a class="btn btn-sm bg-success-light" href="{{route('admin.serviceProviderCategory.edit',$serviceProviderCategory->id)}}">
                                                        <i class="fe fe-pencil"></i> Edit
                                                    </a>
{{--                                                    <a class="btn btn-sm bg-danger-light disabled" data-toggle="modal" href="#delete_modal">--}}
{{--                                                        <i class="fe fe-trash"></i> Delete--}}
{{--                                                    </a>--}}
                                                </div>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered" role="document" >
                                                        <form method="post" action="{{route('admin.serviceProviderCategory.destroy',$serviceProviderCategory->id)}}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <div class="modal-content">
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
                                                <!-- /Delete Modal -->
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

    </div>

@endsection
@push('js')
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
