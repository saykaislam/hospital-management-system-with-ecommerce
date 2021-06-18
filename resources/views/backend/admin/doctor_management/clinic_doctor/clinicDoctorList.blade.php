@extends('backend.layouts.admin.master')
@section('title', 'Service Provider List')
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
                            <h3 class="page-title">Clinic Doctor List</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Clinic Doctor List</li>
                            </ul>
                        </div>
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
                                            <th>#</th>
                                            <th>Clinic Name</th>
                                            <th>Doctor Name</th>
                                            <th>Main Clinic Status</th>
{{--                                            <th class="text-right">Actions</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($clinicDoctors as $key => $clinicDoctor )
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$clinicDoctor->clinic->user->name}}</td>
                                                <td>{{$clinicDoctor->doctor->user->name}}</td>
                                                <td>{{$clinicDoctor->main_clinic_status == 1 ? 'Main' : 'Other'}}</td>


{{--                                                <td class="text-right">--}}
{{--                                                    <div class="actions">--}}
{{--                                                        <a class="btn btn-sm bg-success-light" href="{{route('admin.service.edit',$serviceProviderListsservice->id)}}">--}}
{{--                                                            <i class="fe fe-pencil"></i> Edit--}}
{{--                                                        </a>--}}
{{--                                                        <a class="btn btn-sm bg-info-light" href="{{route('admin.clinic.details',$clinic->id)}}">--}}
{{--                                                             View--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">--}}
{{--                                                        <div class="modal-dialog modal-dialog-centered" role="document" >--}}
{{--                                                            <form method="post" action="{{route('admin.service.destroy',$service->id)}}">--}}
{{--                                                                @method('DELETE')--}}
{{--                                                                @csrf--}}
{{--                                                                <div class="modal-content">--}}
{{--                                                                    <div class="modal-body">--}}
{{--                                                                        <div class="form-content p-2">--}}
{{--                                                                            <h4 class="modal-title">Delete</h4>--}}
{{--                                                                            <p class="mb-4">Are you sure want to delete?</p>--}}
{{--                                                                            <button type="submit" class="btn btn-primary">Save </button>--}}
{{--                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </form>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
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

@endsection
@push('js')
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
