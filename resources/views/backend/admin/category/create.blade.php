@extends('backend.layouts.admin.master')
@section('title','Category Create')
@push('css')

@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-title">Add Category</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Category</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <a href="{{route('admin.category.index')}}">
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
                            <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.category.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="category">Category Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Category Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="icon">Icon <small>(size: 64 * 64 pixel)</small></label>
                                            <input type="file" class="form-control" name="icon" id="logo" >
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Meta Title</label>
                                            <input type="text" class="form-control" name="meta_title" id="phone" placeholder="Enter meta title">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_desc">Meta Description</label>
                                            <textarea name="meta_description" id="meta_desc" class="form-control"  rows="3"></textarea>
                                        </div>

                                        <div class="form-group dc-btnarea">
                                            <input type="submit" class="dc-btn" value="Save">
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
