<!-- Profile Sidebar -->
<div class="profile-sidebar">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="#" class="booking-doc-img">
                <img src="{{asset('uploads/profile_pic/clinic/'.Auth::user()->image)}}" alt="User Image">
            </a>
            <div class="profile-det-info">
                <h3>{{Auth::user()->name}}</h3>

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
                    <a href="{{route('clinic.dashboard')}}">
                        <i class="fas fa-columns"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
{{--                <li>--}}
{{--                    <a href="appointments.html">--}}
{{--                        <i class="fas fa-calendar-check"></i>--}}
{{--                        <span>Appointments</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
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
{{--                <li>--}}
{{--                    <a href="invoices.html">--}}
{{--                        <i class="fas fa-file-invoice"></i>--}}
{{--                        <span>Invoices</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="reviews.html">--}}
{{--                        <i class="fas fa-star"></i>--}}
{{--                        <span>Reviews</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li>
                    <a href="{{route('clinic.doctor.list')}}">
                        <i class="fas fa-comments"></i>
                        <span>Clinic Doctor List</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('clinic.labTest.index')}}">
                        <i class="fas fa-comments"></i>
                        <span>Clinic/Lab Test List</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('clinic.lab.test.order')}}">
                        <i class="fas fa-comments"></i>
                        <span>Clinic/Lab Test Order</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('clinic.ambulance.index')}}">
                        <i class="fas fa-ambulance"></i>
                        <span>Our Ambulance</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('clinic.blood-bank.index')}}">
                        <i class="fas fa-map-marker"></i>
                        <span>Blood Bank</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('clinic.profile')}}">
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
                    <a href="{{route('clinic.change.password')}}">
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
