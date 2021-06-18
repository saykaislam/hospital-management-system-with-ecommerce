@extends('backend.layouts.admin.master')
@section("title","Advertisement List")
@push('css')

@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Advertisement List</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Advertisement</li>
                        </ul>
                    </div>
                    <div class="col-sm-5 col">
                        <a href="{{route('admin.advertisements.create')}}" class="btn btn-primary float-right mt-2">Add New</a>
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
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($advertisements as $key => $advertisement)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$advertisement->title}}</td>
                                            <td>
                                                <img src="{{url($advertisement->image)}}" width="70" height="60" alt="">
                                            </td>
                                            <td>
                                                <a class="btn btn-info waves-effect" href="{{route('admin.advertisements.edit',$advertisement->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger waves-effect" type="button"
                                                        onclick="deleteAd({{$advertisement->id}})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{$advertisement->id}}" action="{{route('admin.advertisements.destroy',$advertisement->id)}}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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
