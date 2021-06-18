@extends('frontend.layouts.master')
@section('title', 'Doctor Details')
@push('css')
    <style>
        .today{
            background-color: #eb419924;
        }
        .select_date{
            border:1px solid rgb(222, 62, 162);
        }
        .calender li{
            cursor: pointer;
        }
        .booked{
            background-color: #b86162 !important;
        }
    </style>
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
                            <li class="breadcrumb-item active" aria-current="page">Doctor Appointment for Clinic</li>
                        </ol>
                    </nav>
                    {{--                    <h2 class="breadcrumb-title">Doctor Details</h2>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="booking-doc-info">
                                <a href="{{route('doctor.details',$slug)}}" class="booking-doc-img">
                                    <img src="{{asset('frontend/img/doctors/doctor-thumb-02.jpg')}}" alt="Doctor Image">
                                </a>
                                <div class="booking-info">
                                    <h4><a href="{{route('doctor.details',$slug)}}">{{$doctorDetails->name}}</a></h4>
                                    <p class="text-muted mb-0"><i class="fa fa-address-card-o" aria-hidden="true"></i>ma{{$doctorDetails->title}}</p>
{{--                                    <div class="rating">--}}
{{--                                        <i class="fas fa-star filled"></i>--}}
{{--                                        <i class="fas fa-star filled"></i>--}}
{{--                                        <i class="fas fa-star filled"></i>--}}
{{--                                        <i class="fas fa-star filled"></i>--}}
{{--                                        <i class="fas fa-star"></i>--}}
{{--                                        <span class="d-inline-block average-rating">135</span>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12">
                            <div class="clinic">
                                @foreach($doctorClinics as $dcclinic)
                                    <div class="card mr-3 clinic_card" id="{{$dcclinic->clinic->user->id}}" style="cursor: pointer">
                                        <img class="card-img-top" src="https://thereceptionist.com/wp-content/uploads/2018/06/featured_clinic-930x633.jpg" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$dcclinic->clinic->user->name}}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">{{$dcclinic->clinic->user->description}}</h6>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <input type = "hidden" class="today" value="{{date('d-m-Y')}}">
                    <input type = "hidden" class="clnc" value="{{$cl_user->user_id}}">
                    <!-- Schedule Widget -->
                    <div class="card booking-schedule schedule-widget">
                        <!-- Schedule Header -->
                        <div class="schedule-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Day Slot -->
                                    <div class="day-slot">
                                        <ul class="calender">
                                            @foreach($dates as $date)
                                                @if($date['date']==date('d-m-Y'))
                                                    <li class="date py-2 today select_date" id="{{$date['date']}}">
                                                        <span>{{$date['day']}}</span>
                                                        <span class="slot-date">{{$date['date']}}</span>
                                                    </li>
                                                @else
                                                    <li class="date py-2" id="{{$date['date']}}">
                                                        <span>{{$date['day']}}</span>
                                                        <span class="slot-date">{{$date['date']}}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- /Day Slot -->
                                </div>
                            </div>
                        </div>
                        <!-- /Schedule Header -->

                        <!-- Schedule Content -->
                        <div class="schedule-cont">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Time Slot -->
                                    <div class="time-slot">
                                        <ul class="clearfix">
                                            @forelse($doctorSchedule as $ds)
                                                @php
                                                    $ds_slot=\App\DoctorClinicScheduleTimeSlot::where('d_c_schedule_id',$ds->id)->get();
//dd($ds_slot);
                                                @endphp
                                                @foreach($ds_slot as $slot)
                                                    <li >
                                                        <a class="timing {{$slot->user_id==null ? "nobooked": "booked"}}" href="{{url('doctor-booking-checkout/'.$slug.'/'.$slot->id)}}" >
                                                            <span>{{$slot->time}}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @empty
                                                <div class="text-center mt-1">
                                                    <h2 class=""><i class="fas fa-clock text-danger" aria-hidden="true"></i></h2>
                                                    <h4 class="text-danger mt-2">No slot available on this day.</h4>
                                                </div>
                                            @endforelse
                                            {{--                                            <li>--}}
                                            {{--                                                <a class="timing" href="#">--}}
                                            {{--                                                    <span>9:00</span> <span>AM</span>--}}
                                            {{--                                                </a>--}}
                                            {{--                                            </li>--}}
                                        </ul>
                                    </div>
                                    <!-- /Time Slot -->
                                </div>
                            </div>
                        </div>
                        <!-- /Schedule Content -->
                    </div>
                    <!-- /Schedule Widget -->
                    <!-- Submit Section -->
{{--                    <div class="submit-section proceed-btn text-right">--}}
{{--                        <a href="{{route('doctor.booking.checkout',$slug)}}" class="btn btn-primary submit-btn">Proceed to Pay</a>--}}
{{--                    </div>--}}
                    <!-- /Submit Section -->
                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->
@stop
@push('js')
    <script type="text/javascript">
        $('.calender').slick({
            infinite: false,
            slidesToShow: 6,
            slidesToScroll: 6
        });
        $('.clinic').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
        $(document).ready(function(){

            var previous_id;
            function  setPrvious(id){
                this.previous_id=id;
            }
            function  getPrvious(){
                return this.previous_id;
            }

            $('.date').click(function(){
                $pre=getPrvious();
                console.log($pre);
                $('#'+$pre).removeClass('select_date');
                setPrvious(this.id);

                var date = this.id;
                var clinic_id=$('.clnc').val();
                var doctor_user_id={{$doctorDetails->user_id}};
                $('#'+date).addClass('select_date');
                console.log(date);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url : "{{URL('doctor/booking/find/slot')}}",
                    method : "post",
                    data : {
                        date : date,
                        clinic_id : clinic_id,
                        doctor_user_id : doctor_user_id
                    },
                    success : function (result){
                        console.log(result);
                        $('.clearfix').empty();
                        if(result.response.length==0){
                            console.log('no');
                            $('.clearfix').html(`<div class="text-center mt-1">
                                                        <h2 class=""><i class="fas fa-clock text-danger" aria-hidden="true"></i></h2>
                                                        <h4 class="text-danger mt-2">No slot available on this day.</h4>
                                                    </div>`);
                        }else {
                            var i=0;
                            for(i=0;i<result.response.length;i++){
                                console.log(result.response[i]);
                                for(j=0;j<result.response[i].length;j++){
                                    console.log(result.response[i][j].time);
                                    $('.clearfix').append(`<li>
                                                        <a class="timing ${result.response[i][j].user_id == null?"nobooked":"booked"}" href="/doctor-booking-checkout/{{$slug}}/${result.response[i][j].id}">
                                                            <span>${result.response[i][j].time}</span>
                                                        </a>
                                                    </li>`);
                                }
                            }
                        }
                    }
                });

            });

            function jumpBack() {
                setTimeout(function() {
                    $('.calender').slick("slickGoTo", 0);
                },0);
            }

            $('.clinic_card').click(function(){
                jumpBack();
                var date = $('.today').val();
                var c = $('.clnc').val(this.id);
                var clinic_id=this.id;
                var doctor_user_id={{$doctorDetails->user_id}};
                console.log(date);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url : "{{URL('doctor/booking/find/slot')}}",
                    method : "post",
                    data : {
                        date : date,
                        clinic_id : clinic_id,
                        doctor_user_id : doctor_user_id
                    },
                    success : function (result){
                        console.log(result);
                        $('.clearfix').empty();
                        if(result.response.length==0){
                            console.log('no');
                            $('.clearfix').html(`<div class="text-center mt-1">
                                                        <h2 class=""><i class="fas fa-clock text-danger" aria-hidden="true"></i></h2>
                                                        <h4 class="text-danger mt-2">No slot available on this day.</h4>
                                                    </div>`);
                        }else {
                            var i=0;
                            for(i=0;i<result.response.length;i++){
                                console.log(result.response[i]);
                                for(j=0;j<result.response[i].length;j++){
                                    console.log(result.response[i][j].time);
                                    $('.clearfix').append(`<li>
                                                        <a class="timing ${result.response[i][j].user_id == null?"nobooked":"booked"}" href="/doctor-booking-checkout/{{$slug}}/${result.response[i][j].id}">
                                                            <span>${result.response[i][j].time}</span>
                                                        </a>
                                                    </li>`);
                                }
                            }
                        }
                    }
                });
            });

        });



    </script>
@endpush
