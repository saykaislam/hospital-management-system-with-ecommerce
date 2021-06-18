<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prevent Care | Invoice Print</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/seller/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/seller/dist/css/adminlte.min.css')}}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h2 class="page-header">
{{--                    <img src="{{asset('frontend/img/logo-mudi-hat.png')}}">--}}
                    <i class="fas fa-globe"></i> Prevent Care
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row ">

            <div class="col-sm-4 ">
                Company Info
                <address>
                    <strong>Mudi Hat</strong><br>
                    <strong>Prevent Care</strong><br>
                    <b>Address :</b> Flat No #E1, Home No #2023, Abdus Sobhan Dhali Road, Solmaid, Vatara, Dhaka-1229 (Near Evercare Hospital Dhaka)<br>
                    <b>Phone :</b> 8801404002233<br>
                    <b>Email :</b> preventcareltd@gmail.com<br>
                </address>
            </div>
            <!-- /.col -->
            @php
                $shippingInfo = json_decode($order->shipping_address)
            @endphp
            <div class="col-sm-4">
                Shipping Info
                <address>
                    <b>Name:</b> {{$shippingInfo->name}} <br>
                    <b>Phone: </b> {{$shippingInfo->phone}} <br>
                    <b>Email: </b> {{$shippingInfo->email}}<br>
                    <b>Address: </b> {{$shippingInfo->address}}<br>
                    @if(!empty($shippingInfo->postal_code))
                        <b>Postal Code: </b> {{$shippingInfo->postal_code}}<br>
                    @endif
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice Info</b><br>
                <b>Invoice Code:</b> {{$order->invoice_code}}<br>
                <b>Date of Order:</b> {{date('jS F Y',strtotime($order->created_at))}}<br>
{{--                <b>Transaction ID:</b> {{$order->transaction_id}}--}}
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        @php
            $orderDetails = \App\OrderDetails::where('order_id',$order->id)->get();
//dd($orderDetails);

        @endphp
        <div class="row" style="padding: 20px">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Product Variant</th>
                        <th>Payment Type</th>
                        <th>Qty</th>
                        <th>Vat</th>
                        <th>Labour Cost</th>
                        <th>Grand Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orderDetails as $key=>$orderDetail)

                        <tr>
                            <td>{{$key +1 }}</td>
                            <td>{{$orderDetail->product_name}}</td>
                            @if(!empty($orderDetail->productStock))
                                @php
                                    $name = explode('-', $orderDetail->productStock->variant);
                                @endphp
                                <td>
                                    @for($i = 0; $i< count($name); $i++ )
                                        {{$name[$i]}}
                                    @endfor
                                </td>
                            @else
                                <td><p>Empty</p></td>
                            @endif
                            <td>{{$orderDetail->order->payment_status}}</td>
                            <td>{{$orderDetail->product_quantity}}</td>
                            <td>{{$orderDetail->vat}}</td>
                            <td>{{$orderDetail->labour_cost}}</td>
                            <td>{{($orderDetail->product_price * $orderDetail->product_quantity) + $orderDetail->vat + $orderDetail->labour_cost}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
            </div>
            <!-- /.col -->
            <div class="col-6">
                {{--                <p class="lead">Amount Due 2/22/2014</p>--}}

                <div class="table-responsive">
                    <table class="table">

                        <tr>
                            <th>Total Vat:</th>
                            <td>{{$order->total_vat}}</td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td>{{$order->delivery_cost}}</td>
                        </tr>
                        <tr>
                            <th>Total Labour Cost:</th>
                            <td>{{$order->total_labour_cost}}</td>
                        </tr>
                        <tr>
                            <th>Discount:</th>
                            <td>{{$order->discount ? $order->discount : 0}}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>{{$order->grand_total}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>
</body>
</html>
