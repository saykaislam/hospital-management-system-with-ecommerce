@extends('backend.layouts.user.master')
@section('title', 'Product Wishlist')
@push('css')
    {{--custom css--}}

@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>Product Wishlist</h5>
                    @if(count($wishlists) > 0)
                        <div class=" table-responsive" style="">
                        <table id="example" class="table  " style="width:100%;overflow-x:auto;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Image</th>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Stock Status</th>
                                <th class="text-center">Cart</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($wishlists as $key => $wishlist)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td><img src="{{url($wishlist->product->thumbnail_img)}}" width="100" height="80"></td>
                                    <td class="text-bold"> {{$wishlist->product->name}}</td>
                                    <td class="text-center">{{$wishlist->product->unit_price}}TK</td>
                                    <td class="text-center">
                                        @if($wishlist->product->current_stock = 100000)
                                            <span class="badge badge-success">Available</span>
                                        @else
                                            <span class="badge badge-danger">Not Available</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-info text-center" href="{{route('product-details',$wishlist->product->slug)}}" id="add_to_cart">Cart</a>
                                        <a class="btn btn-info text-center" href="{{route('user.remove.wishlist',$wishlist->id)}}" id="add_to_cart">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <p style="text-align: center">No Wishlist Found Yet!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@push('js')

@endpush
