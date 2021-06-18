@extends('frontend.layouts.master')
@section('title', 'Home')
@push('css')
    {{--custom css--}}
@endpush
{{--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />--}}
@section('content')

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- Register Content -->
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center" style="background-color: #fff;">
                            <div class="col-md-6 col-lg-6 login-left">
                                <img src="{{asset('frontend/img/login-banner.png')}}" class="img-fluid" alt="Doccure Register">
                            </div>
                            <div class="col-md-6 col-lg-6 login-right">
                                <form method="POST" action="{{route('user.question.store')}}">
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <select id="search_title" name="search_title" class="custom-select form-control bg-white border-md h-100 font-weight-bold text-muted" required>
                                                <option value="" selected>Information Type</option>
                                                <option value="For Looking A Doctor">For Looking A Doctor</option>
                                                <option value="For Information">For Information</option>
                                                <option value="For Treatments">For Treatments</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="col-md-12">
                                            <select id="doctor_speciality_id" name="doctor_speciality_id" class="custom-select form-control bg-white border-md h-100 font-weight-bold text-muted" required>
                                                <option value="">Select Doctor Speciality</option>
                                                @if(!empty($doctorSpecialities))
                                                    @foreach($doctorSpecialities as $doctorSpeciality)
                                                        <option value="{{$doctorSpeciality->id}}">{{$doctorSpeciality->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" m-0 form-group" style="height: 100px;padding-bottom: 20px;">
                                        <div class="col-md-12">
                                            <textarea placeholder="Write your question..." name="question" class="form-control" style="height: 100px;" required></textarea>
                                        </div>
                                    </div>
                                    <br/>
                                    <br/>
                                    <div class="form-group text-center">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- /Register Form -->

                            </div>
                        </div>
                    </div>
                    <!-- /Register Content -->

                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->

@stop

@push('js')

@endpush
