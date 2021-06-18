@extends('frontend-shop.layouts.master')
@section('title','Seller Registration')
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
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Seller Register</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container" style="margin-top: -20px;">
            <div class="mb-4">
                <h1 class="text-center">Be a Seller</h1>
            </div>
            <div class="my-4 my-xl-8">
                <div class="row">
                    <div class="col-md-8" style="padding-left: 300px; margin-top: -20px;">

                        <form class="js-validate" action="{{route('seller.registration.store')}}" method="POST">
                        @csrf
                        <!-- Form Group -->
                            <div class="js-form-message form-group">
                                <label class="form-label" for="signinSrEmailExample3">Name
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="name"  placeholder="Enter Your Name" required>
                            </div>
                            <!-- End Form Group -->
                            <div class="js-form-message form-group">
                                <label class="form-label" for="signinSrEmailExample3">Email
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" class="form-control" name="email"  placeholder="Enter Your Email" required>
                            </div>
                            <div class="js-form-message form-group">
                                <label class="form-label" for="signinSrEmailExample3">Phone
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control" name="phone" minlength="11" placeholder="Enter Your Phone Number" required>
                            </div>
                            <div class="js-form-message form-group">
                                <label class="form-label" for="signinSrEmailExample3">Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="password" minlength="6" placeholder="Enter Your Password" required>
                            </div>
                            <div class="js-form-message form-group">
                                <label class="form-label" for="shop_name">Shop Name
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="shop_name"  placeholder="Enter Your Shop Name" required>
                            </div>
                            <!-- Button -->
                            <div class="mb-1 text-center">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary-dark-w px-5">Save</button>
                                </div>
                            </div>
                            <!-- End Button -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
