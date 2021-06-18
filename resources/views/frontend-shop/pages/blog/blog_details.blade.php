@extends('frontend-shop.layouts.master')
@section('title', 'Blogs')
@push('css')
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/css/style.css')}}">
@endpush
@section('content')
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('shop')}}">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('blog.list')}}">Blogs</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{$blog->title}}</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-wd">
                    <div class="min-width-1100-wd">
                        <article class="card mb-8 border-0">
                            <img class="img-fluid" src="{{url($blog->image)}}" alt="Image Description">
                            <div class="card-body pt-5 pb-0 px-0">
                                <div class="d-block d-md-flex flex-center-between mb-4 mb-md-0">
                                    <h4 class="mb-md-3 mb-1">{{$blog->title}}</h4>
{{--                                    <a href="#" class="font-size-12 text-gray-5 ml-md-4"><i class="far fa-comment"></i> Leave a comment</a>--}}
                                </div>
                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="list-group list-group-horizontal flex-wrap list-group-borderless align-items-center mx-n0dot5">
                                        <span class="mx-0dot5 text-gray-5"> {{$blog->author}}</span>
                                        <span class="mx-2 font-size-n5 mt-1 text-gray-5"><i class="fas fa-circle"></i></span>
                                        <span class="mx-0dot5 text-gray-5">{{date('F j, Y',strtotime($blog->created_at))}}</span>
                                    </div>
                                </div>
                                <p>{!! $blog->description !!}</p>
                            </div>
                        </article>

                    </div>
                </div>
                <div class="col-xl-3 col-wd">
                    <aside class="mb-7">
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Recent Blogs</h3>
                        </div>
                        @foreach($recentBlogs as $recentBlog)
                        <article class="mb-4">
                            <div class="media">
                                <div class="width-75 height-75 mr-3">
                                    <img class="img-fluid object-fit-cover" src="{{url($recentBlog->image)}}" alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <h4 class="font-size-14 mb-1"><a href="{{route('blog.details',$recentBlog->slug)}}" class="text-gray-39">{{$recentBlog->title}}</a></h4>
                                    <span class="text-gray-5">{{date('F j, Y',strtotime($recentBlog->created_at))}}</span>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </aside>

                </div>
            </div>
        </div>
    </main>
@endsection
