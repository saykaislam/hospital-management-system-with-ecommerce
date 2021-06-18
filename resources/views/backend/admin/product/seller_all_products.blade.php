@extends('backend.layouts.admin.master')
@section("title","All Seller Products")
@push('css')

@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-7 col-auto">
                        <h3 class="page-title">Products</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                                        {{--                                @dd($product->user->name)--}}
                                        @php
                                            $shop = \App\Shop::where('user_id',$product->user->id)->first();
                                        @endphp
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>
                                                <img src="{{url($product->thumbnail_img)}}" width="32" height="32" alt="">
                                            </td>
                                            <td>
                                                <a target="_blank" href="#">
                                                    {{$shop->name}}
                                                </a>
                                            </td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->current_stock}}</td>
                                            <td>{{$product->unit_price}}</td>
                                            <td>
                                                <div class="form-group col-md-2">
                                                    <label class="switch" style="margin-top:40px;">
                                                        <input onchange="update_todays_deal(this)" value="{{ $product->id }}" {{$product->todays_deal == 1? 'checked':''}} type="checkbox" >
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group col-md-2">
                                                    <label class="switch" style="margin-top:40px;">
                                                        <input onchange="update_published(this)" value="{{ $product->id }}" {{$product->published == 1 ? 'checked':''}} type="checkbox" >
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group col-md-2">
                                                    <label class="switch" style="margin-top:40px;">
                                                        <input onchange="update_featured(this)"  value="{{ $product->id }}" {{$product->featured == 1 ? 'checked':''}} type="checkbox" >
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="bg-info dropdown-item" href="{{route('admin.edit.seller.products',encrypt($product->id))}}">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <form id="delete-form-{{$product->id}}" action="{{route('admin.products.destroy',$product->id)}}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
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
                    <!-- /Recent Orders -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

    </div>

@stop
@push('js')

    <script>
        $(document).ready( function () {
            $('#order').DataTable();
        } );

        //sweet alert
        function deleteProduct(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your Data is save :)',
                        'error'
                    )
                }
            })
        }
        //today's deals
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
@endpush
