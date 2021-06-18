@extends('frontend.layouts.master')
@section('title', 'Home')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">
            <div class="card card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th >Test Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Lab</th>
                                <th class="text-center">Delivery Type</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Approx.Proce</th>
                                <th class="text-center">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(Cart::content() as $test)
                                <tr>
                                    <td >
                                        <p>{{$test->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        Tk.{{$test->price}}
                                    </td>
                                    <td class="text-center">
                                        {{$test->options->lab_name}}
                                    </td>
                                    <td class="text-center">
                                        @if($test->options->delivery_type=="from_lab")
                                            Collect from lab
                                        @else
                                            Deliver to Home
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form method="post" action="{{route('qty.update')}}">
                                            @csrf
                                            <input type="number" name="quantity" class="input-text" value="{{$test->qty}}" min="0" title="Qty" size="4" onchange="this.form.submit()">
                                            <input type = "hidden" name="rid" value="{{$test->rowId}}">
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        Tk.{{$test->price*$test->qty}}
                                    </td>
                                    <td class="text-center">
                                        <div class="table-action">
                                            <a href="{{route('cart.remove',$test->rowId)}}" class="btn btn-sm bg-danger-light">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" class="text-right">
                                    {{--                                            <div class="coupon">--}}
                                    {{--                                                <input type="text" name="coupon_code" class="input-text" value="" placeholder="Coupon code">--}}
                                    {{--                                                <button type="submit" class="button" name="apply_coupon" value="Apply coupon">Apply coupon</button>--}}
                                    {{--                                            </div>--}}
                                    <a href="{{route('cart.remove.all')}}" class="btn btn-danger mr-4" name="update_cart">Clear Cart</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7 col-lg-8">
                </div>
                <div class="col-md-5 col-lg-4">
                    <!-- Booking Summary -->
                    <div class="card booking-card">
                        <div class="card-header">
                            <h4 class="card-title">Cart Totals</h4>
                        </div>
                        <div class="card-body">
                            <div class="booking-summary">
                                <div class="booking-item-wrap">
                                    <ul class="booking-date">
                                        <li>Subtotal <span>Tk.{{Cart::subtotal()}}</span></li>
                                        {{--                                        <li>Shipping <span>$25.00</span></li>--}}
                                    </ul>
                                    <div class="booking-total">
                                        <ul class="booking-total-list">
                                            <li>
                                                <span>Total</span>
                                                <span class="total-cost">Tk.{{Cart::subtotal()}}</span>
                                            </li>
                                            <li>
                                                <div class="clinic-booking pt-4">
                                                        <a href="{{route('test.checkout')}}" class="checkout-button button">Proceed to checkout</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Booking Summary -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
@stop
@push('js')

@endpush
