@extends('backend.layouts.admin.master')
@section('title', 'Service Sub Category edit')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Question Answer Update</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('admin.users.question.list')}}">Question Answer</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Question Answer Update</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.question.answer.update')}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Doctors<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="hidden" name="question_answer_id" value="{{$questionAnswer->id}}">
                                            <select  name="answer_doctor_user_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach($doctor_users as $doctor_user)
                                                    <option value="{{$doctor_user->id}}" {{$doctor_user->id == $questionAnswer->answer_doctor_user_id ? 'selected' : ''}}>{{$doctor_user->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Answer<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="answer" rows="5">{{$questionAnswer->answer}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2"></label>
                                        <div class="col-lg-10">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('js')

@endpush
