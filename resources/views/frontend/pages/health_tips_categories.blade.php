@extends('frontend.layouts.master')
@section('title', 'Health Tips Categories')
@section('content')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Health Tips</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Health Tips Category</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12">
                @foreach($posts as $health)

                    <!-- Blog Post -->
                        <div class="blog">
                            <div class="blog-image">
                                <a href="javascript:void(0);"><img class="img-fluid" src="{{asset('uploads/health-tips/'.$health->image)}}" alt="{{$health->image_alt}}"></a>
                            </div>
                            <h3 class="blog-title"><a href="{{route('health_tips.details',$health->slug)}}">{{$health->title}}</a></h3>
                            <div class="blog-info clearfix">
                                @php
                                    $dc=\App\User::find($health->doctor_id);

                                @endphp
                                <div class="post-left">
                                    <ul>
                                        <li>
                                            <div class="post-author">
                                                <a href="doctor-profile.html"><img src="{{asset('uploads/profile_pic/doctor/'.$dc->image)}}" alt="Post Author"> <span>{{$dc->name}}</span></a>
                                            </div>
                                        </li>
                                        <li><i class="far fa-clock"></i>{{date('jS F, Y',strtotime($health->created_at))}}</li>
                                        {{--                                        <li><i class="far fa-comments"></i>12 Comments</li>--}}
                                        <li><i class="fa fa-tags"></i>{{ $health->HealthTipsCategory->name }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog-content text-justify">
                                <div class="desc">
                                    {!! Str::limit($health->contents,250) !!}
                                </div>
                                <a href="{{route('health_tips.details',$health->slug)}}" class="read-more">Read More</a>
                            </div>
                        </div>
                @endforeach
                <!-- /Blog Post -->

                    <!-- Blog Pagination -->
                    <div class="c-pagination">
                        <ul class="c-content-pagination c-theme">
                            {{$posts->links()}}
                        </ul>
                    </div>

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

                </div>

                <!-- Blog Sidebar -->
                <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">

                    <!-- Search -->
                    <div class="card search-widget">
                        <div class="card-body">
                            <form class="search-form">
                                <div class="input-group">
                                    <input type="text" placeholder="Search..." class="form-control">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /Search -->

                    <!-- Latest Posts -->
                    <div class="card post-widget">
                        <div class="card-header">
                            <h4 class="card-title">Latest Posts</h4>
                        </div>
                        <div class="card-body">
                            <ul class="latest-posts">
                                @foreach($recentPosts as $post)
                                    <li>
                                        <div class="post-thumb">
                                            <a href="javascript:void(0);">
                                                <img class="img-fluid" src="{{ asset('uploads/health-tips/'.$post->image) }}" alt="{{ $post->image_alt }}">
                                            </a>
                                        </div>
                                        <div class="post-info">
                                            <h4>
                                                <a href="{{route('health_tips.details',$post->slug)}}">{{ $post->title }}</a>
                                            </h4>
                                            <p>{{date('jS F, Y',strtotime($post->created_at))}}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- /Latest Posts -->

                    <!-- Categories -->
                    <div class="card category-widget">
                        <div class="card-header">
                            <h4 class="card-title">Blog Categories</h4>
                        </div>
                        <div class="card-body">
                            <ul class="categories">
                                @foreach($categories as $cat)
                                    <li><a href="{{route('health.category.posts',$cat->slug)}}">{{$cat->name}}<span>({{$cat->posts()->get()->count()}})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- /Categories -->

                </div>
                <!-- /Blog Sidebar -->

            </div>
        </div>

    </div>
    <!-- /Page Content -->
@endsection

