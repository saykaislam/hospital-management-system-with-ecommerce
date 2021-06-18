@extends('backend.layouts.admin.master')
@section('title', 'Health Tips List')
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
                            <h3 class="page-title">Health Tips </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Health Tips</li>
                            </ul>
                        </div>
                        <div class="col-sm-5 col">
                            <a href="{{route('admin.health-tips-list.create')}}" class="btn btn-primary float-right mt-2">Add</a>
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
                                            <th>Title</th>
                                            <th>Slug</th>
{{--                                            <th>Category</th>--}}
                                            <th>Doctor</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($healthTips as $key => $health)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$health->title}}</td>
                                                <td>{{$health->slug}}</td>

                                                <td class="text-right">
                                                    <div class="actions">
                                                        <a class="btn btn-sm bg-success-light" href="{{route('admin.health-tips-list.edit',$health->id)}}">
                                                            <i class="fe fe-pencil"></i> Edit
                                                        </a>
{{--                                                        <a class="btn btn-sm bg-danger-light" data-toggle="modal" href="#delete_modal">--}}
{{--                                                            <i class="fe fe-trash"></i> Delete--}}
{{--                                                        </a>--}}
                                                    </div>
                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered" role="document" >
                                                            <form method="post" action="{{route('admin.health-tips-list.destroy',$health->id)}}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <!--	<div class="modal-header">
                                                                            <h5 class="modal-title">Delete</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>-->
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
                                                </td>

{{--                                                <td class="text-right">--}}
{{--                                                    <div class="actions">--}}
{{--                                                        <a class="btn btn-sm bg-success-light" href="{{route('admin.health-tips-list.edit',$health->id)}}">--}}
{{--                                                            <i class="fe fe-pencil"></i> Edit--}}
{{--                                                        </a>--}}
{{--                                                        <a class="btn btn-sm bg-danger-light" data-toggle="modal" href="#delete_modal">--}}
{{--                                                            <i class="fe fe-trash"></i> Delete--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">--}}
{{--                                                        <div class="modal-dialog modal-dialog-centered" role="document" >--}}
{{--                                                            <form method="post" action="{{route('admin.health-tips-list.destroy',$health->id)}}">--}}
{{--                                                                @method('DELETE')--}}
{{--                                                                @csrf--}}
{{--                                                                <div class="modal-content">--}}
{{--                                                                    <!--	<div class="modal-header">--}}
{{--                                                                            <h5 class="modal-title">Delete</h5>--}}
{{--                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                                                <span aria-hidden="true">&times;</span>--}}
{{--                                                                            </button>--}}
{{--                                                                        </div>-->--}}
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






{{--    <!-- Delete Modal -->--}}
{{--        <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">--}}
{{--            <div class="modal-dialog modal-dialog-centered" role="document" >--}}
{{--                <div class="modal-content">--}}
{{--                    <!--	<div class="modal-header">--}}
{{--                            <h5 class="modal-title">Delete</h5>--}}
{{--                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}
{{--                        </div>-->--}}
{{--                    <div class="modal-body">--}}
{{--                        <div class="form-content p-2">--}}
{{--                            <h4 class="modal-title">Delete</h4>--}}
{{--                            <p class="mb-4">Are you sure want to delete?</p>--}}
{{--                            <button type="button" class="btn btn-primary">Save </button>--}}
{{--                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- /Delete Modal -->--}}
    </div>

@endsection
@push('js')
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
