@extends('backend.layouts.admin.master')
@section('title', 'Service Category')
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
                            <h3 class="page-title">Day</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Day</li>
                            </ul>
                        </div>
                        <div class="col-sm-5 col">
                            <a href="{{route('admin.days.create')}}" class="btn btn-primary float-right mt-2">Add</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="datatable table table-hover table-center mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Day Name</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($days as $key => $day)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$day->name}}</td>

                                            <td class="text-right">
                                                <div class="actions">
                                                    <a class="btn btn-sm bg-success-light" href="{{route('admin.days.edit',$day->id)}}">
                                                        <i class="fe fe-pencil"></i> Edit
                                                    </a>
                                                    <a class="btn btn-sm bg-danger-light" data-toggle="modal" href="#delete_modal">
                                                        <i class="fe fe-trash"></i> Delete
                                                    </a>
                                                </div>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered" role="document" >
                                                        <form method="post" action="{{route('admin.days.destroy',$day->id)}}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="form-content p-2">
                                                                        <h4 class="modal-title">Delete</h4>
                                                                        <p class="mb-4">Are you sure want to delete?</p>
                                                                        <button type="submit" class="btn btn-primary">Save </button>
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- /Delete Modal -->

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

@endpush
