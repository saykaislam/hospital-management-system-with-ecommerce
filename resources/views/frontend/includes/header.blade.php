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
                <a href="{{route('index')}}" class="menu-logo">
                    <h1>PreventCare</h1>
                </a>
                <a id="menu_close" class="menu-close" href="javascript:void(0);">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <ul class="main-nav">
                @if(Auth::guest())
                    <li class="login-link">
                        <a href="{{route('login')}}">Login</a>
                    </li>
                @else
                    <li class="login-link">
                        <a href="{{route('user.dashboard')}}">Dashboard</a>
                    </li>
                    <li class="login-link">
                        <a href="{{route('logout')}}">Logout</a>
                    </li>
                @endif

                <li class="login-link">
                    <a href="/shop">Shop</a>
                </li>
                <li class="login-link">
                    <a href="/lab-test">Lab Test</a>
                </li>
                <li class="login-link">
                    <a href="/question-form">Any Question</a>
                </li>
                <li class="login-link">
                    <a href="/service-provider-category">Services</a>
                </li>
                <li class="login-link">
                    <a href="/cart"><span class="number-cart" id="number-cart"><i class="fa fa-shopping-cart"></i>{{Cart::count()}}</span></a>
                </li>
            </ul>
        </div>
        <ul class="nav header-navbar-rht">
            {{--            <li class="nav-item">--}}
            {{--                <div class="ttm-header-icons ">--}}
            {{--                    <span class="ttm-header-icon ttm-header-cart-link">--}}
            {{--                        <a href="{{route('question.form')}}">--}}
            {{--                            <i class="far fa-comment"></i> Any Question--}}
            {{--                        </a>--}}
            {{--                    </span>--}}
            {{--                </div>--}}
            {{--            </li>--}}
            <li class="nav-item">
                <div class="ttm-header-icons ">
                    <span class="ttm-header-icon ttm-header-cart-link">
                        <a href="/cart"><i class="fa fa-shopping-cart"></i>
                            <span class="number-cart" id="number-cart">{{Cart::count()}}</span>
                        </a>
                    </span>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link header-login" href="{{route('question.form')}}"><i class="far fa-comment mr-1" aria-hidden="true"></i>Any Question</a>
            </li>
            <li class="nav-item">
                <a class="nav-link header-login" href="{{route('test')}}"><i class="fa fa-flask mr-1" aria-hidden="true"></i>Lab Test</a>
            </li>
            <li class="nav-item">
                <a class="nav-link header-login" href="{{route('shop')}}"><i class="fa fa-shopping-bag mr-1" aria-hidden="true"></i>Shop</a>
            </li>

            @if(Auth::guest())
                {{--                <li class="nav_extra_mobile" style="display: none;"><a href="{{route('login')}}">Login/Signup</a></li>--}}
                <li class="nav-item">
                    <a style="background-color: #dc5194;color: #ffffff" class="nav-link header-login" href="{{route('login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i>Login / Signup </a>
                </li>
            @else
                {{--                <li class="nav_extra_mobile" style="display: none;"><a href="/checkout">Checkout</a></li>--}}
                {{--                <li class="nav_extra_mobile" style="display: none;"><a class="" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">LOGOUT</a></li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="/checkout">Checkout</a>--}}
                {{--                </li>--}}
                <li class="nav-item">
                    {{--                    <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">LOGOUT</a>--}}
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
								<span class="user-img">
                                    @if(Auth::user()->role_id == 2)
                                        <img class="rounded-circle" src="{{asset('uploads/profile_pic/doctor/'.Auth::user()->image)}}" width="31" alt="{{Auth::user()->name}}">
                                    @elseif(Auth::user()->role_id == 3)
                                        <img class="rounded-circle" src="{{asset('uploads/profile_pic/clinic/'.Auth::user()->image)}}" width="31" alt="{{Auth::user()->name}}">
                                    @elseif(Auth::user()->role_id == 4)
                                        <img class="rounded-circle" src="{{asset('uploads/profile_pic/service_provider/'.Auth::user()->image)}}" width="31" alt="{{Auth::user()->name}}">
                                    @elseif(Auth::user()->role_id == 5)
                                        <img class="rounded-circle" src="{{asset('uploads/profile_pic/user/'.Auth::user()->image)}}" width="31" alt="{{Auth::user()->name}}">
                                    @elseif(Auth::user()->role_id == 6)
                                        <img class="rounded-circle" src="{{asset('uploads/vendor/service_provider/'.Auth::user()->image)}}" width="31" alt="{{Auth::user()->name}}">
                                    @endif
								</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="user-header">
{{--                                <div class="avatar avatar-sm">--}}
{{--                                    <img src="{{asset('backend/user/img/doctors/doctor-thumb-02.jpg')}}" alt="User Image" class="avatar-img rounded-circle">--}}
{{--                                </div>--}}
                            <div class="avatar avatar-sm">
                                @if(Auth::user()->role_id == 2)
                                    <img src="{{asset('uploads/profile_pic/doctor/'.Auth::user()->image)}}" alt="User Image" class="avatar-img rounded-circle">
                                @elseif(Auth::user()->role_id == 3)
                                    <img src="{{asset('uploads/profile_pic/clinic/'.Auth::user()->image)}}" alt="User Image" class="avatar-img rounded-circle">
                                @elseif(Auth::user()->role_id == 4)
                                    <img src="{{asset('uploads/profile_pic/service_provider/'.Auth::user()->image)}}" alt="User Image" class="avatar-img rounded-circle">
                                @elseif(Auth::user()->role_id == 5)
                                    <img src="{{asset('uploads/profile_pic/user/'.Auth::user()->image)}}" alt="User Image" class="avatar-img rounded-circle">
                                @elseif(Auth::user()->role_id == 6)
                                    <img src="{{asset('uploads/profile_pic/vendor/'.Auth::user()->image)}}" alt="User Image" class="avatar-img rounded-circle">
                                @endif
                            </div>
                            <div class="user-text">
                                <h6>{{Auth::user()->name}}</h6>
                                <p class="text-muted mb-0">
                                    @if(Auth::user()->role_id == 2)
                                        Doctor
                                    @elseif(Auth::user()->role_id == 3)
                                        Clinic
                                    @elseif(Auth::user()->role_id == 4)
                                        Service Provider
                                    @elseif(Auth::user()->role_id == 5)
                                        User
                                    @elseif(Auth::user()->role_id == 6)
                                        Vendor
                                    @endif
                                </p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{route('index')}}">Home</a>
                        <a class="dropdown-item" href="{{route('user.dashboard')}}">Dashboard</a>
                        <a class="dropdown-item   " href="{{route('user.profile')}}">Profile Settings</a>
                        <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                    </div>
                </li>
            @endif

        </ul>
    </nav>
</header>
<!-- /Header -->
