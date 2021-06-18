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
    <!-- Main Wrapper -->
    <div class="wrapper">

        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="invoice-content">
                            <div class="invoice-item">
                                <div class="row">
                                    <div class="col-md-6" style="float: left">
                                        <div class="invoice-logo">
                                            <img src="{{asset('frontend/img/logo.jpg')}}" alt="logo" height="auto" width="150px">
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="float: right">
                                        <p class="invoice-details">
                                            <strong>Order:</strong> {{$productOrder->invoice_code}} <br>
                                            <strong>Issued:</strong> {{date('Y-m-d')}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Invoice Item -->
                            <div class="invoice-item">
                                <div class="row">
                                    <div class="col-md-6" style="float: left">
                                        <div class="invoice-info">
                                            <strong class="customer-text">Invoice From</strong>
                                            <p class="invoice-details invoice-details-two">
                                                Prevent Care <br>
                                                Bashundhara Abashik Area,<br>
                                                Dhaka, Bangladesh <br>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="float: right">
                                        <div class="invoice-info invoice-info2">
                                            <strong class="customer-text">Invoice To</strong>
                                            <p class="invoice-details">
                                                @php
                                                    $shipping_info = json_decode($productOrder->shipping_address);
                                                @endphp
                                                {{$shipping_info->address}}
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
                                            <strong class="customer-text">Payment Method</strong>
                                            <p class="invoice-details invoice-details-two">
                                                {{$productOrder->payment_type}}
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
                                                    <th>Description</th>
                                                    <th class="text-center">Price</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(!empty($productOrderDetails))
                                                    @foreach($productOrderDetails as $productOrderDetail)
                                                        <tr>
                                                            <td>{{$productOrderDetail->product_name}}</td>
                                                            <td>{{$product_price = $productOrderDetail->product_price}}</td>
                                                            <td>{{$product_quantity = $productOrderDetail->product_quantity}}</td>
                                                            <td>{{$product_price*$product_quantity}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xl-4 ml-auto">
                                        <div class="table-responsive">
                                            <table class="invoice-table-two table">
                                                <tbody>
                                                <tr>
                                                    <th>Subtotal:</th>
                                                    <td><span>Tk.{{$productOrder->grand_total}}</span></td>
                                                </tr>
                                                <tr>
                                                    <th>Discount:</th>
                                                    <td><span>Tk.-0</span></td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping Cost:</th>
                                                    <td><span>Tk.{{$productOrder->delivery_cost}}</span></td>
                                                </tr>
                                                <tr>
                                                    <th>Total Amount:</th>
                                                    <td><span>Tk.{{$productOrder->grand_total+$productOrder->delivery_cost}}</span></td>
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
        <!-- /Page Content -->


    </div>
    <!-- /Main Wrapper -->
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
