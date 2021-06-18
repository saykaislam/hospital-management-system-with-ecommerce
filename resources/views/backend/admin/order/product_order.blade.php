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
                            <h3 class="page-title">Order list </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Order list</li>
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
                                            <th>#No</th>
                                            <th>Details</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Invoice</th>
                                            <th>Total</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($productOrders as $key=>$order)
                                            @php
                                                $shipping_info = json_decode($order->shipping_address);
                                                //dd($shipping_info);
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{$key+1}}</td>
                                                <td class="text-center"><a href="{{route('admin.product.order.details',$order->id)}}" class="btn btn-sm btn-info">Products</a></td>
                                                <td class="text-center">{{$shipping_info->name}}</td>
                                                <td class="text-center">{{$shipping_info->phone}}</td>
                                                <td class="text-center">{{$shipping_info->address}}</td>
                                                <td class="text-center">{{$order->invoice_code}}</td>
                                                <td class="text-center">{{$order->grand_total}}TK</td>
                                                <td class="text-center">{{$order->payment_status}}</td>
{{--                                                <td>--}}
{{--                                                    @if($order->delivery_status=="Pending")--}}
{{--                                                        <a href="{{route('admin.cancel.order',$order->id)}}" class="btn btn-sm btn-danger ml-1" title="Click To Cancel The Order" ><i class="fa fa-times" aria-hidden="true"></i></a>--}}
{{--                                                    @else--}}
{{--                                                        {{$order->delivery_status}}--}}
{{--                                                    @endif--}}
{{--                                                </td>--}}

                                                @if($order->delivery_status=="Completed")
                                                    <td>Completed</td>
                                                @elseif($order->delivery_status=="Canceled")
                                                    <td>Canceled</td>
                                                @else
                                                    <td width="200px;">
                                                        <form method="POST" action ="{{route('product.order.delivery.status')}}">
                                                            @csrf
                                                            <input type = "hidden" name="order_id" value="{{$order->id}}">
                                                            <select name="status" id="" class="form-control delivery" onchange="this.form.submit()">
                                                                <option value="Pending" {{$order->delivery_status == "Pending" ? 'selected' : ''}}>Pending</option>
                                                                <option value="On Review" {{$order->delivery_status == "On Review" ? 'selected' : ''}}>On Review</option>
                                                                <option value="Processing" {{$order->delivery_status == "Processing" ? 'selected' : ''}}>Processing</option>
                                                                <option value="Completed" {{$order->delivery_status == "Completed" ? 'selected' : ''}}>Completed</option>
                                                                <option value="Canceled" {{$order->delivery_status == "Canceled" ? 'selected' : ''}}>Cancel</option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                @endif
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
    </div>

@endsection
@push('js')
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
