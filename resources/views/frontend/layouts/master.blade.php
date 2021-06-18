<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>PreventCare</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- Favicons -->
    <link type="image/x-icon" href="{{asset('frontend/img/favicon.png')}}" rel="icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('frontend/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/plugins/fontawesome/css/all.min.css')}}">
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap-datetimepicker.min.css')}}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/slick-theme.css')}}">
    <!-- Daterangepikcer CSS -->
    <link rel="stylesheet" href="{{asset('frontend/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="{{asset('frontend/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('frontend/js/respond.min.js')}}"></script>
    <![endif]-->
    @stack('css')
</head>
<body>

<!-- Main Wrapper -->
<div class="wrapper">
    <!-- Header Start -->
    @include('frontend.includes.header')
    <!--Header End-->
    @yield('content')
    <!-- Header Start -->
    @include('frontend.includes.footer')
    <!--Header End-->
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<!-- Bootstrap Core JS -->
<script src="{{asset('frontend/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<!-- Slick JS -->
<script src="{{asset('frontend/js/slick.min.js')}}"></script>
<!-- Datetimepicker JS -->
<script src="{{asset('frontend/js/moment.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap-datetimepicker.min.js')}}"></script>
<!-- Daterangepikcer JS -->
<script src="{{asset('frontend/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Custom JS -->
<script src="{{asset('frontend/js/script.js')}}"></script>
<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
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
