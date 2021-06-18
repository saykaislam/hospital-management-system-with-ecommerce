<!-- Profile Sidebar -->
<div class="profile-sidebar">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="#" class="booking-doc-img">
                <img src="{{asset('uploads/profile_pic/service_provider/'.Auth::user()->image)}}" alt="User Image">
            </a>
            <div class="profile-det-info">
                <h3>{{Auth::user()->name}}</h3>
                <p class="text-muted mb-0">Service Provider</p>
{{--                <div class="patient-details">--}}
{{--                    <h5 class="mb-0">BDS, MDS - Oral & Maxillofacial Surgery</h5>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li class="active">
                    <a href="{{route('service_provider.dashboard')}}">
                        <i class="fas fa-columns"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('service_provider.order')}}">
                        <i class="fas fa-calendar-check"></i>
                        <span>Order</span>
                    </a>
                </li>
{{--                <li>--}}
{{--                    <a href="my-patients.html">--}}
{{--                        <i class="fas fa-user-injured"></i>--}}
{{--                        <span>My Patients</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="schedule-timings.html">--}}
{{--                        <i class="fas fa-hourglass-start"></i>--}}
{{--                        <span>Schedule Timings</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li>
                    <a href="{{route('service_provider.review')}}">
                        <i class="fas fa-file-invoice"></i>
                        <span>Review</span>
                    </a>
                </li>
{{--                <li>--}}
{{--                    <a href="reviews.html">--}}
{{--                        <i class="fas fa-star"></i>--}}
{{--                        <span>Reviews</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="chat-doctor.html">--}}
{{--                        <i class="fas fa-comments"></i>--}}
{{--                        <span>Message</span>--}}
{{--                        <small class="unread-msg">23</small>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li>
                    <a href="{{route('service_provider.profile')}}">
                        <i class="fas fa-user-cog"></i>
                        <span>Profile Settings</span>
                    </a>
                </li>
{{--                <li>--}}
{{--                    <a href="social-media.html">--}}
{{--                        <i class="fas fa-share-alt"></i>--}}
{{--                        <span>Social Media</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li>
                    <a href="{{route('service_provider.change.password')}}">
                        <i class="fas fa-lock"></i>
                        <span>Change Password</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('logout')}}">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /Profile Sidebar -->
