@extends('backend.layouts.user.master')
@section('title', 'Profile')
@push('css')
    {{--custom css--}}
@endpush
@section('content')

    <!-- Page Content -->
    <form action="{{route('user.basic.update')}}" method="post" enctype="multipart/form-data" >
        @csrf
    <!-- Basic Information -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Basic Information</h4>
            <div class="row form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Username <span class="text-danger">*</span></label>
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}" class="form-control">
                        <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone"  value="{{Auth::user()->phone}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="change-avatar">
                            <div class="profile-img">
                                <img src="{{asset('uploads/profile_pic/user/'.Auth::user()->image)}}" alt="User Image">
                            </div>
                            <div class="upload-img">
                                <div class="change-photo-btn">
                                    <span><i class="fa fa-upload"></i> Upload Photo</span>
                                    <input type="file" name="image" class="upload">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Basic Information -->
    <div class="submit-section submit-btn-bottom">
        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
    </div>
    </form>
    <!-- /Page Content -->
@stop
@push('js')
    <!-- Select2 JS -->
    <script src="{{asset('backend/user/select2/js/select2.min.js')}}"></script>

    <!-- Dropzone JS -->
    <script src="{{asset('backend/user/dropzone/dropzone.min.js')}}"></script>

    <!-- Bootstrap Tagsinput JS -->
    <script src="{{asset('backend/user/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"></script>

    <!-- Profile Settings JS -->
    <script src="{{asset('backend/user/js/profile-settings.js')}}"></script>
@endpush
