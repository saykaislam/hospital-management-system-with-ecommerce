@extends('backend.layouts.user.master')
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
                        <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Rating</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_product_details as $key => $order_product_detail)
                                @php
                                    $review = \App\ProductReview::where('order_id',$order->id)->where('user_id',$order->user_id)->where('product_id',$order_product_detail->product_id)->first();
                                @endphp
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-bold"> {{$order_product_detail->product_name}}</td>
                                    <td class="text-center">{{$order_product_detail->product_price}}TK</td>
                                    <td class="text-center">{{$order_product_detail->product_quantity}}</td>
                                    <td class="text-center">{{$order_product_detail->product_price*$order_product_detail->product_quantity}}TK</td>
                                    <td class="text-center">
                                        @if($order->delivery_status=="Completed" && empty($review))
                                            <button title="Rate This Vendor" type = "button" class="btn btn-sm btn-info text-dark" data-toggle="modal" data-target="#service_provider_review_{{$order_product_detail->product_id}}"><i class="fa fa-star text-light" aria-hidden="true"></i></button>
                                        @elseif(!empty($review))
                                            <i title="Review submitted!" class="fa fa-check-square text-success text-bold"></i>
                                        @else
                                            <p>Order not Delivered yet</p>
                                        @endif
                                    </td>
                                </tr>


                                <!-- Rating Modal Start -->
                                <div class="modal fade custom-modal" id="service_provider_review_{{$order_product_detail->product_id}}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Rating</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h4 class="text-center">Write Your Review</h4>
                                                <div class=" px-1">
                                                    <form class="" method="POST" action="{{route('user.product.review')}}">
                                                        <br>
                                                        @csrf
                                                        <div class="dc-registerformgroup">
                                                            <div class="form-group ">
                                                                <label for="" class="text-dark" style="font-size: 17px">How would you rate <u>{{$order_product_detail->product->name}}</u>?</label>
                                                                <div class="rate mt-2">
                                                                    <input type="radio" id="star{{$order_product_detail->product_id}}" name="rating" value="5" />
                                                                    <label for="star{{$order_product_detail->product_id}}" title="5 star">5 stars</label>
                                                                    <input type="radio" id="starr{{$order_product_detail->product_id}}" name="rating" value="4" />
                                                                    <label for="starr{{$order_product_detail->product_id}}" title="4 star">4 stars</label>
                                                                    <input type="radio" id="starrr{{$order_product_detail->product_id}}" name="rating" value="3" />
                                                                    <label for="starrr{{$order_product_detail->product_id}}" title="3 star">3 stars</label>
                                                                    <input type="radio" id="starrrr{{$order_product_detail->product_id}}" name="rating" value="2" />
                                                                    <label for="starrrr{{$order_product_detail->product_id}}" title="2 star">2 stars</label>
                                                                    <input type="radio" id="starrrrr{{$order_product_detail->product_id}}" name="rating" value="1" />
                                                                    <label for="starrrrr{{$order_product_detail->product_id}}" title="1 star">1 star</label>
                                                                </div>
                                                            </div>
                                                            <input type = "hidden" name="order_id" value="{{$order_product_detail->order_id}}">
                                                            <input type = "hidden" name="product_id" value="{{$order_product_detail->product_id}}">
                                                            <div class="form-group service-modal-height px-4" >
                                                                <label for="health-problem " class=" text-dark" style="font-size: 18px">How is your experience?</label>
                                                                <textarea type="text" name="comment" style="border: 2px solid #174ed8;border-radius: 10px" class="form-control mt-3" placeholder=""  rows="6"></textarea>
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
                                <!-- /Rating Modal End -->


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
