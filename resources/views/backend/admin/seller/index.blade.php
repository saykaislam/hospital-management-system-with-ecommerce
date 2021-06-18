@extends('backend.layouts.admin.master')
@section('title', 'Seller List')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-7 col-auto">
                            <h3 class="page-title">Seller List</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Seller List</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="order" class="table" style="width:100%;overflow-x:auto;">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Seller  Name</th>
                                            <th>Shop Name</th>
                                            <th>Seller Email</th>
                                            <th>Seller Phone</th>
                                            <th>Approval</th>
                                            <th>Commission</th>
                                            <th>Num. of Products</th>
                                            <th>Due to seller</th>
                                            <th>Due to Admin</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sellerUserInfos as $key => $sellerUserInfo)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$sellerUserInfo->name}}</td>
                                                <td>{{$sellerUserInfo->shop->name}}</td>
                                                <td>{{$sellerUserInfo->email}}</td>
                                                <td>{{$sellerUserInfo->phone}}</td>
                                                <td>
                                                    @if($sellerUserInfo->banned == 0)
                                                        <div class="form-group col-md-2">
                                                            <div class="status-toggle" style="">
                                                                <input onchange="verification_status(this)" value="{{ $sellerUserInfo->seller->id }}" {{$sellerUserInfo->seller->verification_status == 1? 'checked':''}} type="checkbox" id="{{ $sellerUserInfo->id }}" class="check">
                                                                <label for="{{ $sellerUserInfo->id }}" class="checktoggle">checkbox</label>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <strong class="badge badge-danger w-100">Banned</strong>
                                                    @endif
                                                </td>
                                                <td><strong class="badge badge-info w-100">{{$sellerUserInfo->seller->commission}}%</strong></td>
                                                <td>{{$sellerUserInfo->products->count()}}</td>
                                                <td>{{$sellerUserInfo->seller->admin_to_pay}}</td>
                                                <td>{{$sellerUserInfo->seller->seller_will_pay_admin}}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="bg-info dropdown-item" href="{{route('admin.seller.profile.show',encrypt($sellerUserInfo->id))}}">
                                                                <i class="fa fa-user"></i> Profile
                                                            </a>
                                                            <a class="bg-success dropdown-item" onclick="show_seller_payment_modal('{{$sellerUserInfo->seller->id}}');" href="#">
                                                                <i class="fa fa-money"></i> Pay To Seller
                                                            </a>
                                                            <a class="bg-primary dropdown-item" onclick="show_admin_payment_modal('{{$sellerUserInfo->seller->id}}');" href="#">
                                                                <i class="fa fa-money"></i> Pay To Admin
                                                            </a>
                                                            <a class="bg-warning dropdown-item" onclick="show_seller_commission_modal('{{$sellerUserInfo->seller->id}}');" href="#">
                                                                <i class="fa fa-money-bill-wave"></i> Set Commission
                                                            </a>
                                                            <a class="bg-secondary dropdown-item" href="{{route('admin.seller.payment.history',$sellerUserInfo->id)}}">
                                                                <i class="fa fa-history"></i> Payment History
                                                            </a>
                                                            <a class="bg-danger dropdown-item" href="{{route('admin.sellers.ban',$sellerUserInfo->id)}}">
                                                                <i class="fa fa-ban"></i> Ban this seller
                                                            </a>
                                                        </div>
                                                    </div>
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
            </div>
        </div>
        <!-- /Page Wrapper -->

        {{-- Modal html start--}}
        <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="modal-content">

                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );

        function verification_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin.seller.verification') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    //toastr.success('success', 'Todays Deal updated successfully');
                }
                else{
                    //toastr.danger('danger', 'Something went wrong');
                }
            });
        }
        function show_seller_payment_modal(id){
            $.post('{{ route('admin.sellers.payment_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#payment_modal #modal-content').html(data);
                $('#payment_modal').modal('show', {backdrop: 'static'});

            });
        }
        function show_admin_payment_modal(id){
            $.post('{{ route('admin.payment_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#payment_modal #modal-content').html(data);
                $('#payment_modal').modal('show', {backdrop: 'static'});

            });
        }
        function show_seller_commission_modal(id){
            $.post('{{ route('admin.sellers.commission_modal') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#payment_modal #modal-content').html(data);
                $('#payment_modal').modal('show', {backdrop: 'static'});

            });
        }

    </script>
@endpush
