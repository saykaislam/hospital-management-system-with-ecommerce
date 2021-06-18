@extends('backend.layouts.admin.master')
@section("title","Due to Seller")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/admin/plugins/select2/select2.min.css')}}">
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Due to Seller</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Due to Seller</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Recent Orders -->
                    <div class="card">
                        <div class="callout callout-info">
                            <div class="card card-info" style="padding: 20px 40px 40px 40px;">
                                <form role="form" action="{{route('admin.due-to-seller-details')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Seller List</label>
                                            <select name="seller_id" id="" class="form-control select2">
                                                @foreach($sellers as $seller)
                                                    <option value="{{$seller->id}}" {{$sellerId == $seller->id ? 'selected' : ''}}>{{$seller->name}} ({{$seller->shop->name}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-4" style="margin-top: 30px">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                @if($sellerInfo != null)
                                    <table id="order" class="table  " style="width:100%;overflow-x:auto;">
                                        <thead>
                                        <tr>
                                            <th>#Id</th>
                                            <th>Shop Name</th>
                                            <th>Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{$sellerInfo->shop->name}}</td>
                                            <td>{{$sellerInfo->admin_to_pay}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <div class="text-center ">
                                        <h2><i class="fa fa-info-circle text-info"></i> Please Select Seller!!!</h2>
                                    </div>
                                @endif
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
    <script src="{{asset('backend/admin/plugins/select2/select2.full.min.js')}}"></script>

    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
    <script>
        $('.select2').select2();
    </script>
@endpush
