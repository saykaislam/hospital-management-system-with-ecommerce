@extends('backend.layouts.user.master')
@section('title', 'Service Order')
@push('css')
    {{--custom css--}}

@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-lg-6">

                    <div class="col-md-12">
                        <h5>Recent Orders</h5>
                    </div>
{{--                    <div class="col-md-12">--}}
{{--                        <a href = "{{route('user.order')}}" class="mb-3"><i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>Back to order list</a>--}}
{{--                        <h5 class="">Orderd Service List</h5>--}}
{{--                        @if($order_service_details[0]->order->delivery_status=="Completed")--}}
{{--                            <button title="Rate This Service" type = "button" class="btn btn-sm btn-info mb-5" data-toggle="modal" data-target="#servicereviewModal"><i class="fa fa-star text-light mr-1" aria-hidden="true"></i>Rate Our Service</button>--}}
{{--                        @else--}}
{{--                        @endif--}}
{{--                    </div>--}}
                    <div class="col-md-12 " style="">
                        <table id="example" class="table  " style="width:100%;overflow-x:auto;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Service Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_service_details as $key => $order)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-bold"> - {{$order->name}}</td>
                                    <td class="text-center">{{$order->service_price}}TK</td>
                                    <td class="text-center">{{$order->service_quantity}}</td>
                                    <td class="text-center">{{$order->total}}TK</td>
                                </tr>
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
