@extends('backend.layouts.service_provider.master')
@section('title', 'Service Order')
@push('css')
    {{--custom css--}}

@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>Recent Orders</h5>

                    <div class="table-responsive">
                        <table id="example" class="table  " style="width:100%;overflow-x:auto;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Details</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Service Date</th>
                                <th>Time</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Invoice</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key => $order)
                                <tr>
                                    @php
                                        $shipping_info = json_decode($order->shipping_address);
                                    @endphp
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-center">
                                        <a href="{{route('service_provider.details',$order->id)}}"  class="btn btn-sm btn-info ">Services</a>
                                    <td class="text-bold">{{$shipping_info->name}}</td>
                                    <td class="">{{$shipping_info->phone}}</td>
                                    <td>house-{{$shipping_info->house}},road-{{$shipping_info->road}},{{$shipping_info->area}}</td>
                                    {{--                                    <td class="">{{$order->subChildCategory->subcategory->name}}-<br>{{$order->service_name}}</td>--}}
                                    <td class="">{{$shipping_info->service_date}}</td>
                                    <td>{{$shipping_info->service_time}}</td>
                                    <td>{{$order->grand_total}}TK</td>
                                    <td>{{$order->payment_status}}</td>
                                    @if($order->service_provider_permission==1)
                                        @if($order->delivery_status=="Completed")
                                            <td>Completed</td>
                                        @elseif($order->delivery_status=="Canceled")
                                            <td>Canceled</td>
                                        @else
                                            <td width="200px;">
                                                <form method="POST" action ="{{route('service.provider.delivery.status')}}">
                                                    @csrf
                                                    <input type = "hidden" name="order_id" value="{{$order->id}}">
                                                    <select name="status" id="" class="form-control delivery" onchange="this.form.submit()">
                                                        <option value="Pending" {{$order->delivery_status == "Pending" ? 'selected' : ''}}>Pending</option>
                                                        <option value="On Review" {{$order->delivery_status == "On Review" ? 'selected' : ''}}>On Review</option>
                                                        <option value="Reached" {{$order->delivery_status == "Reached" ? 'selected' : ''}}>Reached</option>
                                                        <option value="Completed" {{$order->delivery_status == "Completed" ? 'selected' : ''}}>Completed</option>
                                                        <option value="Canceled" {{$order->delivery_status == "Canceled" ? 'selected' : ''}}>Cancel</option>
                                                    </select>
                                                </form>
                                            </td>
                                        @endif
                                    @else
                                        <td>Waiting for Admin Approval</td>
                                    @endif

                                    @if($order->service_provider_permission==1)
                                        <td class="text-center">
                                            <a href="{{route('service.provider.invoice',$order->id)}}"  title="click for invoice" class="btn btn-sm bg-info-light">
                                                <i class="far fa-eye" ></i>
                                            </a>
                                        </td>
                                    @else
                                        <td>Waiting for Admin Approval</td>
                                    @endif

                                </tr>
                                {{--                            Details Modal--}}
                                {{--                                <div class="modal fade" id="modal_{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                                {{--                                    <div class="modal-dialog" role="document">--}}
                                {{--                                        <div class="modal-content">--}}
                                {{--                                            <div class="modal-header">--}}
                                {{--                                                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>--}}
                                {{--                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                                {{--                                                    <span aria-hidden="true">&times;</span>--}}
                                {{--                                                </button>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="modal-body">--}}
                                {{--                                                <ul class="list-group list-group-flush">--}}
                                {{--                                                    <li class="list-group-item">Service Name : {{$order->subChildCategory->subcategory->name}}-{{$order->service_name}}</li>--}}
                                {{--                                                    <li class="list-group-item">Service Price : {{$order->service_price}}TK</li>--}}
                                {{--                                                    <li class="list-group-item">Service Quantity : {{$order->service_quantity}}</li>--}}
                                {{--                                                    <li class="list-group-item">Total Price : {{$order->total}}TK</li>--}}
                                {{--                                                    <li class="list-group-item">Invoice Code : {{$order->invoice_code}}</li>--}}
                                {{--                                                    <li class="list-group-item">Payment Status :@if($order->payment_status)--}}
                                {{--                                                            Paid--}}
                                {{--                                                        @else--}}
                                {{--                                                            Due--}}
                                {{--                                                        @endif--}}
                                {{--                                                    </li>--}}
                                {{--                                                </ul>--}}
                                {{--                                            </div>--}}
                                {{--                                            <div class="modal-footer">--}}
                                {{--                                                <a href="{{route('service.provider.invoice',$order->id)}}" type="button" class="btn btn-primary">Generate Invoice</a>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
@stop
@push('js')

@endpush
