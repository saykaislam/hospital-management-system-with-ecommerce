@extends('backend.layouts.user.master')
@section('title', 'Question')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Page Content -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">View Prescription</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="biller-info">
                        <h4 class="d-block">{{ \App\User::where('id',$infos->user_id)->pluck('name')->first() }}</h4>
{{--                        <span class="d-block text-sm text-muted">{{$infos->doctor_speciality_name}}</span>--}}
{{--                        <span class="d-block text-sm text-muted">Newyork, United States</span>--}}
                    </div>
                </div>
                <div class="col-sm-6 text-sm-right">
                    <div class="billing-info">
                        <h4 class="d-block">{{$infos->date}}</h4>
                        <span class="d-block text-muted">#INV-{{$infos->invoice}}</span>
                    </div>
                </div>
            </div>

            <!-- Prescription Item -->
            <div class="card card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center">
                            <thead>
                                <tr>
                                    <th style="min-width: 200px">Name</th>
                                    <th style="min-width: 80px;">Quantity</th>
                                    <th style="min-width: 80px">Days</th>
                                    <th style="min-width: 100px;">Time</th>
                                    <th style="min-width: 80px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $prescription_infos = json_decode($infos->prescription_info);
                            @endphp
                            @if(!empty($prescription_infos))
                                @foreach($prescription_infos as $prescription_info)
                                    <tr>
                                        <td>
                                            {{$prescription_info->name}}
                                        </td>
                                        <td>
                                            {{$prescription_info->quantity}}
                                        </td>
                                        <td>
                                            {{$prescription_info->days}}
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" {{ $prescription_info->morning ? 'checked' : '' }}> Morning
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" {{ $prescription_info->afternoon ? 'checked' : '' }}> Afternoon
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" {{ $prescription_info->evening ? 'checked' : '' }}> Evening
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="checkbox" {{ $prescription_info->night ? 'checked' : '' }}> Night
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td>Follow Up Date</td>
                                    <td>
                                        {{$infos->follow_up_date}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Prescription Item -->

            <!-- Signature -->
            <div class="row">
                <div class="col-md-12 text-right">
                    <div class="signature-wrap">
{{--                        <div class="signature">--}}
{{--                            Click here to sign--}}
{{--                        </div>--}}
                        <div class="sign-name">
                            <p class="mb-0">( {{$infos->name}} )</p>
                            <span class="text-muted">Signature</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Signature -->


        </div>
    </div>
    <!-- /Page Content -->

@endsection
@push('js')

@endpush
