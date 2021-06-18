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
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Service</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content pt-0">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('frontend/img/slider/serslide.png')}}" alt="First slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="container-fluid mt-4">
            <div class="row">
                {{--                <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">--}}

                {{--                    <!-- Profile Sidebar -->--}}
                {{--                    <div class="profile-sidebar">--}}
                {{--                        <div class="widget-profile pro-widget-content">--}}
                {{--                            <div class="profile-info-widget">--}}
                {{--                                <div class="profile-det-info">--}}
                {{--                                    <h3>Service Providers Category</h3>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <!-- /Profile Sidebar -->--}}

                {{--                </div>--}}
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="doc-review review-listing">
                        <!-- Blog -->
                        <div class="row blog-grid-row">
                            @if(!empty($serviceProviderCategories))
                                @foreach($serviceProviderCategories as $serviceProviderCategory)
                                    <div class="col-md-3 col-xl-3 col-sm-6">
                                        <!-- Blog Post -->
                                        <div class="blog grid-blog">
                                            <div class="blog-image">
                                                <a href="{{url('service-provider/'.$serviceProviderCategory->slug)}}">
                                                    @if(!empty($serviceProviderCategory->image))
                                                        <img class="img-fluid" src="{{asset('uploads/service-provider-category/'.$serviceProviderCategory->image)}}" alt="Post Image">
                                                    @else
                                                        <img class="img-fluid" src="{{asset('uploads/service-provider-category/default.jpg')}}" alt="Post Image">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="blog-content text-center">
                                                <h3 class="blog-title font-weight-bold"><a href="{{url('service-provider/'.$serviceProviderCategory->slug)}}">{{$serviceProviderCategory->name}}</a></h3>
                                                {{--                                                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor.</p>--}}
                                            </div>
                                        </div>
                                        <!-- /Blog Post -->
                                    </div>
                                @endforeach
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
