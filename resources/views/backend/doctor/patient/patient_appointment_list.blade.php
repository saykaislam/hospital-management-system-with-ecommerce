@extends('backend.layouts.doctor.master')
@section('title', 'Question')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Page Content -->
    <div class="row">
        <div class="card">
            <div class="card-body pt-0">
                <div class="user-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified flex-wrap">
                        <li class="nav-item">
                            <a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#followUp" data-toggle="tab"><span>Follow UP</span></a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">

                    <!-- Appointment Tab -->
                    <div id="pat_appointments" class="tab-pane fade show active">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                                        <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Appt Date</th>
                                            <th>Booking Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($user_appointment_infos))
                                            @foreach($user_appointment_infos as $user_appointment_info)

                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="javascript:void(0);" class="avatar avatar-sm mr-2">
                                                                <img class="avatar-img rounded-circle" src="{{asset('uploads/profile_pic/user/'.$user_appointment_info->image)}}" alt="User Image">
                                                            </a>
                                                            <a href="javascript:void(0);">{{$user_appointment_info->name}}<span>User</span></a>
                                                        </h2>
                                                    </td>
                                                    <td>{{$user_appointment_info->date}} <span class="d-block text-info">{{$user_appointment_info->time}}</span></td>
                                                    <td>{{$user_appointment_info->date}}</td>
                                                    <td>{{$user_appointment_info->grand_total}}</td>
                                                    <td>
                                                        <a href="{{URL('prescription-form/'.$user_appointment_info->slug.'/'.$user_appointment_info->slot_id)}}" class="add-new-btn">Add Prescription</a>
                                                        @if($user_appointment_info->follow_up_e_prescription_id != null)
                                                            <a href="{{url('prescription-invoice-print',$user_appointment_info->follow_up_e_prescription_id)}}" class="btn btn-sm bg-primary-light">
                                                                <i class="fas fa-print"></i> Print
                                                            </a>
                                                        @endif
                                                        @if($user_appointment_info->follow_up_e_prescription_id != null)
                                                            <a href="{{url('prescription-view',$user_appointment_info->follow_up_e_prescription_id)}}" class="btn btn-sm bg-info-light">
                                                                <i class="far fa-eye"></i> View
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Appointment Tab -->

                    <!-- Prescription Tab -->
                    <div class="tab-pane fade" id="followUp">
                        <div class="card card-table mb-0">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="order2" class="table  " style="width:100%;overflow-x:auto;">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Previous Shown</th>
                                            <th>Follow UP</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($user_appointment_prescription_infos))
                                                @foreach($user_appointment_prescription_infos as $user_appointment_prescription_info)
                                                    <tr>
                                                        <td>{{$user_appointment_prescription_info->name}}</td>
                                                        <td>{{$user_appointment_prescription_info->previous_date}} {{$user_appointment_prescription_info->time}}</td>
                                                        <td>{{$user_appointment_prescription_info->follow_up_date}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Prescription Tab -->

                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

@endsection
@push('js')
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
            $('#order2').DataTable();
        } );
    </script>
@endpush
