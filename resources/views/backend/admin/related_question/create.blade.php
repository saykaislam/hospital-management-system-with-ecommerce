@extends('backend.layouts.admin.master')
@section('title', 'Service Sub Category create')
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
                            <h3 class="page-title">Related Question Create</h3>
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
                                <h4 class="card-title">Related Question Create</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.relatedQuestions.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Doctor Speciality<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select  name="doctor_speciality_id" class="form-control">
                                                <option>-- Select --</option>
                                                @foreach($doctorSpecialities as $doctorSpeciality)
                                                    <option value="{{$doctorSpeciality->id}}">{{$doctorSpeciality->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Search Title<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select  name="search_title" class="form-control">
                                                <option value="">Select</option>
                                                <option value="For Looking A Doctor">For Looking A Doctor</option>
                                                <option value="For Information">For Information</option>
                                                <option value="For Treatments">For Treatments</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Question<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="question" rows="5"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2"></label>
                                        <div class="col-lg-10">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
