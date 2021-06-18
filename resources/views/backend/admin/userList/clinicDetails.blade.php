@extends('backend.layouts.admin.master')
@section('title', 'Service Provider Details')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-7 col-auto">
                            <h3 class="page-title">Clinic Details </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Clinic Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-table">
                        <h3 style="text-align: center;color: #007bff">Clinic Details</h3>
                        <div class="card-body">
                        @if(!empty($clinicDetails))
                            <!-- Invoice Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <tbody>
                                        <tr>
                                            <th>Clinic Category</th>
                                            <td>{{$clinicDetails->clinicCategory->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Rating</th>
                                            <td>{{$clinicDetails->rating}}</td>
                                        </tr>
                                        <tr>
                                            <th>Emergency Phone</th>
                                            <td>{{$clinicDetails->emergency_phone}}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{{$clinicDetails->description}}</td>
                                        </tr>
                                        <tr>
                                            <th>Verification</th>
                                            <td> <img src="{{asset('uploads/profile_pic/clinic/'.$verification->image)}}" alt="User Image"></td>
                                        </tr>
                                        <tr>
                                            <th>Active/Inactive</th>
                                            <td>{{$clinicDetails->is_active == 1 ? 'Active' : 'Inactive'}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /Invoice Table -->
                            @else
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <h3>NO Details Data Found For This Provider</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-table">
                        <h3 style="text-align: center;color: #007bff">Clinic Contacts</h3>
                        <div class="card-body">
                        @if(!empty($serviceProviderContacts))
                            <!-- Invoice Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <tbody>
                                        <tr>
                                            <th>Address</th>
                                            <td>{{$serviceProviderContacts->address}}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>{{$serviceProviderContacts->gender}}</td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <td>{{$serviceProviderContacts->city}}</td>
                                        </tr>
                                        <tr>
                                            <th>State Or Province</th>
                                            <td>{{$serviceProviderContacts->state_or_province}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /Invoice Table -->
                            @else
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <h3>NO Contact Data Found For This Provider</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Wrapper -->
    </div>

@endsection
@push('js')

@endpush
