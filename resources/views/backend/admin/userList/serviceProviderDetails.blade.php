@extends('backend.layouts.admin.master')
@section('title', 'Service Provider Details')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-7 col-auto">
                            <h3 class="page-title">Service Provider Details </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Service Provider Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-table">
                        <h3 style="text-align: center;color: #007bff">Service Provider Contacts</h3>
                        <div class="card-body">
                        @if(!empty($serviceProviderDetails))
                            <!-- Invoice Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <tbody>
                                        <tr>
                                            <th>Provider Category</th>
                                            <td>{{$serviceProviderDetails->serviceProviderCategory ? $serviceProviderDetails->serviceProviderCategory->name : ''}}</td>
                                        </tr>
                                        <tr>
                                            <th>Service Category</th>
                                            <td>{{$serviceProviderDetails->serviceCategory ? $serviceProviderDetails->serviceCategory->name : ''}}</td>
                                        </tr>
{{--                                        <tr>--}}
{{--                                            <th>Service Sub Category</th>--}}
{{--                                            <td>{{$serviceProviderDetails->serviceSubCategory ? $serviceProviderDetails->serviceSubCategory->name : ''}}</td>--}}
{{--                                        </tr>--}}
                                        <tr>
                                            <th>Services</th>
                                            <td>
                                                @php
                                                    $services = \App\Services::where('service_category_id',$serviceProviderDetails->service_category_id)->get();
                                                @endphp
                                                @if(!empty($services))
                                                    @foreach($services as $service)
                                                        <ul>
                                                            <li>{{$service->name}}</li>
                                                        </ul>
                                                    @endforeach
                                                @endif
                                                @php

                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>{{$serviceProviderDetails->gender}}</td>
                                        </tr>
                                        <tr>
                                            <th>Personal Statement</th>
                                            <td>{{$serviceProviderDetails->personal_statement}}</td>
                                        </tr>
                                        <tr>
                                            <th>Height</th>
                                            <td>{{$serviceProviderDetails->height}}</td>
                                        </tr>
                                        <tr>
                                            <th>Weight</th>
                                            <td>{{$serviceProviderDetails->weight}}</td>
                                        </tr>
                                        <tr>
                                            <th>language</th>
                                            <td>{{$serviceProviderDetails->language}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /Invoice Table -->
                            @else
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <h3>NO Details Data Found For This Provider</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-table">
                        <h3 style="text-align: center;color: #007bff">Service Provider Contacts</h3>
                        <div class="card-body">
                        @if(!empty($serviceProviderContacts))
                            <!-- Invoice Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <tbody>
                                        <tr>
                                            <th>Address</th>
                                            <td>{{$serviceProviderContacts['address']}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /Invoice Table -->
                            @else
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <h3>NO Contact Data Found For This Provider</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-table">
                        <h3 style="text-align: center;color: #007bff">Service Provider Costs</h3>
                        <div class="card-body">
                        @if($serviceProviderCost)
                            <!-- Invoice Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <tbody>
                                        <tr>
                                            <th>Monthly Cost</th>
                                            <td>{{$serviceProviderCost->monthly_cost}}</td>
                                        </tr>
                                        <tr>
                                            <th>Fullday Cost</th>
                                            <td>{{$serviceProviderCost->fullday_cost}}</td>
                                        </tr>
                                        <tr>
                                            <th>Halfday Cost</th>
                                            <td>{{$serviceProviderCost->halfday_cost}}</td>
                                        </tr>
                                        <tr>
                                            <th>Home Cost</th>
                                            <td>{{$serviceProviderCost->home_cost}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /Invoice Table -->
                            @else
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <h3>NO Cost Data Found For This Provider</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-table">
                        <h3 style="text-align: center;color: #007bff">Service Provider Experience</h3>
                        <div class="card-body">
                        @if(count($serviceProviderExperiences) > 0)
                            <!-- Invoice Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <tbody>
                                        @foreach($serviceProviderExperiences as $serviceProviderExperience)
                                            <tr>
                                                <th>Company Name</th>
                                                <td>{{$serviceProviderExperience->company_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>From</th>
                                                <td>{{$serviceProviderExperience->from}}</td>
                                            </tr>
                                            <tr>
                                                <th>To</th>
                                                <td>{{$serviceProviderExperience->to}}</td>
                                            </tr>
                                            <tr>
                                                <th>Designation</th>
                                                <td>{{$serviceProviderExperience->designation}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /Invoice Table -->
                            @else
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <h3>NO Experience Data Found For This Provider</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-table">
                        <h3 style="text-align: center;color: #007bff">Service Provider Experience</h3>
                        <div class="card-body">
                        @if(count($serviceProviderEducations) > 0)
                            <!-- Invoice Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <tbody>
                                        @foreach($serviceProviderEducations as $serviceProviderEducation)
                                            <tr>
                                                <th>Degree</th>
                                                <td>{{$serviceProviderEducation->degree}}</td>
                                            </tr>
                                            <tr>
                                                <th>Institute</th>
                                                <td>{{$serviceProviderEducation->institute}}</td>
                                            </tr>
                                            <tr>
                                                <th>Year of Completion</th>
                                                <td>{{$serviceProviderEducation->year_of_completion}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /Invoice Table -->
                            @else
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <h3>NO Education Data Found For This Provider</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Wrapper -->
    </div>

@endsection
@push('js')

@endpush
