@extends('backend.layouts.doctor.master')
@section('title', 'Dashboard')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    @if(empty($doctorDetails) && empty($doctorContact) && (count($clinicLists) == 0))
        <div class="row">
            <div class="col-md-12">
                <div class="card dash-card">
                    <div class="card-body">
                        <div class="row">
                            <h1>
                                Profile update not completed! Please fill up your profile step by step, to show your profile to users.
                                <a href="{{route('doctor.profile')}}" class="btn btn-info btn-block" role="button">Update Profile settings</a>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card dash-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <a href="{{route('doctor.patient.list')}}">
                                <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar1">
                                        <div class="circle-graph1" data-percent="75">
                                            <img src="{{asset('backend/user/img/icon-01.png')}}" class="img-fluid" alt="patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Patient</h6>
                                        <h3>{{$patients_count}}</h3>
                                        <p class="text-muted">Till Today</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <a href="{{route('doctor.patient.list.today')}}">
                                <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar2">
                                        <div class="circle-graph2" data-percent="65">
                                            <img src="{{asset('backend/user/img/icon-02.png')}}" class="img-fluid" alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Today Patient</h6>
                                        <h3>{{$today_patients_count}}</h3>
                                        <p class="text-muted">{{date('d-m-Y')}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>

{{--                        <div class="col-md-12 col-lg-4">--}}
{{--                            <div class="dash-widget">--}}
{{--                                <div class="circle-bar circle-bar3">--}}
{{--                                    <div class="circle-graph3" data-percent="50">--}}
{{--                                        <img src="{{asset('backend/user/img/icon-03.png')}}" class="img-fluid" alt="Patient">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="dash-widget-info">--}}
{{--                                    <h6>Appointments</h6>--}}
{{--                                    <h3>{{$appointments_count}}</h3>--}}
{{--                                    <p class="text-muted">Till Today</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>



{{--    <div class="row">--}}
{{--        <div class="card">--}}
{{--            <div class="card-body pt-0">--}}
{{--                <div class="user-tabs">--}}
{{--                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified flex-wrap">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" href="#pres" data-toggle="tab"><span>Prescription</span></a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                <div class="tab-content">--}}

{{--                    <!-- Appointment Tab -->--}}
{{--                    <div id="pat_appointments" class="tab-pane fade show active">--}}
{{--                        <div class="card card-table mb-0">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table table-hover table-center mb-0">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th>User</th>--}}
{{--                                            <th>Appt Date</th>--}}
{{--                                            <th>Booking Date</th>--}}
{{--                                            <th>Amount</th>--}}
{{--                                            <th>Follow Up</th>--}}
{{--                                            <th>Status</th>--}}
{{--                                            <th></th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @if(!empty($user_appointment_infos))--}}
{{--                                            @foreach($user_appointment_infos as $user_appointment_info)--}}

{{--                                                <tr>--}}
{{--                                                    <td>--}}
{{--                                                        <h2 class="table-avatar">--}}
{{--                                                            <a href="javascript:void(0);" class="avatar avatar-sm mr-2">--}}
{{--                                                                <img class="avatar-img rounded-circle" src="{{asset('uploads/profile_pic/user/'.$user_appointment_info->image)}}" alt="User Image">--}}
{{--                                                            </a>--}}
{{--                                                            <a href="javascript:void(0);">{{$user_appointment_info->name}}<span>User</span></a>--}}
{{--                                                        </h2>--}}
{{--                                                    </td>--}}
{{--                                                    <td>{{$user_appointment_info->date}} <span class="d-block text-info">{{$user_appointment_info->time}}</span></td>--}}
{{--                                                    <td>{{$user_appointment_info->date}}</td>--}}
{{--                                                    <td>{{$user_appointment_info->grand_total}}</td>--}}
{{--                                                    <td>--}}
{{--                                                        @php--}}
{{--                                                            echo $follow_up_date = \App\FollowUp::where('user_id',$user_appointment_info->user_id)->where('d_c_s_t_slot_id',$user_appointment_info->slot_id)->latest()->pluck('follow_up_date')->first();--}}
{{--                                                        @endphp--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        --}}{{--                                                        <span class="badge badge-pill bg-warning-light">Pending</span>--}}
{{--                                                        <a href="{{URL('prescription-form/'.$user_appointment_info->slug.'/'.$user_appointment_info->slot_id)}}" class="add-new-btn">Add Prescription</a>--}}
{{--                                                    </td>--}}
{{--                                                    --}}{{--                                                    <td class="text-right">--}}
{{--                                                    --}}{{--                                                        <div class="table-action">--}}
{{--                                                    --}}{{--                                                            <a href="javascript:void(0);" class="btn btn-sm bg-success-light">--}}
{{--                                                    --}}{{--                                                                <i class="far fa-edit"></i> Edit--}}
{{--                                                    --}}{{--                                                            </a>--}}
{{--                                                    --}}{{--                                                            <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">--}}
{{--                                                    --}}{{--                                                                <i class="far fa-trash-alt"></i> Cancel--}}
{{--                                                    --}}{{--                                                            </a>--}}
{{--                                                    --}}{{--                                                        </div>--}}
{{--                                                    --}}{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                        @endif--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /Appointment Tab -->--}}

{{--                    <!-- Prescription Tab -->--}}
{{--                    <div class="tab-pane fade" id="pres">--}}
{{--                        --}}{{--                        <div class="text-right">--}}
{{--                        --}}{{--                            <a href="{{route('prescription.form',1)}}" class="add-new-btn">Add Prescription</a>--}}
{{--                        --}}{{--                        </div>--}}
{{--                        <div class="card card-table mb-0">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table table-hover table-center mb-0">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th>Date </th>--}}
{{--                                            <th>Name</th>--}}
{{--                                            --}}{{--                                            <th>Created by </th>--}}
{{--                                            <th></th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @if(!empty($user_appointment_prescription_infos))--}}
{{--                                            @foreach($user_appointment_prescription_infos as $user_appointment_prescription_info)--}}
{{--                                                <tr>--}}
{{--                                                    <td>{{$user_appointment_prescription_info->date}}</td>--}}
{{--                                                    <td>--}}

{{--                                                        @php--}}
{{--                                                            $prescription_infos = json_decode($user_appointment_prescription_info->prescription_info);--}}
{{--                                                        @endphp--}}
{{--                                                        @if(!empty($prescription_infos))--}}
{{--                                                            <ul>--}}
{{--                                                                @foreach($prescription_infos as $prescription_info)--}}
{{--                                                                    <li>name: {{$prescription_info->name}}</li>--}}
{{--                                                                    <li>Quantity: {{$prescription_info->quantity}}</li>--}}
{{--                                                                    <li>Days: {{$prescription_info->days}}</li>--}}
{{--                                                                    <li>Morning: {{$prescription_info->morning}}</li>--}}
{{--                                                                    <li>Afternoon: {{$prescription_info->afternoon}}</li>--}}
{{--                                                                    <li>Evening: {{$prescription_info->evening}}</li>--}}
{{--                                                                    <li>Night: {{$prescription_info->night}}</li>--}}
{{--                                                                @endforeach--}}
{{--                                                            </ul>--}}
{{--                                                        @endif--}}
{{--                                                    </td>--}}
{{--                                                    --}}{{--                                                        <td>--}}
{{--                                                    --}}{{--                                                            <h2 class="table-avatar">--}}
{{--                                                    --}}{{--                                                                <a href="javascript:void(0);" class="avatar avatar-sm mr-2">--}}
{{--                                                    --}}{{--                                                                    <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image">--}}
{{--                                                    --}}{{--                                                                </a>--}}
{{--                                                    --}}{{--                                                                <a href="javascript:void(0);">Dr. Darren Elder <span>Dental</span></a>--}}
{{--                                                    --}}{{--                                                            </h2>--}}
{{--                                                    --}}{{--                                                        </td>--}}
{{--                                                    <td class="text-right">--}}
{{--                                                        <div class="table-action">--}}
{{--                                                            <a href="{{url('prescription-invoice-print',$user_appointment_prescription_info->id)}}" class="btn btn-sm bg-primary-light">--}}
{{--                                                                <i class="fas fa-print"></i> Print--}}
{{--                                                            </a>--}}
{{--                                                            <a href="{{url('prescription-view',$user_appointment_prescription_info->id)}}" class="btn btn-sm bg-info-light">--}}
{{--                                                                <i class="far fa-eye"></i> View--}}
{{--                                                            </a>--}}
{{--                                                            --}}{{--                                                                <a href="javascript:void(0);" class="btn btn-sm bg-success-light">--}}
{{--                                                            --}}{{--                                                                    <i class="fas fa-edit"></i> Edit--}}
{{--                                                            --}}{{--                                                                </a>--}}
{{--                                                            --}}{{--                                                                <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">--}}
{{--                                                            --}}{{--                                                                    <i class="far fa-trash-alt"></i> Delete--}}
{{--                                                            --}}{{--                                                                </a>--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                        @endif--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- /Prescription Tab -->--}}

{{--                    <!-- Medical Records Tab -->--}}
{{--                --}}{{--                    <div class="tab-pane fade" id="medical">--}}
{{--                --}}{{--                        <div class="text-right">--}}
{{--                --}}{{--                            <a href="#" class="add-new-btn" data-toggle="modal" data-target="#add_medical_records">Add Medical Records</a>--}}
{{--                --}}{{--                        </div>--}}
{{--                --}}{{--                        <div class="card card-table mb-0">--}}
{{--                --}}{{--                            <div class="card-body">--}}
{{--                --}}{{--                                <div class="table-responsive">--}}
{{--                --}}{{--                                    <table class="table table-hover table-center mb-0">--}}
{{--                --}}{{--                                        <thead>--}}
{{--                --}}{{--                                        <tr>--}}
{{--                --}}{{--                                            <th>ID</th>--}}
{{--                --}}{{--                                            <th>Date </th>--}}
{{--                --}}{{--                                            <th>Description</th>--}}
{{--                --}}{{--                                            <th>Attachment</th>--}}
{{--                --}}{{--                                            <th>Created</th>--}}
{{--                --}}{{--                                            <th></th>--}}
{{--                --}}{{--                                        </tr>--}}
{{--                --}}{{--                                        </thead>--}}
{{--                --}}{{--                                        <tbody>--}}
{{--                --}}{{--                                        <tr>--}}
{{--                --}}{{--                                            <td><a href="javascript:void(0);">#MR-0009</a></td>--}}
{{--                --}}{{--                                            <td>13 Nov 2019</td>--}}
{{--                --}}{{--                                            <td>Teeth Cleaning</td>--}}
{{--                --}}{{--                                            <td><a href="#">dental-test.pdf</a></td>--}}
{{--                --}}{{--                                            <td>--}}
{{--                --}}{{--                                                <h2 class="table-avatar">--}}
{{--                --}}{{--                                                    <a href="javascript:void(0);" class="avatar avatar-sm mr-2">--}}
{{--                --}}{{--                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image">--}}
{{--                --}}{{--                                                    </a>--}}
{{--                --}}{{--                                                    <a href="javascript:void(0);">Dr. Darren Elder <span>Dental</span></a>--}}
{{--                --}}{{--                                                </h2>--}}
{{--                --}}{{--                                            </td>--}}
{{--                --}}{{--                                            <td class="text-right">--}}
{{--                --}}{{--                                                <div class="table-action">--}}
{{--                --}}{{--                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">--}}
{{--                --}}{{--                                                        <i class="fas fa-print"></i> Print--}}
{{--                --}}{{--                                                    </a>--}}
{{--                --}}{{--                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">--}}
{{--                --}}{{--                                                        <i class="far fa-eye"></i> View--}}
{{--                --}}{{--                                                    </a>--}}
{{--                --}}{{--                                                    <a href="javascript:void(0);" class="btn btn-sm bg-success-light" data-toggle="modal" data-target="#add_medical_records">--}}
{{--                --}}{{--                                                        <i class="fas fa-edit"></i> Edit--}}
{{--                --}}{{--                                                    </a>--}}
{{--                --}}{{--                                                    <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">--}}
{{--                --}}{{--                                                        <i class="far fa-trash-alt"></i> Delete--}}
{{--                --}}{{--                                                    </a>--}}
{{--                --}}{{--                                                </div>--}}
{{--                --}}{{--                                            </td>--}}
{{--                --}}{{--                                        </tr>--}}
{{--                --}}{{--                                        </tbody>--}}
{{--                --}}{{--                                    </table>--}}
{{--                --}}{{--                                </div>--}}
{{--                --}}{{--                            </div>--}}
{{--                --}}{{--                        </div>--}}
{{--                --}}{{--                    </div>--}}
{{--                <!-- /Medical Records Tab -->--}}

{{--                    <!-- Billing Tab -->--}}
{{--                --}}{{--                    <div class="tab-pane" id="billing">--}}
{{--                --}}{{--                        <div class="text-right">--}}
{{--                --}}{{--                            <a class="add-new-btn" href="javascript:void(0);">Add Billing</a>--}}
{{--                --}}{{--                        </div>--}}
{{--                --}}{{--                        <div class="card card-table mb-0">--}}
{{--                --}}{{--                            <div class="card-body">--}}
{{--                --}}{{--                                <div class="table-responsive">--}}

{{--                --}}{{--                                    <table class="table table-hover table-center mb-0">--}}
{{--                --}}{{--                                        <thead>--}}
{{--                --}}{{--                                        <tr>--}}
{{--                --}}{{--                                            <th>Invoice No</th>--}}
{{--                --}}{{--                                            <th>Doctor</th>--}}
{{--                --}}{{--                                            <th>Amount</th>--}}
{{--                --}}{{--                                            <th>Paid On</th>--}}
{{--                --}}{{--                                            <th></th>--}}
{{--                --}}{{--                                        </tr>--}}
{{--                --}}{{--                                        </thead>--}}
{{--                --}}{{--                                        <tbody>--}}
{{--                --}}{{--                                        <tr>--}}
{{--                --}}{{--                                            <td>--}}
{{--                --}}{{--                                                <a href="javascript:void(0);">#INV-0009</a>--}}
{{--                --}}{{--                                            </td>--}}
{{--                --}}{{--                                            <td>--}}
{{--                --}}{{--                                                <h2 class="table-avatar">--}}
{{--                --}}{{--                                                    <a href="javascript:void(0);" class="avatar avatar-sm mr-2">--}}
{{--                --}}{{--                                                        <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image">--}}
{{--                --}}{{--                                                    </a>--}}
{{--                --}}{{--                                                    <a href="javascript:void(0);">Dr. Darren Elder <span>Dental</span></a>--}}
{{--                --}}{{--                                                </h2>--}}
{{--                --}}{{--                                            </td>--}}
{{--                --}}{{--                                            <td>$300</td>--}}
{{--                --}}{{--                                            <td>13 Nov 2019</td>--}}
{{--                --}}{{--                                            <td class="text-right">--}}
{{--                --}}{{--                                                <div class="table-action">--}}
{{--                --}}{{--                                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">--}}
{{--                --}}{{--                                                        <i class="fas fa-print"></i> Print--}}
{{--                --}}{{--                                                    </a>--}}
{{--                --}}{{--                                                    <a href="javascript:void(0);" class="btn btn-sm bg-info-light">--}}
{{--                --}}{{--                                                        <i class="far fa-eye"></i> View--}}
{{--                --}}{{--                                                    </a>--}}
{{--                --}}{{--                                                    <a href="javascript:void(0);" class="btn btn-sm bg-success-light">--}}
{{--                --}}{{--                                                        <i class="fas fa-edit"></i> Edit--}}
{{--                --}}{{--                                                    </a>--}}
{{--                --}}{{--                                                    <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">--}}
{{--                --}}{{--                                                        <i class="far fa-trash-alt"></i> Delete--}}
{{--                --}}{{--                                                    </a>--}}
{{--                --}}{{--                                                </div>--}}
{{--                --}}{{--                                            </td>--}}
{{--                --}}{{--                                        </tr>--}}
{{--                --}}{{--                                        </tbody>--}}
{{--                --}}{{--                                    </table>--}}
{{--                --}}{{--                                </div>--}}
{{--                --}}{{--                            </div>--}}
{{--                --}}{{--                        </div>--}}
{{--                --}}{{--                    </div>--}}
{{--                <!-- Billing Tab -->--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@stop
@push('js')

@endpush
