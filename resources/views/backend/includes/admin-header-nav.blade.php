<!-- Header -->
<div class="header">

    <!-- Logo -->
    <div class="header-left">
        <a href="{{route('admin.dashboard')}}" class="logo">
{{--            <img src="{{asset('backend/admin/img/logo.png')}}" alt="Logo">--}}
            <h2 class="font-weight-bold mt-2">Prevent Care</h2>
        </a>
        <a href="/" class="logo logo-small">
            <img src="{{asset('frontend/img/logo.jpg')}}" alt="Logo" width="30" height="30">
        </a>
    </div>
    <!-- /Logo -->

    <!-- Mobile Menu Toggle -->
    <a class="mobile_btn" id="mobile_btn">
        <i class="fa fa-bars"></i>
    </a>
    <!-- /Mobile Menu Toggle -->

    <!-- Header Right Menu -->
    <ul class="nav user-menu">

        <!-- User Menu -->
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img"><img class="rounded-circle" src="{{asset('backend/admin/img/profiles/avatar-01.jpg')}}" width="31" alt="Ryan Taylor"></span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="{{asset('backend/admin/img/profiles/avatar-01.jpg')}}" alt="User Image" class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        <h6>{{Auth::user()->name}}</h6>
                        <p class="text-muted mb-0">Administrator</p>
                    </div>
                </div>
                <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
            </div>
        </li>
        <!-- /User Menu -->

    </ul>
    <!-- /Header Right Menu -->

</div>
<!-- /Header -->
