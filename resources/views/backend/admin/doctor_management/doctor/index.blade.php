@extends('backend.layouts.admin.master')
@section('title', 'Doctor')
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
                            <h3 class="page-title">Doctor </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Doctor Department</li>
                            </ul>
                        </div>
{{--                        <div class="col-sm-5 col">--}}
{{--                            <a href="{{route('admin.DoctorSpeciality.create')}}" class="btn btn-primary float-right mt-2">Add</a>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                                        <thead>
                                        <tr>
                                            <th>SL NO</th>
                                            <th>Doctor name</th>
                                            <th>Title</th>
                                            <th>Speciality</th>
                                            <th>Active/Inactive</th>
                                            {{--                                            <th>Doctor Department Slug</th>--}}
                                            <th class="text-right">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($doctors as $key => $doctor)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$doctor->name}}</td>
                                                <td>{{$doctor->title}}</td>
                                                <td>{{$doctor->spe_name}}</td>
                                                <td width="200px;">
                                                    <form method="POST" action ="{{route('doctor.active.inactive.status')}}">
                                                        @csrf
                                                        <input type = "hidden" name="user_id" value="{{$doctor->id}}">
                                                        <select name="status" id="" class="form-control delivery" onchange="this.form.submit()">
                                                            <option value="1" {{$doctor->active_inactive_status == 1 ? 'selected' : ''}}>Active</option>
                                                            <option value="0" {{$doctor->active_inactive_status == 0 ? 'selected' : ''}}>Inactive</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td class="text-right">
                                                    <div class="actions">
                                                        <a class="btn btn-sm bg-success-light" href="{{route('admin.Doctor.edit',$doctor->id)}}">
                                                            <i class="fe fe-pencil"></i> Edit
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Wrapper -->
    </div>

@endsection
@push('js')
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
