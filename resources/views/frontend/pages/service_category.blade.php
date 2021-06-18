@extends('frontend.layouts.master')
@section('title', 'Home')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Service Category</li>
                        </ol>
                    </nav>
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

                    <!-- Profile Sidebar -->
                    <div class="profile-sidebar">
                        <div class="widget-profile pro-widget-content">
                            <div class="profile-info-widget">

                                <div class="profile-det-info">
                                    <h3>Services Category</h3>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-widget">
                            <nav class="dashboard-menu">
                                <ul>
                                    @if(count($servicesCategories) > 0)
                                        @foreach($servicesCategories as $servicesCategory)
                                            <li>
                                                <a href="{{url('service-category/'.$servicesCategory->slug)}}">
                                                    <i class="fas fa-columns"></i>
                                                    <span>{{$servicesCategory->name}}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- /Profile Sidebar -->

                </div>
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="doc-review review-listing">
                        <!-- Blog -->
                        <div class="row blog-grid-row">
                            @if(count($servicesCategories) > 0)
                                @foreach($servicesCategories as $servicesCategory)
                                    <div class="col-md-6 col-xl-4 col-sm-12">
                                        <!-- Blog Post -->
                                        <div class="blog grid-blog">
                                            <div class="blog-image">
                                                <a href="{{url('service-category/'.$servicesCategory->slug)}}">
                                                    @if(!empty($servicesCategory->image))
                                                        <img class="img-fluid" src="{{asset('uploads/service-category/'.$servicesCategory->image)}}" alt="Post Image">
                                                    @else
                                                        <img class="img-fluid" src="{{asset('uploads/service-category/default.jpg')}}" alt="Post Image">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="blog-content text-center">
                                                <h3 class="blog-title"><a href="{{url('service-category/'.$servicesCategory->slug)}}">{{$servicesCategory->name}}</a></h3>
{{--                                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>--}}
                                            </div>
                                        </div>
                                        <!-- /Blog Post -->

                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12 col-xl-12 col-sm-12">
                                    <div class="blog grid-blog">
                                        <h3>No Data Found!</h3>
                                    </div>
                                </div>
                            @endif


                        </div>

                        <!-- Blog Pagination -->
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="blog-pagination">--}}
{{--                                    <nav>--}}
{{--                                        <ul class="pagination justify-content-center">--}}
{{--                                            <li class="page-item disabled">--}}
{{--                                                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-double-left"></i></a>--}}
{{--                                            </li>--}}
{{--                                            <li class="page-item">--}}
{{--                                                <a class="page-link" href="#">1</a>--}}
{{--                                            </li>--}}
{{--                                            <li class="page-item active">--}}
{{--                                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>--}}
{{--                                            </li>--}}
{{--                                            <li class="page-item">--}}
{{--                                                <a class="page-link" href="#">3</a>--}}
{{--                                            </li>--}}
{{--                                            <li class="page-item">--}}
{{--                                                <a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </nav>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- /Blog Pagination -->
                        <!-- /Blog -->

                    </div>
                </div>
            </div>
        </div>

    </div>
    @stop
    @push('js')

    @endpush
