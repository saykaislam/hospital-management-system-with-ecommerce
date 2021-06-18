<div  id="print_setion">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Main CSS -->
{{--<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">--}}

<style type="text/css">
    @media print {
        /*.wrapper { position: absolute; font-size: 200px !important; }*/
    }
</style>
<!-- Printable area end -->
<div class="wrapper">

    <!-- Page Content -->

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="invoice-content">
                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-md-6" style="float: left">
                                <div class="invoice-logo">
                                    <img src="{{asset('uploads/logo.jpg')}}" width="200px" height="auto" alt="logo">
                                </div>
                            </div>
                            <div class="col-md-6" style="float:right;font-size: 24px;">
                                <p class="invoice-details">
                                    <strong>Order:</strong> #{{$order->invoice_code}} <br>
                                    <strong>Issued:</strong> {{$order->created_at}}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Invoice Item -->
                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-md-6" style="float: left">
                                <div class="invoice-info">
                                    <strong class="customer-text" style="font-size: 24px;">Invoice From</strong>
                                    <p class="invoice-details invoice-details-two" style="font-size: 24px;">
                                        PreventCare <br>
                                        CNS Tower,West Panthapath,<br>
                                        Dhaka, Bangladesh 1216<br>
                                        Phone: +88-02-9121880<br>
                                        Email: info@preventcare.com
                                    </p>
                                </div>
                            </div>
                            @php
                                $shipping_info = json_decode($order->shipping_address);
                            @endphp
                            <div class="col-md-6" style="float: right">
                                <div class="invoice-info invoice-info2">
                                    <strong class="customer-text" style="font-size: 24px;">Invoice To</strong>
                                    <p class="invoice-details" style="font-size: 24px;">
                                        <strong>{{$shipping_info->name}}</strong><br>
                                        House-{{$shipping_info->house}},Road-{{$shipping_info->road}},<br>
                                        {{$shipping_info->area}},Dhaka<br>
                                        Phone: {{$shipping_info->phone}}<br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Invoice Item -->

                    <!-- Invoice Item -->
                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice-info">
                                    <strong class="customer-text" style="font-size: 24px;">Payment Method</strong>
                                    <p class="invoice-details invoice-details-two" style="font-size: 24px;">
                                        {{$order->payment_type}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Invoice Item -->

                    <!-- Invoice Item -->
                    <div class="invoice-item invoice-table-wrap">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="invoice-table table table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="font-size: 24px;">Serial #</th>
                                            <th style="font-size: 24px;" class="text-center">Product</th>
                                            <th style="font-size: 24px;" class="text-center">Qty</th>
                                            <th style="font-size: 24px;" class="text-right">Subtotal</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order_details as $key => $orders)
                                            <tr>
                                                <td style="font-size: 24px;">{{$key+1}}</td>
                                                <td style="font-size: 24px;" class="text-center">{{$orders->service_name}}</td>
                                                <td style="font-size: 24px;" class="text-center">{{$orders->service_quantity}}</td>
                                                <td style="font-size: 24px;" class="text-right">৳ {{$orders->service_sub_total}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4 ml-auto">
                                <div class="table-responsive">
                                    <table class="invoice-table-two table">
                                        <tbody>
                                        <tr>
                                            <th style="font-size: 24px;">Subtotal:</th>
                                            <td style="font-size: 24px;">৳ {{$order->grand_total}}</td>
                                        </tr>
                                        <tr>
                                            <th style="font-size: 24px;">Total Amount:</th>
                                            <td style="font-size: 24px;">৳ {{$order->grand_total}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Invoice Item -->

                </div>
            </div>
        </div>
    </div>
</div>
</div>


<script type="text/javascript">

    function printDivSection() {
        var Contents_Section = document.getElementById("print_setion").innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = Contents_Section;

        window.print();

        document.body.innerHTML = originalContents;
    }

    (function () {
        printDivSection()
    }());


</script>


