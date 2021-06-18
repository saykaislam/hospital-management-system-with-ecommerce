@extends('backend.layouts.doctor.master')
@section('title', 'Question')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Page Content -->
        <div class="row">
            @if(count($user_appointment_info) > 0)
                @foreach($user_appointment_info as $user_appointment_inf)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card widget-profile pat-widget-profile">
                            <div class="card-body">
                                <div class="pro-widget-content">
                                    <div class="profile-info-widget">
                                        <a href="" class="booking-doc-img">
                                            <img src="{{asset('uploads/profile_pic/user/'.Auth::user()->image)}}" alt="User Image">
                                        </a>
                                        <div class="profile-det-info">
                                            <h3><a href="{{route('doctor.patient.appointment.list',$user_appointment_inf->slug)}}">{{$user_appointment_inf->name}}</a></h3>

                                            <div class="patient-details">
{{--                                                <h5><b>Patient ID :</b> P0016</h5>--}}
{{--                                                <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Alabama, USA</h5>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="patient-info">
                                    <ul>
                                        <li>Phone <span>{{$user_appointment_inf->phone}}</span></li>
                                        <li>Age <span>38 Years, Male</span></li>
{{--                                        <li>Blood Group <span>{{$user_appointment_inf->blood_group}}</span></li>--}}
{{--                                        <li>Blood Group <span>O+</span></li>--}}
                                        <li>
                                            Blood Group
                                            <span>
                                                @php
                                                    echo \Illuminate\Support\Facades\DB::table('users')->where('id',$user_appointment_inf->id)->pluck('blood_group')->first();
                                                @endphp
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="card widget-profile pat-widget-profile">
                        <div class="card-body">
                            <h3 class="text-center">NO Patient Found</h3>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    <!-- /Page Content -->

@endsection
@push('js')

@endpush
