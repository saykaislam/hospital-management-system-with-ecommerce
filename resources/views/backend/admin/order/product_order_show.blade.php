@extends('backend.layouts.admin.master')
@section('title', 'Order list')
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
                            <h3 class="page-title">Order Details</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Order Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 style="text-align: center;color: #007bff">Order</h3>
                                <h2 style="float: left;margin-left: 20px;">
                                    <a href="{{url('product-invoice-print',$productOrder->id)}}" class="btn btn-sm bg-success">
                                        <i class="fas fa-print"></i> Print
                                    </a>
                                </h2>
                                <!-- Invoice Table -->
                                <div class="table-responsive">
                                    <table class="table table-center mb-0">
                                        <tr>
                                            <td><strong>Invoice Code</strong></td>
                                            <td>{{$productOrder->invoice_code}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Order Type</strong></td>
                                            <td>{{$productOrder->order_type}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Grand Total</strong></td>
                                            <td>TK.{{$productOrder->grand_total+$productOrder->delivery_cost}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Payment Status</strong></td>
                                            <td>{{$productOrder->payment_status}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Payment Type</strong></td>
                                            <td>{{$productOrder->payment_type}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Delivery Cost</strong></td>
                                            <td>TK{{$productOrder->delivery_cost}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Delivery Status</strong></td>
                                            <td>{{$productOrder->delivery_status}}</td>
                                        </tr>
                                        @php
                                            $shipping_info = json_decode($productOrder->shipping_address);
                                        @endphp
                                        <tr>
                                            <td><strong>Address</strong></td>
                                            <td>{{$shipping_info->address}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Note</strong></td>
                                            <td>{{$shipping_info->details}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                                        <h3 style="text-align: center;color: #007bff">Order Details</h3>
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Product Price</th>
                                                <th>Product Quantity</th>
                                                <th>Product Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($productOrderDetails))
                                                @foreach($productOrderDetails as $productOrderDetail)
                                                    <tr>
                                                        <td>{{$productOrderDetail->product_name}}</td>
                                                        <td>{{$product_price = $productOrderDetail->product_price}}</td>
                                                        <td>{{$product_quantity = $productOrderDetail->product_quantity}}</td>
                                                        <td>{{$product_price*$product_quantity}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /Invoice Table -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Wrapper -->
        <div>&nbsp;</div>
    </div>

@endsection
@push('js')
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
