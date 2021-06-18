@extends('backend.layouts.admin.master')
@section('title','User Profile')
@push('css')
    <link rel="stylesheet" href="{{asset('backend/dist/css/spectrum.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.css">
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">User Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="profile-header">
                        <div class="row align-items-center">
                            <div class="col-auto profile-image">
                                <a href="#">
                                    <img class="rounded-circle" alt="User Image" src="{{asset('uploads/profile_pic/user/'.$userInfo->image)}}">
                                </a>
                            </div>
                            <div class="col ml-md-n2 profile-user-info">
                                <h4 class="user-name mb-0">{{$userInfo->name}}</h4>
                                <h6 class="text-muted">{{$userInfo->phone}}</h6>
                                <h6 class="text-muted">{{$userInfo->email}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#user_info">User Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#edit_profile">Edit Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#edit_password">Edit Password</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content profile-tab-cont">

                        <!-- Personal Details Tab -->
                        <div class="tab-pane fade show active" id="user_info">

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10 col-lg-6">
                                            <form>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" value="{{$userInfo->name}}" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Phone</label>
                                                    <div class="col-md-9">
                                                        <input type="number" value="{{$userInfo->phone}}" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Email</label>
                                                    <div class="col-md-9">
                                                        <input type="email" value="{{$userInfo->email}}" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /Personal Details Tab -->
                        <div class="tab-pane fade show" id="edit_profile">

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10 col-lg-6">
                                            <form action="{{route('admin.user.profile.update',$userInfo->id)}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <h5 class="card-title">Edit Profile</h5>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="name" value="{{$userInfo->name}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Email</label>
                                                    <div class="col-md-9">
                                                        <input type="email" name="email" value="{{$userInfo->email}}" class="form-control">
                                                    </div>
                                                </div>

                                                {{--                                                <div class="form-group row">--}}
                                                {{--                                                    <label for="image" class="col-sm-3">Profile Image <small class="text-danger">(Photo size: 300x300 and below 100kb)</small></label>--}}
                                                {{--                                                    <div class="col-sm-9">--}}
                                                {{--                                                        <input type="file" name="image" class="form-control" >--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Change Password Tab -->
                        <div id="edit_password" class="tab-pane fade show">

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Edit Password</h5>
                                    <div class="row">
                                        <div class="col-md-10 col-lg-6">
                                            <form action="{{route('admin.user.password.update',$userInfo->id)}}" method="POST">
                                                @csrf
                                                <div class="form-group row">
                                                    <label class="col-md-3">New Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" name="password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Confirm Password</label>
                                                    <div class="col-md-9">
                                                        <input type="password" name="password_confirmation" class="form-control">
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Change Password Tab -->
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('backend/dist/js/spartan-multi-image-picker-min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.js?key:MTg3NzpCRE5DQ01JSkgw"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });

        Bkoi.onSelect(function () {
            // get selected data from dropdown list
            let selectedPlace = Bkoi.getSelectedData()
            console.log(selectedPlace)
            // center of the map
            document.getElementsByName("address")[0].value = selectedPlace.address;
            document.getElementsByName("city")[0].value = selectedPlace.city;
            document.getElementsByName("area")[0].value = selectedPlace.area;
            document.getElementsByName("latitude")[0].value = selectedPlace.latitude;
            document.getElementsByName("longitude")[0].value = selectedPlace.longitude;

        })
        $('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });

    </script>
@endpush
