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
                            <h3 class="page-title">Related Question edit</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('admin.relatedQuestions.index')}}">Related Question</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Related Question edit</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.relatedQuestions.update',$relatedQuestion->id)}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Doctor Speciality<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select  name="doctor_speciality_id" class="form-control">
                                                <option>-- Select --</option>
                                                @foreach($doctorSpecialities as $doctorSpeciality)
                                                    <option value="{{$doctorSpeciality->id}}" {{$doctorSpeciality->id == $relatedQuestion->doctor_speciality_id ? 'selected' : ''}}>{{$doctorSpeciality->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Search Title<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select  name="search_title" class="form-control">
                                                <option value="">Select</option>
                                                <option value="For Looking A Doctor" {{$relatedQuestion->search_title == 'For Looking A Doctor' ? 'selected' : ''}}>For Looking A Doctor</option>
                                                <option value="For Information" {{$relatedQuestion->search_title == 'For Information' ? 'selected' : ''}}>For Information</option>
                                                <option value="For Treatments" {{$relatedQuestion->search_title == 'For Treatments' ? 'selected' : ''}}>For Treatments</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Question<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="question" rows="5">{{$relatedQuestion->question}}</textarea>
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
