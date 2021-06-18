@extends('backend.layouts.doctor.master')
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
                            <h3 class="page-title">Question Answer </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Question Answer Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-table">
                        <h3 style="text-align: center;color: #007bff">Question Details</h3>
                        <div class="card-body">
                        @if(!empty($question))
                            <!-- Invoice Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <tbody>
                                        <tr>
                                            <th>Doctor Speciality</th>
                                            <td>{{$question->doctorSpeciality->name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Search Title</th>
                                            <td>{{$question->search_title}}</td>
                                        </tr>
                                        <tr>
                                            <th>Question User</th>
                                            <td>
                                                @php
                                                    echo $question_user = \App\User::where('id',$question->question_user_id)->pluck('name')->first();
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Question</th>
                                            <td>{{$question->question}}</td>
                                        </tr>
                                        <tr>
                                            <th>Question Liked</th>
                                            <td>{{$question->question_liked}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /Invoice Table -->
                            @else
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <h3>NO Data Found!</h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-table">
                        <h3 style="text-align: center;color: #007bff">Question Answer Details</h3>
                        <div class="card-body">
                        @if(!empty($questionAnswer))
                            <!-- Invoice Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0">
                                        <tbody>
                                        <tr>
                                            <th>Question Answer By</th>
                                            <td>
                                                @php
                                                    echo $question_user = \App\User::where('id',$questionAnswer->answer_user_id)->pluck('name')->first();
                                                @endphp
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Question Answer</th>
                                            <td>{{$questionAnswer->answer}}</td>
                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <td>{{$questionAnswer->date}}</td>
                                        </tr>
{{--                                        <tr>--}}
{{--                                            <th>Answer By</th>--}}
{{--                                            <td>{{$questionAnswer->answer_by}}</td>--}}
{{--                                        </tr>--}}
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /Invoice Table -->
                            @else
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <h3>NO Data Found!</h3>
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
