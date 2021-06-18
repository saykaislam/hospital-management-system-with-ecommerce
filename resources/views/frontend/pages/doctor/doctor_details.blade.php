@extends('frontend.layouts.master')
@section('title', 'Doctor Details')
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
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Doctor Details</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Doctor Details</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <!-- Doctor Widget -->
            <div class="card">
                <div class="card-body">
                    <div class="doctor-widget">
                        <div class="doc-info-left">
                            <div class="doctor-img">
                                <img src="{{asset('uploads/profile_pic/doctor/'.$doctorUserDetails->image)}}" class="img-fluid" alt="User Image">
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name">{{$doctorUserDetails->name}}</h4>
                                <p class="doc-speciality">{{$doctorUserDetails->title}}</p>
                                <p class="doc-department">
                                    {{$doctor_speciality_name}}
                                </p>
                                {{--                                <div class="rating">--}}
                                {{--                                    <i class="fas fa-star filled"></i>--}}
                                {{--                                    <i class="fas fa-star filled"></i>--}}
                                {{--                                    <i class="fas fa-star filled"></i>--}}
                                {{--                                    <i class="fas fa-star filled"></i>--}}
                                {{--                                    <i class="fas fa-star"></i>--}}
                                {{--                                    <span class="d-inline-block average-rating">(35)</span>--}}
                                {{--                                </div>--}}

                                <div class="clinic-details">
                                    <p class="doc-location"><i class="fas fa-map-marker-alt"></i>@if($doctor_contacts != null) {{$doctor_contacts->address}} @else No Address Set Yet! @endif</p>
{{--                                    @if(count($clinicDoctors) > 0)--}}
{{--                                    <ul class="clinic-gallery">--}}
{{--                                        <li>--}}
{{--                                            <a href="#" data-fancybox="gallery">--}}
{{--                                                <img src="{{asset('frontend/img/features/feature-01.jpg')}}" alt="Feature">--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                    @endif--}}
                                </div>
                                {{--                                <div class="clinic-services">--}}
                                {{--                                    <span>Dental Fillings</span>--}}
                                {{--                                    <span>Teeth Whitneing</span>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                        <div class="doc-info-right">
                            <div class="clini-infos">
                                <ul>
{{--                                    <li><i class="far fa-thumbs-up"></i> 99%</li>--}}
                                    {{--                                    <li><i class="far fa-comment"></i> 35 Feedback</li>--}}
                                    <li><i class="fas fa-map-marker-alt"></i>@if($doctor_contacts != null) {{$doctor_contacts->address}} @else No Address Set Yet! @endif</li>
                                    <li><i class="far fa-money-bill-alt"></i> Visit Cost: Tk. {{$doctorUserDetails->home_cost}} </li>
                                </ul>
                            </div>
                            <div class="doctor-action">
                                {{--                                <a href="javascript:void(0)" class="btn btn-white fav-btn">--}}
                                {{--                                    <i class="far fa-bookmark"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="javascript:void(0);" class="btn btn-white msg-btn">--}}
                                {{--                                    <i class="far fa-comment-alt"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="javascript:void(0)" class="btn btn-white call-btn" data-toggle="modal" data-target="#voice_call">--}}
                                {{--                                    <i class="fas fa-phone"></i>--}}
                                {{--                                </a>--}}
                                {{--                                <a href="javascript:void(0)" class="btn btn-white call-btn" data-toggle="modal" data-target="#video_call">--}}
                                {{--                                    <i class="fas fa-video"></i>--}}
                                {{--                                </a>--}}
                            </div>
                            <div class="clinic-booking">
                                <a class="apt-btn" href="{{route('doctor.booking',$doctorUserDetails->slug)}}">Book Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Doctor Widget -->

            <!-- Doctor Details Tab -->
            <div class="card">
                <div class="card-body pt-0">
                    <!-- Tab Menu -->
                    <nav class="user-tabs mb-4">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="#doc_overview" data-toggle="tab">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_locations" data-toggle="tab">My CLinic</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_reviews" data-toggle="tab">Reviews</a>
                            </li>
                            {{--                            <li class="nav-item">--}}
                            {{--                                <a class="nav-link" href="#doc_business_hours" data-toggle="tab">Business Hours</a>--}}
                            {{--                            </li>--}}
                        </ul>
                    </nav>
                    <!-- /Tab Menu -->

                    <!-- Tab Content -->
                    <div class="tab-content pt-0">
                        <!-- Overview Content -->
                        <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                            <div class="row">
                                <div class="col-md-12 col-lg-9">
                                    <!-- About Details -->
                                    <div class="widget about-widget">
                                        <h4 class="widget-title">About Me</h4>
                                        <p>{{$doctorUserDetails->personal_statement}}</p>
                                    </div>
                                    <!-- /About Details -->

                                    <!-- Education Details -->
                                    <div class="widget education-widget">
                                        <h4 class="widget-title">Education</h4>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @if(count($doctorEducations) > 0)
                                                    @foreach($doctorEducations as $doctorEducation)
                                                        <li>
                                                            <div class="experience-user">
                                                                <div class="before-circle"></div>
                                                            </div>
                                                            <div class="experience-content">
                                                                <div class="timeline-content">
                                                                    <a href="javascript:void(0);" class="name">{{$doctorEducation->institute}}</a>
                                                                    <div>{{$doctorEducation->degree}}</div>
                                                                    <span class="time">{{$doctorEducation->year_of_completion}}</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Education Details -->

                                    <!-- Experience Details -->
                                    <div class="widget experience-widget">
                                        <h4 class="widget-title">Work & Experience</h4>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @if(count($doctorExperiences) > 0)
                                                    @foreach($doctorExperiences as $doctorExperience)
                                                        <li>
                                                            <div class="experience-user">
                                                                <div class="before-circle"></div>
                                                            </div>
                                                            <div class="experience-content">
                                                                <div class="timeline-content">
                                                                    <a href="javascript:void(0);" class="name">{{$doctorExperience->hospital_name}}</a>
                                                                    <span class="time">{{$doctorExperience->from}} - {{$doctorExperience->to}}</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Experience Details -->

                                    <!-- Awards Details -->
                                    <div class="widget awards-widget">
                                        <h4 class="widget-title">Awards</h4>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @if(count($doctorAwards) > 0)
                                                    @foreach($doctorAwards as $doctorAward)
                                                        <li>
                                                            <div class="experience-user">
                                                                <div class="before-circle"></div>
                                                            </div>
                                                            <div class="experience-content">
                                                                <div class="timeline-content">
                                                                    <p class="exp-year">{{$doctorAward->year}}</p>
                                                                    <h4 class="exp-title">{{$doctorAward->award}}</h4>
                                                                    {{--                                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>--}}
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Awards Details -->

                                    <!-- Services List -->
                                {{--                                    <div class="service-list">--}}
                                {{--                                        <h4>Services</h4>--}}
                                {{--                                        <ul class="clearfix">--}}
                                {{--                                            @if(!empty($doctorSpecialityDoctors))--}}
                                {{--                                                @foreach($doctorSpecialityDoctors as $doctorSpecialityDoctor)--}}
                                {{--                                                    <li>{{$doctorSpecialityDoctor->doctorSpeciality->name}}</li>--}}
                                {{--                                                @endforeach--}}
                                {{--                                            @endif--}}
                                {{--                                        </ul>--}}
                                {{--                                    </div>--}}
                                <!-- /Services List -->

                                    <!-- Specializations List -->
                                    <div class="service-list">
                                        <h4>Specializations</h4>
                                        <ul class="clearfix">
                                            @if(count($doctorSpecialityDoctors) > 0)
                                                @foreach($doctorSpecialityDoctors as $doctorSpecialityDoctor)
                                                    <li>{{$doctorSpecialityDoctor->doctorSpeciality->name}}</li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    <!-- /Specializations List -->

                                </div>
                            </div>
                        </div>
                        <!-- /Overview Content -->

                        <!-- Locations Content -->
                        <div role="tabpanel" id="doc_locations" class="tab-pane fade">
                        @if(count($clinicDoctors) > 0)
                            @foreach($clinicDoctors as $clinicDoctor)
                                @php
                                    $clinic_infos = \Illuminate\Support\Facades\DB::table('clinics')
                                            ->join('users','clinics.user_id','=','users.id')
                                            ->LeftJoin('clinic_contacts','clinics.id','=','clinic_contacts.clinic_id')
                                            ->LeftJoin('clinic_reviews','users.id','=','clinic_reviews.clinic_user_id')
                                            ->where('clinics.id',$clinicDoctor->clinic_id)
                                            ->select('clinics.emergency_phone','clinics.description','clinics.clinic_category_id','clinics.is_active','clinic_contacts.address','users.name','clinic_reviews.rating')
                                            ->first();
                                @endphp
                                <!-- Location List -->
                                    <div class="location-list">
                                        <div class="row">
                                            <!-- Clinic Content -->
                                            <div class="col-md-6">
                                                <div class="clinic-content">
                                                    <h4 class="clinic-name"><a href="javascript:void(0);">{{$clinic_infos->name}}</a></h4>
                                                    <p class="doc-speciality">
                                                        @php
                                                            echo $category = \App\ClinicCategory::where('id',$clinic_infos->clinic_category_id)->pluck('name')->first();
                                                        @endphp
                                                    </p>
                                                    <div class="rating">
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star filled"></i>
                                                        <i class="fas fa-star"></i>
                                                        <span class="d-inline-block average-rating">({{$clinic_infos->rating}})</span>
                                                    </div>
                                                    <div class="clinic-details mb-0">
                                                        <h5 class="clinic-direction"> <i class="fas fa-map-marker-alt"></i> {{$clinic_infos->address}} <br><a href="javascript:void(0);">Get Directions</a></h5>
                                                        <ul>
                                                            <li>
                                                                <a href="{{asset('frontend/img/features/feature-01.jpg')}}" data-fancybox="gallery2">
                                                                    <img src="{{asset('frontend/img/features/feature-01.jpg')}}" alt="Feature Image">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{asset('frontend/img/features/feature-02.jpg')}}" data-fancybox="gallery2">
                                                                    <img src="{{asset('frontend/img/features/feature-02.jpg')}}" alt="Feature Image">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{asset('frontend/img/features/feature-03.jpg')}}" data-fancybox="gallery2">
                                                                    <img src="{{asset('frontend/img/features/feature-03.jpg')}}" alt="Feature Image">
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{asset('frontend/img/features/feature-04.jpg')}}" data-fancybox="gallery2">
                                                                    <img src="{{asset('frontend/img/features/feature-04.jpg')}}" alt="Feature Image">
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Clinic Content -->

                                            <!-- Clinic Timing -->
                                            <div class="col-md-4">
                                                <div class="clinic-timing">
                                                    <div>
                                                        <p class="timings-days">
                                                            <span> Mon - Sat </span>
                                                        </p>
                                                        <p class="timings-times">
                                                            <span>10:00 AM - 2:00 PM</span>
                                                            <span>4:00 PM - 9:00 PM</span>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="timings-days">
                                                            <span>Sun</span>
                                                        </p>
                                                        <p class="timings-times">
                                                            <span>10:00 AM - 2:00 PM</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Clinic Timing -->

                                            <div class="col-md-2">
                                                {{--                                                <div class="consult-price">--}}
                                                {{--                                                    $250--}}
                                                {{--                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Location List -->
                                @endforeach
                            @endif
                        </div>
                        <!-- /Locations Content -->

                        <!-- Reviews Content -->
                        <div role="tabpanel" id="doc_reviews" class="tab-pane fade">

                            <!-- Review Listing -->
                            <div class="widget review-listing">
                                <div class="all-feedback text-center">
                                    <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm">
                                        All feedback
                                    </a>
                                </div>
                                <ul class="comments-list">
                                @if(count($doctorReviews) > 0)
                                @forelse($doctorReviews as $doctorReview)
                                    <!-- Comment List -->
                                        <li>
                                            <div class="comment">
                                                <img class="avatar avatar-sm rounded-circle" alt="User Image" src="{{asset('uploads/profile_pic/user/'.$doctorReview->user->image)}}">
                                                <div class="comment-body">
                                                    <div class="meta-data">
                                                        <span class="comment-author">{{$doctorReview->user->name}}</span>
                                                        <span class="comment-date">Reviewed Recently</span>
                                                        <div class="review-count rating">
                                                            <i class="fas fa-star {{$doctorReview->rating >= 1 ? 'filled' : ''}}"></i>
                                                            <i class="fas fa-star {{$doctorReview->rating >= 2 ? 'filled' : ''}}"></i>
                                                            <i class="fas fa-star {{$doctorReview->rating >= 3 ? 'filled' : ''}}"></i>
                                                            <i class="fas fa-star {{$doctorReview->rating >= 4 ? 'filled' : ''}}"></i>
                                                            <i class="fas fa-star {{$doctorReview->rating >= 5 ? 'filled' : ''}}"></i>
                                                        </div>
                                                    </div>
                                                    <p class="recommended"><i class="far fa-thumbs-up"></i> I recommend the doctor</p>
                                                    <p class="comment-content">
                                                        {{$doctorReview->description}}
                                                    </p>
{{--                                                    <div class="comment-reply">--}}
{{--                                                        <a class="comment-btn" href="javascript:void(0);">--}}
{{--                                                            <i class="fas fa-reply"></i> Reply--}}
{{--                                                        </a>--}}
{{--                                                        <p class="recommend-btn">--}}
{{--                                                            <span>Recommend?</span>--}}
{{--                                                            <a href="javascript:void(0);" class="like-btn">--}}
{{--                                                                <i class="far fa-thumbs-up"></i> Yes--}}
{{--                                                            </a>--}}
{{--                                                            <a href="javascript:void(0);" class="dislike-btn">--}}
{{--                                                                <i class="far fa-thumbs-down"></i> No--}}
{{--                                                            </a>--}}
{{--                                                        </p>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- /Comment List -->
                                    @empty
                                        <div class="all-feedback text-center">
                                            <h5 href="javascript:void(0);" class="text-primary">
                                                Give Us Your Valuable Feedback
                                            </h5>
                                        </div>
                                    @endforelse
                                    @endif

                                </ul>

                                <!-- Show All -->

                                <!-- /Show All -->

                            </div>
                            <!-- /Review Listing -->

                            <!-- Write Review -->
                            <div class="write-review">
                                <h4>Write a review for <strong>{{$doctorUserDetails->name}}</strong></h4>

                                <!-- Write Review Form -->
                                <form action="{{route('doctor.review.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Review</label>
                                        <div class="star-rating">
                                            <input class="form-control" type="hidden" name="user_id" value="{{Auth::user() ? Auth::user()->id : ''}}">
                                            <input class="form-control" type="hidden" name="doctor_user_id" value="{{$doctorUserDetails->id}}">
                                            <input id="star-5" type="radio" name="rating" value="5">
                                            <label for="star-5" title="5 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-4" type="radio" name="rating" value="4">
                                            <label for="star-4" title="4 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-3" type="radio" name="rating" value="3">
                                            <label for="star-3" title="3 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-2" type="radio" name="rating" value="2">
                                            <label for="star-2" title="2 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-1" type="radio" name="rating" value="1">
                                            <label for="star-1" title="1 star">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Title of your review</label>
                                        <input class="form-control" type="text" name="title" placeholder="If you could say it in one sentence, what would you say?">
                                    </div>
                                    <div class="form-group">
                                        <label>Your review</label>
                                        <textarea id="review_desc" maxlength="100" name="description" class="form-control"></textarea>

                                        <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span id="chars">100</span> characters remaining</small></div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <div class="terms-accept">
                                            <div class="custom-checkbox">
                                                <input type="checkbox" id="terms_accept">
                                                <label for="terms_accept">I have read and accept <a href="#">Terms &amp; Conditions</a></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Add Review</button>
                                    </div>
                                </form>
                                <!-- /Write Review Form -->

                            </div>
                            <!-- /Write Review -->

                        </div>
                        <!-- /Reviews Content -->

                        <!-- Business Hours Content -->
                    {{--                        <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">--}}
                    {{--                            <div class="row">--}}
                    {{--                                <div class="col-md-6 offset-md-3">--}}

                    {{--                                    <!-- Business Hours Widget -->--}}
                    {{--                                    <div class="widget business-widget">--}}
                    {{--                                        <div class="widget-content">--}}
                    {{--                                            <div class="listing-hours">--}}
                    {{--                                                <div class="listing-day current">--}}
                    {{--                                                    <div class="day">Today <span>5 Nov 2019</span></div>--}}
                    {{--                                                    <div class="time-items">--}}
                    {{--                                                        <span class="open-status"><span class="badge bg-success-light">Open Now</span></span>--}}
                    {{--                                                        <span class="time">07:00 AM - 09:00 PM</span>--}}
                    {{--                                                    </div>--}}
                    {{--                                                </div>--}}
                    {{--                                                <div class="listing-day">--}}
                    {{--                                                    <div class="day">Monday</div>--}}
                    {{--                                                    <div class="time-items">--}}
                    {{--                                                        <span class="time">07:00 AM - 09:00 PM</span>--}}
                    {{--                                                    </div>--}}
                    {{--                                                </div>--}}
                    {{--                                                <div class="listing-day">--}}
                    {{--                                                    <div class="day">Tuesday</div>--}}
                    {{--                                                    <div class="time-items">--}}
                    {{--                                                        <span class="time">07:00 AM - 09:00 PM</span>--}}
                    {{--                                                    </div>--}}
                    {{--                                                </div>--}}
                    {{--                                                <div class="listing-day">--}}
                    {{--                                                    <div class="day">Wednesday</div>--}}
                    {{--                                                    <div class="time-items">--}}
                    {{--                                                        <span class="time">07:00 AM - 09:00 PM</span>--}}
                    {{--                                                    </div>--}}
                    {{--                                                </div>--}}
                    {{--                                                <div class="listing-day">--}}
                    {{--                                                    <div class="day">Thursday</div>--}}
                    {{--                                                    <div class="time-items">--}}
                    {{--                                                        <span class="time">07:00 AM - 09:00 PM</span>--}}
                    {{--                                                    </div>--}}
                    {{--                                                </div>--}}
                    {{--                                                <div class="listing-day">--}}
                    {{--                                                    <div class="day">Friday</div>--}}
                    {{--                                                    <div class="time-items">--}}
                    {{--                                                        <span class="time">07:00 AM - 09:00 PM</span>--}}
                    {{--                                                    </div>--}}
                    {{--                                                </div>--}}
                    {{--                                                <div class="listing-day">--}}
                    {{--                                                    <div class="day">Saturday</div>--}}
                    {{--                                                    <div class="time-items">--}}
                    {{--                                                        <span class="time">07:00 AM - 09:00 PM</span>--}}
                    {{--                                                    </div>--}}
                    {{--                                                </div>--}}
                    {{--                                                <div class="listing-day closed">--}}
                    {{--                                                    <div class="day">Sunday</div>--}}
                    {{--                                                    <div class="time-items">--}}
                    {{--                                                        <span class="time"><span class="badge bg-danger-light">Closed</span></span>--}}
                    {{--                                                    </div>--}}
                    {{--                                                </div>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <!-- /Business Hours Widget -->--}}

                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    <!-- /Business Hours Content -->

                    </div>
                </div>
            </div>
            <!-- /Doctor Details Tab -->

        </div>
    </div>
    <!-- /Page Content -->
@stop
@push('js')

@endpush
