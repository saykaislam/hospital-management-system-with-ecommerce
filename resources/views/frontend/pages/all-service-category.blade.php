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
                            <li class="breadcrumb-item active" aria-current="page">Service</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Service</h2>
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
                                    <h3>All Category Services</h3>


                                </div>
                            </div>
                        </div>
                        <div class="dashboard-widget">
                            <nav class="dashboard-menu">
                                <ul>
                                    @if(count($serviceCategories) > 0)
                                        @foreach($serviceCategories as $serviceCategory)
                                            <li>
                                                <a href="{{url('service-category/'.$serviceCategory->slug)}}">
                                                    <i class="fas fa-columns"></i>
                                                    <span>{{$serviceCategory->name}}</span>
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

                            @if(count($services) > 0)
                                @foreach($services as $service)
                                    <div class="col-md-6 col-xl-4 col-sm-12">

                                        <!-- Blog Post -->
                                        <div class="blog grid-blog">
                                            <div class="blog-image">
                                                <a href="{{url('service-sub-category/'.$service->slug)}}">
                                                    @if(!empty($service->image))
                                                        <img class="img-fluid" src="{{asset('uploads/services/'.$service->image)}}" alt="Post Image">
                                                    @else
                                                        <img class="img-fluid" src="{{asset('uploads/services/default.jpg')}}" alt="Post Image">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="blog-content">
                                                <h3 class="blog-title mb-1"><a href="{{url('service-sub-category/'.$service->slug)}}">{{$service->name}}</a></h3>
                                                <span class="text-center">Tk.{{$service->price}}</span>
                                                <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#exampleModalLong{{$service->id}}">
                                                    Details
                                                </button>
                                                {{--                                                <div class="col"><a href="#" class="btn-success text-center" style="padding: 10px 30px;margin-left: 100px" > Add +</a></div>--}}
                                                <div class="modal fade" id="exampleModalLong{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Service Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{$service->description}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $cart=Cart::content() ;
                                                    $ser_id=$service->id;
                                                    $item=$cart->search(function ($cartItem, $rowId) use ($ser_id) {
                                                        return $cartItem->id === $ser_id;
                                                    });
                                                @endphp
                                                @if(Cart::count()==0)
                                                    <div class="cartbtn_{{$service->id}} ">
                                                        {{--                                                <button id="" class=" ttm-textcolor-white " style="padding: 6px 14px; background-color: #fff;border: 2px solid #0d71d5;border-radius: 10px;color: #1b1e21" title="Select Service Provider First" onclick="geoLocationInit({{$service->id}})">Add +</button>--}}
                                                        <button id="{{$service->id}}" class=" ttm-textcolor-white cart_button" style="padding: 6px 14px; background-color: #fff;border: 2px solid #0d71d5;border-radius: 10px;color: #1b1e21" title="CLick To Add Cart">Add +</button>
                                                    </div>
                                                @elseif($item==false)
                                                    <div class="cartbtn_{{$service->id}}">
                                                        <button id="{{$service->id}}" class=" ttm-textcolor-white cart_button" style="padding: 6px 14px; background-color: #fff;border: 2px solid #0d71d5;border-radius: 10px;color: #1b1e21" title="CLick To Add Cart">Add +</button>
                                                    </div>
                                                @else
                                                    <h6 class="">Added</h6>
                                                @endif
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
