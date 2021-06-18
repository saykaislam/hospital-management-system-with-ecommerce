<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title> @yield('title') |PreventCare </title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/admin/img/favicon.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('backend/admin/css/bootstrap.min.css')}}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('backend/admin/css/font-awesome.min.css')}}">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{asset('backend/admin/css/feathericon.min.css')}}">

    <link rel="stylesheet" href="{{asset('backend/admin/plugins/morris/morris.css')}}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('backend/admin/css/style.css')}}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

    <!--[if lt IE 9]>
    <script src="{{asset('backend/admin/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('backend/admin/js/respond.min.js')}}"></script>
    <![endif]-->
    @stack('css')
</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- Header Start -->
    @include('backend.includes.vendor-header-nav')
    <!--Header End-->

    <!-- Sidebar Start -->
    @include('backend.includes.vendor-sidebar')
    <!--Sidebar End-->

    <!-- Page Wrapper -->
@yield('content')
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->
<!-- jQuery -->
<script src="{{asset('backend/admin/js/jquery-3.2.1.min.js')}}"></script>

<!-- Bootstrap Core JS -->
<script src="{{asset('backend/admin/js/popper.min.js')}}"></script>
<script src="{{asset('backend/admin/js/bootstrap.min.js')}}"></script>

<!-- Slimscroll JS -->
<script src="{{asset('backend/admin/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

<script src="{{asset('backend/admin/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('backend/admin/plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('backend/admin/js/chart.morris.js')}}"></script>

<!-- Custom JS -->
<script  src="{{asset('backend/admin/js/script.js')}}"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
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
