@extends('backend.layouts.user.master')
@section('title', 'Favorite Shop List')
@push('css')
    {{--custom css--}}

@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>Favorite Shops</h5>
                    <div class=" table-responsive" style="">
                        <table id="example" class="table  " style="width:100%;overflow-x:auto;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Shop Image</th>
                                <th class="text-center">Shop Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($favoriteShops as $key => $favoriteShop)
                                <tr>
                                    <td class="text-center">{{$key+1}}</td>
                                    <td><img src="{{url($favoriteShop->shop->logo)}}" width="100" height="80"></td>
                                    <td class="text-bold"> <a href="{{route('shop.details',$favoriteShop->shop->slug)}}">{{$favoriteShop->shop->name}}</a></td>
                                    <td class="text-center">
                                        <a class="btn btn-info text-center" href="{{route('remove.favorite-shop',$favoriteShop->shop_id)}}" id="add_to_cart">Unfolow</a>
                                    </td>
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
