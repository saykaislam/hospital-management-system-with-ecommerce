@extends('backend.layouts.admin.master')
@section("title","Seller Payment History")
@push('css')

@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Seller Payment History</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Seller Payment History</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Recent Orders -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                                    <thead>
                                    <tr>
                                        <th>#Id</th>
                                        <th>Date</th>
                                        <th>Seller Name</th>
                                        <th>Shop Name</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($paymentHistories as $key => $paymentHistory)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{date('jS F Y H:i A',strtotime($paymentHistory->created_at))}}</td>
                                            <td>{{$paymentHistory->seller->user->name}}</td>
                                            <td>{{$paymentHistory->seller->shop->name}}</td>
                                            <td>৳{{$paymentHistory->amount}}</td>
                                            <td>{{$paymentHistory->payment_method}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Recent Orders -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@stop
@push('js')

    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
