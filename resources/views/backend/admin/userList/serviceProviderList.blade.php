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
                            <h3 class="page-title">Service Provider List</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Service Provider List</li>
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
                                            <th>Service Provider Name</th>
                                            <th>Service Provider Email</th>
                                            <th>Service Provider Phone</th>
                                            <th>Active/Inactive</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($serviceProviders as $key => $serviceProviderList )
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$serviceProviderList->user->name}}</td>
                                                <td>{{$serviceProviderList->user->email}}</td>
                                                <td>{{$serviceProviderList->user->phone}}</td>
                                                <td width="200px;">
                                                    <form method="POST" action ="{{route('service_provider.active.inactive.status')}}">
                                                        @csrf
                                                        <input type = "hidden" name="user_id" value="{{$serviceProviderList->user->id}}">
                                                        <select name="status" id="" class="form-control delivery" onchange="this.form.submit()">
                                                            <option value="1" {{$serviceProviderList->user->active_inactive_status == 1 ? 'selected' : ''}}>Active</option>
                                                            <option value="0" {{$serviceProviderList->user->active_inactive_status == 0 ? 'selected' : ''}}>Inactive</option>
                                                        </select>
                                                    </form>
                                                </td>

                                                <td class="text-right">
                                                    <div class="actions">
                                                        <a class="btn btn-sm bg-info-light" href="{{route('admin.serviceProvider.details',$serviceProviderList->id)}}">
                                                             View
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


    <!-- Delete Modal -->
        <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document" >
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-content p-2">
                            <h4 class="modal-title">Delete</h4>
                            <p class="mb-4">Are you sure want to delete?</p>
                            <button type="button" class="btn btn-primary">Save </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete Modal -->
    </div>

@endsection
@push('js')
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
