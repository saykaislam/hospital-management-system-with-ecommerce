@extends('backend.layouts.service_provider.master')
@section('title', 'Order Show')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Page Content -->
        <div class="container-fluid">

                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-table">
                        <h3 style="text-align: center;color: #007bff">Order Details</h3>
                        <div class="card-body">

                            <!-- Invoice Table -->
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0">
                                    @php
                                        $shipping_info = json_decode($orders->shipping_address);
                                        //dd($shipping_info);
                                    @endphp
                                    <tbody>
                                        <tr>
                                            <th>Service Date</th>
                                            <td>{{$shipping_info->service_date}}</td>
                                        </tr>
                                        <tr>
                                            <th>Service Time</th>
                                            <td>{{$shipping_info->service_time}}</td>
                                        </tr>
                                        <tr>
                                            <th>Invoice Code</th>
                                            <td>{{$orders->invoice_code}}</td>
                                        </tr>
                                        <tr>
                                            <th>Grand Total</th>
                                            <td>{{$orders->grand_total}}Tk.</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Status</th>
                                            <td>{{$orders->payment_status}}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Type</th>
                                            <td>{{$orders->payment_type}}</td>
                                        </tr>
                                        <tr>
                                            <th> Delivery Cost</th>
                                            <td>{{$orders->delivery_cost}}</td>
                                        </tr>
                                        <tr>
                                            <th> Delivery Status</th>
                                            <td>{{$orders->delivery_status}}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping Address</th>
                                            <td>house-{{$shipping_info->house}},road-{{$shipping_info->road}},{{$shipping_info->area}}</td>
                                        </tr>
                                        <tr>
                                            <th> View</th>
                                            <td>{{$orders->view}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /Invoice Table -->

                        </div>
                    </div>
                </div>
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card card-table">
                    <h3 style="text-align: center;color: #007bff">Order Details</h3>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-hover table-center mb-0">
                                <h3 style="text-align: center;color: #007bff">Order Service Details</h3>
                                <thead>
                                <tr>
                                    <th>Service Name</th>
                                    <th>Service Price</th>
                                    <th>Service Quantity</th>
                                    <th>Service Sub Total</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$orders->orderServiceDetail->service_name}}</td>
                                    <td>{{$orders->orderServiceDetail->service_price}}</td>
                                    <td>{{$orders->orderServiceDetail->service_quantity}}</td>
                                    <td>{{$orders->orderServiceDetail->service_sub_total}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    <!-- /Page Content -->


@stop
@push('js')

@endpush
