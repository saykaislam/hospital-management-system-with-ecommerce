@extends('backend.layouts.user.master')
@section('title', 'Service Order')
@push('css')
    {{--custom css--}}

@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>Recent Appointments</h5>

                    <div class="table-responsive">
                        <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Doctor Name</th>
                                <th>Clinic Name</th>
                                <th>Clinic Address</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Prescription</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user_appointment_infos as $key => $user_appointment_info)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-center">
                                        {{ $doctor_name = \App\User::where('id',$user_appointment_info->doctor_user_id)->pluck('name')->first() }}
                                    </td>
                                    <td class="text-center">
                                        {{ $doctor_name = \App\User::where('id',$user_appointment_info->clinic_user_id)->pluck('name')->first() }}
                                    </td>
                                    <td class="text-center">
                                        @php
                                            echo $address = \Illuminate\Support\Facades\DB::table('clinic_contacts')
                                        ->join('clinics', 'clinic_contacts.clinic_id','=','clinics.id')
                                        ->where('clinics.user_id',$user_appointment_info->clinic_user_id)
                                        ->pluck('clinic_contacts.address')
                                        ->first();
                                        @endphp
                                    </td>
                                    <td class="text-center">{{$user_appointment_info->date}}</td>
                                    <td class="text-center">{{$user_appointment_info->time}}</td>
                                    <td class="text-right">
                                        <div class="table-action">
                                            <a href="{{$user_appointment_info->e_prescription_id != null ? url('user-prescription-invoice-print',$user_appointment_info->id) : 'javascript:void(0);'}}" class="btn btn-sm bg-primary-light">
                                                <i class="fas fa-print"></i> Print
                                            </a>
                                            <a href="{{$user_appointment_info->e_prescription_id != null ? url('user-prescription-view',$user_appointment_info->id) : 'javascript:void(0);'}}" class="btn btn-sm bg-info-light">
                                                <i class="far fa-eye"></i> View
                                            </a>
                                            @if($user_appointment_info->e_prescription_id != '')
                                                <button title="Rate Now" type="button" class="btn btn-sm btn-info text-dark" data-toggle="modal" data-target="#doctor_clinic_review_{{$user_appointment_info->id}}"><i class="fa fa-star text-light" aria-hidden="true"></i></button>
                                            @else
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Time Slot Modal -->
                                <div class="modal fade custom-modal" id="doctor_clinic_review_{{$user_appointment_info->id}}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Time Slots</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h4 class="text-center">Write Your Review</h4>
                                                <div class=" px-1">
                                                    <form class="" method="POST" action="{{route('user.clinic_doctor.review')}}">
                                                        <br>
                                                        @csrf
                                                        <div class="dc-registerformgroup">
                                                            <div class="form-group ">
                                                                <label for="" class="text-dark" style="font-size: 17px">
                                                                    How would you rate
                                                                    @php
                                                                        $clinic_name = \Illuminate\Support\Facades\DB::table('users')
                                                                            ->join('clinics','users.id','clinics.user_id')
                                                                            ->where('clinics.user_id',$user_appointment_info->clinic_user_id)
                                                                            ->pluck('users.name')
                                                                            ->first();

                                                                    $doctor_name = \Illuminate\Support\Facades\DB::table('users')
                                                                            ->join('doctors','users.id','doctors.user_id')
                                                                            ->where('doctors.user_id',$user_appointment_info->doctor_user_id)
                                                                            ->pluck('users.name')
                                                                            ->first();
                                                                    @endphp
                                                                    <u>
                                                                        clinic({{$clinic_name ? $clinic_name : ''}}) and
                                                                        doctor({{$doctor_name ? $doctor_name : ''}})
                                                                    </u>?
                                                                </label>
                                                                <div class="rate mt-2">
                                                                    <input type="radio" id="star{{$user_appointment_info->id}}" name="star" value="5" />
                                                                    <label for="star{{$user_appointment_info->id}}" title="5 star">5 stars</label>
                                                                    <input type="radio" id="starr{{$user_appointment_info->id}}" name="star" value="4" />
                                                                    <label for="starr{{$user_appointment_info->id}}" title="4 star">4 stars</label>
                                                                    <input type="radio" id="starrr{{$user_appointment_info->id}}" name="star" value="3" />
                                                                    <label for="starrr{{$user_appointment_info->id}}" title="3 star">3 stars</label>
                                                                    <input type="radio" id="starrrr{{$user_appointment_info->id}}" name="star" value="2" />
                                                                    <label for="starrrr{{$user_appointment_info->id}}" title="2 star">2 stars</label>
                                                                    <input type="radio" id="starrrrr{{$user_appointment_info->id}}" name="star" value="1" />
                                                                    <label for="starrrrr{{$user_appointment_info->id}}" title="1 star">1 star</label>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="order_id" value="{{$user_appointment_info->id}}">
                                                            <input type="hidden" name="clinic_user_id" value="{{$user_appointment_info->clinic_user_id}}">
                                                            <input type="hidden" name="doctor_user_id" value="{{$user_appointment_info->doctor_user_id}}">
                                                            <div class="form-group service-modal-height px-4" >
                                                                <label for="health-problem " class=" text-dark" style="font-size: 18px">How is your experience?</label>
                                                                <textarea type="text" name="description" style="border: 2px solid #174ed8;border-radius: 10px" class="form-control mt-3" placeholder=""  rows="6"></textarea>
                                                            </div>
                                                            <div class="form-group text-center">
                                                                <button type="submit" class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-black">submit review</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Edit Time Slot Modal -->


                            @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
