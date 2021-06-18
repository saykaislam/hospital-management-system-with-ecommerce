<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> @yield('title')|PreventCare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <!-- Favicons -->
    <link href="{{asset('backend/user/img/favicon.png')}}" rel="icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('backend/user/css/bootstrap.min.css')}}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('backend/user/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/user/plugins/fontawesome/css/all.min.css')}}">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('backend/user/plugins/select2/css/select2.min.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('backend/user/css/style.css')}}">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <style>
        .dashboard-menu {
            background-color: beige !important;
        }
    </style>

@stack('css')

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="{{asset('backend/user/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('backend/user/js/respond.min.js')}}"></script>
    <![endif]-->

</head>
<body>

<!-- Main Wrapper -->
<div class="wrapper">

    <!-- Header Start -->
@include('backend.includes.user-header')
<!--Header End-->

    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Dashboard</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                    <!-- Sidebar Start -->
                @include('backend.includes.user-sidebar')
                <!--Sidebar End-->

                </div>

                <div class="col-md-7 col-lg-8 col-xl-9">
                    @yield('content')
                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->

    <!-- Footer -->
    <footer class="footer">
        <!-- Footer Top -->
        <div class="footer-top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6">

                        <!-- Footer Widget -->
                        <div class="footer-widget footer-about">
                            <div class="footer-logo">
                                {{--                                <img src="{{asset('backend/user/img/footer-logo.png')}}" alt="logo">--}}
                                <h3 style="color: white">PreventCare</h3>
                            </div>
                            <div class="footer-about-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                <div class="social-icon">
                                    <ul>
                                        <li>
                                            <a href="#" target="_blank"><i class="fab fa-facebook-f"></i> </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank"><i class="fab fa-twitter"></i> </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank"><i class="fab fa-dribbble"></i> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /Footer Widget -->
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <!-- Footer Widget -->
                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">For Patients</h2>
                            <ul>
                                <li><a href="search.html">Search for Doctors</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="register.html">Register</a></li>
                                <li><a href="booking.html">Booking</a></li>
                                <li><a href="patient-dashboard.html">Patient Dashboard</a></li>
                            </ul>
                        </div>
                        <!-- /Footer Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <!-- Footer Widget -->
                        <div class="footer-widget footer-menu">
                            <h2 class="footer-title">For Doctors</h2>
                            <ul>
                                <li><a href="appointments.html">Appointments</a></li>
                                <li><a href="chat.html">Chat</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="doctor-register.html">Register</a></li>
                                <li><a href="doctor-dashboard.html">Doctor Dashboard</a></li>
                            </ul>
                        </div>
                        <!-- /Footer Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <!-- Footer Widget -->
                        <div class="footer-widget footer-contact">
                            <h2 class="footer-title">Contact Us</h2>
                            <div class="footer-contact-info">
                                <div class="footer-address">
                                    <span><i class="fas fa-map-marker-alt"></i></span>
                                    <p> 3556  Beech Street, San Francisco,<br> California, CA 94108 </p>
                                </div>
                                <p>
                                    <i class="fas fa-phone-alt"></i>
                                    +1 315 369 5943
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-envelope"></i>
                                    doccure@example.com
                                </p>
                            </div>
                        </div>
                        <!-- /Footer Widget -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /Footer Top -->

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container-fluid">
                <!-- Copyright -->
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="copyright-text">
                                <p class="mb-0">&copy; 2020 PreventCare. All rights reserved.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <!-- Copyright Menu -->
                            <div class="copyright-menu">
                                <ul class="policy-menu">
                                    <li><a href="term-condition.html">Terms and Conditions</a></li>
                                    <li><a href="privacy-policy.html">Policy</a></li>
                                </ul>
                            </div>
                            <!-- /Copyright Menu -->
                        </div>
                    </div>
                </div>
                <!-- /Copyright -->
            </div>
        </div>
        <!-- /Footer Bottom -->
    </footer>
    <!-- /Footer -->
</div>
<!-- /Main Wrapper -->
<!-- jQuery -->
<script src="{{asset('backend/user/js/jquery.min.js')}}"></script>

<!-- Bootstrap Core JS -->
<script src="{{asset('backend/user/js/popper.min.js')}}"></script>
<script src="{{asset('backend/user/js/bootstrap.min.js')}}"></script>

<!-- Slick JS -->
{{--<script src="{{asset('backend/user/js/slick.js')}}"></script>--}}

<!-- Select2 JS -->
<script src="{{asset('backend/user/select2/js/select2.min.js')}}"></script>

<!-- Custom JS -->
<script src="{{asset('backend/user/js/script.js')}}"></script>

<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
<script src="http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
    @if($errors->any())
        @foreach($errors->all() as $error )
            toastr.error('{{$error}}','Error',{
                closeButton:true,
                progressBar:true
            });
        @endforeach
    @endif
</script>

@stack('js')

</body>

</html>
