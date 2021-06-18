<!-- Profile Sidebar -->
<div class="profile-sidebar">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="#" class="booking-doc-img">
                <img src="{{asset('uploads/profile_pic/user/'.Auth::user()->image)}}" alt="User Image">
            </a>
            <div class="profile-det-info">
                <h3>{{Auth::user()->name}}</h3>
                <p class="text-muted mb-0">User</p>
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
                    <a href="{{route('user.dashboard')}}">
                        <i class="fas fa-columns"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.service.order')}}">
                        <i class="fas fa-calendar-check"></i>
                        <span>Service Order</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.clinic.doctor.appointment')}}" class=""><i class="fas fa-hourglass-start"></i>
                        <span>Doctor Appointment Order</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.product.order')}}" class=""><i class="fas fa-hourglass-start"></i>
                        <span>Product Order</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.product.wishlist')}}" class=""><i class="fas fa-heart"></i>
                        <span>Product Wishlist</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.address.index')}}" class=""><i class="fas fa-hourglass-start"></i>
                        <span>address</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.lab.test.order')}}" class=""><i class="fas fa-hourglass-start"></i>
                        <span>Lab Test Order</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.favorite-shop.list')}}" class=""><i class="fas fa-store"></i>
                        <span>Favorite Shop</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.question')}}">
                        <i class="fa fa-question-circle" aria-hidden="true"></i>
                        <span>My Question</span>
                    </a>
                </li>

{{--                <li class="submenu">--}}
{{--                    <a href="#" class=""><i class="fe fe-layout"></i><span>Service List</span> <span class="menu-arrow"></span></a>--}}
{{--                    <ul>--}}
{{--                        <li><a href="">Service Provider Category</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}


{{--                <li>--}}
{{--                    <a href="my-patients.html">--}}
{{--                        <i class="fas fa-user-injured"></i>--}}
{{--                        <span>My Patients</span>--}}
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
{{--                <li>--}}
{{--                    <a href="{{route('user.profile')}}">--}}
{{--                        <i class="fas fa-user-cog"></i>--}}
{{--                        <span>Profile Settings</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="social-media.html">--}}
{{--                        <i class="fas fa-share-alt"></i>--}}
{{--                        <span>Social Media</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li>
                    <a href="{{route('user.change.password')}}">
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
