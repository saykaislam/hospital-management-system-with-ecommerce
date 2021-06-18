@extends('backend.layouts.admin.master')
@section('title', 'Cancel Order')
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
                            <h3 class="page-title">Cancel Order</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Cancel Order</li>
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
                                            <th>#ID</th>
                                            <th>Date</th>
                                            <th>Invoice ID</th>
                                            <th>Area</th>
                                            <th>Payment Method</th>
                                            <th>Grand Total</th>
                                            <th>Discount</th>
                                            <th>Total Vat</th>
                                            <th title="Delivery Status">D.Status</th>
                                            <th>Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i = 0; @endphp
                                        @foreach($Canceled as $key => $Cancel)
                                            @php $i++; @endphp
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{date('j-m-Y',strtotime($Cancel->created_at))}}</td>
                                                <td>{{$Cancel->invoice_code}}</td>
                                                <td>{{$Cancel->area}}</td>
                                                <td>{{$Cancel->payment_type}}</td>
                                                <td>{{$Cancel->grand_total }}</td>
                                                <td>{{$Cancel->discount }}</td>
                                                <td>{{$Cancel->total_vat }}</td>
                                                <td>
                                                    <span class="badge badge-danger">{{$Cancel->delivery_status.'ed'}}</span>

                                                </td>
                                                <td>
                                                    <a class="btn btn-info waves-effect" href="{{route('admin.order-details',encrypt($Cancel->id))}}">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Date</th>
                                            <th>Invoice ID</th>
                                            <th>Area</th>
                                            <th>Payment Method</th>
                                            <th>Grand Total</th>
                                            <th>Discount</th>
                                            <th>Total Vat</th>
                                            <th title="Delivery Status">D.Status</th>
                                            <th>Details</th>
                                        </tr>
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
