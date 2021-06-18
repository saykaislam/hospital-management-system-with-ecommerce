@extends('backend.layouts.admin.master')
@section('title','Shop Pages Edit')
@push('css')

@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-title">Edit Shop Pages</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Shop Pages</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <a href="{{route('admin.shop_pages.index')}}">
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
                            <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.shop_pages.update',$shop_page->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <fieldset>
                                    <div class="form-group">
                                        <label for="title">Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Page Name" value="{{$shop_page->name}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control"  rows="5">{!! $shop_page->description !!}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control" placeholder="Meta Title" value="{{$shop_page->meta_title}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="meta_description" class="form-control"  rows="2">{!! $shop_page->meta_description !!}</textarea>
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
