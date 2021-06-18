
@extends('backend.layouts.admin.master')
@section("title","Sub Category")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <style>
        li{
            list-style:none;
        }

    </style>
@endpush
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Seller Request Product List</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Seller Request Product List</li>
                        </ul>
                    </div>
                    <div class="col-sm-5 col">
                        <a href="{{route('admin.products.create')}}" class="btn btn-primary float-right mt-2">Add New</a>
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
                                        <th>Icon</th>
                                        <th>Shop Name</th>
                                        <th>Name</th>
                                        <th>Total Stock</th>
                                        <th>Base Price</th>
                                        <th>Today's Deal</th>
                                        <th>Published</th>
                                        <th>Featured</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $key => $product)
                                        @php
                                            $shop = \App\Shop::where('user_id',$product->user_id)->first();
                                        @endphp
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>
                                                <img src="{{url($product->thumbnail_img)}}" width="32" height="32" alt="">
                                            </td>
                                            <td>
                                                <a target="_blank" href="">
                                                    {{$shop->name}}
                                                </a>
                                            </td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->current_stock}}</td>
                                            <td>{{$product->unit_price}}</td>
                                            <td>
                                                <div class="form-group col-md-2">
                                                    <div class="status-toggle" style="">
                                                        <input onchange="update_todays_deal(this)" value="{{ $product->id }}" {{$product->todays_deal == 1 ? 'checked':''}} type="checkbox" id="today_{{ $product->id }}" class="check">
                                                        <label for="today_{{ $product->id }}" class="checktoggle">checkbox</label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group col-md-2">
                                                    <div class="status-toggle" style="">
                                                        <input onchange="update_published(this)" value="{{ $product->id }}" {{$product->published == 1 ? 'checked':''}} type="checkbox" id="published_{{ $product->id }}" class="check">
                                                        <label for="published_{{ $product->id }}" class="checktoggle">checkbox</label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group col-md-2">
                                                    <div class="status-toggle" style="">
                                                        <input onchange="update_featured(this)" value="{{ $product->id }}" {{$product->featured == 1 ? 'checked':''}} type="checkbox" id="featured_{{ $product->id }}" class="check">
                                                        <label for="featured_{{ $product->id }}" class="checktoggle">checkbox</label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="btn btn-info waves-effect" href="">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>#Id</th>
                                        <th>Icon</th>
                                        <th>Shop Name</th>
                                        <th>Name</th>
                                        <th>Total Stock</th>
                                        <th>Base Price</th>
                                        <th>Today's Deal</th>
                                        <th>Published</th>
                                        <th>Featured</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
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
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>
        //product todays_deal
        function update_todays_deal(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin.products.todays_deal') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Todays Deal updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
        //product published
        function update_published(el){
            if(el.checked){
                //alert('if')
                var status = 1;
            }
            else{
                //alert('else')
                var status = 0;
            }
            $.post('{{ route('admin.products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Published products updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
        //product featured product
        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin.products.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Featured products updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
    </script>

    <script !src = "">
        $(document).ready( function () {
            $('#order').DataTable();
        } );
    </script>
@endpush
