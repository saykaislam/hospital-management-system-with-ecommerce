<!-- Header -->
<header class="header">
    <nav class="navbar navbar-expand-lg header-nav">
        <div class="navbar-header">
            <a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
            </a>
            <a href="{{route('index')}}" class="navbar-brand logo">
                <img src="{{asset('frontend/img/logo.jpg')}}" class="img-fluid" alt="Logo">
            </a>
        </div>
        <div class="main-menu-wrapper">
            <div class="menu-header">
                <a href="index.html" class="menu-logo">
                    <img src="{{asset('frontend/img/logo.jpg')}}" class="img-fluid" alt="Logo">
                </a>
                <a id="menu_close" class="menu-close" href="javascript:void(0);">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <ul class="main-nav">
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a href="/shop">Shop</a>
                </li>
{{--                <li class="has-submenu active">--}}
{{--                    <a href="#">Doctors <i class="fas fa-chevron-down"></i></a>--}}
{{--                    <ul class="submenu">--}}
{{--                        <li class="active"><a href="doctor-dashboard.html">Doctor Dashboard</a></li>--}}
{{--                        <li class="has-submenu">--}}
{{--                            <a href="doctor-blog.html">Blog</a>--}}
{{--                            <ul class="submenu">--}}
{{--                                <li><a href="doctor-blog.html">Blog</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
                <li class="login-link">
                    @if(Auth::guest())
                        <a href="{{route('register')}}">Register</a>
                        <span class="text-gray-50">or</span>
                        <a href="{{route('seller.login')}}">Login</a>
                    @else
                        <a href="{{route('logout')}}">Logout</a>
                    @endif
                </li>
            </ul>
        </div>
        <ul class="nav header-navbar-rht">
{{--            <li class="nav-item contact-item">--}}
{{--                <div class="header-contact-img">--}}
{{--                    <i class="far fa-hospital"></i>--}}
{{--                </div>--}}
{{--                <div class="header-contact-detail">--}}
{{--                    <p class="contact-header">Contact</p>--}}
{{--                    <p class="contact-info-header"> +1 315 369 5943</p>--}}
{{--                </div>--}}
{{--            </li>--}}

            <!-- User Menu -->
            <li class="nav-item dropdown has-arrow logged-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <span class="user-img">
                        <img class="rounded-circle" src="{{asset('uploads/profile_pic/user/'.Auth::user()->image)}}" width="31" alt="No Image">
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="user-header">
                        <div class="avatar avatar-sm">
                            <img src="{{asset('uploads/profile_pic/user/'.Auth::user()->image)}}" alt="User Image" class="avatar-img rounded-circle">
                        </div>
                        <div class="user-text">
                            <h6>{{Auth::user()->name}}</h6>
                            <p class="text-muted mb-0">User</p>
                        </div>
                    </div>
                    <a class="dropdown-item" href="{{route('index')}}">Home</a>
                    <a class="dropdown-item" href="{{route('shop')}}">Shop</a>
                    <a class="dropdown-item" href="{{route('user.dashboard')}}">Dashboard</a>
                    <a class="dropdown-item" href="{{route('user.profile')}}">Profile Settings</a>
                    <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                </div>
            </li>
            <!-- /User Menu -->

        </ul>
    </nav>
</header>
<!-- /Header -->
