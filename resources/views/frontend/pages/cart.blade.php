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
                    <h2 class="breadcrumb-title">Cart</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        @if(Cart::count()==0)
            <div class="container">
                <div class="row">
                    <div class="col-12  text-center">
                        <img src = "https://i.pinimg.com/originals/2e/ac/fa/2eacfa305d7715bdcd86bb4956209038.png" alt = "" width="500px">
                    </div>

                </div>
            </div>

        @else
            <div class="container">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Approx.Proce</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Cart::content() as $service)
                                    <tr>
                                        <td>
                                            <p>{{$service->name}}</p>
                                        </td>
                                        <td>
                                            Tk.{{$service->price}}
                                        </td>
                                        <td>
                                            <form method="post" action="{{route('qty.update')}}">
                                                @csrf
                                                <input type="number" name="quantity" class="input-text" value="{{$service->qty}}" min="0" title="Qty" size="4" onchange="this.form.submit()">
                                                <input type = "hidden" name="rid" value="{{$service->rowId}}">
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            Tk.{{$service->price*$service->qty}}
                                        </td>
                                        <td class="text-right">
                                            <div class="table-action">
                                                <a href="{{route('cart.remove',$service->rowId)}}" class="btn btn-sm bg-danger-light">
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
                                        <a href="{{route('cart.remove.all')}}" class="button text-danger" name="update_cart">Clear Cart</a>
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
                                                        @if(Auth::guest())
                                                            <a href="/login" class="checkout-button button">Login First</a>
                                                        @else
                                                            @if(Cart::count() > 0)
                                                                @if(Cart::content()->first()->options['cart_type']=="service")
                                                                    <a href="/checkout" class="checkout-button button">Proceed to checkout</a>
                                                                @else
                                                                    <a href="/checkout-product" class="checkout-button button">Proceed to checkout</a>
                                                                @endif
                                                            @endif
                                                        @endif
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
        @endif

    </div>
    <!-- /Page Content -->
@stop
@push('js')

@endpush
