@extends('frontend-shop.layouts.master')
@section('title', 'Contact Us')
@push('css')
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/css/style.css')}}">
@endpush
@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('shop')}}">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Contact Us</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->


        <div class="container">
            <div class="mb-5">
                <h1 class="text-center">Contact Us</h1>
            </div>
            <div class="row mb-10">
                <div class="col-lg-7 col-xl-6 mb-8 mb-lg-0">
                    <div class="mr-xl-6">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Our Address</h3>
                        </div>
                        <address class="mb-6 text-lh-23">
                            Flat No #E1, Home No #2023, Abdus Sobhan Dhali Road, Solmaid, Vatara, Dhaka-1229 (Near Evercare Hospital Dhaka)
                            <br>
                            <div class=""><strong>Phone: </strong> +8801404002233</div>
                            <div class=""><strong>Email: </strong> preventcareltd@gmail.com</div>
                        </address>

                    </div>
                </div>
                <div class="col-lg-5 col-xl-6">
                    <div class="mb-6">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14601.31838381257!2d90.4275532!3d23.806876!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xe1c36c9967b983d2!2sPrevent%20Care%20LTD!5e0!3m2!1sen!2sbd!4v1618814612096!5m2!1sen!2sbd" width="100%" height="288" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
{{--                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835252972956!2d144.95592398991224!3d-37.817327693787625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sin!4v1575470633967!5m2!1sen!2sin" width="100%" height="288" frameborder="0" style="border:0;" allowfullscreen=""></iframe>--}}
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection
