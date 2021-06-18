@extends('backend.layouts.clinic.master')
@section('title', 'Lab Test')
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
                        <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Details</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Total</th>
                                <th>My Address</th>
                                <th>Delivery Status</th>
                                <th>Invoice</th>
                                <th>Payment</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($labTestOrders as $key => $order)
                                @php
                                    $shipping_info = json_decode($order->shipping_address);
                                    //dd($shipping_info);
                                @endphp
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-center">
                                        <a href="{{route('clinic.lab.test.list',$order->id)}}"  class="btn btn-sm btn-info services">Tests</a>
                                    </td>
                                    <td class="text-center">{{$shipping_info->name}}</td>
                                    <td class="text-center">{{$shipping_info->phone}}</td>
                                    <td class="text-center">{{$order->grand_total}}TK</td>
                                    <td>{{$shipping_info->address}}</td>
                                    <td class="text-center">
                                        {{$order->delivery_status}}
                                    </td>
                                    <td class="text-center">{{$order->invoice_code}}</td>
                                    <td class="text-center">{{$order->payment_status}}</td>
{{--                                    <td>--}}
{{--                                        @if($order->delivery_status=="Pending")--}}
{{--                                            <a href="{{route('user.cancel.order',$order->id)}}" class="btn btn-sm btn-danger ml-1" title="Click To Cancel The Order" ><i class="fa fa-times" aria-hidden="true"></i></a>--}}
{{--                                        @else--}}
{{--                                            {{$order->delivery_status}}--}}
{{--                                        @endif--}}
{{--                                    </td>--}}

                                    @if($order->delivery_status=="Completed")
                                        <td>Completed</td>
                                    @elseif($order->delivery_status=="Canceled")
                                        <td>Canceled</td>
                                    @else
                                        <td width="200px;">
                                            <form method="POST" action ="{{route('lab.order.delivery.status')}}">
                                                @csrf
                                                <input type = "hidden" name="order_id" value="{{$order->id}}">
                                                <select name="status" id="" class="form-control delivery" onchange="this.form.submit()">
                                                    <option value="Pending" {{$order->delivery_status == "Pending" ? 'selected' : ''}}>Pending</option>
                                                    <option value="Processing" {{$order->delivery_status == "Processing" ? 'selected' : ''}}>Processing</option>
                                                    <option value="Completed" {{$order->delivery_status == "Completed" ? 'selected' : ''}}>Completed</option>
                                                    <option value="Canceled" {{$order->delivery_status == "Canceled" ? 'selected' : ''}}>Cancel</option>
                                                </select>
                                            </form>
                                        </td>
                                    @endif

                                </tr>


                                <!-- Edit Time Slot Modal -->
                                <div class="modal fade custom-modal" id="service_provider_review_{{$order->id}}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Time Slots</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h4 class="text-center">Write Your Review</h4>
                                                <div class=" px-1">
                                                    <form class="" method="POST" action="{{route('user.service_provider.review')}}">
                                                        <br>
                                                        @csrf
                                                        <div class="dc-registerformgroup">
                                                            <div class="form-group ">
                                                                <label for="" class="text-dark" style="font-size: 17px">How would you rate <u>service provider</u>?</label>
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
                                                            <input type = "hidden" name="service_provider_id" value="{{$order->service_provider_id}}">
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
                                <!-- /Edit Time Slot Modal -->

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
