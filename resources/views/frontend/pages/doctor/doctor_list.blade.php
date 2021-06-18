@extends('frontend.layouts.master')
@section('title', 'Clinic')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Doctor</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Doctor</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">

                    <!-- Search Filter -->
                    <div class="card search-filter">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Filter Doctor</h4>
                        </div>
                        <form action = "{{route('doctor.filter')}}" method="post">
                            @csrf
                            <div class="card-body">
{{--                                <div class="filter-widget">--}}
{{--                                    <div class="cal-icon">--}}
{{--                                        <input type="text" class="form-control datetimepicker" placeholder="Select Date" name="date">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="filter-widget">
                                    <h4>Gender</h4>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="gender_type[]" value="male" {{in_array("male", $gen) ?"checked":""}}>
                                            <span class="checkmark"></span> Male Doctor
                                        </label>
                                    </div>
                                    <div>
                                        <label class="custom_check">
                                            <input type="checkbox" name="gender_type[]" value="female" {{in_array("female", $gen) ?"checked":""}}>
                                            <span class="checkmark"></span> Female Doctor
                                        </label>
                                    </div>
                                </div>
                                <div class="filter-widget">
                                    <h4>Select Specialist</h4>
                                    @if(!empty($doctorSpecialities))
                                        @foreach($doctorSpecialities as $doctorSpeciality)
                                            <div>
                                                <label class="custom_check">
                                                    <input type="checkbox" name="doctor_speciality_id[]" value="{{$doctorSpeciality->id}}" {{in_array($doctorSpeciality->id, $spe) ?"checked":""}}>
                                                    <span class="checkmark"></span> {{$doctorSpeciality->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="btn-search">
                                    <button type="submit" class="btn btn-block">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /Search Filter -->

                </div>

                <div class="col-md-12 col-lg-8 col-xl-9">

                @if(!empty($doctorUserLists))
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="additional-fields-provider text-center" onclick="geoLocationInit()">--}}
{{--                                    <h3 class="m-0">Click For Nearest Doctor</h3>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                    <div id="doctor_list">
                    @foreach($doctorUserLists as $doctorUserList)
                        <!-- Doctor Widget -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img">
                                                <a href="javascript:void(0);">
                                                    <img src="{{asset('uploads/profile_pic/doctor/'.$doctorUserList->image)}}" class="img-fluid" alt="User Image">
                                                </a>
                                            </div>
                                            <div class="doc-info-cont">
                                                <h4 class="doc-name"><a href="javascript:void(0);">{{$doctorUserList->name}}</a></h4>
{{--                                                <p class="doc-speciality">{{$doctorUserList->doctor->title}}</p>--}}
                                                <p class="doc-speciality">{{$doctorUserList->spe_name}}</p>
{{--                                                <h5 class="doc-department"><img src="{{asset('uploads/profile_pic/doctor/'.$doctorUserList->image)}}" class="img-fluid" alt="Speciality">{{$doctorUserList->name}}</h5>--}}

                                                <div class="rating">
                                                    @if($doctorUserList->rating != null)
                                                        @if($doctorUserList->rating == 5)
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                        @elseif($doctorUserList->rating == 4)
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star"></i>
                                                        @elseif($doctorUserList->rating == 3)
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        @elseif($doctorUserList->rating == 2)
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        @else
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        @endif
{{--                                                        <span class="d-inline-block average-rating">(67)</span>--}}
                                                    @else
                                                        No Review Found Yet!
                                                    @endif
                                                </div>

                                                {{--                                            <div class="clinic-services">--}}
                                                {{--                                                <span>Dental Fillings</span>--}}
                                                {{--                                                <span> Whitneing</span>--}}
                                                {{--                                            </div>--}}
                                            </div>
                                        </div>
                                        <div class="doc-info-right">
                                            <div class="clini-infos">
                                                @php
                                                    $addr=\App\DoctorContact::where('doctor_id',$doctorUserList->doctor_id)->first();
                                                @endphp
                                                <ul>
{{--                                                    <li><i class="far fa-thumbs-up"></i> 98%</li>--}}
                                                    @if(!empty($addr))
                                                    <li><i class="fas fa-map-marker-alt"></i> {{$addr->address}}</li>
                                                    @endif
{{--                                                    <li><i class="far fa-money-bill-alt"></i> Tk {{$doctorUserList->home_cost}} <i class="fas fa-info-circle" data-toggle="tooltip" title="Clinic Visit Cost"></i> </li>--}}
                                                </ul>
                                            </div>
                                            <div class="clinic-booking">
                                                <a class="view-pro-btn" href="{{route('doctor.details',$doctorUserList->slug)}}">View Profile</a>
                                                <a class="apt-btn" href="{{route('doctor.booking',$doctorUserList->slug)}}">Book Appointment</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Doctor Widget -->
                        @endforeach
                    </div>
                    @endif

{{--                    <div class="load-more text-center">--}}
{{--                        <a class="btn btn-primary btn-sm" href="javascript:void(0);">Load More</a>--}}
{{--                    </div>--}}
                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->
@stop
@push('js')
    <script src="{{asset('frontend/js/map/doctor_search.js')}}" type="text/javascript"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCE1oI9UN7X2VYS0UFVRKBdWd3TzyxT-tE&callback">
    </script>
@endpush
