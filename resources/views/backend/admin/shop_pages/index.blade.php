@extends('backend.layouts.admin.master')
@section("title","Shop Pages")
@push('css')

@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Shop Pages</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Shop Pages</li>
                        </ul>
                    </div>
                    <div class="col-sm-5 col">
                        <a href="{{route('admin.shop_pages.create')}}" class="btn btn-primary float-right mt-2">Add New</a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Recent Orders -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                                    <thead>
                                    <tr>
                                        <th>#Id</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shop_pages as $key => $shop_page)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$shop_page->name}}</td>
                                            <td>{!! $shop_page->description !!}</td>
                                            <td>
                                                <a class="btn btn-info waves-effect" href="{{route('admin.shop_pages.edit',$shop_page->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
{{--                                                <button class="btn btn-danger waves-effect" type="button"--}}
{{--                                                        onclick="deleteBlog({{$shop_page->id}})">--}}
{{--                                                    <i class="fa fa-trash"></i>--}}
{{--                                                </button>--}}
{{--                                                <form id="delete-form-{{$shop_page->id}}" action="{{route('admin.shop_pages.destroy',$shop_page->id)}}" method="POST" style="display: none;">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                </form>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Recent Orders -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@stop
@push('js')
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>

        //sweet alert
        function deleteBlog(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your Data is save :)',
                        'error'
                    )
                }
            })
        }
    </script>
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
