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
                    <div class="col-md-12 " style="">
                        <table id="example" class="table  " style="width:100%;overflow-x:auto;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_lab_details as $key => $order)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-bold"> {{$order->test_name}}</td>
                                    <td class="text-center">{{$order->test_price}}TK</td>
                                    <td class="text-center">{{$order->test_quantity}}</td>
                                    <td class="text-center">{{$order->test_price*$order->test_quantity}}TK</td>
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
