<!-- Profile Sidebar -->
<div class="profile-sidebar">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="#" class="booking-doc-img">
                <img src="{{asset('uploads/profile_pic/doctor/'.Auth::user()->image)}}" alt="User Image">
            </a>
            <div class="profile-det-info">
                <h3>{{Auth::user()->name}}</h3>

                <div class="patient-details">
                    <h5 class="mb-0">
                        @php
                            echo $title = \Illuminate\Support\Facades\DB::table('doctors')
                        ->join('users','doctors.user_id','=','users.id')
                        ->where('doctors.user_id',\Illuminate\Support\Facades\Auth::user()->id)
                        ->pluck('doctors.title')
                        ->first();
                        @endphp
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li >
                    <a href="{{route('doctor.dashboard')}}">
                        <i class="fas fa-columns"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
{{--                <li class="active">--}}
{{--                    <a href="appointments.html">--}}
{{--                        <i class="fas fa-calendar-check"></i>--}}
{{--                        <span>Appointments</span>--}}
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
{{--                <li>--}}
{{--                    <a href="chat-doctor.html">--}}
{{--                        <i class="fas fa-comments"></i>--}}
{{--                        <span>Message</span>--}}
{{--                        <small class="unread-msg">23</small>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li>
                    <a href="{{route('doctor.profile')}}">
                        <i class="fas fa-user-cog"></i>
                        <span>Profile Settings</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('doctor.patient.list')}}">
                        <i class="fas fa-user-injured"></i>
                        <span>My Patients</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('doctor.users.question.list')}}">
                        <i class="fas fa-share-alt"></i>
                        <span>Questions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ $title ? route('doctor.clinicSchedules.create') : 'javascript:void(0)'}}">
                        <i class="fas fa-hourglass-start"></i>
                        <span>Clinic Schedule Timings</span>
                    </a>
                </li>
{{--                <li>--}}
{{--                    <a href="{{route('doctor.my.lab.list')}}">--}}
{{--                        <i class="fas fa-share-alt"></i>--}}
{{--                        <span>My Labs</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li>
                    <a href="{{route('doctor.change.password')}}">
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
