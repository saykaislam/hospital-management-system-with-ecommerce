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
                        <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Details</th>
                                <th>Service Date</th>
                                <th>Service Time</th>
                                {{--                        <th>Order Place Time</th>--}}
                                <th>Total</th>
                                <th>My Address</th>
                                <th>Selected Service Provider</th>
                                <th>Invoice</th>
                                <th>Payment</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key => $order)
                                @php
                                    $shipping_info = json_decode($order->shipping_address);
                                    //dd($shipping_info);
                                @endphp
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-center">
                                        <a href="{{route('user.service.list',$order->id)}}"  class="btn btn-sm btn-info services">Services</a>
                                    </td>
                                    <td class="text-center">{{$shipping_info->service_date}}</td>
                                    <td class="text-center">{{$shipping_info->service_time}}</td>
                                    {{--                            <td>{{date("F j, Y, g:i a",strtotime($order->created_at))}}</td>--}}
                                    <td class="text-center">{{$order->grand_total}}TK</td>
                                    <td>house-{{$shipping_info->house}},road-{{$shipping_info->road}},{{$shipping_info->area}}</td>
                                    {{--                                    <td class="text-center text-bold">{{$order->vendor->title}}--}}
                                    <td class="text-center text-bold">
                                        @if($order->delivery_status=="Completed")
                                            <button title="Rate This Vendor" type = "button" class="btn btn-sm btn-info text-dark" data-toggle="modal" data-target="#vendorreviewModal_{{$order->id}}"><i class="fa fa-star text-light" aria-hidden="true"></i></button>
                                        @else
                                        @endif
                                    </td>
                                    <td class="text-center">{{$order->invoice_code}}</td>
                                    <td class="text-center"></td>
                                    <td>
                                        @if($order->delivery_status=="Pending")
                                            <a href="{{route('user.cancel.order',$order->id)}}" class="btn btn-sm btn-danger ml-1" title="Click To Cancel The Order" ><i class="fa fa-times" aria-hidden="true"></i></a>
                                        @else
                                            {{$order->delivery_status}}
                                        @endif
                                    </td>
                                </tr>
                                <div class="modal fade " id="vendorreviewModal_{{$order->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content dcinfo-shadow dcinfo-header ">
                                            <div class="modal-body text-center">
                                                <h4 class="text-center">Write Your Review</h4>
                                                <div class=" px-1">
                                                    <form class="" method="POST" action="{{route('user.service_provider.review')}}">
                                                        <br>
                                                        @csrf
                                                        <div class="dc-registerformgroup">
                                                            <div class="form-group ">
                                                                <label for="" class="text-dark" style="font-size: 17px">How would you rate <u>Service provider</u>?</label>
                                                                <div class="rate mt-2">
                                                                    <input type="radio" id="star{{$order->id}}" name="star" value="5" />
                                                                    <label for="star{{$order->id}}" title="5 star">5 stars</label>
                                                                    <input type="radio" id="starr{{$order->id}}" name="star" value="4" />
                                                                    <label for="starr{{$order->id}}" title="4 star">4 stars</label>
                                                                    <input type="radio" id="starrr{{$order->id}}" name="star" value="3" />
                                                                    <label for="starrr{{$order->id}}" title="3 star">3 stars</label>
                                                                    <input type="radio" id="starrrr{{$order->id}}" name="star" value="2" />
                                                                    <label for="starrrr{{$order->id}}" title="2 star">2 stars</label>
                                                                    <input type="radio" id="starrrrr{{$order->id}}" name="star" value="1" />
                                                                    <label for="starrrrr{{$order->id}}" title="1 star">1 star</label>
                                                                </div>
                                                            </div>
                                                            <input type = "hidden" name="vendor_id" value="{{$order->vendor_id}}">
                                                            <div class="form-group service-modal-height px-4" >
                                                                <label for="health-problem " class=" text-dark" style="font-size: 18px">How is your experience?</label>
                                                                <textarea type="text" name="description" style="border: 2px solid #174ed8;border-radius: 10px" class="form-control mt-3" placeholder=""  rows="6"></textarea>
                                                            </div>
                                                            <div class="form-group text-center">
                                                                <button type="submit" class="ttm-btn ttm-btn-size-md ttm-btn-shape-square ttm-btn-style-border ttm-btn-color-black">submit review</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
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
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
