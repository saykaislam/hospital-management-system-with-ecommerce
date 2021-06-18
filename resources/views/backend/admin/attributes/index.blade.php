
@extends('backend.layouts.admin.master')
@section("title","Attribute")
@push('css')

@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Product Attribute</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Product Attribute</li>
                        </ul>
                    </div>
                    <div class="col-sm-5 col">
                        <a href="{{route('admin.attributes.create')}}" class="btn btn-primary float-right mt-2">Add New</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Recent Orders -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                                    <thead>
                                    <tr>
                                        <th>#Id</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($attributes as $key => $attribute)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$attribute->name}}</td>
                                            <td>{{$attribute->slug}}</td>
                                            <td>
                                                <a class="btn btn-info waves-effect" href="{{route('admin.attributes.edit',$attribute->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Recent Orders -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@stop
@push('js')

    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
