@extends('backend.layouts.admin.master')
@section('title','Shop Slider Edit')
@push('css')
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-title">Edit Slider</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Slider</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <a href="{{route('admin.sliders.index')}}">
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
                            <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.sliders.update',$slider->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <fieldset>
                                    <img src="{{url($slider->image)}}" width="100" height="60">
                                    <div class="form-group">
                                        <label for="image">Image <small>(size: 1349 * 420 pixel)</small></label>
                                        <input type="file" class="form-control" name="image" id="image" >
                                    </div>
                                    <div class="form-group">
                                        <label for="url">URL</label>
                                        <input type="text" name="url" class="form-control" value="{{$slider->url}}" placeholder="Enter URl">
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
