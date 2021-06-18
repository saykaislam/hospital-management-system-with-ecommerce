@extends('frontend-shop.layouts.master')
@section('title', 'About US')
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
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">About US</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="mb-12 text-center">
                <h1>About US</h1>
{{--                <p class="text-gray-44">This Agreement was last modified on 18th february 2019</p>--}}
            </div>

            <div class="mb-10">
                @if(!empty($about_us))
                    {!! $about_us->description !!}
                @endif
            </div>

            <!-- End Brand Carousel -->
        </div>
    </main>
@endsection
@push('js')
@endpush
