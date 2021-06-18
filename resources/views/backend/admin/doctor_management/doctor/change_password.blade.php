@extends('backend.layouts.admin.master')
@section('title', 'Doctor edit')
@push('css')
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>

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
                            <h3 class="page-title">Doctor edit</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('admin.Doctor.index')}}">Doctor</a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Doctor Department edit</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.Doctor.update',$doctor->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Title</label>
                                        <div class="col-md-10">
                                            <input type="text" name="title" class="form-control" value="{{$doctor->title}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Doctor Name</label>
                                        <div class="col-md-10">
                                            <input type="text" name="user_id" class="form-control" value="{{$doctor->user->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Doctor Email</label>
                                        <div class="col-md-10">
                                            <input type="text" name="user_id" class="form-control" value="{{$doctor->user->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Doctor Spciality</label>
                                        <div class="col-md-10">
                                            <select class="form-control" name="doctor_specialities_id">
                                                <option>-- Select --</option>
                                                @foreach($doctor_departments as $doctor_department)
                                                    <option value="{{$doctor_department->id}}" {{$doctor_department->id == $doctor->doctor_specialities_id ? 'selected' : ''}}>{{$doctor_department->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">

                                            @if($doctor->is_active == 1)
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="is_active" checked style="margin: 30px;">Active
                                                </label>
                                            @elseif($doctor->is_active == 0)
                                                <label class="checkbox-inline"><input type="checkbox" name="is_active"  style="margin: 30px;">InActive</label>
                                            @endif
                                            <label class="checkbox-inline" style="margin-left: 40px">
                                                @if($doctor->is_online == 1)
                                                    <input type="checkbox" name="is_online" checked style="margin: 30px;">Online</label>
                                            @elseif($doctor->is_online == 0)
                                                <input type="checkbox" name="is_online"  style="margin: 30px;">Offline</label>
                                            @endif

                                            <label class="checkbox-inline" style="margin-left: 40px"> <input type="checkbox" name="has_permission" {{$doctor->has_permission == 1 ? 'checked' : ''}} style="margin: 30px;">Permission</label>
                                            <label class="checkbox-inline" style="margin-left: 40px"> <input type="checkbox" name="has_clinic" {{$doctor->has_clinic == 1 ? 'checked' : ''}} style="margin: 30px;">Clinic</label>
                                            <label class="checkbox-inline" style="margin-left: 40px"> <input type="checkbox" name="has_home_service" {{$doctor->has_home_service == 1 ? 'checked' : ''}} style="margin: 30px;">Home Service</label>
                                            <label class="checkbox-inline" style="margin-left: 40px"> <input type="checkbox" name="is_on_demand" {{$doctor->is_on_demand == 1 ? 'checked' : ''}} style="margin: 30px;"> On Demand</label>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Home Cost</label>
                                        <div class="col-md-10">
                                            <input type="text" name="home_cost" class="form-control" value="{{$doctor->home_cost}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">BMDC</label>
                                        <div class="col-md-10">
                                            <input type="text" name="Bmdc_number" class="form-control" value="{{$doctor->Bmdc_number}}">
                                        </div>
                                    </div>
                                    <label class="col-form-label col-md-6">Personal Statement</label>
                                    <div id="editor">

                                        <textarea name="personal_statement" id="" cols="30" rows="30">{!! $doctor->personal_statement !!}</textarea>
                                    </div>
                                    <br>

                                    <label class="col-form-label col-md-6">Education</label>
                                    <div id="editor1">

                                        <textarea name="education" id="" cols="30" rows="10">{!! $doctor->education !!}</textarea>
                                    </div>
                                    <label class="col-form-label col-md-6">Past Experience</label>
                                    <div id="editor2">

                                        <textarea name="past_experience" id="" cols="30" rows="10">{!! $doctor->past_experience !!}</textarea>
                                    </div>
                                    <label class="col-form-label col-md-6">Experience</label>
                                    <div id="editor3">
                                        <textarea name="experience" id="" cols="30" rows="10">{!! $doctor->experience !!}</textarea>
                                    </div>
                                    <label class="col-form-label col-md-6">Award</label>
                                    <div id="editor4">
                                        <textarea name="award" id="" cols="30" rows="10">{!! $doctor->award !!}</textarea>
                                    </div>
                                    <label class="col-form-label col-md-6">language</label>
                                    <div id="editor5">
                                        <textarea name="language" id="" cols="30" rows="10">{!! $doctor->language !!}</textarea>
                                    </div>

                                    <br>
                                    <br>
                                    <a href=""><button type="submit" class="btn btn-info btn-block">Change Password</button></a>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#editor1' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#editor2' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#editor3' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#editor4' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#editor5' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endpush
