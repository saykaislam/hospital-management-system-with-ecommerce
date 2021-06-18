@extends('backend.layouts.clinic.master')
@section('title', 'Profile')
@push('css')
    <!-- barikoi -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin="" />
    <!-- barikoi -->
    {{--custom css--}}
    <style>
        body {

            font-family: 'Open Sans', sans-serif;

        }
        h1 {
            text-align: center;
        }
    </style>
@endpush
@section('content')

    <!-- Page Content -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profile</h4>
                <div class="appointment-tab">

                    <!-- Profile Tab -->
                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                        <li class="nav-item">
                            <a class="nav-link active" href="#basic-information" data-toggle="tab">Basic</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#clinic-information" data-toggle="tab">Details</a>
                        </li>
                        @if(!empty($clinicDetails))
                            <li class="nav-item">
                                <a class="nav-link" href="#contact-details" data-toggle="tab">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#open-close" data-toggle="tab">Open Close</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#clinic-verification" data-toggle="tab">Verification</a>
                            </li>
                        @endif
                    </ul>
                    <!-- /Profile Tab -->

                    <div class="tab-content">

                        <!-- Basic-Information Tab -->
                        <div class="tab-pane show active" id="basic-information">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <form action="{{route('clinic.basic.update')}}" method="post" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="row form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name <span class="text-danger">*</span></label>
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
                                                    <input type="text" name="phone" value="{{Auth::user()->phone}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="change-avatar">
                                                        <div class="profile-img">
                                                            <img src="{{asset('uploads/profile_pic/clinic/'.Auth::user()->image)}}" alt="User Image">
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
                                        <div class="submit-section submit-btn-bottom text-center">
                                            <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Basic-Information Tab -->

                        <!-- Clinic Details Tab -->
                        <div class="tab-pane" id="clinic-information">
                            <div class="card mb-0">
                                <div class="card-body">
                                    @if(empty($clinicDetails))
                                        <form action="{{route('clinic.details.insert')}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}" class="form-control">
                                            <div class="row form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Clinic Category <span class="text-danger">*</span></label>
                                                        <select class="select form-control specialist-select-area" name="clinic_category_id">
                                                            <option value="">Select</option>
                                                            @foreach($clinicCategoryLists as $clinicCategoryList)
                                                                <option value="{{$clinicCategoryList->id}}">{{$clinicCategoryList->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Rating</label>
                                                        <input type="text" name="rating" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Opens Time</label>
                                                        <input type="text" name="opens_time" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Emergency Phone</label>
                                                        <input type="text" name="emergency_phone" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Is Active</label>
                                                        <select class="select form-control" name="is_active">
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Description</label>
                                                        <textarea class="form-control" rows="3" cols="" name="description"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="submit-section submit-btn-bottom text-center">
                                                <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                            </div>
                                        </form>
                                    @else
                                        <form action="{{route('clinic.details.update')}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}" class="form-control">
                                            <div class="row form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Clinic Category <span class="text-danger">*</span></label>
                                                        <input type="hidden" name="clinic_id" class="form-control" value="{{$clinicDetails->id}}">
                                                        <select class="select form-control specialist-select-area" name="clinic_category_id">
                                                            <option value="">Select</option>
                                                            @foreach($clinicCategoryLists as $clinicCategoryList)
                                                                <option value="{{$clinicCategoryList->id}}" {{ $clinicCategoryList->id  ==  $clinicDetails->clinic_category_id ? 'selected' : ''}}>{{$clinicCategoryList->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Rating</label>
                                                        <input type="text" name="rating" class="form-control" value="{{$clinicDetails->rating}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Opens Time</label>
                                                        <input type="text" name="opens_time" class="form-control" value="{{$clinicDetails->opens_time}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Emergency Phone</label>
                                                        <input type="text" name="emergency_phone" class="form-control" value="{{$clinicDetails->emergency_phone}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="control-label">Is Active</label>
                                                        <select class="select form-control" name="is_active">
                                                            <option value="1" {{$clinicDetails->is_active == 1 ? 'selected' : ''}}>Yes</option>
                                                            <option value="0" {{$clinicDetails->is_active == 0 ? 'selected' : ''}}>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Description</label>
                                                        <textarea class="form-control" rows="3" cols="" name="description">{{$clinicDetails->description}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="submit-section submit-btn-bottom text-center">
                                                <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /Clinic Details Tab -->

                        @if(!empty($clinicDetails))
                        <!-- Contact Tab -->
                            <div class="tab-pane" id="contact-details">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        @if(empty($clinicContact))
                                            <form action="{{route('clinic.contact.insert')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="clinic_id" value="{{$clinicDetails->id}}" class="form-control">
                                                <div class="row form-row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">District</label>
                                                            <select class="select form-control" name="division_district_id">
                                                                <option value="">Select District</option>
                                                                @if(!empty($divisionDistricts))
                                                                    @foreach($divisionDistricts as $divisionDistrict)
                                                                        <option value="{{$divisionDistrict->id}}">{{$divisionDistrict->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Address </label>
                                                            <input type="text" name="address" class="bksearch">
                                                            <div class="bklist">
                                                            </div>
                                                            <input type="hidden" name="city">
                                                            <input type="hidden" name="area">
                                                            <input type="hidden" name="latitude">
                                                            <input type="hidden" name="longitude">
                                                            <input type="hidden" name="postcode">
                                                            <div id="map" style="height: 400px;display: none;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{route('clinic.contact.update')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="clinic_id" value="{{$clinicDetails->id}}" class="form-control">
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">District</label>
                                                            <select class="select form-control" name="division_district_id">
                                                                <option value="">Select District</option>
                                                                @if(!empty($divisionDistricts))
                                                                    @foreach($divisionDistricts as $divisionDistrict)
                                                                        <option value="{{$divisionDistrict->id}}" {{ $divisionDistrict->id == $clinicContact->division_district_id ? 'selected' : '' }}>{{$divisionDistrict->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Address </label>
                                                            <input type="hidden" name="doctor_contact_id" class="form-control" value="{{$clinicContact->id}}">
                                                            <input type="text" name="address" value="{{$clinicContact->address}}" class="bksearch">
                                                            <div class="bklist">
                                                            </div>
                                                            <input type="hidden" name="city">
                                                            <input type="hidden" name="area">
                                                            <input type="hidden" name="latitude">
                                                            <input type="hidden" name="longitude">
                                                            <input type="hidden" name="postcode">
                                                            <div id="map" style="height: 400px;display: none;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Lat</label>
                                                            <input type="text" class="form-control" value="{{$clinicContact->lat}}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Lng</label>
                                                            <input type="text" class="form-control" value="{{$clinicContact->lng}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /Contact Tab -->

                            <!-- Open Close Tab -->
                            <div class="tab-pane" id="open-close">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        @if($clinicOpenClose == NULL)
                                            <form action="{{route('clinic.openClose.insert')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="clinic_id" value="{{$clinicDetails->id}}" class="form-control">
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Day</label>
                                                            <input type="text" class="form-control" name="day[]" value="Sunday" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Open Close Status</label>
                                                            <select class="select form-control" name="open_close_status[]" required>
                                                                <option value="">Select</option>
                                                                <option value="Open">Open</option>
                                                                <option value="Close">Close</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Open Time</label>
                                                            <input type="text" class="form-control" name="open_time[]" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Close Time</label>
                                                            <input type="text" class="form-control" name="close_time[]" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="day[]" value="Monday" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="select form-control" name="open_close_status[]" required>
                                                                <option value="">Select</option>
                                                                <option value="Open">Open</option>
                                                                <option value="Close">Close</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="open_time[]" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="close_time[]" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="day[]" value="Tuesday" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="select form-control" name="open_close_status[]" required>
                                                                <option value="">Select</option>
                                                                <option value="Open">Open</option>
                                                                <option value="Close">Close</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="open_time[]" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="close_time[]" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="day[]" value="Wednesday" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="select form-control" name="open_close_status[]" required>
                                                                <option value="">Select</option>
                                                                <option value="Open">Open</option>
                                                                <option value="Close">Close</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="open_time[]" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="close_time[]" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="day[]" value="Thursday" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="select form-control" name="open_close_status[]" required>
                                                                <option value="">Select</option>
                                                                <option value="Open">Open</option>
                                                                <option value="Close">Close</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="open_time[]" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="close_time[]" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="day[]" value="Friday" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="select form-control" name="open_close_status[]" required>
                                                                <option value="">Select</option>
                                                                <option value="Open">Open</option>
                                                                <option value="Close">Close</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="open_time[]" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="close_time[]" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="day[]" value="Saturday" required readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="select form-control" name="open_close_status[]" required>
                                                                <option value="">Select</option>
                                                                <option value="Open">Open</option>
                                                                <option value="Close">Close</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="open_time[]" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="close_time[]" value="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{route('clinic.openClose.update')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="clinic_id" value="{{$clinicDetails->id}}" class="form-control">
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Day</label>
                                                            <input type="text" class="form-control" name="day[]" value="Sunday" required readonly>
                                                            <input type="hidden" name="clinic_open_close_id[]" value="{{$clinicOpenClose[0]->id}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Open Close Status</label>
                                                            <select class="select form-control" name="open_close_status[]" required>
                                                                <option value="">Select</option>
                                                                <option value="Open" {{$clinicOpenClose[0]->open_close_status == 'Open' ? 'selected' : ''}}>Open</option>
                                                                <option value="Close" {{$clinicOpenClose[0]->open_close_status == 'Close' ? 'selected' : ''}}>Close</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Open Time</label>
                                                            <input type="text" class="form-control" name="open_time[]" value="{{$clinicOpenClose[0]->open_time}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Close Time</label>
                                                            <input type="text" class="form-control" name="close_time[]" value="{{$clinicOpenClose[0]->close_time}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="day[]" value="Monday" required readonly>
                                                            <input type="hidden" name="clinic_open_close_id[]" value="{{$clinicOpenClose[1]->id}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="select form-control" name="open_close_status[]" required>
                                                                <option value="">Select</option>
                                                                <option value="Open" {{$clinicOpenClose[1]->open_close_status == 'Open' ? 'selected' : ''}}>Open</option>
                                                                <option value="Close" {{$clinicOpenClose[1]->open_close_status == 'Close' ? 'selected' : ''}}>Close</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="open_time[]" value="{{$clinicOpenClose[1]->open_time}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="close_time[]" value="{{$clinicOpenClose[1]->close_time}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="day[]" value="Tuesday" required readonly>
                                                            <input type="hidden" name="clinic_open_close_id[]" value="{{$clinicOpenClose[2]->id}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="select form-control" name="open_close_status[]" required>
                                                                <option value="">Select</option>
                                                                <option value="Open" {{$clinicOpenClose[2]->open_close_status == 'Open' ? 'selected' : ''}}>Open</option>
                                                                <option value="Close" {{$clinicOpenClose[2]->open_close_status == 'Close' ? 'selected' : ''}}>Close</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="open_time[]" value="{{$clinicOpenClose[2]->open_time}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="close_time[]" value="{{$clinicOpenClose[2]->close_time}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="day[]" value="Wednesday" required readonly>
                                                            <input type="hidden" name="clinic_open_close_id[]" value="{{$clinicOpenClose[3]->id}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="select form-control" name="open_close_status[]" required>
                                                                <option value="">Select</option>
                                                                <option value="Open" {{$clinicOpenClose[3]->open_close_status == 'Open' ? 'selected' : ''}}>Open</option>
                                                                <option value="Close" {{$clinicOpenClose[3]->open_close_status == 'Close' ? 'selected' : ''}}>Close</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="open_time[]" value="{{$clinicOpenClose[3]->open_time}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="close_time[]" value="{{$clinicOpenClose[3]->close_time}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="day[]" value="Thursday" required readonly>
                                                            <input type="hidden" name="clinic_open_close_id[]" value="{{$clinicOpenClose[4]->id}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="select form-control" name="open_close_status[]" required>
                                                                <option value="">Select</option>
                                                                <option value="Open" {{$clinicOpenClose[4]->open_close_status == 'Open' ? 'selected' : ''}}>Open</option>
                                                                <option value="Close" {{$clinicOpenClose[4]->open_close_status == 'Close' ? 'selected' : ''}}>Close</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="open_time[]" value="{{$clinicOpenClose[4]->open_time}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="close_time[]" value="{{$clinicOpenClose[4]->close_time}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="day[]" value="Friday" required readonly>
                                                            <input type="hidden" name="clinic_open_close_id[]" value="{{$clinicOpenClose[5]->id}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="select form-control" name="open_close_status[]" required>
                                                                <option value="">Select</option>
                                                                <option value="Open" {{$clinicOpenClose[5]->open_close_status == 'Open' ? 'selected' : ''}}>Open</option>
                                                                <option value="Close" {{$clinicOpenClose[5]->open_close_status == 'Close' ? 'selected' : ''}}>Close</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="open_time[]" value="{{$clinicOpenClose[5]->open_time}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="close_time[]" value="{{$clinicOpenClose[5]->close_time}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="day[]" value="Saturday" required readonly>
                                                            <input type="hidden" name="clinic_open_close_id[]" value="{{$clinicOpenClose[6]->id}}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <select class="select form-control" name="open_close_status[]" required>
                                                                <option value="">Select</option>
                                                                <option value="Open" {{$clinicOpenClose[6]->open_close_status == 'Open' ? 'selected' : ''}}>Open</option>
                                                                <option value="Close" {{$clinicOpenClose[6]->open_close_status == 'Close' ? 'selected' : ''}}>Close</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="open_time[]" value="{{$clinicOpenClose[6]->open_time}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="close_time[]" value="{{$clinicOpenClose[6]->close_time}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /Open Close Tab -->

                            <!-- Clinic Verification Tab -->
                            <div class="tab-pane show" id="clinic-verification">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        @if(empty($clinicVer))
                                            <form action="{{route('clinic.verification.insert')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <div class="row form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="change-avatar">
{{--                                                                <div class="profile-img">--}}
{{--                                                                    <img src="{{asset('uploads/profile_pic/clinic/'.$clinicVer->image)}}" alt="User Image">--}}
{{--                                                                </div>--}}
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
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{route('clinic.verification.update')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="clinic_verification_id" value="{{$clinicVer->id}}" class="form-control">
                                                <div class="row form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="change-avatar">
                                                                <div class="profile-img">
                                                                    <img src="{{asset('uploads/profile_pic/clinic/'.$clinicVer->image)}}" alt="User Image">
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
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /Clinic Verification Tab -->

                        @endif



                    </div>
                </div>
            </div>
        </div>
    <!-- /Page Content -->
@stop
@push('js')
    <!-- Custom JS -->
    {{--<script src="{{asset('backend/user/js/script.js')}}"></script>--}}

    <!-- Select2 JS -->
    <script src="{{asset('backend/user/select2/js/select2.min.js')}}"></script>

    <!-- Dropzone JS -->
    <script src="{{asset('backend/user/dropzone/dropzone.min.js')}}"></script>

    <!-- Bootstrap Tagsinput JS -->
    <script src="{{asset('backend/user/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"></script>

    <!-- Profile Settings JS -->
    <script src="{{asset('backend/user/js/profile-settings.js')}}"></script>
    <!-- barikoi -->
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
            crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.js?key:MTg3NzpCRE5DQ01JSkgw"></script>

    <script>

        const defaultMarker = [23.7104, 90.40744]
        let map = L.map('map')
        map.setView(defaultMarker, 13)
        // Set up the OSM layer
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18
            }).addTo(map)
        L.marker(defaultMarker).addTo(map)
        Bkoi.onSelect(function () {
            //alert('test');
            // get selected data from dropdown list
            let selectedPlace = Bkoi.getSelectedData()
            console.log(selectedPlace);
            document.getElementsByName("city")[0].value = selectedPlace.city;
            document.getElementsByName("area")[0].value = selectedPlace.area;
            document.getElementsByName("latitude")[0].value = selectedPlace.latitude;
            document.getElementsByName("longitude")[0].value = selectedPlace.longitude;
            document.getElementsByName("postcode")[0].value = selectedPlace.postcode;
            //console.log(selectedPlace.latitude);
            // center of the map
            let center = [selectedPlace.latitude, selectedPlace.longitude]
            // Add marker to the map & bind popup
            map.setView(center, 19)
            L.marker(center).addTo(map).bindPopup(selectedPlace.address)
        })
    </script>
    <!-- barikoi -->
@endpush
