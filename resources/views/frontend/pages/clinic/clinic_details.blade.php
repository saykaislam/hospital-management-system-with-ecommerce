@extends('frontend.layouts.master')
@section('title', 'Clinic Details')
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
                            <li class="breadcrumb-item active" aria-current="page">Clinic Details</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Clinic Details</h2>
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
                            <div class="doctor-img1">
                                <a href="javascript:void(0);">
                                    <img src="{{asset('uploads/profile_pic/clinic/default.jpg')}}" class="img-fluid" alt="User Image">
                                </a>
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name mb-2"><a href="javascript:void(0);">{{$clinicUserDetails->name}}</a></h4>
                                <div class="rating mb-2">
                                    <span class="badge badge-primary">{{$clinicUserDetails->rating}}</span>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i>
                                    <span class="d-inline-block average-rating">({{$clinicUserDetails->rating}})</span>
                                </div>
                                <div class="clinic-details">
                                    <div class="clini-infos pt-3">

                                        <p class="doc-location mb-2"><i class="fas fa-phone-volume mr-1"></i> {{$clinicUserDetails->emergency_phone}}</p>
                                        <p class="doc-location mb-2 text-ellipse"><i class="fas fa-map-marker-alt mr-1"></i> {{$clinicUserDetails->address}} </p>
                                        <p class="doc-location mb-2"><i class="fas fa-chevron-right mr-1"></i> {{$clinicUserDetails->clinic_category_name}}</p>

                                        <p class="doc-location mb-2"><i class="fas fa-chevron-right mr-1"></i> Opens at {{$clinicUserDetails->opens_time}}</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="doc-info-right d-flex align-items-center justify-content-center">
                            <div class="clinic-booking">
                                <a class="view-pro-btn" href="{{route('question.form')}}">Question?</a>
{{--                                <a class="apt-btn" href="#" data-toggle="modal" data-target="#voice_call">Call Now</a>--}}
                                <a href="{{route('clinic.doctor',$clinicUserDetails->slug)}}" class="view-pro-btn">Get A Doctors</a>
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
                                <a class="nav-link" href="#doc_locations" data-toggle="tab">Locations</a>
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
                                <div class="col-md-9">

                                    <!-- About Details -->
                                    <div class="widget about-widget">
                                        <h4 class="widget-title">About Me</h4>
                                        <p>{{$clinicUserDetails->description}}</p>
                                    </div>
                                    <!-- /About Details -->


                                    <!-- Awards Details -->
{{--                                    <div class="widget awards-widget">--}}
{{--                                        <h4 class="widget-title">Awards</h4>--}}
{{--                                        <div class="experience-box">--}}
{{--                                            <ul class="experience-list">--}}
{{--                                                <li>--}}
{{--                                                    <div class="experience-user">--}}
{{--                                                        <div class="before-circle"></div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="experience-content">--}}
{{--                                                        <div class="timeline-content">--}}
{{--                                                            <p class="exp-year">July 2019</p>--}}
{{--                                                            <h4 class="exp-title">Humanitarian Award</h4>--}}
{{--                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <div class="experience-user">--}}
{{--                                                        <div class="before-circle"></div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="experience-content">--}}
{{--                                                        <div class="timeline-content">--}}
{{--                                                            <p class="exp-year">March 2011</p>--}}
{{--                                                            <h4 class="exp-title">Certificate for International Volunteer Service</h4>--}}
{{--                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <div class="experience-user">--}}
{{--                                                        <div class="before-circle"></div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="experience-content">--}}
{{--                                                        <div class="timeline-content">--}}
{{--                                                            <p class="exp-year">May 2008</p>--}}
{{--                                                            <h4 class="exp-title">The Dental Professional of The Year Award</h4>--}}
{{--                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <!-- /Awards Details -->

                                </div>
                            </div>
                        </div>
                        <!-- /Overview Content -->

                        <!-- Locations Content -->
                        <div role="tabpanel" id="doc_locations" class="tab-pane fade">

                            <!-- Location List -->
                            <div class="location-list">
                                <div class="row">

                                    <!-- Clinic Content -->
                                    <div class="col-md-4">
                                        <div class="clinic-content">
                                            <h4 class="clinic-name"><a href="#">{{$clinicUserDetails->name}}</a></h4>
                                            <div class="rating">
                                                <i class="fas fa-star {{$clinicUserDetails->rating >= 1 ? 'filled' : ''}}"></i>
                                                <i class="fas fa-star {{$clinicUserDetails->rating >= 1 ? 'filled' : ''}}"></i>
                                                <i class="fas fa-star {{$clinicUserDetails->rating >= 1 ? 'filled' : ''}}"></i>
                                                <i class="fas fa-star {{$clinicUserDetails->rating >= 1 ? 'filled' : ''}}"></i>
                                                <i class="fas fa-star {{$clinicUserDetails->rating >= 1 ? 'filled' : ''}}"></i>
                                                <span class="d-inline-block average-rating">({{$clinicUserDetails->rating}})</span>
                                            </div>
                                            <div class="clinic-details mb-0">
                                                <h5 class="clinic-direction">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    {{$clinicUserDetails->address}}
                                                    <br>
{{--                                                    <a href="javascript:void(0);">Get Directions</a>--}}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Clinic Content -->

                                    <!-- Clinic Timing -->
                                    <div class="col-md-8">
                                        <div class="clinic-timing">
                                            <div>
{{--                                                <p class="timings-days">--}}
{{--                                                    <span> Mon - Sat </span>--}}
{{--                                                </p>--}}
                                                <p class="timings-times">
                                                    @if(count($clinicOpenCloses) > 0)
                                                        @foreach($clinicOpenCloses as $clinicOpenClose)
                                                            <span>{{$clinicOpenClose->day}} - {{$clinicOpenClose->open_close_status}} {{$clinicOpenClose->open_close_status == 'Open' ? " - ".$clinicOpenClose->open_time : ''}} {{$clinicOpenClose->open_close_status == 'Open' ? " - ".$clinicOpenClose->close_time : ''}}</span>
                                                        @endforeach
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Clinic Timing -->

                                </div>
                            </div>
                            <!-- /Location List -->

                        </div>
                        <!-- /Locations Content -->

                        <!-- Reviews Content -->
                        <div role="tabpanel" id="doc_reviews" class="tab-pane fade">

                            <!-- Review Listing -->
                            <div class="widget review-listing">
                                <ul class="comments-list">

                                    @if(!empty($clinicReviews))
                                        @foreach($clinicReviews as $clinicReview)
                                        <!-- Comment List -->
                                        <li>
                                            <div class="comment">
                                                <img class="avatar avatar-sm rounded-circle" alt="User Image" src="{{asset('uploads/profile_pic/clinic/'.$clinicUserDetails->image)}}">
                                                <div class="comment-body">
                                                    <div class="meta-data">
                                                        <span class="comment-author">{{$clinicUserDetails->name}}</span>
                                                        <span class="comment-date">Reviewed 2 Days ago</span>
                                                        <div class="review-count rating">
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p class="recommended"><i class="far fa-thumbs-up"></i> I recommend the doctor</p>
                                                    <p class="comment-content">
                                                        {{$clinicReview->description}}
                                                    </p>
                                                    <div class="comment-reply">
                                                        <a class="comment-btn" href="javascript:void(0);">
                                                            <i class="fas fa-reply"></i> Reply
                                                        </a>
                                                        <p class="recommend-btn">
                                                            <span>Recommend?</span>
                                                            <a href="javascript:void(0);" class="like-btn">
                                                                <i class="far fa-thumbs-up"></i> Yes
                                                            </a>
                                                            <a href="javascript:void(0);" class="dislike-btn">
                                                                <i class="far fa-thumbs-down"></i> No
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Comment Reply -->
{{--                                            <ul class="comments-reply">--}}
{{--                                                <li>--}}
{{--                                                    <div class="comment">--}}
{{--                                                        <img class="avatar avatar-sm rounded-circle" alt="User Image" src="{{asset('frontend/img/patients/patient1.jpg')}}">--}}
{{--                                                        <div class="comment-body">--}}
{{--                                                            <div class="meta-data">--}}
{{--                                                                <span class="comment-author">Lindsey Kesterson</span>--}}
{{--                                                                <span class="comment-date">Reviewed 3 Days ago</span>--}}
{{--                                                                <div class="review-count rating">--}}
{{--                                                                    <i class="fas fa-star filled"></i>--}}
{{--                                                                    <i class="fas fa-star filled"></i>--}}
{{--                                                                    <i class="fas fa-star filled"></i>--}}
{{--                                                                    <i class="fas fa-star filled"></i>--}}
{{--                                                                    <i class="fas fa-star"></i>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <p class="comment-content">--}}
{{--                                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit,--}}
{{--                                                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.--}}
{{--                                                                Ut enim ad minim veniam.--}}
{{--                                                                Curabitur non nulla sit amet nisl tempus--}}
{{--                                                            </p>--}}
{{--                                                            <div class="comment-reply">--}}
{{--                                                                <a class="comment-btn" href="#">--}}
{{--                                                                    <i class="fas fa-reply"></i> Reply--}}
{{--                                                                </a>--}}
{{--                                                                <p class="recommend-btn">--}}
{{--                                                                    <span>Recommend?</span>--}}
{{--                                                                    <a href="#" class="like-btn">--}}
{{--                                                                        <i class="far fa-thumbs-up"></i> Yes--}}
{{--                                                                    </a>--}}
{{--                                                                    <a href="#" class="dislike-btn">--}}
{{--                                                                        <i class="far fa-thumbs-down"></i> No--}}
{{--                                                                    </a>--}}
{{--                                                                </p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
                                            <!-- /Comment Reply -->

                                        </li>
                                        <!-- /Comment List -->
                                        @endforeach
                                    @endif

                                </ul>

                                <!-- Show All -->
                                <div class="all-feedback text-center">
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm">
                                        Show all feedback <strong>(1)</strong>
                                    </a>
                                </div>
                                <!-- /Show All -->

                            </div>
                            <!-- /Review Listing -->

                            <!-- Write Review -->
                            <div class="write-review">
                                <h4>Write a review for <strong>{{$clinicUserDetails->name}}</strong></h4>

                                <!-- Write Review Form -->
                                <form action="{{route('clinic.review.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Review</label>
                                        <div class="star-rating">
                                            <input class="form-control" type="hidden" name="user_id" value="{{Auth::user() ? Auth::user()->id : ''}}">
                                            <input class="form-control" type="hidden" name="clinic_user_id" value="{{$clinicUserDetails->id}}">
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
