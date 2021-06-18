@extends('backend.layouts.doctor.master')
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
                            <a class="nav-link" href="#doctor-information" data-toggle="tab">Details</a>
                        </li>
                        @if(!empty($doctorDetails))
                            <li class="nav-item">
                                <a class="nav-link" href="#contact-details" data-toggle="tab">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#clinics" data-toggle="tab">Clinics</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#educations" data-toggle="tab">Educations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#experiences" data-toggle="tab">Experience</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#awards" data-toggle="tab">Awards</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#specialist" data-toggle="tab">Specialist</a>
                            </li>
                        @endif
                    </ul>
                    <!-- /Profile Tab -->

                    <div class="tab-content">

                        <!-- Basic-Information Tab -->
                        <div class="tab-pane show active" id="basic-information">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <form action="{{route('doctor.basic.update')}}" method="post" enctype="multipart/form-data" >
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Gender<span class="text-danger">*</span></label>
                                                    <select class="select form-control" name="gender">
                                                        <option value="">Select</option>
                                                        <option value="male" {{Auth::user()->gender == 'male' ? 'selected' : ''}}>Male</option>
                                                        <option value="female" {{Auth::user()->gender == 'female' ? 'selected' : ''}}>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="change-avatar">
                                                        <div class="profile-img">
                                                            <img src="{{asset('uploads/profile_pic/doctor/'.Auth::user()->image)}}" alt="User Image">
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

                        <!-- Doctor Details Tab -->
                        <div class="tab-pane" id="doctor-information">
                            <div class="card mb-0">
                                <div class="card-body">
                                    @if(empty($doctorDetails))
                                        <form action="{{route('doctor.details.insert')}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}" class="form-control">
                                            <div class="row form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Doctor Main Speciality <span class="text-danger">*</span></label>
                                                        <select class="select form-control specialist-select-area" name="doctor_speciality_id">
                                                            <option value="">Select</option>
                                                            @foreach($doctorSpecialityLists as $doctorSpecialityList)
                                                                <option value="{{$doctorSpecialityList->id}}">{{$doctorSpecialityList->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Title</label>
                                                        <input type="text" name="title" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Is Active</label>
                                                        <select class="select form-control" name="is_active">
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="display: none">
                                                    <div class="form-group">
                                                        <label class="control-label">Is Online</label>
                                                        <select class="select form-control" name="is_online">
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="display: none">
                                                    <div class="form-group">
                                                        <label class="control-label">Has Permission</label>
                                                        <select class="select form-control" name="has_permission">
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Has Clinic</label>
                                                        <select class="select form-control" name="has_clinic">
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Has Home Service</label>
                                                        <select class="select form-control" name="has_home_service">
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="display: none">
                                                    <div class="form-group">
                                                        <label class="control-label">Is On Demand</label>
                                                        <select class="select form-control" name="is_on_demand">
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Home Cost</label>
                                                        <input type="number" class="form-control" name="home_cost">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Bmdc Number</label>
                                                        <input type="text" class="form-control" name="Bmdc_number">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">language</label>
                                                        <input type="text" class="form-control" name="language">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Personal Statement</label>
                                                        <textarea class="form-control" rows="3" cols="" name="personal_statement"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="submit-section submit-btn-bottom text-center">
                                                <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                            </div>
                                        </form>
                                    @else
                                        <form action="{{route('doctor.details.update')}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}" class="form-control">
                                            <div class="row form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Doctor Main Speciality <span class="text-danger">*</span></label>
                                                        <input type="hidden" name="doctor_id" class="form-control" value="{{$doctorDetails->id}}">
                                                        <select class="select form-control specialist-select-area" name="doctor_speciality_id">
                                                            <option value="">Select</option>
                                                            @foreach($doctorSpecialityLists as $doctorSpecialityList)
                                                                <option value="{{$doctorSpecialityList->id}}" {{ $doctorSpecialityList->id  ==  $doctorDetails->doctor_speciality_id ? 'selected' : ''}}>{{$doctorSpecialityList->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Title</label>
                                                        <input type="text" name="title" class="form-control" value="{{$doctorDetails->title}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Is Active</label>
                                                        <select class="select form-control" name="is_active">
                                                            <option value="1" {{$doctorDetails->is_active == 1 ? 'selected' : ''}}>Yes</option>
                                                            <option value="0" {{$doctorDetails->is_active == 0 ? 'selected' : ''}}>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="display: none">
                                                    <div class="form-group">
                                                        <label class="control-label">Is Online</label>
                                                        <select class="select form-control" name="is_online">
                                                            <option value="1" {{$doctorDetails->is_online == 1 ? 'selected' : ''}}>Yes</option>
                                                            <option value="0" {{$doctorDetails->is_online == 0 ? 'selected' : ''}}>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="display: none">
                                                    <div class="form-group">
                                                        <label class="control-label">Has Permission</label>
                                                        <select class="select form-control" name="has_permission">
                                                            <option value="1" {{$doctorDetails->has_permission == 1 ? 'selected' : ''}}>Yes</option>
                                                            <option value="0" {{$doctorDetails->has_permission == 0 ? 'selected' : ''}}>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Has Clinic</label>
                                                        <select class="select form-control" name="has_clinic">
                                                            <option value="1" {{$doctorDetails->has_clinic == 1 ? 'selected' : ''}}>Yes</option>
                                                            <option value="0" {{$doctorDetails->has_clinic == 0 ? 'selected' : ''}}>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Has Home Service</label>
                                                        <select class="select form-control" name="has_home_service">
                                                            <option value="1" {{$doctorDetails->has_home_service == 1 ? 'selected' : ''}}>Yes</option>
                                                            <option value="0" {{$doctorDetails->has_home_service == 0 ? 'selected' : ''}}>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3" style="display: none">
                                                    <div class="form-group">
                                                        <label class="control-label">Is On Demand</label>
                                                        <select class="select form-control" name="is_on_demand">
                                                            <option value="1" {{$doctorDetails->is_on_demand == 1 ? 'selected' : ''}}>Yes</option>
                                                            <option value="0" {{$doctorDetails->is_on_demand == 0 ? 'selected' : ''}}>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Home Cost</label>
                                                        <input type="number" class="form-control" name="home_cost" value="{{$doctorDetails->home_cost}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Bmdc Number</label>
                                                        <input type="text" class="form-control" name="Bmdc_number" value="{{$doctorDetails->Bmdc_number}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">language</label>
                                                        <input type="text" class="form-control" name="language" value="{{$doctorDetails->language}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Personal Statement</label>
                                                        <textarea class="form-control" rows="3" cols="" name="personal_statement">{{$doctorDetails->personal_statement}}</textarea>
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
                        <!-- /Doctor Details Tab -->
                        @if(!empty($doctorDetails))
                            <!-- Contact Details Tab -->
                            <div class="tab-pane" id="contact-details">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        @if(empty($doctorContact))
                                            <form action="{{route('doctor.contact.insert')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="doctor_id" value="{{$doctorDetails->id}}" class="form-control">
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
                                            <form action="{{route('doctor.contact.update')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="doctor_id" value="{{$doctorDetails->id}}" class="form-control">
                                                <div class="row form-row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">District</label>
                                                            <select class="select form-control" name="division_district_id">
                                                                <option value="">Select District</option>
                                                                @if(!empty($divisionDistricts))
                                                                    @foreach($divisionDistricts as $divisionDistrict)
                                                                        <option value="{{$divisionDistrict->id}}" {{ $divisionDistrict->id == $doctorContact->division_district_id ? 'selected' : '' }}>{{$divisionDistrict->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Address </label>
                                                            <input type="hidden" name="doctor_contact_id" class="form-control" value="{{$doctorContact->id}}">
                                                            <input type="text" name="address" value="{{$doctorContact->address}}" class="bksearch">
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
                                                            <input type="text" class="form-control" value="{{$doctorContact->lat}}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Lng</label>
                                                            <input type="text" class="form-control" value="{{$doctorContact->lng}}" readonly>
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
                            <!-- /Contact Details Tab -->

                            <!-- Clinic Tab -->
                            <div class="tab-pane" id="clinics">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        @if(count($clinicDoctors) == 0)
                                            <form action="{{route('doctor.clinic.insert')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="doctor_id" value="{{$doctorDetails->id}}" class="form-control">
                                                <div class="clinic-info">
                                                    <div class="row form-row clinic-cont">
                                                        <div class="col-12 col-md-10 col-lg-11">
                                                            <div class="row form-row">
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label>Clinic</label>
                                                                        <select class="select form-control cliniclist-select-area" name="clinic_id[]">
                                                                            <option value="">Select</option>
                                                                            @foreach($clinicLists as $clinicList)
                                                                                <option value="{{$clinicList->id}}">{{$clinicList->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label>Visit Cost</label>
                                                                        <input type="text" name="visit_cost[]" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label>Main Clinic Status</label>
                                                                        <select class="select form-control main_clinic_status" name="main_clinic_status[]">
                                                                            <option value="">Select</option>
                                                                            <option value="1">Main</option>
                                                                            <option value="0">Other</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="add-clinic"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{route('doctor.clinic.update')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="doctor_id" value="{{$doctorDetails->id}}" class="form-control">
                                                <div class="clinic-info">
                                                    <div class="row form-row clinic-cont">
                                                        <div class="col-12 col-md-10 col-lg-11">
                                                            @foreach($clinicDoctors as $clinicDoctor)
                                                                <div class="row form-row">
                                                                    <div class="col-12 col-md-6 col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>Clinic</label>
                                                                            <input type="hidden" name="clinic_doctor_id[]" class="form-control" value="{{$clinicDoctor->id}}">
                                                                            <select class="select form-control cliniclist-select-area" name="clinic_id[]">
                                                                                <option value="">Select</option>
                                                                                @foreach($clinicLists as $clinicList)
                                                                                    <option value="{{$clinicList->id}}" {{$clinicList->id == $clinicDoctor->clinic_id ? 'selected' : ''}}>{{$clinicList->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-6 col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>Visit Cost</label>
                                                                            <input type="text" name="visit_cost[]" class="form-control" value="{{$clinicDoctor->visit_cost}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-6 col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>Main/Other Clinic</label>
                                                                            <select class="select form-control cliniclist-select-area main_clinic_status" name="main_clinic_status[]">
                                                                                <option value="1" {{$clinicDoctor->main_clinic_status == '1' ? 'selected' : ''}}>Main</option>
                                                                                <option value="0" {{$clinicDoctor->main_clinic_status == '0' ? 'selected' : ''}}>Other</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="add-clinic"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /Clinic Tab -->

                                <!-- Education Tab -->
                                <div class="tab-pane" id="educations">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            @if(count($doctorEducations) == 0)
                                                <form action="{{route('doctor.education.insert')}}" method="post" enctype="multipart/form-data" >
                                                    @csrf
                                                    <input type="hidden" name="doctor_id" value="{{$doctorDetails->id}}" class="form-control">
                                                    <div class="education-info">
                                                        <div class="row form-row education-cont">
                                                            <div class="col-12 col-md-10 col-lg-11">
                                                                <div class="row form-row">
                                                                    <div class="col-12 col-md-6 col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>Degree</label>
                                                                            <input type="text" name="degree[]" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-6 col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>College/Institute</label>
                                                                            <input type="text" name="institute[]" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-6 col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>Year of Completion</label>
                                                                            <input type="text" name="year_of_completion[]" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-more">
                                                        <a href="javascript:void(0);" class="add-education"><i class="fa fa-plus-circle"></i> Add More</a>
                                                    </div>
                                                    <div class="submit-section submit-btn-bottom text-center">
                                                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                    </div>
                                                </form>
                                            @else
                                                <form action="{{route('doctor.education.update')}}" method="post" enctype="multipart/form-data" >
                                                    @csrf
                                                    <input type="hidden" name="doctor_id" value="{{$doctorDetails->id}}" class="form-control">
                                                    <div class="education-info">
                                                        <div class="row form-row education-cont">
                                                            <div class="col-12 col-md-10 col-lg-11">
                                                                @foreach($doctorEducations as $doctorEducation)
                                                                    <div class="row form-row">
                                                                        <div class="col-12 col-md-6 col-lg-4">
                                                                            <div class="form-group">
                                                                                <label>Degree</label>
                                                                                <input type="hidden" name="doctor_education_id[]" class="form-control" value="{{$doctorEducation->id}}">
                                                                                <input type="text" name="degree[]" value="{{$doctorEducation->degree}}" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 col-lg-4">
                                                                            <div class="form-group">
                                                                                <label>College/Institute</label>
                                                                                <input type="text" name="institute[]" value="{{$doctorEducation->institute}}" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-md-6 col-lg-4">
                                                                            <div class="form-group">
                                                                                <label>Year of Completion</label>
                                                                                <input type="text" name="year_of_completion[]" value="{{$doctorEducation->year_of_completion}}" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-more">
                                                        <a href="javascript:void(0);" class="add-education"><i class="fa fa-plus-circle"></i> Add More</a>
                                                    </div>
                                                    <div class="submit-section submit-btn-bottom text-center">
                                                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- /Education Tab -->

                            <!-- Experience Tab -->
                            <div class="tab-pane" id="experiences">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        @if(count($doctorExperiences) == 0)
                                            <form action="{{route('doctor.experience.insert')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="doctor_id" value="{{$doctorDetails->id}}" class="form-control">
                                                <div class="experience-info">
                                                    <div class="row form-row experience-cont">
                                                        <div class="col-12 col-md-10 col-lg-11">
                                                            <div class="row form-row">
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label>Hospital Name</label>
                                                                        <input type="text" name="hospital_name[]" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label>From</label>
                                                                        <input type="text" name="from[]" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label>To</label>
                                                                        <input type="text" name="to[]" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label>Designation</label>
                                                                        <input type="text" name="designation[]" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="add-experience"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{route('doctor.experience.update')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="doctor_id" value="{{$doctorDetails->id}}" class="form-control">
                                                <div class="experience-info">
                                                    <div class="row form-row experience-cont">
                                                        <div class="col-12 col-md-10 col-lg-11">
                                                            <div class="row form-row">
                                                                @foreach($doctorExperiences as $doctorExperience)
                                                                    <div class="col-12 col-md-6 col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Hospital Name</label>
                                                                            <input type="hidden" name="doctor_experience_id[]" class="form-control" value="{{$doctorExperience->id}}">
                                                                            <input type="text" name="hospital_name[]" value="{{$doctorExperience->hospital_name}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-6 col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>From</label>
                                                                            <input type="text" name="from[]" value="{{$doctorExperience->from}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-6 col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>To</label>
                                                                            <input type="text" name="to[]" value="{{$doctorExperience->to}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-6 col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Designation</label>
                                                                            <input type="text" name="designation[]" value="{{$doctorExperience->designation}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="add-experience"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /Experience Tab -->

                            <!-- Awards Tab -->
                            <div class="tab-pane" id="awards">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        @if(count($doctorAwards) == 0)
                                            <form action="{{route('doctor.award.insert')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="doctor_id" value="{{$doctorDetails->id}}" class="form-control">
                                                <div class="awards-info">
                                                    <div class="row form-row awards-cont">
                                                        <div class="col-12 col-md-5">
                                                            <div class="form-group">
                                                                <label>Awards</label>
                                                                <input type="text" name="award[]" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-5">
                                                            <div class="form-group">
                                                                <label>Year</label>
                                                                <input type="text" name="year[]" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="add-award"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{route('doctor.award.update')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="doctor_id" value="{{$doctorDetails->id}}" class="form-control">
                                                <div class="awards-info">
                                                    <div class="row form-row awards-cont">
                                                        @foreach($doctorAwards as $doctorAward)
                                                            <div class="col-12 col-md-5">
                                                                <div class="form-group">
                                                                    <label>Awards</label>
                                                                    <input type="hidden" name="doctor_award_id[]" class="form-control" value="{{$doctorAward->id}}">
                                                                    <input type="text" name="award[]" class="form-control" value="{{$doctorAward->award}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-5">
                                                                <div class="form-group">
                                                                    <label>Year</label>
                                                                    <input type="text" name="year[]" class="form-control" value="{{$doctorAward->year}}">
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="add-award"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /Awards Tab -->

                            <!-- Specialist Tab -->
                            <div class="tab-pane" id="specialist">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        @if(count($doctorSpecialityDoctors) == 0)
                                            <form action="{{route('doctor.speciality.insert')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="doctor_id" value="{{$doctorDetails->id}}" class="form-control">
                                                <div class="specialist-info">
                                                    <div class="row form-row specialists-cont">
                                                        <div class="col-12 col-md-5">
                                                            <div class="form-group">
                                                                <label>Specialist</label>
                                                                <select class="select form-control specialist-select-area" name="doctor_speciality_id[]">
                                                                    <option value="">Select</option>
                                                                    @foreach($doctorSpecialityLists as $doctorSpecialityList)
                                                                        <option value="{{$doctorSpecialityList->id}}">{{$doctorSpecialityList->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-5">
                                                            <div class="form-group">
                                                                <label>Main Specialist Status</label>
                                                                <select class="select form-control" name="main_specialist_status[]">
                                                                    <option value="">Select</option>
                                                                    <option value="1">Main</option>
                                                                    <option value="0">Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="add-specialist"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{route('doctor.speciality.update')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="doctor_id" value="{{$doctorDetails->id}}" class="form-control">
                                                <div class="specialist-info">
                                                    <div class="row form-row specialists-cont">
                                                        @foreach($doctorSpecialityDoctors as $doctorSpecialityDoctor)
                                                            <div class="col-12 col-md-5">
                                                                <div class="form-group">
                                                                    <label>Specialist</label>
                                                                    <input type="hidden" name="doctor_speciality_doctor_id[]" class="form-control" value="{{$doctorSpecialityDoctor->id}}">
                                                                    <select class="select form-control specialist-select-area" name="doctor_speciality_id[]">
                                                                        <option value="">Select</option>
                                                                        @foreach($doctorSpecialityLists as $doctorSpecialityList)
                                                                            <option value="{{$doctorSpecialityList->id}}" {{$doctorSpecialityDoctor->doctor_speciality_id == $doctorSpecialityList->id ? 'selected' : ''}}>{{$doctorSpecialityList->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-5">
                                                                <div class="form-group">
                                                                    <label>Main Specialist Status</label>
                                                                    <select class="select form-control" name="main_specialist_status[]">
                                                                        <option value="">Select</option>
                                                                        <option value="1" {{$doctorSpecialityDoctor->main_specialist_status == 1 ? 'selected' : ''}}>Main</option>
                                                                        <option value="0" {{$doctorSpecialityDoctor->main_specialist_status == 0 ? 'selected' : ''}}>Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="add-specialist"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- /Specialist Tab -->
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


{{--    <script>--}}
{{--        $(document).ready( function() {--}}
{{--            $(".main_clinic_status").on('change', function () {--}}
{{--                alert();--}}
{{--                var t = 0;--}}
{{--                $('.main_clinic_status').each(function(i,e){--}}
{{--                    // var main_clinic_status_count = $(this).val();--}}
{{--                    // if(main_clinic_status_count == 1){--}}
{{--                    //     i++;--}}
{{--                    // }--}}
{{--                    var amt = $(this).val();--}}
{{--                    t += amt;--}}

{{--                });--}}
{{--                console.log(t)--}}
{{--            });--}}
{{--        });--}}

{{--    </script>--}}
@endpush
