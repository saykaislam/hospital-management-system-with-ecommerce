@extends('backend.layouts.clinic.master')
@section('title', 'Blood Bank')
@push('css')
    {{--custom css--}}
@endpush
@section('content')

    <!-- /Page Header -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Blood Bank</h3>
                    </div>
                    <div class="col-sm-5 col">
                        <a href="{{route('clinic.blood-bank.create')}}" class="btn btn-primary float-right mt-2">Add New</a>
                    </div>
                </div>
            </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Blood Group</th>
                                <th>Quantity (Bags)</th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bloods as $key => $blood)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$blood->name}}</td>
                                    <td>{{$blood->quantity}}</td>
                                    <td class="text-right">
                                        <div class="actions">
                                            <a class="btn btn-sm bg-success-light" href="{{route('clinic.blood-bank.edit',$blood->id)}}">
                                                <i class="fe fe-pencil"></i> Edit
                                            </a>
                                            <a class="btn btn-sm bg-danger-light" data-toggle="modal" href="#delete_modal">
                                                <i class="fe fe-trash"></i> Delete
                                            </a>
                                        </div>
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered" role="document" >
                                                <form method="post" action="{{route('clinic.blood-bank.destroy',$blood->id)}}">
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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



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

