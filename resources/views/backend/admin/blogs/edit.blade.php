@extends('backend.layouts.admin.master')
@section('title','Blog Edit')
@push('css')

@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-title">Edit Blog</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Blog</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <a href="{{route('admin.blogs.index')}}">
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
                            <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.blogs.update',$blog->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <fieldset>
                                    <div class="form-group">
                                        <label for="title">Blog Title</label>
                                        <input type="text" name="title" class="form-control" value="{{$blog->title}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Author</label>
                                        <input type="text" class="form-control" name="author" id="author" value="{{$blog->author}}">
                                    </div>
                                    <img src="{{url($blog->image)}}" width="100" height="80">
                                    <div class="form-group">
                                        <label for="image">Image <small>(size: 862 * 456 pixel)</small></label>
                                        <input type="file" class="form-control" name="image" id="image" >
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="5">{!! $blog->description !!}</textarea>
                                    </div>

                                    <div class="form-group dc-btnarea">
                                        <input type="submit" class="dc-btn btn-info" value="Update">
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
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'description' );
    </script>
@endpush
