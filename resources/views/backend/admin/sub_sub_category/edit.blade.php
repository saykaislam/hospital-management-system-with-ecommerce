@extends('backend.layouts.admin.master')
@section('title','Sub Sub Category Edit')
@push('css')

@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-title">Edit Sub Sub Category</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Sub Sub Category</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <a href="{{route('admin.subsubcategory.index')}}">
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
                            <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.subsubcategory.update',$subsubcategory->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <fieldset>
                                    <div class="form-group">
                                        <label for="name">Sub Sub Category Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$subsubcategory->name}}">
                                    </div>
                                    <div class="form-group ">
                                        <label for="sub_category_id">Change Category</label>
                                        <select name="sub_category_id" id="" class="form-control">
                                            @foreach($subcategory as $cat)
                                                <option {{$subsubcategory->sub_category_id == $cat->id ? 'selected' : ''}}  value="{{$cat->id}}">{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{$subsubcategory->meta_title}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_desc">Meta Description</label>
                                        <textarea name="meta_description" id="meta_desc" class="form-control"  rows="3">{{$subsubcategory->meta_description}}</textarea>
                                    </div>

                                    <div class="form-group ">
                                        <input type="submit" class="btn btn-secondary" value="Update">
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

@endsection
@push('js')

@endpush
