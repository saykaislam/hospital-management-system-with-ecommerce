@extends('backend.layouts.admin.master')
@section("title","Seller Order Report")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/admin/plugins/select2/select2.min.css')}}">
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Seller Order Report</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Seller Order Report</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Recent Orders -->
                    <div class="card">
                        <div class="callout callout-info">
                            <div class="card card-info" style="padding: 20px 40px 40px 40px;">
                                <form role="form" action="{{route('admin.seller-order-details')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Seller List</label>
                                            <select name="seller_id" id="" class="form-control select2">
                                                @foreach($sellers as $seller)
                                                    <option value="{{$seller->id}}" {{$sellerId == $seller->id ? 'selected' : ''}}>{{$seller->name}} ({{$seller->shop->name}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label>Delivery Status</label>
                                            <select name="delivery_status" id="" class="form-control select2">
                                                <option value="Pending" {{$deliveryStatus == 'Pending' ? 'selected' : ''}}>Pending</option>
                                                <option value="On review" {{$deliveryStatus == 'On review' ? 'selected' : ''}}>On review</option>
                                                <option value="On delivered" {{$deliveryStatus == 'On delivered' ? 'selected' : ''}}>On delivered</option>
                                                <option value="Delivered" {{$deliveryStatus == 'Delivered' ? 'selected' : ''}}>Delivered</option>
                                                <option value="Completed" {{$deliveryStatus == 'Completed' ? 'selected' : ''}}>Completed</option>
                                                <option value="Cancel" {{$deliveryStatus == 'Cancel' ? 'selected' : ''}}>Cancel</option>
                                            </select>
                                        </div>
                                        <div class="col-4" style="margin-top: 30px">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                @if($orders != null)
                                    <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                                        <thead>
                                        <tr>
                                            <th>#Id</th>
                                            <th>Date</th>
                                            <th>Invoice Code</th>
                                            <th>Payment Method</th>
                                            <th>Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $key => $order)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{date('j-m-Y',strtotime($order->created_at))}}</td>
                                                <td>{{$order->invoice_code}}</td>
                                                <td>{{$order->payment_type}}</td>
                                                <td>
                                                    <a class="btn btn-info waves-effect" href="{{route('admin.order-details',encrypt($order->id))}}">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="text-center ">
                                        <h2><i class="fa fa-info-circle text-info"></i> Please Select Seller and delivery status!!!</h2>
                                    </div>
                                @endif
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
    <script src="{{asset('backend/admin/plugins/select2/select2.full.min.js')}}"></script>
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );

        $('.select2').select2();
    </script>
@endpush
