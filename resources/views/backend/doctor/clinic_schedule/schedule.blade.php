@extends('backend.layouts.doctor.master')
@section('title', 'Schedule')
@push('css')
    <link rel="stylesheet" href="{{asset('frontend/css/wickedpicker.min.css')}}">
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
    <!-- Main Wrapper -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title d-flex justify-content-between">
                                    <span>Schedule Timings</span>
                                    <a class="edit-link" data-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
                                </h4>
                                <div class="profile-box">
                                    {{--                                    <div class="row">--}}

                                    {{--                                        <div class="col-lg-4">--}}
                                    {{--                                            <div class="form-group">--}}
                                    {{--                                                <label>Timing Slot Duration</label>--}}
                                    {{--                                                <select class="select form-control">--}}
                                    {{--                                                    <option>-</option>--}}
                                    {{--                                                    <option>15 mins</option>--}}
                                    {{--                                                    <option selected="selected">30 mins</option>--}}
                                    {{--                                                    <option>45 mins</option>--}}
                                    {{--                                                    <option>1 Hour</option>--}}
                                    {{--                                                </select>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}

                                    {{--                                    </div>--}}
                                    <div class="row">
                                        <div class="col-md-12">



                                            <div class="form-group">
                                                <select name="clinic_id" class="form-control" id="clinic_card">
                                                    @if(!empty($doctorClinics))
                                                        @foreach($doctorClinics as $doctorClinic)
                                                            <option value="{{$doctorClinic->clinic->user->id}}">{{$doctorClinic->clinic->user->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>











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
                                                                        @endphp
                                                                        @foreach($ds_slot as $slot)
                                                                            <li >
                                                                                <a class="timing {{$slot->user_id==null ? "nobooked": "booked"}}" href="/doctor-booking-checkout/{{$doctorDetails->user_slug}}/{{$slot->id}}" >
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


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Wrapper -->

        <!-- Add Time Slot Modal -->
        <div class="modal fade custom-modal" id="add_time_slot">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Time Slots</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('doctor.clinicSchedules.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="hours-info">
                                <div class="row form-row hours-cont">
                                    <div class="col-12 col-md-12">
                                        <div class="row form-row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Select Clinic for Appointment</label>
                                                    <select name="clinic_user_id" class="select form-control" required>
                                                        <option value="">Select</option>
                                                        @if(!empty($doctorClinics))
                                                            @foreach($doctorClinics as $doctorClinic)
                                                                <option value="{{$doctorClinic->clinic->user->id}}">{{$doctorClinic->clinic->user->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Select Day</label>
                                                    <select name="day_id" id="day" class="select form-control day-list" required>
                                                        <option value="">Select</option>
                                                        @if(!empty($days))
                                                            @foreach($days as $day)
                                                                <option value="{{$day->id}}" {{$day->id == 1 ? 'selected' : ''}}>{{$day->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <div class="form-group">
                                                    <label class="mr-1">Slot for : </label>
                                                    <label class="radio-inline mr-3">
                                                        <input type="radio" value="this_day" name="timing_day_duration" checked> This <span class="dy">Monday</span> Only
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" value="this_month" name="timing_day_duration"> All <span class="dy">Monday</span> of this Month
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 text-center">
                                                <div class="form-group">
                                                    <label style="display: block">Start Time</label>
                                                    <input type="time" name="start_time[]" class="timepicker form-group"/>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 text-center">
                                                <div class="form-group">
                                                    <label style="display: block">End Time</label>
                                                    <input type="time" name="end_time[]" class="timepicker form-group"/>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 text-center">
                                                <div class="form-group">
                                                    <label>Timing Slot Duration</label>
                                                    <select name="interval_time" class="select form-control">
                                                        <option>Select Duration</option>
                                                        <option value="10">10 mins</option>
                                                        <option value="20">20 mins</option>
                                                        <option value="30" selected="selected">30 mins</option>
                                                        <option value="45">45 mins</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="add-more mb-3 text-center">
                                <a href="javascript:void(0);" class="add-hours"><i class="fa fa-plus-circle"></i> Add More Slot</a>
                            </div>
                            <div class="submit-section text-center">
                                <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                            </div>
                        </form>

        <!-- /Add Time Slot Modal -->

    </div>

@endsection
@push('js')
    <script src="{{asset('frontend/js/wickedpicker.min.js')}}"></script>
    <script>

        $(".hours-info").on('click','.trash', function () {
            $(this).closest('.hours-cont').remove();
            return false;
        });
        $("select.day-list").change(function(){
            var selectedVal = $(this).children("option:selected").text();
            $(".dy").html(selectedVal);
        });


        $(".add-hours").on('click', function () {

            var hourscontent = '<div class="row form-row hours-cont">' +
                '<div class="col-12 col-md-8">' +
                '<div class="row form-row">' +
                '<div class="col-12 col-md-6 text-center">' +
                '<div class="form-group">' +
                '<label style="display: block">Start Time</label>' +
                '<input type="time" name="start_time[]" class="timepicker form-group"/>' +
                '</div>' +
                '</div>' +
                '<div class="col-12 col-md-6 text-center">' +
                '<div class="form-group">' +
                '<label style="display: block">End Time</label>' +
                '<input type="time" name="end_time[]" class="timepicker form-group"/>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-12 col-md-3"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
                '</div>';

            $(".hours-info").append(hourscontent);
            return false;
        });

    </script>

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
                //var clinic_id=11;
                var clinic_id=$('#clinic_card').val();
                console.log(clinic_id);
                var doctor_user_id={{$doctorDetails->user_id}};
                $('#'+date).addClass('select_date');
                console.log(date);
                console.log(clinic_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url : "{{URL('doctor/clinic/schedule/slot')}}",
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
                                                        <a class="timing" href="">
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

            {{--$('#clinic_card').change(function(){--}}
            {{--    jumpBack();--}}
            {{--    var date = $('.today').val();--}}
            {{--    var clinic_id=this.id;--}}
            {{--    console.log(clinic_id)--}}
            {{--    var doctor_user_id={{$doctorDetails->user_id}};--}}
            {{--    console.log(date);--}}
            {{--    $.ajaxSetup({--}}
            {{--        headers: {--}}
            {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--        }--}}
            {{--    });--}}
            {{--    $.ajax({--}}
            {{--        url : "{{URL('doctor/clinic/schedule/slot')}}",--}}
            {{--        method : "post",--}}
            {{--        data : {--}}
            {{--            date : date,--}}
            {{--            clinic_id : clinic_id,--}}
            {{--            doctor_user_id : doctor_user_id--}}
            {{--        },--}}
            {{--        success : function (result){--}}
            {{--            console.log(result);--}}
            {{--            $('.clearfix').empty();--}}
            {{--            if(result.response.length==0){--}}
            {{--                console.log('no');--}}
            {{--                $('.clearfix').html(`<div class="text-center mt-1">--}}
            {{--                                            <h2 class=""><i class="fas fa-clock text-danger" aria-hidden="true"></i></h2>--}}
            {{--                                            <h4 class="text-danger mt-2">No slot available on this day.</h4>--}}
            {{--                                        </div>`);--}}
            {{--            }else {--}}
            {{--                var i=0;--}}
            {{--                for(i=0;i<result.response.length;i++){--}}
            {{--                    console.log(result.response[i]);--}}
            {{--                    for(j=0;j<result.response[i].length;j++){--}}
            {{--                        console.log(result.response[i][j].time);--}}
            {{--                        $('.clearfix').append(`<li>--}}
            {{--                                            <a class="timing" href="">--}}
            {{--                                                <span>${result.response[i][j].time}</span>--}}
            {{--                                            </a>--}}
            {{--                                        </li>`);--}}
            {{--                    }--}}
            {{--                }--}}
            {{--            }--}}
            {{--        }--}}
            {{--    });--}}

            {{--});--}}

        });




    </script>
@endpush
