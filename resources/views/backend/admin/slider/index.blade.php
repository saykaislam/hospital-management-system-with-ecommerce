@extends('backend.layouts.admin.master')
@section("title","Shop Sliders")
@push('css')

@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Shop Sliders</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sliders</li>
                        </ul>
                    </div>
                    <div class="col-sm-5 col">
                        <a href="{{route('admin.sliders.create')}}" class="btn btn-primary float-right mt-2">Add New</a>
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
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sliders as $key => $slider)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>
                                                <img src="{{url($slider->image)}}" width="80" height="50">
                                            </td>
                                            <td>
                                                <a class="btn btn-info waves-effect" href="{{route('admin.sliders.edit',$slider->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger waves-effect" type="button"
                                                        onclick="deleteSlider({{$slider->id}})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{$slider->id}}" action="{{route('admin.sliders.destroy',$slider->id)}}" method="POST" style="display: none;">
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
