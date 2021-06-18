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
                            <h3 class="page-title">Order Details </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Order Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-table">
                        <h3 style="text-align: center;color: #007bff">Order Details</h3>
                        <h2 style="float: left;margin-left: 20px;">
                            <a href="{{url('service-invoice-print',$serviceOrder->id)}}" class="btn btn-sm bg-success">
                                <i class="fas fa-print"></i> Print
                            </a>
                        </h2>
                        <div class="card-body">

                            <!-- Invoice Table -->
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0">
                                    @php
                                        $shipping_info = json_decode($serviceOrder->shipping_address);
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
                                            <th>Service Provider Permission</th>
                                            <td>
                                                <form method="POST" action ="{{route('service.provider.permission.status')}}">
                                                    @csrf
                                                    <input type = "hidden" name="order_id" value="{{$serviceOrder->id}}">
                                                    <select name="service_provider_permission" class="form-control delivery" onchange="this.form.submit()">
                                                        <option value="1" {{$serviceOrder->service_provider_permission == '1' ? 'selected' : ''}}>Yes</option>
                                                        <option value="0" {{$serviceOrder->service_provider_permission == '0' ? 'selected' : ''}}>No</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Invoice Code</th>
                                            <td>{{$serviceOrder->invoice_code}}</td>
                                        </tr>
                                        <tr>
                                            <th>Order Type</th>
                                            <td>{{$serviceOrder->order_type}}</td>
                                        </tr>
                                        <tr>
                                            <th>Grand Total</th>
                                            <td>{{$serviceOrder->grand_total}}TK</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Status</th>
                                            <td>{{$serviceOrder->payment_status}}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Type</th>
                                            <td>{{$serviceOrder->payment_type}}</td>
                                        </tr>
                                        <tr>
                                            <th> Delivery Cost</th>
                                            <td>{{$serviceOrder->delivery_cost}}</td>
                                        </tr>
                                        <tr>
                                            <th> Delivery Status</th>
                                            <td>{{$serviceOrder->delivery_status}}</td>
                                        </tr>
                                        @php
                                            $shipping_info = json_decode($serviceOrder->shipping_address);
                                        @endphp
                                        <tr>
                                            <th>Shipping Address</th>
                                            <td>house-{{$shipping_info->house}},road-{{$shipping_info->road}},{{$shipping_info->area}}</td>
                                        </tr>
                                        <tr>
                                            <th> View</th>
                                            <td>{{$serviceOrder->view}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
                                            <td>{{$serviceOrder->orderServiceDetail->service_name}}</td>
                                            <td>{{$serviceOrder->orderServiceDetail->service_price}}</td>
                                            <td>{{$serviceOrder->orderServiceDetail->service_quantity}}</td>
                                            <td>{{$serviceOrder->orderServiceDetail->service_sub_total}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /Invoice Table -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Wrapper -->
    </div>

@endsection
@push('js')

@endpush
