@extends('backend.layouts.service_provider.master')
@section('title', 'Profile')
@push('css')
    <!-- barikoi -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin="" />
    <!-- barikoi -->
    {{--custom css--}}
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
                            <a class="nav-link active" href="#basic-information" data-toggle="tab">Basic <span class="text-danger">*</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#service-provider-information" data-toggle="tab">Details <span class="text-danger">*</span></a>
                        </li>
                        @if(!empty($serviceProviderDetails))
                        <li class="nav-item">
                            <a class="nav-link" href="#contact-details" data-toggle="tab">Contact <span class="text-danger">*</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#cost" data-toggle="tab">Cost</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#educations" data-toggle="tab">Educations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#experiences" data-toggle="tab">Experience</a>
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
                                    <form action="{{route('service_provider.basic.update')}}" method="post" enctype="multipart/form-data" >
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
                                                    <label class="control-label">Gender</label>
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
                                                            <img src="{{asset('uploads/profile_pic/service_provider/'.Auth::user()->image)}}" alt="User Image">
                                                        </div>
                                                        <div class="upload-img">
                                                            <div class="change-photo-btn">
                                                                <span><i class="fa fa-upload"></i> Upload Photo</span>
                                                                <input type="file" name="image"  class="upload">
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
                        <div class="tab-pane" id="service-provider-information">
                            <div class="card mb-0">
                                <div class="card-body">
                                    @if(empty($serviceProviderDetails))
                                        <form action="{{route('service_provider.details.insert')}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}" class="form-control">
                                            <div class="row form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Service Provider Category <span class="text-danger">*</span></label>
                                                        <select class="select form-control specialist-select-area" name="service_provider_category_id" id="service_provider_category_id">
                                                            <option value="">Select</option>
                                                            @foreach($serviceProviderCategories as $serviceProviderCategory)
                                                                <option value="{{$serviceProviderCategory->id}}">{{$serviceProviderCategory->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Service Category <span class="text-danger">*</span></label>
                                                        <select class="select form-control specialist-select-area" name="service_category_id" id="service_category_id">
                                                            <option value="">Select</option>
                                                            @foreach($serviceCategories as $serviceCategory)
                                                                <option value="{{$serviceCategory->id}}">{{$serviceCategory->name}}</option>
                                                            @endforeach
                                                        </select>
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
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Height</label>
                                                        <input type="text" class="form-control" name="height">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Weight</label>
                                                        <input type="text" class="form-control" name="weight">
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
                                        <form action="{{route('service_provider.details.update')}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}" class="form-control">
                                            <div class="row form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Service Provider Category <span class="text-danger">*</span></label>
                                                        <input type="hidden" name="service_provider_id" class="form-control" value="{{$serviceProviderDetails->id}}">
                                                        <select class="select form-control specialist-select-area" name="service_provider_category_id" id="service_provider_category_id">
                                                            <option value="">Select</option>
                                                            @foreach($serviceProviderCategories as $serviceProviderCategory)
                                                                <option value="{{$serviceProviderCategory->id}}" {{$serviceProviderDetails->service_provider_category_id == $serviceProviderCategory->id ? 'selected' : ''}}>{{$serviceProviderCategory->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Service Category <span class="text-danger">*</span></label>
                                                        <select class="select form-control specialist-select-area" name="service_category_id" id="service_category_id">
                                                            <option value="">Select</option>
                                                            @foreach($serviceCategories as $serviceCategory)
                                                                <option value="{{$serviceCategory->id}}"{{$serviceProviderDetails->service_category_id == $serviceCategory->id ? 'selected' : ''}}>{{$serviceCategory->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Is Active</label>
                                                        <select class="select form-control" name="is_active">
                                                            <option value="1" {{$serviceProviderDetails->is_active == 1 ? 'selected' : ''}}>Yes</option>
                                                            <option value="0" {{$serviceProviderDetails->is_active == 0 ? 'selected' : ''}}>No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Height</label>
                                                        <input type="text" class="form-control" name="height" value="{{$serviceProviderDetails->height}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Weight</label>
                                                        <input type="text" class="form-control" name="weight" value="{{$serviceProviderDetails->weight}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">language</label>
                                                        <input type="text" class="form-control" name="language" value="{{$serviceProviderDetails->language}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Personal Statement</label>
                                                        <textarea class="form-control" rows="3" cols="" name="personal_statement">{{$serviceProviderDetails->personal_statement}}</textarea>
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
                        @if(!empty($serviceProviderDetails))
                            <div class="tab-pane" id="contact-details">
                            <div class="card mb-0">
                                <div class="card-body">
                                    @if(empty($service_provider_contact))
                                        <form action="{{route('service_provider.contact.insert')}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                            <input type="hidden" name="service_provider_id" value="{{$serviceProviderDetails->id}}" class="form-control">
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
                                                        <label>Address <span class="text-danger">*</span></label>
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
                                        <form action="{{route('service_provider.contact.update')}}" method="post" enctype="multipart/form-data" >
                                            @csrf

                                            <input type="hidden" name="service_provider_id" value="{{$serviceProviderDetails->id}}" class="form-control">
                                            <div class="row form-row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">District</label>
                                                        <select class="select form-control" name="division_district_id">
                                                            <option value="">Select District</option>
                                                            @if(!empty($divisionDistricts))
                                                                @foreach($divisionDistricts as $divisionDistrict)
                                                                    <option value="{{$divisionDistrict->id}}" {{ $divisionDistrict->id == $service_provider_contact->division_district_id ? 'selected' : '' }}>{{$divisionDistrict->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Address<span class="text-danger">*</span> </label>
                                                        <input type="hidden" name="service_provider_contact_id" class="form-control" value="{{$service_provider_contact->id}}">
                                                        <input type="text" name="address" value="{{$service_provider_contact->address}}" class="bksearch">
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
                                                        <input type="text" class="form-control" value="{{$service_provider_contact->lat}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Lng</label>
                                                        <input type="text" class="form-control" value="{{$service_provider_contact->lng}}" readonly>
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

                             <div class="tab-pane" id="cost">
                            <div class="card mb-0">
                                <div class="card-body">
                                    @if(empty($serviceProviderCost))
                                        <form action="{{route('service_provider.cost.insert')}}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                            <input type="hidden" name="service_provider_id" value="{{$serviceProviderDetails->id}}" class="form-control">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Monthly Cost<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="monthly_cost" value="123">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Full Day Cost</label>
                                                    <input type="text" class="form-control" name="fullday_cost">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Half Day Cost</label>
                                                    <input type="text" class="form-control" name="halfday_cost">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Home Cost</label>
                                                    <input type="text" class="form-control" name="home_cost">
                                                </div>
                                            </div>
                                            <div class="submit-section submit-btn-bottom text-center">
                                                <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                            </div>
                                        </form>
                                    @else
                                        <form action="{{route('service_provider.cost.update')}}" method="post" enctype="multipart/form-data" >
                                            @csrf

                                            <input type="hidden" name="service_provider_id" value="{{$serviceProviderDetails->id}}" class="form-control">


                                            <div class="row form-row">
                                                <input type="hidden" name="service_provider_cost_id" value="{{$serviceProviderCost->id}}" class="form-control">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Monthly Cost<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="monthly_cost" value="{{$serviceProviderCost->monthly_cost}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Full Day Cost</label>
                                                        <input type="text" class="form-control" name="fullday_cost" value="{{$serviceProviderCost->fullday_cost}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Half Day Cost</label>
                                                        <input type="text" class="form-control" name="halfday_cost" value="{{$serviceProviderCost->halfday_cost}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Home Cost</label>
                                                        <input type="text" class="form-control" name="home_cost" value="{{$serviceProviderCost->home_cost}}">
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
                            <!-- Education Tab -->
                            <div class="tab-pane" id="educations">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        @if(count($serviceProviderEducations) == 0)
                                            <form action="{{route('service_provider.education.insert')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="service_provider_id" value="{{$serviceProviderDetails->id}}" class="form-control">
                                                <div class="service-provider-education-info">
                                                    <div class="row form-row service-provider-education-cont">
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
                                                    <a href="javascript:void(0);" class="add-service-provider-education"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{route('service_provider.education.update')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="service_provider_id" value="{{$serviceProviderDetails->id}}" class="form-control">
                                                <div class="service-provider-education-info">
                                                    <div class="row form-row service-provider-education-cont">
                                                        <div class="col-12 col-md-10 col-lg-11">
                                                            @foreach($serviceProviderEducations as $serviceProviderEducation)
                                                                <div class="row form-row">
                                                                    <div class="col-12 col-md-6 col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>Degree</label>
                                                                            <input type="hidden" name="service_provider_education_id[]" value="{{$serviceProviderEducation->id}}" class="form-control" >
                                                                            <input type="text" name="degree[]"  value="{{$serviceProviderEducation->degree}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-6 col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>College/Institute</label>
                                                                            <input type="text" name="institute[]" value="{{$serviceProviderEducation->institute}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-6 col-lg-4">
                                                                        <div class="form-group">
                                                                            <label>Year of Completion</label>
                                                                            <input type="text" name="year_of_completion[]" value="{{$serviceProviderEducation->year_of_completion}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="add-service-provider-education"><i class="fa fa-plus-circle"></i> Add More</a>
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
                                        @if(count($serviceProviderExperiences) == 0)
                                            <form action="{{route('service_provider.experience.insert')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="service_provider_id" value="{{$serviceProviderDetails->id}}" class="form-control">
                                                <div class="service-provider-experience-info
">
                                                    <div class="row form-row service-provider-experience-cont">
                                                        <div class="col-12 col-md-10 col-lg-11">
                                                            <div class="row form-row">
                                                                <div class="col-12 col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label>Company Name</label>
                                                                        <input type="text" name="company_name[]" class="form-control">
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
                                                    <a href="javascript:void(0);" class="add-service-provider-experience"><i class="fa fa-plus-circle"></i> Add More</a>
                                                </div>
                                                <div class="submit-section submit-btn-bottom text-center">
                                                    <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                                                </div>
                                            </form>
                                        @else
                                            <form action="{{route('service_provider.experience.update')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="service_provider_id" value="{{$serviceProviderDetails->id}}" class="form-control">
                                                <div class="service-provider-experience-info">
                                                    <div class="row form-row service-provider-experience-cont">
                                                        <div class="col-12 col-md-10 col-lg-11">
                                                            <div class="row form-row">
                                                                @foreach($serviceProviderExperiences as $serviceProviderExperience)
                                                                    <div class="col-12 col-md-6 col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Company Name</label>
                                                                            <input type="hidden" name="service_provider_experience_id[]" class="form-control" value="{{$serviceProviderExperience->id}}">
                                                                            <input type="text" name="company_name[]" value="{{$serviceProviderExperience->company_name}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-6 col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>From</label>
                                                                            <input type="text" name="from[]" value="{{$serviceProviderExperience->from}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-6 col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>To</label>
                                                                            <input type="text" name="to[]" value="{{$serviceProviderExperience->to}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-6 col-lg-3">
                                                                        <div class="form-group">
                                                                            <label>Designation</label>
                                                                            <input type="text" name="designation[]" value="{{$serviceProviderExperience->designation}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-more">
                                                    <a href="javascript:void(0);" class="add-service-provider-experience"><i class="fa fa-plus-circle"></i> Add More</a>
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



                            <!-- Service Provider Verification Tab -->
                            <div class="tab-pane show" id="clinic-verification">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        @if(empty($serviceProviderVer))
                                            <form action="{{route('service_provider.verification.insert')}}" method="post" enctype="multipart/form-data" >
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
                                            <form action="{{route('service_provider.verification.update')}}" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="clinic_verification_id" value="{{$serviceProviderVer->id}}" class="form-control">
                                                <div class="row form-row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="change-avatar">
                                                                <div class="profile-img">
                                                                    <img src="{{asset('uploads/profile_pic/service_provider/'.$serviceProviderVer->image)}}" alt="User Image">
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
        $('#service_provider_category_id').change(function(){
            var service_provider_category_id = $(this).val();
            $.ajax({
                url : "{{URL('service-category-list')}}",
                method : "get",
                data : {
                    service_provider_category_id : service_provider_category_id
                },
                success : function (res){
                    console.log(res)
                    $('#service_category_id').html(res.data)
                },
                error : function (err){
                    console.log(err)
                }
            })
        })
    </script>

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
