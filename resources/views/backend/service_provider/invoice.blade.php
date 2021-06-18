@extends('backend.layouts.service_provider.master')
@section("title","Invoice")
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="main-wrapper">

      <!-- Page Content -->

          <div class="container-fluid">

              <div class="row">
                  <div class="col-md-12">
                      <div class="invoice-content">
                          <div class="invoice-item">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="invoice-logo">
                                          <img src="{{asset('uploads/logo.jpg')}}" alt="logo">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
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
                                  <div class="col-md-6">
                                      <div class="invoice-info">
                                          <strong class="customer-text">Invoice From</strong>
                                          <p class="invoice-details invoice-details-two">
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
                                  <div class="col-md-6">
                                      <div class="invoice-info invoice-info2">
                                          <strong class="customer-text">Invoice To</strong>
                                          <p class="invoice-details">
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
                                          <strong class="customer-text">Payment Method</strong>
                                          <p class="invoice-details invoice-details-two">
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
                                                  <th>Serial #</th>
                                                  <th class="text-center">Product</th>
                                                  <th class="text-center">Qty</th>
                                                  <th class="text-right">Subtotal</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                              @foreach($order_details as $key => $orders)
                                              <tr>
                                                  <td>{{$key+1}}</td>
                                                  <td class="text-center">{{$orders->service_name}}</td>
                                                  <td class="text-center">{{$orders->service_quantity}}</td>
                                                  <td class="text-right">৳ {{$orders->service_sub_total}}</td>
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
                                                  <th>Subtotal:</th>
                                                  <td><span>৳ {{$order->grand_total}}</span></td>
                                              </tr>
{{--                                              <tr>--}}
{{--                                                  <th>Discount:</th>--}}
{{--                                                  <td><span>-10%</span></td>--}}
{{--                                              </tr>--}}
                                              <tr>
                                                  <th>Total Amount:</th>
                                                  <td><span>৳ {{$order->grand_total}}</span></td>
                                              </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- /Invoice Item -->

                          <div class="row no-print">
                              <div class="col-12">
                                  <a href="{{route('service.provider.invoice.print',$order->id)}}" target="_blank" class="btn btn-success"><i class="fas fa-print"></i> Print</a>
                              </div>
                          </div>

                      </div>
                  </div>
              </div>

          </div>


      <!-- /Page Content -->


  </div>
  <!-- /.content-wrapper -->
@stop
