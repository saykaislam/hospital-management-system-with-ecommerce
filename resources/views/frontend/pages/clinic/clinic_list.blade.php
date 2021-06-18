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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Clinic</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Clinic</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
{{--                <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">--}}

{{--                    <!-- Search Filter -->--}}
{{--                    <div class="card search-filter">--}}
{{--                        <div class="card-header">--}}
{{--                            <h4 class="card-title mb-0">Search Filter</h4>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="filter-widget">--}}
{{--                                <label>Location</label>--}}
{{--                                <input type="text" class="form-control" placeholder="Select Location">--}}
{{--                            </div>--}}
{{--                            <div class="filter-widget">--}}
{{--                                <h4>Categories</h4>--}}
{{--                                @if(!empty($clinicCategories))--}}
{{--                                    @foreach($clinicCategories as $clinicCategory)--}}
{{--                                        <div>--}}
{{--                                            <label class="custom_check">--}}
{{--                                                <input type="checkbox" name="clinic_category_id">--}}
{{--                                                <span class="checkmark"></span> {{$clinicCategory->name}}--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </div>--}}

{{--                            <div class="btn-search">--}}
{{--                                <button type="button" class="btn btn-block">Search</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /Search Filter -->--}}

{{--                </div>--}}

                <div class="col-md-12 col-lg-12 col-xl-12">

                    @if(!empty($clinicUserLists))
                        @foreach($clinicUserLists as $clinicUserList)
                            <!-- Doctor Widget -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="doctor-widget">
                                        <div class="doc-info-left">
                                            <div class="doctor-img1">
                                                <a href="javascript:void(0);">
                                                    <img src="{{asset('uploads/profile_pic/clinic/default.jpg')}}" class="img-fluid" alt="User Image">
                                                </a>
                                            </div>
                                            <div class="doc-info-cont">
                                                <h4 class="doc-name mb-2"><a href="javascript:void(0);">{{$clinicUserList->name}}</a></h4>
                                                <div class="rating mb-2">
                                                    <span class="badge badge-primary">{{$clinicUserList->clinic->rating}}</span>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span class="d-inline-block average-rating">({{$clinicUserList->clinic->rating}})</span>
                                                </div>
                                                <div class="clinic-details">
                                                    <div class="clini-infos pt-3">

                                                        <p class="doc-location mb-2"><i class="fas fa-phone-volume mr-1"></i> {{$clinicUserList->clinic->emergency_phone}}</p>
                                                        <p class="doc-location mb-2 text-ellipse"><i class="fas fa-map-marker-alt mr-1"></i> {{$clinicUserList->clinic->clinicContact ? $clinicUserList->clinic->clinicContact->address : ''}} </p>
                                                        <p class="doc-location mb-2"><i class="fas fa-chevron-right mr-1"></i> {{$clinicUserList->clinic->clinicCategory ? $clinicUserList->clinic->clinicCategory->name : ''}}</p>
                                                        <p class="doc-location mb-2"><i class="fas fa-chevron-right mr-1"></i> Opens at {{$clinicUserList->clinic->opens_time}}</p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="doc-info-right">
                                            <div class="clinic-booking">
                                                <a class="view-pro-btn" href="{{route('clinic.details',$clinicUserList->slug)}}">View Details</a>
                                                <a class="apt-btn" href="{{route('clinic.doctor',$clinicUserList->slug)}}">Get A Doctor</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Doctor Widget -->
                        @endforeach
                    @endif

{{--                    <div class="load-more text-center">--}}
{{--                        <a class="btn btn-primary btn-md" href="javascript:void(0);">Load More</a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>

    </div>
@stop
@push('js')

@endpush
