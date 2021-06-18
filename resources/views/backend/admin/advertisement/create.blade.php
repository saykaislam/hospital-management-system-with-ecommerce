@extends('backend.layouts.admin.master')
@section('title','Advertisement Create')
@push('css')

@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-title">Add Advertisement</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Advertisement</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <a href="{{route('admin.advertisements.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body custom-edit-service">
                            <!-- Add Medicine -->
                            <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.advertisements.store')}}" enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <div class="form-group">
                                        <label for="title">Advertisement Name</label>
                                        <input type="text" name="title" class="form-control" placeholder="Enter Advertisement Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image <small>(size: 270 * 132 pixel)</small></label>
                                        <input type="file" class="form-control" name="image" id="image" >
                                    </div>
                                    <div class="form-group dc-btnarea">
                                        <input type="submit" class="btn btn-info" value="Save">
                                    </div>
                                </fieldset>
                            </form>
                            <!-- /Add Medicine -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

@endsection
@push('js')

@endpush
