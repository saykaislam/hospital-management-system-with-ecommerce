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
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2"></label>
                                        <div class="col-md-10">

                                            @if($doctor->is_active == 1)
                                            <label class="checkbox-inline">
                                                <input type="checkbox" name="is_active" checked style="margin: 30px;" value="0">Active
                                            </label>
                                            @elseif($doctor->is_active == 0)
                                                <label class="checkbox-inline"><input type="checkbox" value="1" name="is_active"  style="margin: 30px;">InActive</label>
                                            @endif


                                            <label class="checkbox-inline" style="margin-left: 40px">
                                            @if($doctor->is_online == 1)
                                                    <input type="checkbox" name="is_online" value="0" checked style="margin: 30px;">Online</label>
                                            @elseif($doctor->is_online == 0)
                                                <input type="checkbox" name="is_online" value="1"  style="margin: 30px;">Offline</label>
                                            @endif

                                            <label class="checkbox-inline" style="margin-left: 40px">
                                            @if($doctor->has_permission == 1)
                                                <input type="checkbox" name="has_permission" value="0" checked style="margin: 30px;">Permission</label>
                                            @elseif($doctor->has_permission == 0)
                                                <input type="checkbox" name="has_permission" value="1"  style="margin: 30px;">Permission</label>
                                            @endif
                                        </div>
                                        <label class="col-form-label col-md-2"></label>
                                        <div class="col-md-10">
                                            @if($doctor->has_clinic == 1)
                                                <label class="checkbox-inline" style="margin-left: 40px"> <input type="checkbox" name="has_clinic" value="0" checked style="margin: 30px;">Clinic</label>
                                            @elseif($doctor->has_clinic == 0)
                                                <label class="checkbox-inline" style="margin-left: 40px">  <input type="checkbox" name="has_clinic" value="1"  style="margin: 30px;">Clinic</label>
                                            @endif

                                            @if($doctor->has_home_service == 1)
                                                <label class="checkbox-inline" style="margin-left: 40px"> <input type="checkbox" name="has_home_service" value="0" checked style="margin: 30px;">Home Service</label>
                                            @elseif($doctor->has_home_service == 0)
                                                <label class="checkbox-inline" style="margin-left: 40px">  <input type="checkbox" name="has_home_service" value="1"  style="margin: 30px;">Home Service</label>
                                            @endif
                                            @if($doctor->is_on_demand == 1)
                                                <label class="checkbox-inline" style="margin-left: 40px"> <input type="checkbox" name="is_on_demand" value="0" checked style="margin: 30px;"> On Demand</label>
                                            @elseif($doctor->is_on_demand == 0)
                                                <label class="checkbox-inline" style="margin-left: 40px">  <input type="checkbox" name="is_on_demand" value="1"  style="margin: 30px;"> On Demand</label>
                                            @endif
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
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Personal Statement</label>
                                        <div class="col-md-10">
                                            <div id="editor">
                                                <textarea name="personal_statement" id="" cols="30" rows="30">{!! $doctor->personal_statement !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">language</label>
                                        <div class="col-md-10">
                                            <div id="editor5">
                                                <textarea name="language" id="" cols="30" rows="10">{!! $doctor->language !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2"></label>
                                        <div class="col-md-10">
                                            <div class="col-lg-10">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
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
